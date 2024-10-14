<?php

class CategoryModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=inmobiliaria_db;charset=utf8', 'root', '');
    }

    public function getCategories()
    {
        $query = $this->db->prepare('SELECT * FROM categorias');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }

    public function insertCategory($nombre)
    {
        $query = $this->db->prepare('INSERT INTO categorias (nombre) VALUES (?)');
        $query->execute([$nombre]);
        return $this->db->lastInsertId();
    }

    public function deleteCategory($id)
    {
        $query = $this->db->prepare('DELETE FROM categorias WHERE id = ?');
        $query->execute([$id]);
    }
}
