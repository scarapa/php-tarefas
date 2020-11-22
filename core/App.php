<?php
class App{
    
    function init() {
        $ajax = isset($_GET['ajax']);
        $controller = isset($_GET['controller']) ? strtolower(trim($_GET['controller'])) : 'index';
        $action = isset($_GET['action']) ? strtolower(trim($_GET['action'])) : 'index';

        $controllerClassName = ucfirst($controller) . 'Controller';

        if (! class_exists($controllerClassName)) {
            ob_start();
            include('view/error/classe.php');
            $actionReturn = ob_get_clean();
            //$main = "view/error/class.php";
            return $actionReturn;
            //throw new Exception('Classe não encontrada.');
        } 
        
        $controllerObject = new $controllerClassName();  
        if (! method_exists($controllerObject, $action)) {
            ob_start();
            include('view/error/controle.php');
            $actionReturn = ob_get_clean();
            //$main = "view/error/controller.php";
            return $actionReturn;
        }        


        $actionReturn = call_user_func(array($controllerObject, $action));
        return $actionReturn;

    }
}