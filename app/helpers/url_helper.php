<?php 

	// Simple Page Redirect
	function redirect($page){
		session_write_close();
		header('location: ' . ROOT . '/' . $page);
		exit;
	}