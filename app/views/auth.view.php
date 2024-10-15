<?php

class AuthView
{
    private $user = null;

    public function showLogin($error = '')
    {
        require 'templates/form_login.phtml';
    }

    public function showError($error)
    {
        require 'templates/error.phtml';
        require 'templates/form_login.phtml';
    }
}
