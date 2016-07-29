<?php

/**
 * Database library
 * File: db.php
 * Part of Orpheus Framework core.
 * 
 * @author Charalampos Mavidis
 * @since version 0.1
 * @version 0.1
 * 
 */ 

class DB {

	private static $instance;
	protected static $dsn;
	protected $dbh;
	private $tableName = 'orph_todo';
	private $joinClause = "";
	private $whereClause = "";
	protected $connection = null;
	private $_lastQueryRows = 0;

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
	 * Constructor
	 */ 
	public function __construct() {
		self::$instance = $this;

		// Check if there is a config file
		$classname = strtolower(__CLASS__);
		if(file_exists(APP_PATH . '/config/'. $classname . '.php')) {
			require_once(APP_PATH . '/config/'. $classname . '.php');
			$config = Registry::getConfigItem($classname);
			if(is_array($config)) {
				$this->_dbhost = $config['host'];
				$this->_dbuser = $config['user'];
				$this->_dbpass = $config['password'];
				$this->_dbName = $config['dbName'];
			} 
		}

		// Connect to db
		if(!$this->connect()) {
			throw new Exception("Cannot connect to the database. Please check your configuration settings.");
		} else {
			// Connected. 
			Registry::setDbConnection(true);		
		}
	}

	/**
	 * 
	 */
	 public function __toString() {
	 	return 'I am the Database Helper class.';
	 } 

	/**
	 * magic method __clone()
	 */
	 final public function __clone() {
	 	// do nothing
	 } 

