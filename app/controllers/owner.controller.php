<?php
require_once './app/models/owner.model.php';
require_once './app/views/owner.view.php';

class OwnerController
{
    private $model;
    private $view;

    public function __construct($res)
    {
        $this->model = new OwnerModel(); // Adaptado a OwnerModel
        $this->view = new OwnerView($res->user);
    }

    public function showHome()
    {
        return $this->view->showHome();
    }

    public function showOwners()
    {
        // Obtiene los propietarios de la DB
        $owners = $this->model->getOwners();

        // Envía los propietarios a la vista
        return $this->view->showOwners($owners);
    }

    public function addOwner()
    {
        // Valida que los campos obligatorios estén presentes
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el nombre');
        }
        if (!isset($_POST['apellido']) || empty($_POST['apellido'])) {
            return $this->view->showError('Falta completar el apellido');
        }
        if (!isset($_POST['categoria']) || empty($_POST['categoria'])) {
            return $this->view->showError('Falta completar la categoría');
        }

        // Obtiene los datos del formulario
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $categoria = $_POST['categoria'];

        // Inserta el nuevo propietario en la base de datos
        $id = $this->model->insertOwner($nombre, $apellido, $categoria);

        header('Location: ' . BASE_URL . 'propietarios'); // Redirige a la lista de propietarios
    }

    public function viewOwner($id)
    {
        // Obtiene el propietario por id
        $owner = $this->model->getOwner($id);

        if (!$owner) {
            return $this->view->showError("No existe el propietario con el id=$id");
        }

        // Envía el propietario a la vista
        return $this->view->viewOwner($owner);
    }

    public function updateOwner($id)
    {
        // Valida si el propietario existe
        $owner = $this->model->getOwner($id);

        if (!$owner) {
            return $this->view->showError("No existe el propietario con el id=$id");
        }

        // Actualiza el propietario (puedes ajustar los campos a actualizar según tus necesidades)
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $categoria = $_POST['categoria'];
        
        $this->model->updateOwner($id, $nombre, $apellido, $categoria);

        header('Location: ' . BASE_URL . 'propietarios');
    }

    public function deleteOwner($id)
    {
        // Valida si el propietario existe
        $owner = $this->model->getOwner($id);

        if (!$owner) {
            return $this->view->showError("No existe el propietario con el id=$id");
        }

        // Elimina el propietario de la base de datos
        $this->model->deleteOwner($id);

        header('Location: ' . BASE_URL . 'propietarios');
    }
}
