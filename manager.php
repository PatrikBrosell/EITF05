<?php

class Manager {

	/*
	 * Database variables
	 */
	private $db;
	private $dbHost;
	private $dbConnection;
	private $dbResult;
	private $dbPassword; //should this be a central secret password only we know? since user passwords should NOT give them db access..

	/*
	 * User Login variables
	 */
	private $loginUserName; 
	private $loginPassword; //maybe not even store this?

	//Add SQL statements here

	//-----------------------------------------------------------------------------------------------
	//-----------------------------------------------------------------------------------------------
	//-----------------------------------------------------------------------------------------------

	public function __construct($dbHost, $db, $dbPassword, $loginUserName, $loginPassword){
		$this->dbHost = $dbHost;
		$this->db = $db;
		$this->password = $password;

		$this->loginUserName = $loginUserName;
		$this->loginPassword = $loginPassword;
		
	}

	/*
	 * Applies our hash algorithm to an inputted password.
	 * Use this BEFORE we look for password in database, since they are not stored in plaintext
	 */
	public function hashPassword($pw){
		//hash it
		return null;
	}

	/*
	 * Logs in a user
	 */
	public function loginUser($userName, $pw){
		$hashedPW = hashPassword($pw);
		// do more stuff
	}

	/*
	 * Logs out a user
	 */
	public function logoutUser($userName){
		// do logout stuff
	}

	/*
	 * Registers a user
	 * Returns true if successful, returns false if unsuccessful
	 */
	public function registerUser($userName, $pw, $homeAddress){
		//IF(database !has $userName) THEN database.add(userName, hashPassword(pw), homeAddress) RETURN true
		//ELSE RETURN false
	}






	//----------------------------------------------------------------------------------
	// EVERYTHING BELOW IS USED TO CONNECT TO AND COMMUNICATE WITH THE DATABASE
	// för tillfället är all taget från ett tidigare php-projekt jag gjorde.
	// Vet inte än om vi kan använda detta rakt av eller om det måste justeras.
	//----------------------------------------------------------------------------------
	
	//TODO: all variable names need to be renamed to fit with the ones I have assigned at the top
	// of this document

		/** 
	 * Opens a connection to the database, using the earlier specified user
	 * name and password.
	 *
	 * @return true if the connection succeeded, false if the connection 
	 * couldn't be opened or the supplied user name and password were not 
	 * recognized.
	 */
	public function openConnection() {
		try {
			$this->conn = new PDO("mysql:host=$this->host;dbname=$this->database", 
					$this->userName,  $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			$error = "Connection error: " . $e->getMessage();
			print $error . "<p>";
			unset($this->conn);
			return false;
		}
		return true;
	}
	
	/**
	 * Closes the connection to the database.
	 */
	public function closeConnection() {
		$this->conn = null;
		unset($this->conn);
	}

	/**
	 * Checks if the connection to the database has been established.
	 *
	 * @return true if the connection has been established
	 */
	public function isConnected() {
		return isset($this->conn);
	}
	
	/**
	 * Execute a database query (select).
	 *
	 * @param $query The query string (SQL), with ? placeholders for parameters
	 * @param $param Array with parameters 
	 * @return The result set
	 */
	private function executeQuery($query, $param = null) {
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->execute($param);
			$result = $stmt->fetchAll();
		} catch (PDOException $e) {
			$error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
			die($error);
		}
		return $result;
	}
	
	/**
	 * Execute a database update (insert/delete/update).
	 *
	 * @param $query The query string (SQL), with ? placeholders for parameters
	 * @param $param Array with parameters 
	 * @return The number of affected rows
	 */
	private function executeUpdate($query, $param = null) {
		try {
			$stmt = $this->conn->prepare($query);
			$stmt->execute($param);
			$result = $stmt->rowCount();
		} catch (PDOException $e) {
			$error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
			die($error);
		}
		return $result;
	}



?>