<?php
require_once './app/models/category.model.php';
require_once './app/views/category.view.php';

class CategoryController
{
    private $model;
    private $view;

    public function __construct($res)
    {
        $this->model = new CategoryModel(); // Adaptado a CategoryModel
        $this->view = new CategoryView($res->user);
    }

    public function showHome()
    {
        return $this->view->showHome();
    }

    public function showCategories()
    {
        // Obtiene las categorías de la DB
        $categories = $this->model->getCategories();

        // Envía las categorías a la vista
        return $this->view->showCategories($categories);
    }

    public function addCategory()
    {
        // Valida que los campos obligatorios estén presentes
        if (!isset($_POST['nombre']) || empty($_POST['nombre'])) {
            return $this->view->showError('Falta completar el nombre');
        }
        if (!isset($_POST['tipo']) || empty($_POST['tipo'])) {
            return $this->view->showError('Falta seleccionar el tipo de categoría');
        }

        // Obtiene los datos del formulario
        $nombre = $_POST['nombre'];
        $tipo = $_POST['tipo'];

        // Inserta la nueva categoría en la base de datos
        $id = $this->model->insertCategory($nombre, $tipo); // Asegúrate de que insertCategory está en CategoryModel

        header('Location: ' . BASE_URL . 'categorias'); // Redirige a la lista de categorías
    }

    public function viewCategory($id)
    {
        // Obtiene la categoría por id
        $category = $this->model->getCategory($id);

        if (!$category) {
            return $this->view->showError("No existe la categoría con el id=$id");
        }

        // Envía la categoría a la vista
        return $this->view->viewCategory($category);
    }

    public function updateCategory($id)
    {
        // Valida si la categoría existe
        $category = $this->model->getCategory($id);

        if (!$category) {
            return $this->view->showError("No existe la categoría con el id=$id");
        }

        // Actualiza la categoría
        $nombre = $_POST['nombre'];

        $this->model->updateCategory($id, $nombre);

        header('Location: ' . BASE_URL . 'categorias');
    }

    public function deleteCategory($id)
    {
        // Valida si la categoría existe
        $category = $this->model->getCategory($id);

        if (!$category) {
            return $this->view->showError("No existe la categoría con el id=$id");
        }

        // Elimina la categoría de la base de datos
        $this->model->deleteCategory($id);

        header('Location: ' . BASE_URL . 'categorias');
    }
}
