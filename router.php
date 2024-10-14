<?php
require_once 'libs/response.php';
require_once 'app/middlewares/session.auth.middleware.php';
require_once 'app/controllers/property.controller.php';
require_once 'app/controllers/auth.controller.php';
require_once 'app/controllers/owner.controller.php';
require_once 'app/controllers/category.controller.php';

define('BASE_URL', '//' . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']) . '/');

$res = new Response();

$action = 'home';
if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        sessionAuthMiddleware($res);
        $controller = new PropertyController($res);
        $controller->showHome();
        break;
    case 'propiedades':
        sessionAuthMiddleware($res);
        $controller = new PropertyController($res);
        $controller->showProperties();
        break;
    case 'propietarios':
        sessionAuthMiddleware($res);
        $controller = new OwnerController($res);
        $controller->showOwners();
        break;
    case 'categorias':
        sessionAuthMiddleware($res);
        $controller = new CategoryController($res);
        $controller->showCategories();
        break;
    case 'detallePropiedad':
        sessionAuthMiddleware($res);
        $controller = new PropertyController($res);
        $controller->showDetails($params[1]);
        break;
    case 'detallePropietario':
        sessionAuthMiddleware($res);
        $controller = new OwnerController($res);
        $controller->viewOwner($params[1]);
        break;
    case 'showLogin':
        $controller = new AuthController();
        $controller->showLogin();
        break;
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
    default:
        echo "404 Page Not Found"; // deberiamos llamar a un controlador que maneje esto
        break;
}
