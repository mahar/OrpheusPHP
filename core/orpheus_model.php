<?php

/**
 * 
 * Orpheus Model Base Class
 * 
 * @author Charalampos Mavidis
 * @since version 0.1
 * @version 0.1
 * @package core
 * 
 */ 
abstract class Orpheus_Model {

	protected $load;

	private static $instance;

	/**
	 * @static var bool $dbRequired
	 * @access protected (true if db is required by the model)
	 */ 
	protected static $dbRequired = false;



	public function __toString() {
		return 'Orpheus Base Model Class';
	}


	public function __clone() {
		// ...
	}

	public function __construct($modelName) {
		// ...
		$this->load = Load::get_instance();
		self::$instance = $this;
	}

	/**
	 * Implement the singleton pattern 
	 * 
	 * get_instance()
	 * 
	 * @return object
	 * @author Charalampos Mavidis
	 * @since version 0.1
	 */ 
	public static function get_instance() {
		if (is_null(self::$instance)) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * Magic method __get()
	 * 
	 * @param string
	 * @return -
	 */
	/**
	 public function __get($property) {
	 	$ORPHEUS = Orpheus_Controller::get_instance();
	 	return $ORPHEUS->$property;
	 } 
	 */ 

	 /**
	  * setActiveDbConn()
	  * 
	  * If it returs true, then a database connection will be established.
	  */ 
	 public function setActiveDb($conn = false) {
	 	self::$dbRequired = $conn;
	 	return $conn;
	 }



} // end-class

