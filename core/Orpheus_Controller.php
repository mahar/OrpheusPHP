<?php if(!array_key_exists('APP_PATH', get_defined_constants())) { die('Application path has not been set.');}?>
<?php
/**
 * File: Orpheus_Controller.php
 * 
 * Main Orpheus Controller
 * 
 * abstract class 
 * 
 * @author Charalampos Mavidis
 * @since version 0.1
 * @version 0.1
 * @package core
 * 
 */
//require_once(APP_PATH . '/core/load.php');
abstract class Orpheus_Controller {


	protected static $loadedControllers = array();

	private static $instance;

	/**
	 * $this->load
	 * 
	 * Instance of Load class.
	 *    -- Methods:
	 *        $this->load->model($model_name,$data=null)
	 * 		  $this->load->view($view_name,$data=null)
	 *        $this->load->library($lib_name)
	 */ 
	public $load;

	// database connection
	protected $db = null;
	protected $connNeeded = false;

	/* MAGIC METHODS */
	public function __construct($controllerName) {

		self::$instance = $this; 
		//self::addToLoadedControllers($controllerName);
		Registry::add($controllerName,Registry::CONTROLLER);

		$this->load = Load::get_instance();
	}

	public function __toString() {
		echo 'I am the default OrpheusTools Controller.';
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
			self::$instance = new self();
		}
		return self::$instance;
	}
	/* **************************************************/



	  /**
	   * dbConnectionNeeded()
	   * 
	   * return bool
	   */ 
	  public function dbConnectionNeeded() {
	  		return $this->connNeeded;
	  }

	  /**
	   * setDbConnection()
	   * 
	   * @param bool, default false
	   * @return void
	   */ 
	  protected function setDbConnection($on = false) {
	  		$this->connNeeded = $on;
	  }





} // End-class

 


