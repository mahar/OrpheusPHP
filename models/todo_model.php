<?php if(!array_key_exists('APP_PATH', get_defined_constants())) { die('Application path has not been set.');}?>
<?php

/**
 * File: todo_model.php
 *
 * To-Do app is a package of Orpheus Tools
 * @author Charalampos Mavidis
 * @package 
 * @since version 0.1
 * 
 * 
 */
class Todo_Model extends Orpheus_Model {

	private $modelName = 'Todo_Model';

	/**
	 * 
	 * @var todoDbFields
	 * @access private
	 * 
	 */ 
	private $todoDbFields = array(
			'id',
			'cid',
			'user_id',
			'title',
			'details',
			'created_on',
			'updated_on',
			'done'
		);
	
	/* CLASS CONSTRUCTOR */
	public function __construct() {
		parent::__construct($this->modelName);	

		// Load the db lib
		try {
			$this->load->library('db');
		}catch(Exception $e) {
			echo $e->getMessage(),'<br/>';
		}
		//var_dump($this->load);
	}

	/**
	 * getItems()
	 * 
	 * @param int number of items (default: -1 -> fetch all)
	 * @param int start the fetch from this row (will be used for pagination)
	 * @return object
	 * @access public
	 */
	 public function getItems($itemsNum = -1,$startFrom = 0,$order="DESC", $orderBy = 'updated_on') {
	 	$sql =  "SELECT id, title,details FROM orph_todo";

	 
	 	if (in_array($orderBy, $this->todoDbFields)) {
	 		$sql .= " ORDER BY {$orderBy} {$order}";
	 	}
	 	if($itemsNum > 0) {
	 		$sql .= " LIMIT {$startFrom},{$itemsNum} ";
	 	}
	 	$res = $this->db->query($sql);
	 	return $res;

	 } 

	 /**
	  * itemCount() 
	  * 
	  * @return int
	  */
	  public function itemCount() {
	  	return $this->db->getLastQueryRows();
	  } 

	/**
	 * add_item()
	 * 
	 * @param array $data
	 * @return boolean 
	 * @access public 
	 */
	 public function add_item(array $data) {
	 	// Data should be an associative array
	 	/*
		$data = array(
			'field1' => '...',
			'field2' => '...',
			....
		);
	 	*/
	 	if(is_array($data)) {
	 		$this->db->setTableName('orph_todo'); // set table name
	 		$this->db->insert($data);
	 		return true;
	 	}
	 	return false;
	 } 

	 /**
	 * getItem()
	 * 
	 * @param int task id
	 *
	 * @return object
	 * @access public
	 */ 
	 public function getTask($task_id = 1) {
	 	echo "task_id = " . $task_id . "<br />";

	 	if (is_int($task_id) && $task_id > -1) {
	 		echo 'haha<br />'; 
	 		$da[':task_id'] = $task_id;
	 		$sql =  "SELECT id,title, details FROM orph_todo WHERE id=:task_id LIMIT 1";
	 		$res = $this->db->query($sql,$da);
	 		//var_dump($res);
	 		echo 'haha2<br />';
	 		if ($res) {
	 			return $res[0];
	 		} else {
	 			return false;
	 		}
	 	}
	 	return false;

	 } 

} // end-class

/**  
 * File: todo_model.php
 * Last update: July 9, 2012
 */ 