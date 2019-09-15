<?php 


class Todo
{
	private $db;

	public function __construct()
	{
		$this->db = new Database;
	}

	public function getTodos()
	{
		$this->db->query(
			'SELECT *,
			todos.id as todoId,
			users.id as userId,
			todos.due as todoDue,
			users.created_at as userCreated
			FROM todos
			INNER JOIN users
			ON todos.user_id = users.id
			ORDER BY todos.due
			');

		$results = $this->db->resultSet();
		$rowCount = $this->db->rowCount();

		return $results;
	}

	public function addTodo($data)
	{
		$this->db->query("INSERT INTO todos (user_id, description, due) VALUES (:user_id, :description, :due)");

		$this->db->bind(':user_id', $data['user_id']);
		$this->db->bind(':description', $data['description']);
		$this->db->bind(':due', $data['due']);

		if($this->db->execute())
		{
			return true;
		} else {
			return false;
		}
	}

	#todo
	public function getTodoById($id)
	{
		$this->db->query("SELECT * FROM todos WHERE id = :id");
		$this->db->bind(':id', $id);

		$row = $this->db->single();

		// Check row
		if($this->db->rowCount() > 0)
		{
			return $row;
		} else {
			return false;
		}
	}

	#todo
	public function updateTodo($data)
	{
		$this->db->query('UPDATE todos SET complete = :complete WHERE id = :id ');

		$this->db->bind(':id', $data['id']);
		$this->db->bind(':complete', $data['complete']);

		if($this->db->execute())
		{
			return true;
		} else
		{
			return false;
		}
	}

	#todo
	public function deleteTodo($id)
	{
		$this->db->query("DELETE FROM todos WHERE id = :id");
		$this->db->bind(':id', $id);

		if($this->db->execute())
		{
			return true;
		} else
		{
			return false;
		}

	}
}