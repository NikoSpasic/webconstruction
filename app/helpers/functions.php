<?php 

/**
 * 
 */
function cleanString($value) 
{					
	$value = trim($value);

	$value = htmlspecialchars($value, ENT_QUOTES | ENT_HTML5);

	if(!$value) {
		$value = null;
	}
	
	return $value;
}

/**
 * 
 */
function checkInputString($value, $minLength=6, $maxLength=255) 
{									
	$errorMessage = null;
	
	// 1. $value auf Leerstring prüfen
	if(!$value) {
		$errorMessage = "This field is required";
	
	// 2. $value auf Mindestlänge prüfen
	} elseif(mb_strlen($value) < $minLength) {
		$errorMessage = "This field must be at least {$minLength} characters long";
	
	// 3. $value auf Maximallänge prüfen 					
	} elseif(mb_strlen($value) > $maxLength) {
		$errorMessage = "This field cannot be longer than {$maxLength} characters";
	}
	
	return $errorMessage;
}

/**
 * 
 */
function checkEmail($value) 
{					
	$errorMessage = null;
	
	// 1. $value auf Leerstring prüfen
	if(!$value) {
		$errorMessage = "Please enter email";
	
	// 2. $value auf valide Email-Adresse prüfen
	} elseif(!filter_var( $value, FILTER_VALIDATE_EMAIL)) {
		$errorMessage = "Invalid email address";					
	}
	
	return $errorMessage;
}

/**
  * Simple page redirect
  */ 
function redirect($page)
{
	header('Location: ' . URLROOT . '/' . $page . '/');
}

/**
 * 
 */
function dd($value)
{
	echo "<pre>";

	die(var_dump($value));
	
	echo "</pre>";
}