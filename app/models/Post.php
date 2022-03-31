<?php 

	class Post {

		private $db; 

		public function __construct() {
			$this->db = new Database; 
		}

		public function getPosts() {
			$this->db->query("SELECT categories.id as cat_id ,categories.name as cat_name,posts.*,users.id as user_id,users.name as name 
			FROM categories, posts , users 
			WHERE 
			 posts.cat_id = categories.id 
			AND 
			posts.user_id = users.id
			ORDER BY like_post DESC ");
			return $results = $this->db->resultSet();
		}

		public function addPost($data) {			
			$this->db->query('INSERT INTO posts (user_id,cat_id, title, body) VALUES (:user_id,:cat_id ,:title, :body)');

			// Bind Values 
			$this->db->bind(':user_id',intval($data['user_id']) , PDO::PARAM_INT);
			$this->db->bind(':cat_id',intval($data['cat_id']),PDO::PARAM_INT);
			$this->db->bind(':title', $data['title']);
			$this->db->bind(':body', $data['body']);

			// Execute 
			if($this->db->execute()){
					return true; 
			}else {
					return false; 
			}
		}

		public function updatePost($data) {
			$this->db->query('UPDATE posts SET title = :title, body = :body , cat_id=:cat_id WHERE id = :id');
			// Bind Values 
			$this->db->bind(':id', $data['id']);
			$this->db->bind(':title', $data['title']);
			$this->db->bind(':body', $data['body']);
			$this->db->bind(':cat_id', $data['cat_id']); 
			// Execute 
			if($this->db->execute()){
					return true; 
			}else {
					return false; 
			}
		}

		public function getPostById($id) {
			$this->db->query('SELECT * FROM posts WHERE id = :id');
			$this->db->bind(':id', $id);
			$row = $this->db->single();
			return $row;
		}
		public function getPostByCat($id) {
			$this->db->query("SELECT categories.id as cat_id ,categories.name as cat_name,posts.*,users.id as user_id,users.name as name 
			FROM categories, posts , users 
			WHERE 
			cat_id = :id
			AND
			 posts.cat_id = categories.id 
			AND 
			posts.user_id = users.id
			ORDER BY like_post DESC");
			$this->db->bind(':id', $id);
			$results = $this->db->resultSet();
			return $results;
		}

		public function deletePost($id) {
			$this->db->query('DELETE FROM posts WHERE id = :id ');
			// Bind Values 
			$this->db->bind(':id', $id);

			// Execute 
			if($this->db->execute()){
					return true; 
			}else {
					return false; 
			}
		}

		public function post_like($data, $votes) {
			$totalVotes = $data['like_post'] + $votes;

			$this->db->query('UPDATE posts SET like_post = :like_post WHERE id = :id ');

			// Bind Values 
			$this->db->bind(':id', $data['id']);
			$this->db->bind(':like_post', $totalVotes);

			// Execute 
			if($this->db->execute()){
				return true; 
			}else {
					return false; 
			}
		}
		public function post_dislike($data, $votes) {
			$totalVotes = $data['dislike'] + $votes;

			$this->db->query('UPDATE posts SET dislike = :dislike WHERE id = :id ');

			// Bind Values 
			$this->db->bind(':id', $data['id']);
			$this->db->bind(':dislike', $totalVotes);

			// Execute 
			if($this->db->execute()){
				return true; 
			}else {
					return false; 
			}
		}

	}