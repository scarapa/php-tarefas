<?php
require('core/autoload.php');
require('core/App.php');
include("core/config.php");


//IDENTIIFCAR CONTROLLER
$main = "include/home/index.php";

$app = new App();
$actionReturn = $app->init();

require_once ("view/template.php");

