<?php if(!array_key_exists('APP_PATH', get_defined_constants())) { die('Application path has not been set.');}?>
<?php

/**
* 
* @author Charalampos Mavidis 
* @package Example
* @version -
* 
*/
class Example extends Orpheus_Controller {
	
	protected $controllerName = 'Example';

	public function index() {

	}
	public function __construct() {
		parent::__construct($this->controllerName);	

		// Load a model
		//$this->load->model('mymodel');
		//echo $this->mymodel;
		
		// Now $title is a variable that can be used is the view
		$this->load->view('example');
	
	}

	/**
	 * 
	 */

	/**
	 * getControllerName()
	 * 
	 * @access public
	 * @return (string) controllerName
	 * @author Charalampos Mavidis
	 * @since version 0.1
	 * 
	 */ 
	public function getControllerName() {
		return $this->controllerName;
	}

	public function haha() { 
		echo "Haha!!!";
	}


} // END-class


