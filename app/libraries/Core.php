<?php 
	// App Core class 
	// Creates URL & Loads Core Controller
	// Url Format - /controller/method/params
	require_once __DIR__.'\..\config\config.php';
	class Core {
		
		protected $controller = 'Pages';
		protected $method = 'index';
		protected $params = [];

		public function __construct() {

			$url = $this->parseUrl();

			// Look into controllers for first index in url array
			if (file_exists(APP_PATH."/controllers/" . ucwords($url[0]) . '.php')) {
				// If exists, set as controller 
				$this->controller = ucwords($url[0]);
				// unset 0 index 
				unset($url[0]);
			}

			// Require the controller 
			require_once APP_PATH."/controllers/" . $this->controller . '.php';

			// Instantiate Controller 
			$this->controller = new $this->controller;

			// Check for second part of URL 
			if(isset($url[1])) {
				// Check to see if method exists 
				if (method_exists($this->controller, $url[1])) {
					$this->method = $url[1];
					unset($url[1]);
				}
			}
			
			// Get Params 
			$this->params = $url ? array_values($url) : [];

			// Callback with array of params 
			call_user_func_array([$this->controller, $this->method], $this->params);

		}

		private function parseUrl()
		{
			$url = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/blog'), 3);
			return $url;
		}




	}