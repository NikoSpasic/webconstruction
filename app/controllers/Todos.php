<?php 


class Todos extends Controller
{
	private $todoModel;
	private $userModel;

	/**
	 * 
	 */
	public function __construct()
	{
		!isLoggedIn() ? redirect('users/login') : '';

		$this->todoModel = $this->model('Todo');
		$this->userModel = $this->model('User');
	}

	/**
	 * 
	 */
	public function index()
	{
		$todos = $this->todoModel->getTodos()['allTodos'];

		$this->view('todos/index', compact('todos'));
	}

	/**
	 * 
	 */
	public function add()
	{
		if(isset($_POST['formAddTodo'])) {

			// Sanitize POST
			// $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
			$data = [
				'description' 	=> cleanString($_POST['description']),
				
				'user_id' 		=> $_SESSION['user_id']
			];

			//process
			if($this->todoModel->addTodo($data)) {

				flash('todo_message', 'Todo Added');
				redirect('todos');

			} else {

				die('Something went wrong');

			}

		} else {

			$data = null;
		}

		$this->view('todos', $data);
	}

	/**
	 * 
	 */
	public function show($id)
	{
		$todo = $this->todoModel->getTodoById($id);
		$user = $this->userModel->getUserById($todo->user_id);

		$this->view('todos/show', compact('todo', 'user'));
	}

	/**
	 * 
	 */
	public function edit($id)
	{
		if(isset($_POST['formEditTodo'])) {
			// Sanitize POST
			// $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
			$data = [
				'id'		  => $id,
				'complete' => cleanString($_POST['complete']),
				'user_id'  => $_SESSION['user_id']
			];

			//process
			if($this->todoModel->updateTodo($data)) {

				redirect('todos');

			} else {

				return false;
			}

			# get existing todo from model
			$todo = $this->todoModel->getTodoById($id);

			# Check for owner:
			if($todo->user_id != $_SESSION['user_id']) {

				redirect('todos');
			}

			$data = [
				'id' 		  => $id,
				'complete' => $todo->todo_complete,
			];
		}

		$this->view('todos', $data);
	}

	/**
	 * 
	 */
	public function delete($id)
	{
		if(isset($_POST['formDeleteTodo'])) {
			// get existing todo from model
			$todo = $this->todoModel->getTodoById($id);
			
			// Check for owner:
			if($todo->user_id != $_SESSION['user_id']) {

				redirect('todos');
			}

			if($this->todoModel->deleteTodo($id)) {

				flash('post_message', 'TODO REMOVED FROM LIST', 'alert alert-danger');
				redirect('todos');

			} else {

				die('Something went wrong');
			}

		} else {

			redirect('todos');
		}
	}
}