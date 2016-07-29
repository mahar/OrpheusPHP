<?php 

/**
 * Load class
 * File: App.php
 * Part of Orpheus Framework core
 * 
 * @since version 0.1
 * @version 0.1
 * @package core
 * @author Charalampos Mavidis
 * 
 * 
 */

class App { 

	protected $controller = 'Example';

	protected $method = 'index';

	protected $params = [];

	public function __construct($app_path) { 
		// Routing
		$url = $this->parseUrl();
	
		if (file_exists($app_path . "/controllers/" . $url[0] . ".php")) { 
			$this->controller = $url[0];
			unset($url[0]);
		} else {

			echo "dont exist";
		}

		require_once($app_path . "/controllers/" . $this->controller . ".php");

		$this->controller = new $this->controller;

		// Check if method exists
		if (isset($url[1])) { 
			if(method_exists($this->controller, $url[1])) { 
				// load the method
				$this->method = $url[1];
				unset($url[1]);
				if(isset($url[2])) { 
					echo $url[2]; 
				}
			}
		}
		$this->params = $url ? array_values($url) : [];

		call_user_func_array([$this->controller, $this->method], $this->params);


	}

	public function parseUrl() { 
		if (isset($_GET['url'])) { 
			$filtered = filter_var(rtrim($_GET['url']),FILTER_SANITIZE_URL);
			$filtered2 = explode("/",$filtered);
			return $url = $filtered2;//explode(filter_var(rtrim($_GET['url'],'/'), FILTER_SANITIZE_URL),'/');
		} else {
			return [$this->controller];
		}

	}

}

?> 