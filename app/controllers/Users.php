<?php 


class Users extends Controller
{
	private $userModel;

	public function __construct()
	{
		# Instantiation MODEL-a User:
		$this->userModel = $this->model('User');
	}

	public function index()
	{
		$this->view('index');
	}

	public function register()
	{
		// Check for post
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			// Sanitize POST data
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			// Init data
			$data = [
				'first_name' => trim($_POST['first_name']),
				'last_name' => trim($_POST['last_name']),
				'username' => trim($_POST['username']),
				'email' => trim($_POST['email']),
				'password' => trim($_POST['password']),
				'confirm_password' => trim($_POST['confirm_password']),
				'first_name_err' => '',
				'last_name_err' => '',
				'username_err' => '',
				'email_err' => '',
				'password_err' => '',
				'confirm_password_err' => ''
			];

			# Validate Email:
			if(empty($data['email']))
			{
				$data['email_err'] = 'Please enter email';
			} elseif($this->userModel->findUserByEmail($data['email'])) {
				$data['email_err'] = 'Email is already taken';
			}
			# Validate FirstName:
			if(empty($data['first_name']))
			{
				$data['first_name_err'] = 'Please enter first name';
			}
			# Validate Last Name:
			if(empty($data['last_name']))
			{
				$data['last_name_err'] = 'Please enter last name';
			}
			# Validate Username:
			if(empty($data['username']))
			{
				$data['username_err'] = 'Please enter username';
			} elseif($this->userModel->findUserByUsername($data['username'])) {
				$data['username_err'] = 'Username is already taken';
			}
			# Validate Password:
			if(empty($data['password']))
			{
				$data['password_err'] = 'Please enter password';
			}elseif(strlen($data['password']) < 6) {
				$data['password_err'] = 'Password must be at least 6 characters';
			}
			# Validate Confirm Password:
			if(empty($data['confirm_password']))
			{
				$data['confirm_password_err'] = 'Please confirm password';
			}elseif($data['confirm_password'] != $data['password']) {
				$data['confirm_password_err'] = 'Passwords do not match';
			}
			# Make sure errors are empty:
			if(empty($data['email_err']) && empty($data['first_name_err']) && empty($data['last_name_err']) && empty($data['username_err']) && empty($data['password_err']) && empty($data['confirm_password_err']))
			{
				// Validated

				# Hash Password:
				$data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

				# Register USER:
				if($this->userModel->register($data))
				{
					flash('register_success', 'You are registered and can log in');
					redirect('users/login');
				} else 
				{
					die('Something went wrong');
				}
			} else 
			{
				// Load view with errors
				$this->view('users/register', $data);
			}

		} else 
		{
			// Init data
			$data = [
				'first_name' => '',
				'last_name' => '',
				'username' => '',
				'email' => '',
				'password' => '',
				'confirm_password' => '',
				'name_err' => '',
				'email_err' => '',
				'password_err' => '',
				'confirm_password_err' => ''
			];

			// Load view
			$this->view('users/register', $data);
		}
	}

	public function login()
	{
		// Check for post
		if($_SERVER['REQUEST_METHOD'] == 'POST')
		{
			// Sanitize POST data
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			// Process form

			// Init data
			$data = [
				'username' => trim($_POST['username']),
				'password' => trim($_POST['password']),
				'username_err' => '',
				'password_err' => ''
			];

			# Validate Username:
			if(empty($data['username']))
			{
				$data['username_err'] = 'Please enter username';
			}
			# Validate Password:
			if(empty($data['password']))
			{
				$data['password_err'] = 'Please enter password';
			}
			# Check for USER/EMAIL:
			if ($this->userModel->findUserByUsername($data['username']))
			{
				// User Found
			} else
			{
				// User not Found 
				$data['username_err'] = 'No user found';
			}
			# Make sure errors are empty:
			if(empty($data['username_err']) && empty($data['password_err']))
			{
				// Check and set logged in user
				$loggedInUser = $this->userModel->login($data['email'], $data['username'], $data['password']);
				if($loggedInUser)
				{
					//CREATE SESSION
					$this->createUserSession($loggedInUser);
				} else
				{
					$data['password_err'] = 'Password incorrect';
					$this->view('users/login', $data);
				}
			}else {
				// Load view with errors
				$this->view('users/login', $data);
			}

		}else {
			// Init data
			$data = [
				'username' => '',
				'email' => '',
				'password' => '',
				'username_err' => '',
				'password_err' => ''
			];
			// Load view
			$this->view('users/login', $data);
		}
	}

	public function createUserSession($user)
	{
		$_SESSION['user_id'] = $user->id;
		$_SESSION['user_email'] = $user->email;
		$_SESSION['user_first_name'] = $user->first_name;
		$_SESSION['user_last_name'] = $user->last_name;
		$_SESSION['user_username'] = $user->username;

		redirect('posts');
	}

	public function logout()
	{
		unset($_SESSION['user_id']);
		unset($_SESSION['user_email']);
		unset($_SESSION['user_first_name']);
		unset($_SESSION['user_last_name']);
		unset($_SESSION['user_username']);
		session_destroy();
		redirect('users/login');
	}

}