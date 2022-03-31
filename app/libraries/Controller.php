<?php 

	// Base controller and loads models and views
	class Controller {
		// Load Model
		public function model($model) {
			// Require model file
			require_once APP_PATH.'/models/' . $model . '.php';
			// Instantiate model
			return new $model();
		}

		// Load view 
		public function view($view, $data = []) {
			// Check for view file 
			if( file_exists(APP_PATH.'/views/'. $view . '.php') ) {
				require_once APP_PATH.'/views/'. $view . '.php';
			} else {
				// View does not exist 
				die('View Does not exist!');
			}
		}

	}