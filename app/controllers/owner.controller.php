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
    public function showEdit($id)
    {
        $owner = $this->model->getOwner($id);
        if (!$owner) {
            return $this->view->showError("No existe el propietario con el id=$id");
        }
        return $this->view->showEdit($id, $owner);
    }

    public function addOwners()
    {
        // Obtiene las propiedades de la DB
        $owners = $this->model->getOwners();

        // Envía las propiedades a la vista
        return $this->view->addOwners($owners);
    }
    public function addOwner()
    {
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el nombre');
        }
        if (!isset($_POST['apellido']) || empty($_POST['apellido'])) {
            return $this->view->showError('Falta completar el apellido');
        }


        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];


        $id = $this->model->insertOwner($nombre, $apellido);


        $owners = $this->model->getOwners();

        return $this->view->showOwners($owners);
    }

    public function viewOwner($id)
    {
        $owner = $this->model->getOwner($id);
        $properties = $this->model->countPropertiesByOwner($id);
        if (!$owner) {
            return $this->view->showError("No existe el propietario con el id=$id");
        }

        // Envía el propietario a la vista
        return $this->view->viewOwner($owner, $properties);
    }

    public function updateOwner()
    {
        $id = $_POST['id'];
        // Valida si el propietario existe
        $owner = $this->model->getOwner($id);

        if (!$owner) {
            return $this->view->showError("No existe el propietario con el id=$id");
        }

        // Actualiza el propietario (puedes ajustar los campos a actualizar según tus necesidades)
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];

        $this->model->updateOwner($id, $nombre, $apellido);
        return $this->view->showAlert("Propietario editado!");
    }

    public function deleteOwner($id)
    {
        // Valida si el propietario existe
        $owner = $this->model->getOwner($id);
        $properties = $this->model->countPropertiesByOwner($id);
        if ($properties > 0) {
            return $this->view->showError("No se puede borrar un propietario con $properties propiedades a su nombre, borralas primero");
        }
        // Elimina el propietario de la base de datos
        $this->model->deleteOwner($id);

        return $this->view->showAlert("Propietario eliminado!");
    }
}