	 /**
	  * connect() 
	  * 
	  * @return boolean
	  * 
	  * @todo 
	  * 
	  */
	  public function connect() {
	  		// New PDO connection
	  			try {
	  	   $this->dbh = new PDO("mysql:host={$this->_dbhost};dbname={$this->_dbName}", $this->_dbuser, $this->_dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
	  		$this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   			$this->dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
   			$this->dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
   		} catch(PDOException $e) {
   			echo $e->getMessage();
   		}
	 
	  		return $this->dbh;
	  }

	  /**
	 * setTableName()
	 * 
	 * @param string
	 * @return -
	 * @author Charalampos Mavidis
	 * @since version 0.1
	 * 
	 */ 
	public function setTableName($tablename) {
		// ...
		$this->tableName = $tablename;
	}

	/**
	 * query()
	 * 
	 * @param (string) SQL string
	 * @param ( associatiave array) placeholders
	 * @param (string) where
	 * @return boolean
	 * @author Charalampos Mavidis
	 * @since version 0.1
	 * 
	 * @todo I need to think a bit here about how I am going to implement this.
	 *       Read more about PDO, fetch and fetchAll.
	 */ 
	public function query($sql, array $placeholders = [],  $where=null ) {
		// ...
		try {
			$q = $this->dbh->prepare($sql);
			//var_dump($placeholders);
			foreach($placeholders as $key => $val) {
				echo $key . " - " . $val . "<br />";
				$paramName = ":" . $key;
				$q->bindParam($paramName, $val);
			}
			$q->execute($placeholders);

			// now, we must fetch the results
			// TO BE DONE;

			// return a result!!
			$result =   $q->fetchAll(PDO::FETCH_OBJ);
			$this->_lastQueryRows = $q->rowCount();
			// return an object with properties named after the names of the selected fields.
			return $result;

		} catch(PDOException $e) {
			echo $e->getMessage(), "\n";
			return false;
		}
	}

	/**
	 * getLastQuesyRows() 
	 * 
	 * @return int
	 * @access public
	 */
	 public function getLastQueryRows() {
	 	return $this->_lastQueryRows;
	 } 

	/**
	 * result()
	 * 
	 * @return boolean
	 * @author Charalampos Mavidis
	 * @since version 0.1
	 */
	 public function result() {
	 	
	 } 
	

	/**
	 * get()
	 * 
	 * @param string
	 * @return -
	 * @author Charalampos Mavidis
	 * @since version 0.1
	 * 
	 */ 
	public function get($tablename) {
		// ...
		$this->tableName = $tablename;
	}

	/**
	 * where()
	 * 
	 * @param string
	 * @param string
	 * @param string $andOr = {AND, OR, null}
	 * @return void
	 * @access public 
	 * @author Charalampos Mavidis
	 * @since version 0.1
	 * 
	 */ 
	public function where($field,$value,$andOr = null) {
		// ...
		//$this->whereClause = $where;
		$this->whereClause .= " {$field} = {$value} ";
		$andOr = strtoupper($andOr);
		if($andOr = "AND" || $andOr = "OR") {
			$this->whereClause .= $andOr;
		}
	}

	/* CRUD OPERATIONS */
	/**
	 * @param array $data (an associative array)
	 * @return boolean
	 * @access public
	 * 
	 * @link http://www.phpro.org/tutorials/Introduction-to-PHP-PDO.html#7.1
	 */
	public function insert(array $data) {
		if(!is_array($data)) { return false;}
		try {
			// Step 1: Create a string for the fields and the values
			$fieldsString = implode(array_keys($data),',');
			
			$placeholdersArray = array();

			foreach($data as $k => $v) {
				if($v == '{TIME}[NOW]') {
					$v = "NOW()";
				}
				$placeholdersArray[":{$k}"] = $v; 
			}

			$placeholders = implode(array_keys($placeholdersArray),',');

			// Step 2: Write the SQL query
			
			$query = "INSERT INTO `{$this->tableName}` ({$fieldsString}) VALUES ( {$placeholders})";

			// Step 3: Use PDO prepared statements
			$q = $this->dbh->prepare($query);

			// Step 4: Execute the query
			$q->execute($placeholdersArray);
			return true;
		} catch(PDOException $e) {
			echo $e->getMessage();
			return false;
		}
		
		
	}

	/**
	 * update()
	 * 
	 * @param array where (condition of which field will be updated) (one record) {field => value }
	 * @param array $data to be updated
	 * @param $where clause
	 * @return boolean
	 * @access public
	 */
	 public function update(array $where,array $data, $where=null) {
	 	
	 	if(!is_array($data)) { return false; }
	 	$placeholdersArray = array();
	 	$upd = "";
	 	$c = count($data) - 1;
	 	$i = 0;


	 	try {	
	 		if(!is_array(($where)) || count($where) > 1) {
	 			throw new PDOException("Where clause must be an array with only one element");
	 			return false;
	 		}

	 		$field = array_keys($where);
	 		$value = array_values($where);

	 		// Create an array for the placeholders and a string for the UPDATE
	 		foreach($data as $key => $val) {
	 			$pl[":{$key}"] = $val;
	 			$upd .= "{$key} = :{$key} ";
	 			if($i<$c) { $upd .= " , "; }
	 			$i++;
	 		}

	 		$query = "UPDATE {$this->tableName} SET {$upd} WHERE {$field[0]} = :{$field[0]}";
	 		// bind param 
	 		$pl[":{$field[0]}"] = $value[0];

	 		$q = $this->dbh->prepare($query);
	 		$q->execute($pl);
	 		if($q->rowCount() != 1) { return false; }
	 		return true; 

	 	} catch(PDOException $e) {
	 		echo $e->getMessage();
	 		return false;
	 	}

	 } 

	 /**
	  * delete()
	  * 
	  * @param string field_name
	  * @param int $id to be deleted
	  * @return booolean
	  * @access public
	  */
	  public function delete($fieldName, $id) {
	  	try {
		  	$query = "DELETE FROM {$this->tableName} WHERE {$fieldName} = :{$fieldName}";
		  	$q = $this->dbh->prepare($query);
		  	$q->bind_param(":{$fieldName}", $id);
		  	$q->execute();
		  	if($q->rowCount() != 1) { return false; } 
		  	return true;
		} catch(PDOException $e) {
			echo $e->getMessage(), "\n";
			return false;
		}
	  } 

} // end-class

