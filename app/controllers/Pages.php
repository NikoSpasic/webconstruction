<?php 

class Pages extends Controller 
{

	public function index()
	{
		if(isLoggedIn())
		{
			redirect('posts');
		}

		$data2323 = [
			'title' => 'Lorem ipsum dolor',
			'description' => 'Sit amet, consectetur adipisicing elit. Velit ducimus, molestias earum ea, exercitationem reprehenderit. Voluptate optio incidunt, quo voluptatibus delectus illum vitae laboriosam, odio, molestias beatae enim itaque? Molestiae ab laborum maiores!'
			
		];

		$this->view('pages/index', $data2323);
	}

	public function about()
	{
		$data2323 = [
			'title' => 'About Us',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit ducimus, molestias earum ea, exercitationem reprehenderit. Voluptate optio incidunt, quo voluptatibus delectus illum vitae laboriosam, odio, molestias beatae enim itaque? Molestiae ab laborum maiores!',
			'google-map' => ''
		];
		$this->view('pages/about', $data2323);
	}

	public function contact()
	{
		$data2323 = [
			'title' => 'Contact',
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit ducimus, molestias earum ea, exercitationem reprehenderit. Voluptate optio incidunt, quo voluptatibus delectus illum vitae laboriosam, odio, molestias beatae enim itaque? Molestiae ab laborum maiores!'
		];
		$this->view('pages/contact', $data2323);
	}
}