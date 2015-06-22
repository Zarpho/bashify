<?php

/* :: Bashify ::
 * 
 * FILENAME:    lib/database.php
 * AUTHOR(S):   Joey Miller ("Zarpho")
 * DESCRIPTION: Contains the Database class.
 */

class Database
{
	public $hostname;
	public $username;
	public $password;
	public $database;
	
	/* Constructor method */
	function __construct($host, $user, $pass, $db)
	{
		$this->hostname = $host;
		$this->username = $user;
		$this->password = $pass;
		$this->database = $db;
	}
	
	/* Connects to database and returns connection */
	function connect()
	{
		return mysqli_connect($this->hostname, $this->username, $this->password, $this->database);
	}
}

?>