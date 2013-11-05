<?php
class users_controller extends base_controller {

    			public function __construct() {
        		parent::__construct();
 
    } 

    			public function index() {
        		 Router::redirect('/');
    }

/*-------------------------------------------------------------------------------------------------
        Display a form so users can sign up        
        -------------------------------------------------------------------------------------------------*/

    public function signup() {
                
                 $this->template->content = View::instance('v_users_signup');        
        
                echo $this->template;
        }
    /*-------------------------------------------------------------------------------------------------
Process the sign up form
-------------------------------------------------------------------------------------------------*/
    
   public function p_signup() {
         # Dump out the results of POST to see what the form submitted
         // print_r($_POST);
        
                $_POST['created'] = Time::now();
                $_POST['modified'] = Time::now();
                
                $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
                # Create an encrypted token via their email address and a random string
                $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
        
         		# Insert this user into the database
         		$user_id = DB::instance(DB_NAME)->insert('users', $_POST);
        
        
         		//echo 'You\'re signed up';
        
         		Router::redirect('/users/login');
        
    }

    public function login() {

    			$this->template->content = View::instance('v_users_login');
        
        		echo $this->template;
    }
        
         /*-------------------------------------------------------------------------------------------------
Process the login form
-------------------------------------------------------------------------------------------------*/
    public function p_login() {
    
    	$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
        
        
         $q = "SELECT token FROM users WHERE email = '".$_POST['email']."' and password = '".$_POST['password']."'";
        
         		$token = DB::instance(DB_NAME)->select_field($q);
        
         		if(!$token) {
                 Router::redirect("/users/login/");
                 } 
                 else {
                 setcookie("token",$token,strtotime('+1 year'),'/');
                
                 Router::redirect("/");
         		}
        
    }
           


    public function logout() {
       
       			# Generate a new token they'll use next time they login
       			$new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
       
       			# Update their row in the DB with the new token
       			$data = Array(
               'token' => $new_token
       );
       			DB::instance(DB_NAME)->update('users',$data, 'WHERE user_id ='. $this->user->user_id);
       
       			# Delete their old token cookie by expiring it
       			setcookie('token', '', strtotime('-1 year'), '/');
       
       			# Send them back to the homepage
       			Router::redirect('/');
    }

        /*-------------------------------------------------------------------------------------------------
        
        -------------------------------------------------------------------------------------------------*/
    public function profile($user_name = NULL) {
                
             $this->template->content = View::instance('v_users_profile');
        
         	/* $title is another variable used in _v_template to set the <title> of the page*/
         	$this->template->title = "Profile";
        
         	# Pass information to the view fragment
         	$this->template->content->user_name = $user_name;
        
         	# Render View
         	echo $this->template;
                    
    }

} # end of the class



