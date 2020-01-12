<?php 


class Users extends Controller
{
	private $userModel;

	/**
	 * 
	 */
	public function __construct()
	{
		# Instantiation MODEL-a User:
		$this->userModel = $this->model('User');
	}

	/**
	 * 
	 */
	public function index()
	{
		$this->view('index');
	}

	/**
	 * 
	 */
	public function register()
	{
		// Check for post
		if(isset($_POST['formRegistration'])) {
			// Sanitize POST data
			// $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

			// Init data
			$registerData = [
				'first_name' 				=> cleanString($_POST['first_name']),
				'last_name' 				=> cleanString($_POST['last_name']),
				'username' 					=> cleanString($_POST['username']),
				'email' 						=> cleanString($_POST['email']),
				'password' 					=> cleanString($_POST['password']),
				'confirm_password' 		=> cleanString($_POST['confirm_password']),
				'first_name_err' 			=> null,
				'last_name_err' 			=> null,
				'username_err' 			=> null,
				'email_err' 				=> null,
				'password_err' 			=> null,
				'confirm_password_err' 	=> null,
			];

			// Validate FirstName:
			$registerData['first_name_err'] = checkInputString($registerData['first_name'], 2);

			// Validate Last Name:
			$registerData['last_name_err'] = checkInputString($registerData['last_name'], 2);
			
			// Validate Username:
			if(checkInputString($registerData['username'])) {

				$registerData['username_err'] = checkInputString($registerData['username'], 2, 25);

			} elseif($this->userModel->findUserByUsername($registerData['username'])) {

				$registerData['username_err'] = 'Username is already taken';
			}

			// Validate Email:
			if(checkEmail($registerData['email'])) {

				$registerData['email_err'] = checkEmail($registerData['email']);

			} elseif($this->userModel->findUserByEmail($registerData['email'])) {

				$registerData['email_err'] = 'Email is already taken';
			}

			// Validate Password:
			$registerData['password_err'] = checkInputString($registerData['password']);

			// Validate Confirm Password:
			if(checkInputString($registerData['confirm_password'])) {

				$registerData['confirm_password_err'] = checkInputString($registerData['confirm_password']);

			} elseif($registerData['confirm_password'] != $registerData['password']) {

				$registerData['confirm_password_err'] = 'Passwords do not match';
			}

			// Make sure errors are empty:
			if(($registerData['email_err']) || ($registerData['first_name_err']) || ($registerData['last_name_err']) || 
				($registerData['username_err']) || ($registerData['password_err']) || ($registerData['confirm_password_err'])) {

				// LOAD VIEW WITH ERRORS
				$this->view('users/register', $registerData);

			} else {

				// VALIDATED

				# Hash Password:
				$registerData['password'] = password_hash($registerData['password'], PASSWORD_DEFAULT);

				# Register USER:
				if($this->userModel->register($registerData)) {

					flash('register_success', 'You are registered and can log in');
					redirect('users/login');

				} else {

					die('Something went wrong');
				}
			}

		} else {

			// Init data
			$registerData = null;

			// Load view
			if(!isLoggedIn()){

				$this->view('users/register', $registerData);

			} else {

				redirect('posts');
			}
		}
	}

	/**
	 * 
	 */
	public function login()
	{
		if(isset($_POST['formLogin'])) {
			// Sanitize POST data
			// $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
			# --> Process form <--
			// Init data
			$loginData = [
				'username' 		=> cleanString($_POST['username']),
				'password' 		=> cleanString($_POST['password']),
				'username_err' => null,
				'password_err' => null,
				'logging_err' 	=> null,
			];

			// Validate Password:
			$loginData['password_err'] = checkInputString($loginData['password']);		

			// Validate Username:
			if(checkInputString($loginData['username'], 2)) {

				$loginData['username_err'] = checkInputString($loginData['username'], 2);

			} elseif(!$this->userModel->findUserByUsername($loginData['username'])) {

				$loginData['username_err'] = 'No user found';
			}			

			// Make sure errors are empty:
			if($loginData['username_err'] || $loginData['password_err']) {

				$loginData['logging_err'] = 'The email and password you entered did not match our records. <br> Please double-check and try again.';
				// Load view with errors
				$this->view('users/login', $loginData);

			} else {				
				// Check and set logged in user
				$loggedInUser = $this->userModel->login($loginData['username'], $loginData['password']);
				
				if($loggedInUser)	{
					//CREATE SESSION:
					$this->createUserSession($loggedInUser);

				} else {

					$loginData['logging_err'] = 'The email and password you entered did not match our records. Please double-check and try again.';
					$this->view('users/login', $loginData);
				}
			}

		} else {
			// Init data
			$loginData = null;

			// Load view
			if(!isLoggedIn()){

				$this->view('users/login', $loginData);

			} else {

				redirect('posts');
			}
		}
	}

	/**
	 * 
	 */
	public function createUserSession($user)
	{
		$_SESSION['user_id'] 			= $user->user_id;
		$_SESSION['user_email'] 		= $user->user_email;
		$_SESSION['user_first_name'] 	= $user->user_firstname;
		$_SESSION['user_last_name'] 	= $user->user_lastname;
		$_SESSION['user_username'] 	= $user->user_username;

		redirect('posts');
	}

	/**
	 * 
	 */
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