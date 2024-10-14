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
        require_once 'templates/home.phtml'; // Vista de inicio
    }

    public function showProperties($properties) // Cambiado de $tasks a $properties
    {
        // La vista define una nueva variable con la cantidad de propiedades
        $count = count($properties); // Cambiado de $tasks a $properties

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta función
        require 'templates/lista_propiedades.phtml'; // Cambiado el nombre a lista_propiedades.phtml
    }

    public function viewDetails($property) // Cambiado de $tasks a $property
    {
        require_once 'templates/detalles_propiedades.phtml'; // Cambiado el nombre a detalles_propiedades.phtml
    }

    public function showError($error)
    {
        require 'templates/error.phtml'; // Vista de error
    }
}
