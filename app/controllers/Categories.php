<?php 

	class Categories extends Controller {

		public function __construct() {
			if(!isLoggedIn()) {
				redirect('users/login');
			}

			$this->catModel = $this->model('Category');
			$this->userModel = $this->model('User');
		}
        public function index() {
			// Get Categories
			$categories = $this->catModel->getCategory();

			$data = [
				'categories' => $categories
			];

			$this->view('categories/index', $data);
		}
		public function add() {
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Sanitize post array
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$data = [
					'name' => trim($_POST['name']),
					'user_id' => $_SESSION['user_id'],
				];

				// Validate title
				if (empty($data['name'])){
					$data['name_err'] = 'Please enter a name';
				}

				// Make sure no errors
				if(empty($data['name_err'])) {
					// Validated
					if($this->catModel->addCategory($data)) {

						flash('Category_message', 'Category Added');
						redirect('posts');
					} else {
						die('Something went wrong!');
					}
				}else {
					// Load view with errors
					$this->view('categories/add', $data);
				}


			}else {
				$data = [
					'name' => '',
			];

			$this->view('categories/add', $data);
			}

		}
		public function edit() {
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Sanitize post array
				$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
				$data = [
					'name' => trim($_POST['name']),
					'user_id' => $_SESSION['user_id'],
				];

				// Validate title
				if (empty($data['name'])){
					$data['name_err'] = 'Please enter a name';
				}

				// Make sure no errors
				if(empty($data['name_err'])) {
					// Validated
					if($this->postModel->updateCategory($data)) {
						flash('Category_message', 'Category Added');
						redirect('categories');
					} else {
						die('Something went wrong!');
					}
				}else {
					// Load view with errors
					$this->view('categories/add', $data);
				}


			}else {
				$data = [
					'name' => '',
			];

			$this->view('categories/add', $data);
			}

		}
		public function delete($id) {
			if($_SERVER['REQUEST_METHOD'] == 'POST') {
				// Fetch the post 
				$post = $this->catModel->getCatById($id);

				// Check for owner 
				if ($post->user_id != $_SESSION['user_id']){
					redirect('posts');
				}
				if($this->postModel->deletePOst($id)) {
					flash('category_message', 'category Removed');
					redirect('posts');
				}else {
					die('Something Went Wrong!');
				}
			} else {
				redirect('posts');
			}
		}
    
    }
