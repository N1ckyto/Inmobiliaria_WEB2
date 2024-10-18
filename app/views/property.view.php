<?php

class PropertyView
{
    private $user = null;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function showHome()
    {
        require_once 'templates/home.phtml';
    }

    public function showProperties($properties)
    {
        $count = count($properties);
        require 'templates/lista_propiedades.phtml';
    }

    public function addProperties($properties, $owners)
    {
        $count = count($properties);
        require 'templates/agregar_propiedad.phtml';
    }

    public function viewDetails($property)
    {
        require_once 'templates/detalles_propiedades.phtml';
    }

    public function showEdit($id, $propertyDetails, $property, $owners)
    {
        require 'templates/form_edit_propierty.phtml';
    }

    public function showError($error)
    {
        require 'templates/error.phtml';
    }

    public function showAlert($alert)
    {
        require 'templates/alert.phtml';
    }
}
