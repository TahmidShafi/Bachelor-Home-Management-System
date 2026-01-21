<?php
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'auth';
$allowed_controllers = ['auth', 'supervisor', 'resident', 'admin'];

if (in_array($controller, $allowed_controllers)) {
    $controllerFile = '../app/controllers/' . $controller . '_controller.php';

    if (file_exists($controllerFile)) {
        require_once $controllerFile;
    } else {
        echo "404 - Controller file not found: $controllerFile";
    }
} else {
    echo "404 - Invalid Controller";
}
?>