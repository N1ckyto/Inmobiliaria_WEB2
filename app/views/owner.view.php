<?php

class OwnerView
{
    private $user = null;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function showOwners($owners)
    {
        $count = count($owners);
        require 'templates/lista_propietarios.phtml'; 
    }

    public function viewOwner($owner)
    {
        require 'templates/detalles_propietario.phtml'; 
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
