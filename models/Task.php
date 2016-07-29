<?php if(!array_key_exists('APP_PATH', get_defined_constants())) { die('Application path has not been set.');}?>
<?php

/**
 * File: task.php
 *
 * To-Do app is a package of Orpheus Tools
 * @author Charalampos Mavidis
 * @package 
 * @since version 0.1
 * 
 *
 * Task [model] fetches all the details from a specific task.
 * 
 */
class Task extends Orpheus_Model {

	private $modelName = 'Task';

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
	 * getItem()
	 * 
	 * @param int task id
	 *
	 * @return object
	 * @access public
	 */
	 public function getItem($task_id = -1) {
	 	if (is_int($task) && $task_id > -1) { 
	 		$sql =  "SELECT id,title, details, created_on FROM orph_todo WHERE id = :task_id ";
	 		$res = $this->db->query($sql, [$task_id]);
	 		return $res;
	 	}
	 	return false;

	 } 

	 

} // end-class
