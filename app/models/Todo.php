<?php 


class Todo
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
	 * 
	 */
	public function getTodos()
	{
		// $sql = "SELECT *,
		// 	todos.id as todoId,
		// 	users.id as userId,
		// 	todos.due as todoDue,
		// 	users.created_at as userCreated
		// 	FROM todos
		// 	INNER JOIN users
		// 	ON todos.user_id = users.id
		// 	ORDER BY todos.due";
		$sql = "SELECT * FROM todo INNER JOIN user USING(user_id) ORDER BY todo_due";

		$statement = $this->pdo->prepare($sql);
		$statement->execute();

		$data['allTodos']  		= $statement->fetchAll(PDO::FETCH_OBJ);
		$data['countOfTodos'] 	= $statement->rowCount();

		return $data;
	}

	/**
	 * 
	 */
	public function addTodo($data)
	{
		$sql = "INSERT INTO todo (todo_description, user_id) VALUES (?, ?)";
		$params = [
			$data['description'], $data['user_id']
		];

		$statement = $this->pdo->prepare($sql);
		$statement->execute($params);

		return $this->pdo->lastInsertId();
	}

	/**
	 * 
	 */
	public function getTodoById($id)
	{
		$sql 		= "SELECT * FROM todo WHERE todo_id = ?";
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
	public function updateTodo($data)
	{
		$sql = "UPDATE todo SET todo_complete = ? WHERE todo_id = ?";
		$params = [
			$data['complete'], $data['id']
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
	public function deleteTodo($id)
	{
		$sql = "DELETE FROM todo WHERE todo_id = ?";
		$params = [$id];

		$statement = $this->pdo->prepare($sql);
		if($statement->execute($params)) {

			return true;

		} else {

			return false;
		}
	}
}