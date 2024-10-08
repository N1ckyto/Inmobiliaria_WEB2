<?php

class TaskModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=inmobiliaria_db;charset=utf8', 'root', '');
    }

    public function getTasks()
    {
        // 2. Ejecuto la consulta
        $query = $this->db->prepare('SELECT * FROM propiedades');
        $query->execute();

        // 3. Obtengo los datos en un arreglo de objetos
        $tasks = $query->fetchAll(PDO::FETCH_OBJ);

        return $tasks;
    }


    public function getTask($id)
    {
        $query = $this->db->prepare('SELECT * FROM propiedades WHERE id = ?');
        $query->execute([$id]);

        $task = $query->fetch(PDO::FETCH_OBJ);

        return $task;
    }

    public function insertTask($title, $description, $priority, $finished = false)
    {
        $query = $this->db->prepare('INSERT INTO propiedades(ubicacion, m2, modalidad, precio_inicial) VALUES (?, ?, ?, ?)');
        $query->execute([$title, $description, $priority, $finished]);

        $id =   $this->db->lastInsertId();

        return $id;
    }

    public function getDetails($id)
    {
        // Consulta para obtener los detalles de la propiedad
        $stmt = $this->db->prepare('SELECT p.ubicacion, p.m2, p.modalidad, p.precio_inicial, p.precio_flex, pr.nombre, 
            pr.apellido 
            FROM propiedades p 
            JOIN propietarios pr ON p.id_propietario = pr.id
            WHERE p.id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function eraseTask($id)
    {
        $query = $this->db->prepare('DELETE FROM propiedades WHERE id = ?');
        $query->execute([$id]);
    }

    public function updateTask($id)
    {
        $query = $this->db->prepare('UPDATE propiedades SET finalizada = 1 WHERE id = ?');
        $query->execute([$id]);
    }
}
