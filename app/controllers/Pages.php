<?php 

class Pages extends Controller 
{
	private $pageModel;

	/**
	 * 
	 */
	public function __construct()
	{
		// Model-Instantiation:
		$this->pageModel = $this->model('Page');
	}

	/**
	 * 
	 */
	public function index()
	{
		// if(isLoggedIn()) {

		// 	redirect('posts');
		// }

		$pages = $this->pageModel->getPageElements();

		$this->view('pages/index', compact('pages'));

		// $indexData = [
		// 	'title'			=> 'Lorem ipsum dolor',
		// 	'description' 	=> 'Sit amet, consectetur adipisicing elit. Velit ducimus, molestias earum ea, exercitationem reprehenderit. Voluptate optio incidunt, quo voluptatibus delectus illum vitae laboriosam, odio, molestias beatae enim itaque? Molestiae ab laborum maiores!',
		// ];

		// $this->view('pages/index', $indexData);
	}

	/**
	 * 
	 */
	public function about()
	{
		$aboutData = [
			'title' 			=> "About Us",
			'description' 	=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit ducimus, molestias earum ea, exercitationem reprehenderit. Voluptate optio incidunt, quo voluptatibus delectus illum vitae laboriosam, odio, molestias beatae enim itaque? Molestiae ab laborum maiores!',
			'google-map' 	=> '',
		];

		$this->view('pages/about', $aboutData);
	}
	
	/**
	 * 
	 */
	public function contact()
	{
		$contactData = [
			'title' => 'Contact',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit ducimus, molestias earum ea, exercitationem reprehenderit. Voluptate optio incidunt, quo voluptatibus delectus illum vitae laboriosam, odio, molestias beatae enim itaque? Molestiae ab laborum maiores!',
		];

		$this->view('pages/contact', $contactData);
	}
}