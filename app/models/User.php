<?php 


class User
{
	private $pdo;

	/**
	 * 
	 */
	public function __construct()
	{
		$this->pdo = Connection::getInstance()->getPdo();
	}

	/**
	  * Register USER
	  */ 
	public function register($data)
	{
		$sql = "INSERT INTO 
			user (user_firstname, user_lastname, user_username, user_email, user_password) 
			VALUES (?, ?, ?, ?, ?)";
		$params = [
			$data['first_name'], $data['last_name'], $data['username'], $data['email'], $data['password'],
		];

		$statement = $this->pdo->prepare($sql);
		$statement->execute($params);

		return $this->pdo->lastInsertId();
	}

	/**
	 * Login USER
	 */
	public function login($username, $password)
	{
		$sql = "SELECT * FROM user WHERE (user_username = ?)";
		$params = [$username];

		$statement = $this->pdo->prepare($sql);
		$statement->execute($params);

		$row = $statement->fetch(PDO::FETCH_OBJ);

		$hashed_password = $row->user_password;

		if(password_verify($password, $hashed_password)) {

			return $row;

		} else {

			return false;
		}
	}

	/**
	 * Find USER by Email:
	 */
	public function findUserByEmail($email)
	{
		$sql = "SELECT * FROM user WHERE user_email = ?";
		$params = [$email];

		$statement = $this->pdo->prepare($sql);
		$statement->execute($params);

		$row = $statement->fetch(PDO::FETCH_OBJ);

		// Check row
		if($statement->rowCount() > 0) {

			return true;

		} else {

			return false;
		}
	}

	/**
	 * Find USER by Username:
	 */
	public function findUserByUsername($username)
	{
		$sql ="SELECT * FROM user WHERE user_username = ?";
		$params = [$username];

		$statement = $this->pdo->prepare($sql);
		$statement->execute($params);

		$row = $statement->fetch(PDO::FETCH_OBJ);

		// Check row
		if($statement->rowCount() > 0) {

			return true;

		} else {

			return false;
		}
	}

	/**
	 * Get USER by id:
	 */
	public function getUserById($id)
	{
		$sql = "SELECT * FROM user WHERE user_id = ?";
		$params = [$id];

		$statement = $this->pdo->prepare($sql);
		$statement->execute($params);

		$row = $statement->fetch(PDO::FETCH_OBJ);

		// Check row
		if($statement->rowCount() > 0) {

			return $row;

		} else {

			return false;
		}
	}
}