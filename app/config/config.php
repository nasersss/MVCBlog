<?php 

  // DB params
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASS', '');
  define('DB_NAME', 'blogDB');

	// App root 
	if(!defined('DS')) {
		define('DS', DIRECTORY_SEPARATOR);
	}
	
	define('APP_PATH', realpath(dirname(__FILE__)) . DS . '..');
	define('VIEWS_PATH', APP_PATH . DS . 'views' . DS);
	define('PUBLIC_PATH', realpath(APP_PATH) . DS . '..'.DS.'public');
	define('ROOT','http://localhost/blog');

