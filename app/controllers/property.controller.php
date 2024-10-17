<?php
require_once './app/models/property.model.php';
require_once './app/views/property.view.php';

class PropertyController
{
    private $model;
    private $view;

    public function __construct($res)
    {
        $this->model = new PropertyModel(); // Adaptado a PropertyModel
        $this->view = new PropertyView($res->user);
    }

    public function showHome()
    {
        return $this->view->showHome();
    }

    public function showProperties()
    {
        // Obtiene las propiedades de la DB
        $properties = $this->model->getProperties();

        // Envía las propiedades a la vista
        return $this->view->showProperties($properties);
    }

    public function addProperties()
    {
        // Obtiene las propiedades de la DB
        $properties = $this->model->getProperties();

        // Envía las propiedades a la vista
        return $this->view->addProperties($properties);
    }

    public function addProperty()
    {
        // Valida que los campos obligatorios estén presentes
        if (!isset($_POST['ubicacion']) || empty($_POST['ubicacion'])) {
            return $this->view->showError('Falta completar la ubicación');
        }
        if (!isset($_POST['m2']) || empty($_POST['m2'])) {
            return $this->view->showError('Falta completar los metros cuadrados');
        }
        if (!isset($_POST['modalidad']) || empty($_POST['modalidad'])) {
            return $this->view->showError('Falta completar la modalidad');
        }
        if (!isset($_POST['precio_inicial']) || empty($_POST['precio_inicial'])) {
            return $this->view->showError('Falta completar el precio inicial');
        }
        if (!isset($_POST['precio_flexible'])) {
            return $this->view->showError('Falta completar si el precio es flexible' . $_POST['precio_flexible']);
        }
        if (!isset($_POST['propietario']) || empty($_POST['propietario'])) {
            return $this->view->showError('Falta completar quien es el propietario');
        }

        // Obtiene los datos del formulario
        $ubicacion = $_POST['ubicacion'];
        $m2 = $_POST['m2'];
        $modalidad = $_POST['modalidad'];
        $precio_inicial = $_POST['precio_inicial'];
        $precio_flex = isset($_POST['precio_flexible']) ? $_POST['precio_flexible'] : 0;
        $id_propietario = $_POST['propietario'];

        // Inserta la nueva propiedad en la base de datos
        $id = $this->model->insertProperty($ubicacion, $m2, $modalidad, $id_propietario, $precio_inicial, $precio_flex);

        $properties = $this->model->getProperties();

        return $this->view->addProperties($properties);
    }

    public function showDetails($id)
    {
        // Obtiene los detalles de la propiedad por id
        $propertyDetails = $this->model->getDetails($id);

        // Envía los detalles a la vista
        return $this->view->viewDetails($propertyDetails);
    }


    public function showEdit($id)
    {
        $property = $this->model->getProperty($id);
        if (!$property) {
            return $this->view->showError("No existe la propiedad con el id=$id");
        }
        $url = $_SERVER['REQUEST_URI'];
        $id_propierty = basename($url);
        //return $this->view->showError($id_propierty); me da el id de la propiedad que quiero modificar
        return $this->view->showEdit($id_propierty);
    }


    public function updateProperty()
    {
        if (!isset($_POST['ubicacion']) || empty($_POST['ubicacion'])) {
            return $this->view->showError('Falta completar la ubicación');
        }
        if (!isset($_POST['m2']) || empty($_POST['m2'])) {
            return $this->view->showError('Falta completar los metros cuadrados');
        }
        if (
            !isset($_POST['modalidad']) || empty($_POST['modalidad'])
        ) {
            return $this->view->showError('Falta completar la modalidad');
        }
        if (!isset($_POST['precio_inicial']) || empty($_POST['precio_inicial'])) {
            return $this->view->showError('Falta completar el precio inicial');
        }
        if (!isset($_POST['precio_flexible'])) {
            return $this->view->showError('Falta completar si el precio es flexible' . $_POST['precio_flexible']);
        }
        if (!isset($_POST['propietario']) || empty($_POST['propietario'])) {
            return $this->view->showError('Falta completar quien es el propietario');
        }

        // Obtiene los datos del formulario
        $ubicacion = $_POST['ubicacion'];
        $m2 = $_POST['m2'];
        $modalidad = $_POST['modalidad'];
        $precio_inicial = $_POST['precio_inicial'];
        $precio_flex = isset($_POST['precio_flexible']) ? $_POST['precio_flexible'] : 0;
        $id_propietario = $_POST['propietario'];
        $id = $id;
        //Actualiza la propiedad (podrías ajustar los campos a actualizar según tus necesidades)
        $this->model->updateProperty($ubicacion, $m2, $modalidad, $id_propietario, $precio_inicial, $precio_flex);
        return $this->view->showEdit();
    }

    public function deleteProperty($id)
    {
        // Valida si la propiedad existe
        $property = $this->model->getProperty($id);

        if (!$property) {
            return $this->view->showError("Propiedad eliminada exitosamente!");
        }

        // Elimina la propiedad de la base de datos
        $this->model->deleteProperty($id);

        header('Location: ' . BASE_URL);
    }
}
