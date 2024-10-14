<?php

class CategoryView
{
    private $user = null;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function showCategories($categories)
    {
        $count = count($categories);
        require 'templates/lista_categorias.phtml'; 
    }

    public function viewCategory($category)
    {
        require 'templates/detalles_categoria.phtml'; 
    }

    public function showError($error)
    {
        require 'templates/error.phtml'; 
    }

    public function showHome()
    {
        require_once 'templates/home.phtml'; 
    }
}
