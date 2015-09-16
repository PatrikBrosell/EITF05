<?php


class Manager {

	/*
	 * Database variables
	 */
	private $dbHost;
	private $db;
	private $dbUserName;
	private $dbPassword;

	private $dbConnection;
	private $dbResult;

	/*
	 * User Login variables
	 */
	private $loginUserName; 
	private $loginPassword; //maybe not even store this?

	//Add SQL statements here

	//-----------------------------------------------------------------------------------------------
	//-----------------------------------------------------------------------------------------------
	//-----------------------------------------------------------------------------------------------

	public function __construct(){
		require_once("database_connection_data.php"); //to access our DB connection variables
		$array = array($dbHostC, $dbC, $dbUserNameC, $dbPasswordC);
		$this->dbHost = $array[0];
		$this->db = $array[1];
		$this->dbUserName = $array[2];
		$this->dbPassword = $array[3];

		//$this->loginUserName = $loginUserName;
		//$this->loginPassword = $loginPassword;
		
	}

	/*
	 * Applies our hash algorithm to an inputted password.
	 * Use this BEFORE we look for password in database, since they are not stored in plaintext
	 */
	public function hashPassword($pw){
		//hash it
		return $pw;
	}

	/*
	 * Logs in a user
	 * Returns true if login is successful, return false if not
	 */
	public function loginUser($userName, $pw){
		$sqlLoginUser = "select password from users where username = ?";
		$hashedPW = $this->hashPassword($pw);
		$resultSet = $this->executeQuery($sqlLoginUser, array($userName));
		if(count($resultSet) == 1){
			if($resultSet[0]['password'] == $hashedPW){
				//fix login php session stuff? Or handle that in login.php?
				return true;
			}
			else{
				//generate fail login html content? Or handle that in login.php?
				return false;
			}
		}
		else{
			//generate fail login html content? Or handle that in login.php?
			return false;
		}
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

	/*
	 * Returns an array of all products in the database
	 */
	public function getProductsAll(){
		$sqlGetProductsAll = "select * from products";
		return $resultSet = $this->executeQuery($sqlGetProductsAll, null);
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
			$this->dbConnection = new PDO("mysql:host=$this->dbHost;dbname=$this->db", 
					$this->dbUserName,  $this->dbPassword);
			$this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
		$this->dbConnection = null;
		unset($this->dbConnection);
	}

	/**
	 * Checks if the connection to the database has been established.
	 *
	 * @return true if the connection has been established
	 */
	public function isConnected() {
		return isset($this->dbConnection);
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
			$stmt = $this->dbConnection->prepare($query);
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
			$stmt = $this->dbConnection->prepare($query);
			$stmt->execute($param);
			$result = $stmt->rowCount();
		} catch (PDOException $e) {
			$error = "*** Internal error: " . $e->getMessage() . "<p>" . $query;
			die($error);
		}
		return $result;
	}
}
?>