<?php 
// load  config
require_once ('config/config.php');

// SESSION helper:
require_once ('helpers/session_helper.php');

// Functions helper:
require_once ('helpers/functions.php');

// load libraries
/*
require_once ('libraries/Core.php');
require_once ('libraries/Controller.php');
require_once ('libraries/Database.php');
*/

// Autoload Core Libraries - automatizuje ovo iznad
spl_autoload_register(function($className)
{
	require_once ('libraries/' . $className . '.php');
});