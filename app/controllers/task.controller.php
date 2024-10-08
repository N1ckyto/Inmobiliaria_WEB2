<?php
require_once './app/models/task.model.php';
require_once './app/views/task.view.php';

class TaskController
{
    private $model;
    private $view;

    public function __construct($res)
    {
        $this->model = new TaskModel();
        $this->view = new TaskView($res->user);
    }

    public function showHome()
    {
        return $this->view->showHome();
    }

    public function showTasks()
    {
        // obtengo las tareas de la DB
        $tasks = $this->model->getTasks();

        // mando las tareas a la vista
        return $this->view->showTasks($tasks);
    }
    public function addTask()
    {
        if (!isset($_POST['title']) || empty($_POST['title'])) {
            return $this->view->showError('Falta completar el título');
        }

        if (!isset($_POST['priority']) || empty($_POST['priority'])) {
            return $this->view->showError('Falta completar la prioridad');
        }

        $title = $_POST['title'];
        $description = $_POST['description'];
        $priority = $_POST['priority'];

        $id = $this->model->insertTask($title, $description, $priority);

        header('Location: ' . BASE_URL);
    }

    public function viewTask($id)
    {
        // obtengo la tarea por id
        $task = $this->model->getTask($id);
    }

    public function showDetails($id)
    {
        // obtengo las tareas de la DB
        $tasks = $this->model->getDetails($id);

        // mando las tareas a la vista
        return $this->view->viewDetails($tasks);
    }

    public function finishTask($id)
    {
        $task = $this->model->getTask($id);

        if (!$task) {
            return $this->view->showError("No existe la tarea con el id=$id");
        }

        // actualiza la tarea
        $this->model->updateTask($id);

        header('Location: ' . BASE_URL);
    }
}
