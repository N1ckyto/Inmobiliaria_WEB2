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

    public function viewOwner($owner, $properties)
    {
        require 'templates/detalles_propietario.phtml'; 
    }

    public function addOwners($owners)
    {  
        $count = count($owners);
        require 'templates/agregar_propietario.phtml';
    }

    public function showEdit($id, $owner)
    {
        require 'templates/form_edit_propietario.phtml';
    }

    public function showError($error)
    {
        require 'templates/layout/header.phtml';
        require 'templates/error.phtml'; 
        require 'templates/layout/footer.phtml';
    }

    public function showHome()
    {
        require_once 'templates/home.phtml'; 
    }
    public function showAlert($alert)
    {
        require 'templates/layout/header.phtml';
        require 'templates/alert.phtml';
        require 'templates/layout/footer.phtml';
    }
}
