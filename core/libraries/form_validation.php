<?php
/**
 * Form Validation
 * 
 */
class Form_validation {

	/**
	 * @var array $messages
	 * @access private
	 * 
	 */ 
	private $messages = array();

	/* constructor */
	public function __construct() {
		// ...
	}

	/**
	 * getMessages()
	 * 
	 * @return array
	 * @access public
	 * 
	 */ 
	public function getMessages() {
		return $this->messages;
	}

	/**
	 * validate()
	 * 
	 * @param field
	 * @param string $options
	 * @return boolean
	 * 
	 */ 
	public function validate($field, $options="") {
		// options:
		// "trim|email|max_length[n]|min_length[m]"
		// use regular expressions
		$m = explode('|',$options);

		// trim
		if(in_array('trim',$options)) {
			$field = trim($field);
		}

		// max_length[number]
		// use regular expressions and strlen()
		// also for min_length[number]

		// enail
		// use regular expressions
		if(in_array('email',$field)) {
			// ...

			$this->messages[] = 'Email address is not valid.';
		}


		// if false : add a message:
		$this->messages[] = '';

		return false;
	}

} // end-class

