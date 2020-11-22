
<?php

ini_set("display_errors", "0");
error_reporting(E_ALL);
//error_reporting(E_ALL | E_WARNING | E_PARSE);


/* DEFININDO FUSO HORARIO */
date_default_timezone_set('America/Sao_Paulo');
/* DEFININDO IDIOMA */
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');


/* ONLINE */
if( ($_SERVER['SERVER_ADDR'] == "::1") || ($_SERVER['SERVER_ADDR'] == "localhost") ){
    $ip = $_SERVER['HTTP_HOST'];
}else{
    $ip = $_SERVER['SERVER_ADDR'];
}
define('IP',$ip);
$aux = substr( $_SERVER['REQUEST_URI'], strlen('/'));
if( substr( $aux, -1) == '/'){ $aux=substr( $aux, 0, -1); }
$link =explode( '/', $aux);


$server = $ip."/tarefas";
define("URLPRINCIPAL","http://{$server}/");
define("URLSITE","http://{$server}/");
define("SERVER","http://{$server}/");
define("URL","http://{$server}/");
define("PASTA",$_SERVER['DOCUMENT_ROOT']."/tarefas");

include("DatabaseModel.php");
//include("../model/ActiveRecord.php");
//include("autoload.php");
include("Funcoes.php");

?>