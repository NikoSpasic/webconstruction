<?php 

/*
* Base Controller
* Loads the models and views
*/

abstract class Controller 
{
	// Load model
	public function model($model)
	{
		require_once ('../app/models/' . $model . '.php');

		//instantiate model
		return new $model();
	}

	// Load view 
	public function view($view, $data = [])
	{
		// Check for view file
		if(file_exists('../app/views/' . $view . '.php'))
		{
			require_once '../app/views/' . $view . '.php';
		} else {
			die('View does not exist');
		}
	}
}