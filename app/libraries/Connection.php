<?php 

/*
* PDO Connection Class
* Connect to database
* Create prepared statement
* Bind values
* Return rows and results 
*/

class Connection
{
	private $host 	 = DB_HOST;
	private $user 	 = DB_USER;
	private $pass 	 = DB_PASS;
	private $dbname = DB_NAME;

	private static  $instance = null;
	private $pdo; 
	private $statement; 
	private $error;

	/**
	 * 
	 */
	private function __construct()
	{
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
		$options = array(
			PDO::ATTR_PERSISTENT => true,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		);

		// Create PDO instance
		try{
			$this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
		} catch(PDOException $e){
			$this->error = $e->getMessage();
			echo $this->error;
		}
	}

	/**
	 * 
	 */
	public static function getInstance()
	{
     if(is_null(self::$instance)) {
         self::$instance = new Connection();
     }

     return self::$instance;
    }

	/**
	 * 
	 */
	public function getPdo()
	{   
     return $this->pdo;
   }




	// /**
	//   * Prepare statement with query
	//   */ 
	// public function query($sql)
	// {
	// 	$this->statement = $this->pdo->prepare($sql);
	// }

	// /**
	//   * Bind values
	//   */ 
	// public function bind($param, $value, $type = null)
	// {
	// 	if(is_null($type)){
	// 		switch(true){
	// 			case is_int($value):
	// 				$type = PDO::PARAM_INT;
	// 				break;
	// 			case is_bool($value):
	// 				$type = PDO::PARAM_BOOL;
	// 				break;
	// 			case is_null($value):
	// 				$type = PDO::PARAM_NULL;
	// 				break;
	// 			default:
	// 				$type = PDO::PARAM_STR;
	// 		}
	// 	}

	// 	$this->statement->bindValue($param, $value, $type);
	// }

	// /**
	//   * Execute the prepared statement
	//   */ 
	// public function execute()
	// {
	// 	return $this->statement->execute();
	// }

	// // Get result set as array of objects
	// public function resultSet()
	// {
	// 	$this->execute();
	// 	return $this->statement->fetchAll(PDO::FETCH_OBJ);
	// }

	// // Get single record as object
	// public function single()
	// {
	// 	$this->execute();
	// 	return $this->statement->fetch(PDO::FETCH_OBJ);
	// }

	// // Get row count
	// public function rowCount() 
	// {
	// 	return $this->statement->rowCount();
	// }

}