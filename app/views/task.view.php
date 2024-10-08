<?php

class TaskView
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

    public function showTasks($tasks)
    {
        // la vista define una nueva variable con la cantida de tareas
        $count = count($tasks);

        // NOTA: el template va a poder acceder a todas las variables y constantes que tienen alcance en esta funcion
        require 'templates/lista_tareas.phtml';
    }

    public function viewDetails($tasks)
    {
        require_once 'templates/detalles_propiedades.phtml';
    }

    public function showError($error)
    {
        require 'templates/error.phtml';
    }
}
