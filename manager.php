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
	}

	/*
	 * Applies our hash algorithm to an inputted password.
	 * Use this BEFORE we look for password in database, since they are not stored in plaintext
	 */
	public function hashPassword($pw){
		//hash it
		//return $pw;
		return password_hash($pw, PASSWORD_DEFAULT);
	}

	/*
	 * Logs in a user
	 * Returns true if login is successful, return false if not
	 */
	public function loginUser($userName, $pw){
		$sqlLoginUser = "select password from users where username = ?";
		$sqlNbrFailedLogins = "select nbrFailedLogin from users where username = ?";
		$sqlFailedLoginUpdate = "UPDATE users SET nbrFailedLogin=nbrFailedLogin+1 WHERE username=?";
		$sqlResetLoginAttempts = "UPDATE users SET nbrFailedLogin=0 WHERE username=?";

		$hashedPW = $this->hashPassword($pw);
		$resultSet = $this->executeQuery($sqlLoginUser, array($userName));
		if(count($resultSet) == 1){
			if(password_verify($pw, $resultSet[0]['password'])){
			//if($resultSet[0]['password'] == $hashedPW){
				//fix login php session stuff? Or handle that in login.php?
				$resultSet = $this->executeQuery($sqlNbrFailedLogins, array($userName));
				if(count($resultSet) == 1){
					if($resultSet[0]['nbrFailedLogin'] > 5){
						return false;
					}
				}
				$resultSet = $this->executeUpdate($sqlResetLoginAttempts, array($userName));
				return true;
			}
			else{
				//update failed login
				$resultSet = $this->executeUpdate($sqlFailedLoginUpdate, array($userName));
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
		$sqlFindUser = "SELECT username FROM users WHERE username = ?";
		$resultSet = $this->executeQuery($sqlFindUser, array($userName));
		if(count($resultSet) == 0){
			$sqlRegister = "INSERT INTO users VALUES(?,?,?,?)";
			$hashedPW = $this->hashPassword($pw);
			$resultSet = $this->executeUpdate($sqlRegister, array($userName, $hashedPW, $homeAddress, 0));
			return true;
		}
		return false;
	}


	/*
	 * Returns an array of all products in the database
	 */
	public function getProductsAll(){
		$sqlGetProductsAll = "select * from products";
		return $resultSet = $this->executeQuery($sqlGetProductsAll, null);
	}

	public function printProducts(){
		$sqlGetProductsAll = "select * from products";
		$resultSet = $this->executeQuery($sqlGetProductsAll, null);
		for($i = 0; $i < count($resultSet); $i++){
			$product = array();
			array_push($product, $resultSet[$i]['name']);
			array_push($product, $resultSet[$i]['description']);
			array_push($product, $resultSet[$i]['price']);
			array_push($product, $resultSet[$i]['nbrInStore']);
			array_push($product, $resultSet[$i]['id']);
			array_push($product, $resultSet[$i]['usercomment']);
			echo '
			<div class="product-box">
				<h3 class="line-title">'.$product[0].'</h3>

				<p class="line-title">Description:</p>
				<p class="description">'.$product[1].'</p>

				<p class="line-title">Price:</p>
				<p>'.$product[2].'SEK</p>
			
				<p class = "line-title">Nbr in store:</p>
				<p>'.$product[3].'</p>

				<p class = "line-title">User Comment:</p>
				<p>'.$product[5].'</p>
			
				<form method=post action="addtocart.php">
					<input type="hidden" name="productID" value="'.$product[4].'">
					<input type="submit" value="Add">
					<input type="number" name="productCount" value="1" min="1" max="'.$product[3].'">
					to cart
				</form> 
			</div>';
		}
	}

	public function printProductCart($id, $nbr){
		$sqlGetProduct = "select * from products where id = ?";
		$resultSet = $this->executeQuery($sqlGetProduct, array($id));
		for($i = 0; $i < count($resultSet); $i++){
			$product = array();
			array_push($product, $resultSet[$i]['name']);
			array_push($product, $resultSet[$i]['description']);
			array_push($product, $resultSet[$i]['price']);
			array_push($product, $resultSet[$i]['nbrInStore']);
			array_push($product, $resultSet[$i]['id']);
			echo '
			<div class="product-box">
				<h3 class="line-title">'.$product[0].'</h3>

				<p class="line-title">Description:</p>
				<p class="description">'.$product[1].'</p>

				<p class="line-title">Price:</p>
				<p>'.$product[2]*$nbr.'SEK, ('.$product[2].'SEK/unit)</p>
			
				<p class = "line-title">Nbr in cart:</p>
				<p>'.$nbr.'</p>
			</div>';
		}
	}

	public function addToCart($id, $count){
		if(!isset($_SESSION['cartArray'])){
			$_SESSION['cartArray'] = array();
		}
		if(in_array($id, $_SESSION['cartArray'])){ //duplicates in product list.. not important
			//echo $_SESSION['cartArray'][0];
			//$_SESSION['cartArray'][$id][0] = $_SESSION['cartArray'][$id][0]+$count;
		}
		array_push($_SESSION['cartArray'], array($id, $count));
	}

	//TODO: transaction, make sure product quantity does not go below 0.
	public function buyProduct($id, $count){
		//$sqlBuyProduct = "UPDATE products SET nbrInStore=((SELECT nbrInStore from products where id=?)-?) WHERE id=?;";
		$sqlBuyProduct = "UPDATE products SET nbrInStore=nbrInStore-? WHERE id=?;";
		return $result = $this->executeUpdate($sqlBuyProduct, array($count, $id)); 
	}

	function searchForId($id, $array) {
	   foreach ($array as $key => $val) {
	       if ($val['uid'] === $id) {
	           return $key;
	       }
	   }
	   return null;
	}

	function cleanUserInput($input){
		$string = strip_tags($input);
		//$string = escapeshellarg($string); //??
		//$string = escapeshellcmd($string); //??
		return $string; //GOOD
		//return $input; //BAD
	}

	function addFormToken($where){
		$token = $this->hashPassword(time());
		$_SESSION[$where] = $token;
		return $token;
	}

	function checkFormToken($where, $token){
		if(isset($_SESSION[$where])){
			if($_SESSION[$where] == $token){
				$_SESSION[$where] = null;
				return true;
			}
			else{
				return false;
			}
		}
		else{
			return false;
		}
	}

	function addComment($str){
		$sqlAddComment = "INSERT INTO guestbook VALUES(null, ?)";
		$resultSet = $this->executeUpdate($sqlAddComment, array($str));
	}

	function readComments(){
		$sqlReadComments = "SELECT comment FROM guestbook";
		$resultSet = $this->executeQuery($sqlReadComments, null);

		for($i = 0; $i < count($resultSet); $i++){
			//$comments = array();
			//array_push($comments, $resultSet[$i]['text']);
			echo '
				<div class="product-box">
					'.$resultSet[$i]['comment'].'
				</div>';
		}
	}

	public function openConnection() {
		try {
			$this->dbConnection = new PDO("mysql:host=$this->dbHost;dbname=$this->db", $this->dbUserName,  $this->dbPassword);
			$this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			$error = $e->getMessage();
			print $error;
			unset($this->conn);
			return false;
		}
		return true;
	}
	
	public function closeConnection() {
		$this->dbConnection = null;
		unset($this->dbConnection);
	}

	public function isConnected() {
		return isset($this->dbConnection);
	}
	
	private function executeQuery($query, $param = null) {
		try {
			$stmt = $this->dbConnection->prepare($query);
			$stmt->execute($param);
			$result = $stmt->fetchAll();
		} catch (PDOException $e) {
			$error = $e->getMessage() . $query;
			die($error);
		}
		return $result;
	}
	
	private function executeUpdate($query, $param = null) {
		try {
			$stmt = $this->dbConnection->prepare($query);
			$stmt->execute($param);
			$result = $stmt->rowCount();
		} catch (PDOException $e) {
			$error = $e->getMessage() . $query;
			die($error);
		}
		return $result;
	}
}
?>