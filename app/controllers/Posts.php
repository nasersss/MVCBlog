<?php 

	class Posts extends Controller {

		public function __construct() {
			

			$this->postModel = $this->model('Post');
			$this->userModel = $this->model('User');
			$this->catModel = $this->model('Category');
		}

		public function index() {
			if(!isLoggedIn()) {
				redirect('users/login');
			}
			// Get Posts
			if(isset($_GET['search'])){
				if($_GET['search']=='all'){
					$posts = $this->postModel->getPosts();
				}else{
					$posts = $this->postModel->getPostByCat($_GET['id']);
				}

			}else{
				$posts = $this->postModel->getPosts();
			}
		
			$categories = $this->catModel->getCategory();


			$data = [
				'posts' => $posts,
				'categories'=>$categories
			];
			
		
			$this->view('posts/index', $data);
		}

		public function add() {
			if(!isLoggedIn()) {
				redirect('users/login');
			}

			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Sanitize post array
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$data = [
					'title' => trim($_POST['title']),
					'body' => trim($_POST['body']),
					'user_id' => $_SESSION['user_id'],
					'cat_id' => $_POST['cat_id'],
					'title_err' => '',
					'body_err' => '',
				];

				// Validate title
				if (empty($data['title'])){
					$data['title_err'] = 'Please enter a title';
				}

				// Validate body
				if (empty($data['body'])){
					$data['body_err'] = 'Please enter body text';
				}

				// Make sure no errors
				if(empty($data['title_err']) && empty($data['body_err'])) {
					print_r($data);
					// Validated
					if($this->postModel->addPost($data)) {
						flash('post_message', 'Post Added');
						redirect('posts');
					} else {
						die('Something went wrong!');
					}
				}else {
					// Load view with errors
					$this->view('posts/add', $data);
				}


			}else {
				$categories = $this->catModel->getCategory();
				$data = [
					'title' => '',
					'body' => '',
					'categories' => $categories,

			];

			$this->view('posts/add', $data);
			}

		}

		public function edit($id) {
			if(!isLoggedIn()) {
				redirect('users/login');
			}
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				
				// Sanitize post array
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$data = [
					'id'=> intval($_POST['id']),
					'title' => trim($_POST['title']),
					'body' => trim($_POST['body']),
					'user_id' => $_SESSION['user_id'],
					'cat_id'=>$_POST['cat_id'],
					'title_err' => '',
					'body_err' => '',
				];

				// Validate title
				if (empty($data['title'])){
					$data['title_err'] = 'Please enter a title';
				}

				// Validate body
				if (empty($data['body'])){
					$data['body_err'] = 'Please enter body text';
				}

				// Make sure no errors
				if(empty($data['title_err']) && empty($data['body_err'])) {
					// Validated
					if($this->postModel->updatePost($data)) {
						flash('post_message', 'Post Updated');
						redirect('posts');
					} else {
						die('Something went wrong!');
					}
				}else {
					// Load view with errors
					$this->view('posts/edit', $data);
				}


			}else {
				// Fetch the post 
				$post = $this->postModel->getPostById($id);

				// Check for owner 
				if ($post->user_id != $_SESSION['user_id']){
					redirect('posts');
				}
				$categories = $this->catModel->getCategory();
				$data = [
					'id' => $id,
					'title' => $post->title,
					'body' => $post->body,
					'categories' => $categories,
				];

			$this->view('posts/edit', $data);
			}

		}

		public function show($id) {
			if(!isLoggedIn()) {
				redirect('users/login');
			}
			$post = $this->postModel->getPostById($id);
	
			$user = $this->userModel->getUserById($post->user_id);
			$data = [
				'post' => $post,
				'user' => $user,
			];
			$this->view('posts/show', $data);
		}

		public function delete($id) {
			if(!isLoggedIn()) {
				redirect('users/login');
			}
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Fetch the post 
				$post = $this->postModel->getPostById($id);

				// Check for owner 
				if ($post->user_id != $_SESSION['user_id']){
					redirect('posts');
				}
				if($this->postModel->deletePOst($id)) {
					flash('post_message', 'Post Removed');
					redirect('posts');
				}else {
					die('Something Went Wrong!');
				}
			} else {
				redirect('posts');
			}
		}

		public function post_like ($id) {
			if($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Fetch the post 
				$post = $this->postModel->getPostById($id);
				$votes = 1;
				$data = [
					'id' => $id,
					'like_post' => $post->like_post
				];
				// settype($id, "integer");
				if($this->postModel->post_like($data, $votes)) {
					flash('post_message', 'Point Added to Post');
					redirect('pages');
				}else {
					die('Something Went Wrong!');
				}
			} else {
				redirect('pages');
			}
		}

		public function post_dislike ($id) {
			if($_SERVER['REQUEST_METHOD'] == 'POST') {

				// Fetch the post 
				$post = $this->postModel->getPostById($id);
				$votes = 1;
				$data = [
					'id' => $id,
					'dislike' => $post->dislike
				];
				echo 'here';
				// settype($id, "integer");
				if($this->postModel->post_dislike($data, $votes)) {
					flash('post_message', 'Point Subtracted from Post');
					redirect('pages');
				}else {
					die('Something Went Wrong!');
				}
			} else {
				redirect('pages');
			}
		}

	}