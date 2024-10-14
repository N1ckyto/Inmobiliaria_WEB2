<?php

class OwnerModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=inmobiliaria_db;charset=utf8', 'root', '');
    }

    public function getOwners()
    {
        $query = $this->db->prepare('SELECT id,nombre, apellido, categoria_id FROM propietarios'); // Solo seleccionando nombre, apellido y categoría
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertOwner($nombre, $apellido, $categoria_id)
    {
        $query = $this->db->prepare('INSERT INTO propietarios (nombre, apellido, categoria_id) VALUES (?, ?, ?)');
        $query->execute([$nombre, $apellido, $categoria_id]);
        return $this->db->lastInsertId(); // Devuelve el ID del nuevo propietario
    }

    public function getOwner($id)
    {
        $query = $this->db->prepare('SELECT id,nombre, apellido, categoria_id FROM propietarios WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function updateOwner($id, $nombre, $apellido, $categoria_id)
    {
        $query = $this->db->prepare('UPDATE propietarios SET nombre = ?, apellido = ?, categoria_id = ? WHERE id = ?');
        $query->execute([$nombre, $apellido, $categoria_id, $id]);
    }

    public function deleteOwner($id)
    {
        $query = $this->db->prepare('DELETE FROM propietarios WHERE id = ?');
        $query->execute([$id]);
    }
}
