<?php
/**
  * registry.php
  * 
  * 
  */
class Registry {

	/* DEFINE SOME CONSTANCTS */
	const LIB = 0;
	const CONTROLLER = 1;
	const MODEL = 2;
	const VIEW = 3;

	/* Arrays */
	private static $_loadedLibs = array();
	private static $_loadedControllers = array();
	private static $_loadedModels = array();
	private static $_loadedViews = array();
	

	private static $_loadedData = array(); // loaded data per view

	private static $_config = array();

	private static $dbConnected = false;

	public function __construct() {
		// ...
	}

	/**
	 * addConfigItem()
	 * 
	 * @param array or string
	 * @param string
	 * @return void
	 * @access public
	 */
	 public static function addConfigItem($citem,$citem_key) {
	 	self::$_config[$citem_key] = $citem;
	 } 
	 /**
	 * getConfigItem()
	 * 
	 * @param string
	 * @return array
	 * @access public
	 */
	 public static function getConfigItem($key) {
	 	if(array_key_exists($key, self::$_config)) {
	 		return self::$_config[$key];
	 	} else {
	 		return null;
	 	}
	 }
	/**
	 * setDbConnection()
	 * 
	 * @param boolean (defauit: true)
	 * @return boolean
	 * @static
	 * @access public 
	 * 
	 */
	 public static function setDbConnection($conn = true) {
	 	self::$dbConnected = $conn;
	 	return $conn;
	 }

	 /**
	  * isDbConnected()
	  * 
	  * @return boolean
	  * @access public
	  * @static 
	  * 
	  */ 
	 public static function isDbConnected() {
	 	return self::$dbConnected;
	 }

	 /**
	  * The following two methods will help the view designer to 
	  * check what data are passed to the view via the controller.
	  * 
	  * The designer should first use the second function and then
	  * use var_dump() on the result.
	  */ 
	 /**
	  * addDataToView()
	  * 
	  * @param string $view_name
	  * @param array $data
	  * @return void
	  * @static
	  * @access public
	  */
	  public static  function addDataToView($vName, $data) {
	  		self::$_loadedData[$vName] = $data;
	  	
	  } 

	   /**
	  * getViewData()
	  * 
	  * @param string $view_name
	  * 
	  * @return array $data
	  * @static
	  * @access public
	  */
	  public static function getViewData($vName) {
	  		return self::$_loadedData[$vName]; 	
	  } 
	  
	/**
	 * getLoadedLibs()
	 * 
	 * @return array
	 * @access public 
	 * @static
	 * 
	 */ 
	public static function getLoadedLibs() {
		return self::$_loadedLibs;
	}

	/**
	 * getLoadedControllers()
	 * 
	 * @return array
	 * @access public
	 * @static
	 * 
	 * 
	 */ 
	public static function getLoadedControllers() {
		return self::$_loadedControllers;
	}
	/**
	 * getLoadedModels()
	 * 
	 * @return array
	 * @access public
	 * @static
	 * 
	 * 
	 */ 
	public static function getLoadedModels() {
		return self::$_loadedModels;
	}

	/**
	 * getLoadedViews()
	 * 
	 * @return array
	 * @access public
	 * @static
	 * 
	 * 
	 */ 
	public static function getLoadedViews() {
		return self::$_loadedViews;
	}

	/**
	 * add()
	 * 
	 * Load a model, a library or a controller
	 * 
	 * @param string $name
	 * @param int $type
	 */ 
	public static function add($name, $type) {
		switch($type) {
			case self::LIB:
				self::$_loadedLibs[] = ucfirst($name);
				break;
			case self::CONTROLLER:
				self::$_loadedControllers[] = ucfirst($name);
				break;
			case self::MODEL:
				self::$_loadedModels[] = ucfirst($name);
				break;
			case self::VIEW:
				self::$_loadedViews[] = ucfirst($name);
				break;
			default:
				throw new Exception("Type should be in [lib,controller,model].");			
		}
	} 

} // end-class

