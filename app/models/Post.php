<?php 


class Post
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
	// public function getPosts()
	// {
	// 	$dbData = [];

	// 	$sql = "SELECT * FROM post INNER JOIN user USING(user_id) ORDER BY post_created DESC LIMIT 5";

	// 	$statement = $this->pdo->prepare($sql);
	// 	$statement->execute();

	// 	$dbData['allPosts']  		= $statement->fetchAll(PDO::FETCH_OBJ);
	// 	$dbData['countOfPosts'] 	= $statement->rowCount();

	// 	return $dbData;
	// }



	public function getPosts($data)
	{
		$dbData = [];

		$sql = "SELECT * FROM post INNER JOIN user USING(user_id) ORDER BY post_created LIMIT ?, ?";

		$statement = $this->pdo->prepare($sql);
		$statement->bindValue(1, $data['start'], PDO::PARAM_INT);
		$statement->bindValue(2, $data['perPage'], PDO::PARAM_INT);
		$statement->execute();

		$dbData['allPosts']  		= $statement->fetchAll(PDO::FETCH_OBJ);
		$dbData['countOfPosts'] 	= $statement->rowCount();

		return $dbData;
	}


	public function fetchAllPostsNumber()
	{

		$sql = "SELECT COUNT(post_id) FROM post";

		$statement = $this->pdo->prepare($sql);
		$statement->execute();

		$count = $statement->fetchColumn();

		return $count;
	}




	/**
	 * 
	 */
	public function addPost($data)
	{
		$sql 		= "INSERT INTO post (post_title, post_body, user_id) VALUES (?, ?, ?)";
		$params 	= [
			$data['title'], $data['body'], $data['user_id']
		];

		$statement = $this->pdo->prepare($sql);
		$statement->execute($params);

		return $this->pdo->lastInsertId();
	}

	/**
	 * 
	 */
	public function getPostById($id)
	{
		$sql 		= "SELECT * FROM post WHERE post_id = ?";
		$params 	= [$id];

		$statement = $this->pdo->prepare($sql);
		$statement->execute($params);

		$row = $statement->fetch(PDO::FETCH_OBJ);
		if($statement->rowCount() > 0) {

			return $row;

		} else {

			return false;
		}
	}

	/**
	 * 
	 */
	public function updatePost($data)
	{
		$sql 		= "UPDATE post SET post_title = ?, post_body = ? WHERE post_id = ?";
		$params 	= [
			$data['title'], $data['body'], $data['id'],
		];

		$statement = $this->pdo->prepare($sql);
		if($statement->execute($params)) {

			return true;

		} else {

			return false;
		}
	}

	/**
	 * 
	 */
	public function deletePost($id)
	{
		$sql 		= "DELETE FROM post WHERE post_id = ?";
		$params 	= [$id];

		$statement = $this->pdo->prepare($sql);
		if($statement->execute($params)) {

			return true;

		} else {
			
			return false;
		}
	}
}