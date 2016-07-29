<?php
/**
 * auth.php
 * 
 * Authentication class
 * Part of Orpheus Framework core
 * 
 * @package
 * @author Charalampos Mavidis
 * @since version 0.1
 * 
 *  
 *
 */
class Auth {

	// Retrieval of data from a database is not done here.
	// This class only provides some functions for security purposes.
	private _username = '';
	private _password = '';
	/**** SECURITY FUNCTION ****/

	/**
	 * hashPassword() 
	 * 
	 * @param string $password
	 * @return string
	 * @access public
	 */
	 public function hashPassword($passwd) {
	 	/* - Use sha1 instead of md5
		   - Use a salt, unique for each user 
		 */
	 } 

	 /**
	  * compareHashes()
	  * 
	  * @param string $userInput
	  * @param string $dbHash
	  * @return bool
	  * @access public 
	  * 
	  */
	  public function compareHashes($userInput, $dbHash) {
	  	// Step 1: Use hashPassword() to create a hash for $userInput
	  	$userHash = $this->hashPassword($userInput);

	  	// Step 2: Compare the two hashes
	  	if($userHash == $dbHash) {
	  		return true;
	  	}
	  	return false;
	  } 

} // end-class
