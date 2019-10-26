<?php
	error_reporting(E_ERROR);
	ini_set('display_errors','1');

	spl_autoload_register(function($sClass){
		if(file_exists('class.'.$sClass.'.php'))
			include_once 'class.'.$sClass.'.php';
		else
			include_once 'class/class.'.$sClass.'.php';
	});	

	function session_ini(){
		// server should keep session data for AT LEAST 1 hour
		ini_set('session.gc_maxlifetime', 3600);

		// each client should remember their session id for EXACTLY 1 hour
		session_set_cookie_params(3600);

		session_start(); // ready to go!
	}

	function gradeAssoc($grade){
		switch($grade){
		  case '1':
			return 'F';
		  break;
		  case '2':
			return 'D-';
		  break;
		  case '3':
			return 'D';
		  break;
		  case '4':
			return 'D+';
		  break;
		  case '5':
			return 'C-';
		  break;
		  case '6':
			return 'C';
		  break;
		  case '7':
			return 'C+';
		  break;
		  case '8':
			return 'B-';
		  break;
		  case '9':
			return 'B';
		  break;
		  case '10':
			return 'B+';
		  break;
		  case '11':
			return 'A-';
		  break;
		  case '12':
			return 'A';
		  break;
		  case '13':
			return 'A+';
		  break;
		}
	}
?>