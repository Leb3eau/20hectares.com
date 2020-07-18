<?php 
require "controllers/utilisateurcontroller.php";
require "controllers/documentcontroller.php";
require "controllers/produitcontroller.php";
require "controllers/locationcontroller.php";
require "controllers/notificationcontroller.php";
require "controllers/clientcontroller.php";
require "controllers/partenairecontroller.php";
require "controllers/commandecontroller.php";


if (isset($_GET['c']) && isset($_GET['a'])) 
{
	$controller = $_GET['c'];
	$action     = $_GET['a'];
	
if (class_exists($controller, true) and method_exists($controller,$action)) 
{
	$controller = new $controller();
    $controller->$action();
} 
else 
{
	include "erreur.html";
}

} 
else
{
	include "erreur.html";
}






?>