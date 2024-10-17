<?php
require_once 'libs/response.php';
require_once 'app/middlewares/session.auth.middleware.php';
require_once 'app/controllers/property.controller.php';
require_once 'app/controllers/auth.controller.php';
require_once 'app/controllers/owner.controller.php';

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
    case 'agregar-modificarPropiedad':
        sessionAuthMiddleware($res);
        $controller = new PropertyController($res);
        $controller->addProperties();
        break;
    case 'agregar-modificarPropietario':
        sessionAuthMiddleware($res);
        $controller = new OwnerController($res);
        $controller->addOwners();
        break;
    case 'agregarPropiedad':
        sessionAuthMiddleware($res);
        $controller = new PropertyController($res);
        $controller->addProperty();
        break;
    case 'agregarPropietario':
        sessionAuthMiddleware($res);
        $controller = new OwnerController($res);
        $controller->addOwner();
        break;
    case 'borrarPropiedad':
        sessionAuthMiddleware($res);
        $controller = new PropertyController($res);
        $controller->deleteProperty($params[1]);
        break;
    case 'borrarPropietario':
        sessionAuthMiddleware($res);
        $controller = new OwnerController($res);
        $controller->deleteOwner($params[1]);
        break;
    case 'showEdit':
        sessionAuthMiddleware($res);
        $controller = new PropertyController($res);
        $controller->showEdit($params[1]);
        break;
    case 'editarPropiedad':
        sessionAuthMiddleware($res);
        $controller = new PropertyController($res);
        $controller->updateProperty();
        break;
    case 'showEditOwner':
        sessionAuthMiddleware($res);
        $controller = new OwnerController($res);
        $controller->showEdit($params[1]);
        break;
    case 'editarPropietario':
        sessionAuthMiddleware($res);
        $controller = new OwnerController($res);
        $controller->updateOwner();
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
