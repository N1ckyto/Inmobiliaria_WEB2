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
        $query = $this->db->prepare('SELECT id,nombre,apellido FROM propietarios'); 
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function countPropertiesByOwner($id)
    {
        $query = $this->db->prepare('SELECT COUNT(*) AS total FROM propiedades WHERE id_propietario = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ)->total;
    }

    public function insertOwner($nombre, $apellido,)
    {
        $query = $this->db->prepare('INSERT INTO propietarios (nombre, apellido) VALUES (?, ?)');
        $query->execute([$nombre, $apellido]);
        return $this->db->lastInsertId(); 
    }

    public function getOwner($id)
    {
        $query = $this->db->prepare('SELECT id,nombre, apellido FROM propietarios WHERE id = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function updateOwner($id, $nombre, $apellido)
    {
        $query = $this->db->prepare('UPDATE propietarios SET nombre = ?, apellido = ? WHERE id = ?');
        $query->execute([$nombre, $apellido, $id]);
    }

    public function deleteOwner($id)
    {
        $query = $this->db->prepare('DELETE FROM propietarios WHERE id = ?');
        $query->execute([$id]);
    }
}
