<?php

class PropertyModel
{
    private $db;

    public function __construct()
    {
        // Conexión a la base de datos inmobiliaria_db
        $this->db = new PDO('mysql:host=localhost;dbname=inmobiliaria_db;charset=utf8', 'root', '');
    }

    // Obtener todas las propiedades
    public function getProperties()
    {
        // Consulta para obtener todas las propiedades
        $query = $this->db->prepare('SELECT * FROM propiedades');
        $query->execute();

        // Obtiene las propiedades en un arreglo de objetos
        $properties = $query->fetchAll(PDO::FETCH_OBJ);

        return $properties;
    }

    // Obtener una propiedad específica por ID
    public function getProperty($id)
    {
        $query = $this->db->prepare('SELECT * FROM propiedades WHERE id = ?');
        $query->execute([$id]);

        // Obtiene la propiedad
        $property = $query->fetch(PDO::FETCH_OBJ);

        return $property;
    }

    // Insertar una nueva propiedad en la base de datos
    public function insertProperty($ubicacion, $m2, $modalidad, $id_propietario, $precio_inicial, $precio_flex)
    {
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM propietarios WHERE id = :id_propietario");
        $stmt->execute(['id_propietario' => $id_propietario]);
        if ($stmt->fetchColumn() == 0) {
            die('Error: El propietario no existe');
        }
        // Inserta una nueva propiedad con los campos necesarios
        $query = $this->db->prepare('INSERT INTO propiedades (ubicacion, m2, modalidad, id_propietario, precio_inicial, precio_flex) 
                                     VALUES (?, ?, ?, ?, ?, ?)');
        $query->execute([$ubicacion, $m2, $modalidad, $id_propietario, $precio_inicial, $precio_flex]);

        // Obtiene el último ID insertado
        $id = $this->db->lastInsertId();

        return $id;
    }

    // Obtener los detalles de una propiedad con su propietario
    public function getDetails($id)
    {
        // Consulta para obtener los detalles de la propiedad y su propietario
        $stmt = $this->db->prepare('SELECT p.ubicacion, p.m2, p.modalidad, p.precio_inicial, p.precio_flex, 
            pr.nombre, pr.apellido 
            FROM propiedades p 
            JOIN propietarios pr ON p.id_propietario = pr.id
            WHERE p.id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    // Eliminar una propiedad
    public function deleteProperty($id)
    {
        // Elimina una propiedad por su ID
        $query = $this->db->prepare('DELETE FROM propiedades WHERE id = ?');
        $query->execute([$id]);
    }

    // Actualizar una propiedad (aquí puedes ajustar los campos que desees actualizar)
    public function updateProperty($id, $ubicacion, $m2, $modalidad, $categoria_id, $precio_inicial, $precio_flex)
    {
        // Actualiza una propiedad con los datos proporcionados
        $query = $this->db->prepare('UPDATE propiedades SET ubicacion = ?, m2 = ?, modalidad = ?, categoria_id = ?, precio_inicial = ?, precio_flex = ? 
                                     WHERE id = ?');
        $query->execute([$ubicacion, $m2, $modalidad, $categoria_id, $precio_inicial, $precio_flex, $id]);
    }
}
