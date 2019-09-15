<?php 


class Todos extends Controller
{
	private $todoModel;
	private $userModel;

	public function __construct()
	{
		!isLoggedIn() ? redirect('users/login') : '';

		# Instantiation MODEL-a User:
		$this->todoModel = $this->model('Todo');
		$this->userModel = $this->model('User');
	}


	public function index()
	{
		# Get POSTS:
		$todos = $this->todoModel->getTodos();
		$data = [
			'todos' => $todos
		];

		$this->view('todos/index', $data);
	}


	public function add()
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			// Sanitize POST
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data = [
				'description' => trim($_POST['description']),
				'due' => trim($_POST['due']),
				'user_id' => $_SESSION['user_id']
			];

			//process
			if($this->todoModel->addTodo($data))
			{
				flash('todo_message', 'Todo Added');
				redirect('todos');
			} else
			{
				die('Something went wrong');
			}

		} else {
			$data = [
				'description' => '',
				'due' => ''
			];
		}
		$this->view('todos/add', $data);
	}


	public function show($id)
	{
		$todo = $this->todoModel->getTodoById($id);
		$user = $this->userModel->getUserById($todo->user_id);

		$data = [
			'todo' => $todo,
			'user' => $user
		];
		$this->view('todos/show', $data);
	}


	public function edit($id)
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			// Sanitize POST
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$data = [
				'id' => $id,
				'complete' => (bool)trim($_POST['complete']),
				'user_id' => $_SESSION['user_id']
			];

			//process
			if($this->todoModel->updateTodo($data))
			{
				redirect('todos');
			} else
			{
				return false;
			}

			# get existing post from model
			$todo = $this->todoModel->getTodoById($id);

			# Check for owner:
			if($todo->user_id != $_SESSION['user_id'])
			{
				redirect('todos');
			}

			$data = [
				'id' => $id,
				'complete' => $todo->complete
			];
		}
		$this->view('todos/edit', $data);
	}


	public function delete($id)
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			# get existing post from model
			$todo = $this->todoModel->getTodoById($id);
			
			# Check for owner:
			if($todo->user_id != $_SESSION['user_id'])
			{
				redirect('todos');
			}

			if($this->todoModel->deleteTodo($id))
			{
				redirect('todos');
			} else {
				die('Something went wrong');
			}
		} else {
			redirect('todos');
		}
	}
}