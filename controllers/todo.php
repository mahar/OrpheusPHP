<?php
/**
  * TO-DO Controller
  *
  */
class Todo extends Orpheus_Controller {

	protected $controllerName = 'Todo';

	// $this->dbAble 
	// true if a database connection is needed.
	protected $dbAble = true; 

	protected $data; // data passed to the view
	
 	public function __construct() {
		parent::__construct($this->controllerName);	
		$this->load->model('todo_model');

		$this->data = array(
			'title' => 'Orpheus.todo',
			'loadedControllers' => Registry::getLoadedLibs()
			);
		
		
		//$this->index();
		
	}

	/**
	 * Default Method: index() 
	 * 
	 */
	public function index() {
		
		$d = array('x','y');

		//$this->db->query("SELECT * FROM orph_todo");
		//$r = $this->todo_model->getItems();
		$rr = $this->todo_model->getItems($itemsNum = -1,0);
		$this->data['rowCount'] = $this->todo_model->itemCount();
		if($rr != false) { 
			$this->data['res'] = $rr;
			$this->data['message'] = "{$this->data['rowCount']} items.";
		} else {
			// Create an anonymous class
			//$x = new stdClass;
			//$x->title = "No items.";
			$this->data['res'] =  array(); // return an empty array
			$this->data['message'] = "No items found."; // message 
			

		}

		// Load the model
		$this->load->view('todo_index',$this->data);
		
	} 
	
	/**
	 * 
	 * 
	 */ 

	/**
	 * add()
	 * 
	 * @param array
	 * @return boolean
	 * @access public
	 * @author Charalampos Maviidis
	 * @since version 0.1
	 * 
	 * 
	 */ 
	public function add() 
	{	
		$this->load->view('addform',$this->data);
		if(isset($_POST['submit'])) {
			var_dump($_POST);
			$dateTime = new DateTime($_POST['deadline']);
			$d = $dateTime->getTimestamp();
			echo '<br/>', $d;
			$data = array(
				'title' => $_POST['title'],
				'deadline' => $d, // convert this to timestamp
				'details' => $_POST['details'],
				'done' => 0
				);
		
			// Pass $data to todo_model.php
			$this->todo_model->add_item($data);
			return true;
		}

			//$this->index();

		return false;
	}

	/**
	 * update()
	 * 
	 * @param array
	 * @return boolean
	 * @access public
	 * @author Charalampos Maviidis
	 * @since version 0.1
	 * 
	 * 
	 */ 
	public function update() {
		return false;
	}
	/**
	 * delete()
	 * 
	 * @param array
	 * @return boolean
	 * @access public
	 * @author Charalampos Maviidis
	 * @since version 0.1
	 * 
	 * 
	 */ 
	public function delete() {
		return false;
	}

	/**
	 * item()
	 * 
	 * @param array
	 * @return boolean
	 * @access public
	 * @author Charalampos Mavidis
	 * @since version 0.1
	 * 
	 * 
	 */ 
	public function task($params) { 
		/* 
			Show the content of a to-do item.

			1) Routing: todo/task/title will point to a page with the details for that task.
		*/	
			$params = is_array($params) ? (int) $params[0] : (int) $params;
			$task = $this->todo_model->getTask($params);

			//echo "params = " . $params . " - " . var_dump($params) . "<br />";
			$this->data['task']  = false;
			$title = "";
			$details = "Not found";
			if($task) { 
				//$this->data['task'] = $task;
				$title = $task->title; 
				$details = $task->details;
				
			}
			$this->data['title'] = $title;
			$this->data['details'] = $details;
			//var_dump($task);
			$this->load->view('view_task',$this->data);

	}
	
} // end-class

