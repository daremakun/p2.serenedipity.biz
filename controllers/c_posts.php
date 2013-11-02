<?php

class posts_controller extends base_controller {

	   public function __construct() {
                
       # Make sure the base controller construct gets called
       parent::__construct();
        }
        
       public function add() {
       
      	 	$this->template->content = View::instance("v_posts_add");
                
                echo $this->template;
       
       }
            
        public function p_add() {
        
        	$_POST['user_id'] = $this->user->user_id;
            $_POST['created'] = Time::now();
            $_POST['modified'] = Time::now();
                
            DB::instance(DB_NAME)->insert('posts',$_POST);
        	
        }
        
        public function index() {
        
        $this->template->content = View::instance('v_posts_index');
        
        $q = 'SELECT *
        	FROM posts';
        	
        	$posts = DB::instance(DB_NAME)->select_rows($q);
                
                # Pass $posts array to the view
                $this->template->content->posts = $posts;
                
                # Render view
                echo $this->template;
        	
        }
    }