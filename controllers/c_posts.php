<?php

class posts_controller extends base_controller {

	   public function __construct() {
                
       # Make sure the base controller construct gets called
       parent::__construct();
        }
        
       public function add() {
       
      	 	$this->template->content = View::instance("v_posts_add");
            $this->template->title   = "Add a Post";   
            echo $this->template;
       
       }
            
        public function p_add() {
        
        
    
        	$_POST['user_id'] = $this->user->user_id;
            $_POST['created'] = Time::now();
            $_POST['modified'] = Time::now();
                
            DB::instance(DB_NAME)->insert('posts', $_POST);
                
                
           
        }
        
       public function view($input) {
                $this->template->content = View::instance("v_posts_view");
                $this->template->title = "View a Post";
                
                // Build the query
                $q = 'SELECT content, created, user_id, post_id
                        FROM posts
                        WHERE post_id = '.$input;
                
                // Run the query
                $post = DB::instance(DB_NAME)->select_row($q);

                $this->template->content->post = $post;

                echo $this->template;
        }
                 
                 
        public function delete_one($errorMsg) {
                $this->template->content = View::instance("v_posts_delete_one");
                $this->template->title = "Delete a Post";
                $this->template->content->msg = $errorMsg;
                
                // Build the query
                $q = 'SELECT content, created, user_id, post_id
                        FROM posts
                        WHERE post_id = '.$errorMsg;
                
                // Run the query
                $post = DB::instance(DB_NAME)->select_row($q);

                // Confirm that the user who posted it is editing it
                if (($this->user->user_id != $post['user_id']) && ($errorMsg != -1))
                {
                        Router::redirect('/posts/delete_one/-1');
                }
                
                $this->template->content->post = $post;

                echo $this->template;
        }
        
        public function p_delete_one() {
                
                $ret = DB::instance(DB_NAME)->delete('posts', "WHERE post_id = ".$_POST['post_id']);
                
                if ($ret != 1) {
                        echo "<h2> No posts to delete!</h2>";
                }
                else {
                        Router::redirect('/posts/edit');
                }         
        
        public function index() {
                
                # Set up view
                $this->template->content = View::instance('v_posts_index');
                
                # Set up query
                $q = 'SELECT
                         posts.*,
                         users.first_name,
                         users.last_name
                        FROM posts
                        INNER JOIN users
                         ON posts.user_id = users.user_id';
                         
                $posts = DB::instance(DB_NAME)->select_rows($q);
                
                $this->template->content->posts = $posts;
                
                echo $this->template;
        	
        }
        
        public function users() {
                
                # Set up view
                $this->template->content = View::instance("v_posts_users");
                
                # Set up query to get all users
                $q = 'SELECT *
                        FROM users';
                        
                # Set up query to get all connections from users_users table
                $users = DB::instance(DB_NAME)->select_rows($q);
                
                $q = 'SELECT *
                        FROM users_users
                        WHERE user_id = '.$this->user->user_id;
                        
                # Run query
                $connections = DB::instance(DB_NAME)->select_array($q,'user_id_followed');
                
                print_r($connections);
                
                # Pass data to the view
                $this->template->content->users = $users;
                $this->template->content->connections = $connections;
                
                # Render view
                echo $this->template;
    
    	}
    	
    	 /*-------------------------------------------------------------------------------------------------
        Creates a row in the users_users table representing that one user is following another
        -------------------------------------------------------------------------------------------------*/
        public function follow($user_id_followed) {
        
         		# Prepare the data array to be inserted
         		$data = Array(
         		"created" => Time::now(),
         		"user_id" => $this->user->user_id,
         		"user_id_followed" => $user_id_followed
         );
        
         		# Do the insert
         		DB::instance(DB_NAME)->insert('users_users', $data);
        
        		# Send them back
         		Router::redirect("/posts/users");
        
        }
        
        
        /*-------------------------------------------------------------------------------------------------
        Removes the specified row in the users_users table, removing the follow between two users
        -------------------------------------------------------------------------------------------------*/
        public function unfollow($user_id_followed) {
        
         		# Set up the where condition
         		$where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
        
         		# Run the delete
         		DB::instance(DB_NAME)->delete('users_users', $where_condition);
        
         		# Send them back
         		Router::redirect("/posts/users");
        
        }
        
    }
    
    
    