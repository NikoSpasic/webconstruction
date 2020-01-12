<?php  


class Posts extends Controller
{
	private $postModel;
	private $userModel;

	/**
	 * 
	 */
	public function __construct()
	{
		!isLoggedIn() ? redirect('users/login') : '';

		// Models-Instantiation:
		$this->postModel = $this->model('Post');
		$this->userModel = $this->model('User');
	}

	/**
	 * get Posts
	 * ['posts' => $posts] <=> compact('posts')
	 * Load view
	 */
	// public function index()
	// {
	// 	// Get POSTS:
	// 	$posts = $this->postModel->getPosts()['allPosts'];

	// 	$this->view('posts/index', compact('posts'));
	// }


	public function index($page = 1, $perPage = 5)
	{
		$perPage = isset($perPage) && $perPage <= 10 ? $perPage : 5;

		$start = ($page > 1) ? ($page * $perPage) - $perPage : 0;

		$total = $this->postModel->fetchAllPostsNumber();
		$pages = ceil($total / $perPage);


		$pagData = [
			'page' =>  $page,
			'perPage' => $perPage,
			'start' =>  $start,
			'pages' =>	$pages,
			'total' => $total
		];
		// Get POSTS:
		$posts = $this->postModel->getPosts($pagData)['allPosts'];

		$this->view('posts/index', compact('posts', 'pagData'));
	}







	/**
	 * 
	 */
	public function add()
	{
		if(isset($_POST['formAddPost'])) {
			// Sanitize POST
			// $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			$addData = [
				'title' 		=> cleanString($_POST['title']),
				'body' 		=> cleanString($_POST['body']),
				'user_id' 	=> $_SESSION['user_id'],
				'title_err' => null,
				'body_err' 	=> null,
			];

			// Validate Title:
			$addData['title_err'] = checkInputString($addData['title'], 1);

			// Validate Body:
			$addData['body_err']  = checkInputString($addData['body'], 3, 60000);

			if($addData['title_err'] || $addData['body_err']) {
				// ERROR(S):
				$this->view('posts/add', $addData);

			} else {
				// PROCESS:
				if($this->postModel->addPost($addData)) {

					flash('post_message', 'POST ADDED');
					redirect('posts');

				} else {

					die('Something went wrong');
				}
			}

		} else {

			$addData = null;
		}
		
		$this->view('posts/add', $addData);
	}

	/**
	 *
	 * ['post' => $post, 'user' => $user] <=> compact('post', 'user')
	 *
	 */
	public function show($id)
	{
		$post = $this->postModel->getPostById($id);
		$user = $this->userModel->getUserById($post->user_id);

		$this->view('posts/show', compact('post', 'user'));
	}

	/**
	 * 
	 */
	public function edit($id)
	{
		if(isset($_POST['formEditPost'])) {
			// Sanitize POST
			// $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
			$editData = [
				'id' 			=> $id,
				'title' 		=> cleanString($_POST['title']),
				'body' 		=> cleanString($_POST['body']),
				'user_id' 	=> $_SESSION['user_id'],
				'title_err' => null,
				'body_err' 	=> null,
			];

			// Validate Title:
			$editData['title_err'] = checkInputString($editData['title'], 1);

			// Validate Body:
			$editData['body_err']  = checkInputString($editData['body'], 3, 60000);

			if($editData['title_err'] || $editData['body_err']) {
				// ERROR(S)
				$this->view('posts/edit', $editData);

			} else {
				// PROCESS
				if($this->postModel->updatePost($editData)) {

					flash('post_message', 'POST UPDATED');
					redirect('posts');

				} else {

					die('Something went wrong');
				}

			}

		} else {
			// get existing post from model
			$post = $this->postModel->getPostById($id);

			// Check for owner:
			if($post->user_id != $_SESSION['user_id']) {
				redirect('posts');
			}

			$editData = [
				'id' 		=> $id,
				'title' 	=> $post->post_title,
				'body' 	=> $post->post_body,
			];
		}

		$this->view('posts/edit', $editData);
	}

	/**
	 * 
	 */
	public function delete($id)
	{
		if($_SERVER['REQUEST_METHOD'] == 'POST') {
			// get existing post from model
			$post = $this->postModel->getPostById($id);
			
			// Check for owner:
			if($post->user_id != $_SESSION['user_id']) {

				redirect('posts');
			}

			if($this->postModel->deletePost($id)) {

				flash('post_message', 'POST REMOVED', 'alert alert-danger');
				redirect('posts');

			} else {

				die('Something went wrong');
			}

		} else {

			redirect('posts');
		}
	}

	/**
	 * 
	 */
	// public function pagination($data)
	// {
	// 	if(isset($_GET['startPage']) && isset($_GET['perPage']) && $_GET['perPage'] <= 50) {

	// 		$pagData = [
	// 				'startPage' 		=> cleanString($_GET['startPage']),
	// 				'perPage' 			=> cleanString($_GET['perPage']),
	// 				'startPage_err' 	=> null,
	// 				'perPage_err' 		=> null,
	// 			];

	// 		// Validate Start Page:
	// 		$pagData['startPage_err'] = checkInputString($pagData['startPage'], 1);

	// 		// Validate Per Page:
	// 		$pagData['perPage_err'] = checkInputString($pagData['perPage'], 2);

	// 		if($pagData['startPage_err'] || $pagData['perPage_err']) {
	// 			// ERROR(S)
	// 			$pagData = [
	// 				'startPage' => 1,
	// 				'perPage'	=> 5,
	// 			];

	// 			$this->view('posts/index', $pagData);

	// 		} else {
	// 			// PROCESS
	// 			if($this->postModel->paginationPosts($data)) {

	// 				return true;

	// 			} else {

	// 				die('Something went wrong (Pagination)');
	// 			}
	// 		}

	// 		// // User Input
	// 		// $pagData['startPage'] 	= isset($_GET['startPage']) ? (int)$_GET['startPage'] : 1;
	// 		// $pagData['perPage'] 		= isset($_GET['perPage']) && $_GET['perPage'] <= 50 ? (int)$_GET['perPage'] : 5;

	// 		// $pagPosts = $this->postModel->paginationPosts($pagData);
	// 		// $this->view('posts/index', compact('pagPosts'));

	// 	} else {

	// 		$pagData = [
	// 			'startPage' => 1,
	// 			'perPage'	=> 5
	// 		];		
	// 	}

	// 	$this->view('posts/index', $pagData);

	// }
}