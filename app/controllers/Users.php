<?php 

	class Users extends Controller {

		public function __construct() {
      $this->userModel = $this->model('User');
		}

		public function register() {
      //Check for posts
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Process form 

        // Sanitize Post data 
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'name' => trim($_POST['name']),
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'confirm_password' => trim($_POST['confirm_password']),
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => '',
        ];

        // Validate Email 
        if (empty($data['email'])) {
          $data['email_err'] = "Please enter email";
        }else {
          // Check email 
          if($this->userModel->findUserByEmail($data['email'])) {
            $data['email_err'] = "Email is already taken";
            echo $data['email_err'];
          }
        }

        // Validate name
        if (empty($data['name'])) {
          $data['name_err'] = "Please enter name";
        }

        // Validate Password  
        if (empty($data['password'])) {
          $data['password_err'] = "Please enter password";
        }elseif(strlen($data['password']) < 6 ) {
          $data['password_err'] = "Password must be at lesat 6 characters";
        }

        // Validate Confirm Password  
        if (empty($data['password'])) {
          $data['confirm_password_err'] = "Please Confirm password";
        }else {
          if($data['password'] != $data['confirm_password']){
            $data['confirm_password_err'] = "Passwords do not match";
          }
        }

        // Make sure errors are empty 
        if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) &&
        empty($data['confirm_password_err'])) {
          // Hash Password 
          $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

          // Register User 
          if($this->userModel->register($data)){
            flash('register_success', 'You are registered and can log in!');
            redirect('users/login');
          } else {
            die('Something went wrong!');
          }
        } else {
          // Load view with errors 
          $this->view('users/register', $data);
        }

      }else {
        //Init Data
        $data = [
          'name' => '',
          'email' => '',
          'password' => '',
          'confirm_password' => '',
          'name_err' => '',
          'email_err' => '',
          'password_err' => '',
          'confirm_password_err' => '',
        ];

        //Load View
        $this->view('users/register', $data);
      }
    } // End of register method 

		public function login() {
      //Check for posts
      if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // //Process Form 
        // echo $_SERVER['REQUEST_METHOD'];
        // Sanitize Post data 
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        $data = [
          'email' => trim($_POST['email']),
          'password' => trim($_POST['password']),
          'email_err' => '',
          'password_err' => '',
        ];

        // Validate Email 
        if (empty($data['email'])) {
          $data['email_err'] = "Please enter email";
        }

        // Validate Password  
        if (empty($data['password'])) {
          $data['password_err'] = "Please enter password";
        }elseif(strlen($data['password']) < 6 ) {
          $data['password_err'] = "Password must be at lesat 6 characters";
        }

        // Check for user email 
        if($this->userModel->findUserByEmail($data['email'])){
          // User found 
        }else {
          // User not found
          $data['email_err'] = 'No user Found';
        }

        // Make sure errors are empty 
        if(empty($data['email_err']) && empty($data['password_err'])) {
          // Validated 
          // Check and set logged in user 
          $loggedInUser = $this->userModel->login($data['email'], $data['password']);
          if ($loggedInUser) {
            // Create session
            $this->createUserSession($loggedInUser);
            die('workd');
          }else {
            $data['password_err'] = 'Password Incorrect';
            $this->view('users/login', $data);
          }
        } else {
          // Load view with errors 
          $this->view('users/login', $data);
        }


      }else {
        //Init Data
        $data = [
          'email' => '',
          'password' => '',
          'email_err' => '',
          'password_err' => '',
        ];

        //Load View
        $this->view('users/login', $data);
      }
    } // End of login method 

    public function createUserSession($user) {
      $_SESSION['user_id'] = $user->id;
      $_SESSION['email'] = $user->email;
      $_SESSION['name'] = $user->name;
      redirect('posts');
    }

    public function logout() {
      unset($_session['user_id']);
      unset($_session['email']);
      unset($_session['name']);
      session_destroy();
      redirect('users/login');
    }

	}