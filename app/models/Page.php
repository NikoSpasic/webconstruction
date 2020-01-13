<?php 

class Page
{
	private $pdo;

	/**
	 * Connection with DB
	 */
	public function __construct()
	{
		$this->pdo = Connection::getInstance()->getPdo();
	}

	/**
	 * 
	 */
	public function getPageElements()
	{
		$pageData = [];

		$sql = "SELECT * FROM page";

		$statement = $this->pdo->prepare($sql);
		$statement->execute();

		$pageData = $statement->fetch(PDO::FETCH_OBJ);

		return $pageData;
	}
}