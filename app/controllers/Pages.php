<?php 	

	class Pages extends Controller {

		public function __construct() {
			$this->postModel = $this->model('Post');
			$this->userModel = $this->model('User');
			$this->catModel = $this->model('Category');
		}

		public function index() {
			// $posts = $this->postModel->getPosts();
			if (isLoggedIn()){
				redirect('posts');
			}
		
			if(isset($_GET['search'])){
				$posts = $this->postModel->getPostByCat($_GET['id']);

			}else{
				$posts = $this->postModel->getPosts();
			}
		
			$categories = $this->catModel->getCategory();


			$data = [
				'posts' => $posts,
				'categories'=>$categories
			];
			$this->view('pages/index', $data);
		}

		public function about() {
			$data = [
				"title" => "About"
			];

			$this->view('pages/about', $data);
		}

	}