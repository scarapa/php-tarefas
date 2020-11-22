<?php
function __autoload($class) {

    // tenta carregar classes do diretório /model
    $modelFilePath = PASTA."/model/" . $class . ".php";
    if (file_exists($modelFilePath)) {
        require_once($modelFilePath);
        return;
    }

    // tenta carregar classes do diretório /controller
    $controllerFilePath =  PASTA."/controller/" . $class . ".php";
    if (file_exists($controllerFilePath)) {
        require_once($controllerFilePath);
        return;
    }    

    // tenta carregar classes do diretório /controller
    $providerFilePath =  PASTA."/provider/" . $class . ".php";
    if (file_exists($providerFilePath)) {
        require_once($providerFilePath);
        return;
    }      

}