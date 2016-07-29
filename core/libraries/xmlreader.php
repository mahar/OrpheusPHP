<?php
/**
 * xmlreader.php
 * 
 * XML reader library
 * Part of Orpheus Framework core
 * 
 * @package
 * @author Charalampos Mavidis
 * @since version 0.1
 * 
 */
class XMLreader {

	/*
	 * @var $feedUrl
	 * @access private
	 *
	 * Could be either a file or an actual url.
	 */
	private $feed_url; 
	
	private $is_url = true;

	private error_messages;

	function __construct() {
		$this->error_messages = array();
	}

	function __toString() {
		return "{xml parser object}";
	}
	/*
	 * @var $URLFILE = 1;
	 * @static 
	 * @library constant
	 * @access public
	 */ 
	public static FILE_FROM_URL = true;


	/*
	 * init() 
	 * 
	 * @param $url (if is not set already)
	 * @return xml object 
	 * @access public
	 * @throws Exception
	 */
	public function init($url = $this->feed_url, $urlorfile = self::$FILE_FROM_URL) {
		$this->setFeedUrl($url, $urlorfile);

		$output = false;

		if(isset($feed_url)) {

			// Check if it is a url
			if ($is_url) {
				// use curl
				$curl = curl_init();
				curl_setopt($curl, CURLOPT_URL, $feed_url);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				$output = curl_exec($curl); // this variable holds the entire xml file
				curl_close($curl);
				if ($feed = simplexml_load_string($output)) {
					return $feed;
				} else {
					$this->error_messages[] = "The url given is not a well-formatted xml file";
					throw new Exception("The url given is not a well-formatted xml file", 1);
					return;
				}
			} else {
				if (file_exists($feed_url)) {
					$feed = simplexml_load_file($feed_url);
					return $output;
				} else {
					$this->error_messages[] = "File does not exist.";
					throw new Exception("XML reader : File does not exist.", 1);
					return;
				}
			}

			
	}


	/* 
	 * getErrorMessages
	 *
	 * @return array
	 * @access public
	 */ 
	public function getErrorMessages() {
		return $this->error_messages;
	}

	/*
	 * getFeedUrl()
	 * 
	 * @return string
	 * @access public
	 */
	public function getFeedUrl() {
		return $this->feed_url;
	}

	/*
	 * setFeedUrl()
	 * 
	 * @param string $url
	 * @param int $urlorfile -> { 1 : url , else : it is a file  (defailt)}
	 * @return void
	 * @access public
	 */

	public function setFeedUrl($url, $urlorfile = false) {
		$this->feed_url = $url;
		 $this->is_url = ($urlorfile == self::$FILE_FROM_URL);

	}

}// end-class

