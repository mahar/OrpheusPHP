<?php if(!array_key_exists('APP_PATH', get_defined_constants())) { die('Application path has not been set.');}?>
<?php

/**
 * Load class
 * File: load.php
 * Part of OrpheusPHP Framework core
 * 
 * @since version 0.1
 * @version 0.1
 * @package core
 * @author Charalampos Mavidis
 * 
 * 
 */

class Load {
	
	public $load = null; // object

	private static $instance;
	
	/**
	 * Class constructor
	 * 
	 * @param object
	 * @author Charalampos Mavidis
	 * @since version 0.1
	 * 
	 * @Notes: -
	 */ 
	public function __construct() {

		// Implement the singleton pattern
		//$this->instance = $this;

	}

	/* Singleton pattern */

	final public function __clone() {
		// stop __clone()
	}

	/**
	 * get_instance() 
	 * 
	 * @return object
	 * @author Charalampos Mavidis
	 * @since version 0.1 
	 */
	final public static function get_instance() {
		if (is_null(self::$instance)) {
			self::$instance = new self;
		}
		return self::$instance;
	}

	// load->view
	// load->model

	/**
	 * view()
	 * 
	 * @access public
	 * @param $view_name (string)
	 * @param $data (array)
	 * @return void
	 */ 
	public function view($view_name,$data=null) {
		if(!is_null($data) && is_array($data)) {
			// Create variable and pass them 
			// to the view
			foreach ($data as $key => $datum) {
				$$key = $datum;
			}
		} 
		Registry::add($view_name,Registry::VIEW);
		Registry::addDataToView($view_name,$data);
		include(APP_PATH . '/views/'.$view_name .'.php');
	}

	/**
	 * model()
	 * 
	 * @access public
	 * @param string
	 * @return void
	 * @since -version-
	 */ 
	public function model($model_name = '') {

		/**
		 * In case $model_name == array()
		 */ 
		if(is_array($model_name)) {
			foreach($model_name as $mn) {
				$this->model($mn);
			}
		}
		/**
		 * @todo 
		 *     Check if $model_name is a folder
		 * 	   Check if it exists. 
		 * 	   Check if the first character is in [a-z_]
		 * 	   Check if strlen($model_name) > 0
		 */ 
		Registry::add($model_name,Registry::MODEL);
		include(APP_PATH . '/models/'. $model_name . '.php');

		/**
		 * Check if there is already a class property called $model_name
		 */ 
		if(isset($this->$model_name)) {
			returN FALSE;
		}

		/** Create an new property called $model_name
		 *
		 * Specify some rules for the name:
		 * strlen($model_name) > 0
		 *
		 */
		/**
		 * Get an instance of the main controller
		 * see singleton pattern
		 */ 
		$ORPHEUS = Orpheus_Controller::get_instance();;
		$modelName = ucfirst($model_name);
		$ORPHEUS->$model_name = new $modelName();
	}

	/**
	 * 
	 * library()
	 * 
	 * @access public 
	 * @param string $lib_name
	 * @return void
	 */
	public function library($lib_name) {
		$exists = false;
		if(is_dir($lib_name)) {
			if(file_exists(APP_PATH . '/core/libraries/'.$lib_name . '/lib.php')) {
				//
				$exists = true;
				


			} else {
				die('lib.php does not exist.');
			}
		} else if(file_exists(APP_PATH . '/core/libraries/'.$lib_name . '.php')) {
			$exists = true;
			//require_once(APP_PATH . '/core/libraries/' . $lib_name .'.php');
		} else {
			throw new Exception('Library ' . $lib_name .' does not exist.');
			return;
		}

		// Check now if there is a config file with the same name as the library. If there is, load it.
		if($exists && file_exists(APP_PATH . '/config/' . $lib_name . '.php' )) {
			require_once(APP_PATH . '/config/' . $lib_name . '.php');
			require_once(APP_PATH . '/core/libraries/' . $lib_name . '.php');	
			Registry::addConfigItem($config[$lib_name],$lib_name);
		} else {
			require_once(APP_PATH . '/core/libraries/' . $lib_name . '.php');
		}
		Registry::add($lib_name,Registry::LIB);
		$ORPHEUS = Orpheus_Model::get_instance();
		$libName = strtoupper($lib_name);
		//$ORPHEUS->HELLO = 1;
		$ORPHEUS->$lib_name = new $libName(); 
	}

} // end-class


