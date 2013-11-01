<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
 
    } 

    public function index() {
        echo "This is the index page";
    }

/*-------------------------------------------------------------------------------------------------
        Display a form so users can sign up        
        -------------------------------------------------------------------------------------------------*/

    public function signup() {
    
        # Set up the view
    	$this->template->content = View::instance('v_users_signup');
    	
    	# Render the view
    	echo $this->template;
    	
    }
    /*-------------------------------------------------------------------------------------------------
Process the sign up form
-------------------------------------------------------------------------------------------------*/
    
   public function p_signup () {
    
                
                $_POST['created']  = Time::now();
                $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
                $_POST['token']           = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
                
                echo "<pre>";
                print_r($_POST);
                echo "<pre>";
                
                DB::instance(DB_NAME)->insert_row('users', $_POST);
                
                # Send them to the login page
                //Router::redirect('/users/login');

    }

    public function login() {
        
        $this->template->content = View::instance('v_users_login');
        echo $this->template;
        
    }

         /*-------------------------------------------------------------------------------------------------
Process the login form
-------------------------------------------------------------------------------------------------*/
    public function p_login() {
                 
     # Hash the password they entered so we can compare it with the ones in the database
        $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
                
     # Set up the query to see if there's a matching email/password in the DB
        $q =
             'SELECT token
              FROM users
              WHERE email = "'.$_POST['email'].'"
              AND password = "'.$_POST['password'].'"';
 
                
     # If there was, this will return the token        
        $token = DB::instance(DB_NAME)->select_field($q);
                
     # Success
        if($token) {
                
     # Don't echo anything to the page before setting this cookie!
        setcookie('token',$token, strtotime('+1 year'), '/');
              
        echo "Success. You are logged in!";
                        
     # Send them to the homepage
            jRouter::redirect('/');
                }
                # Fail
                else {
                        echo "Login failed! <a href='/users/login'>Try again?</a>";                }
        
    }

    public function logout() {
        echo "This is the logout page";
    }

    public function profile($user_name = NULL) {
    
    # Only logged in users are allowed...
                if(!$this->user) {
                        die('Members only. <a href="/users/login">Login</a>');
                }
    
    # Set up the view
    	$this->template->content = View::instance('v_users_profile');
    	$this->tmplate->title = "Profile";
    
    	$client_files_head = Array(
    	'/css/profile.css',
    	'/css/master.css'
    );    
    
    $this->template->client_files_head = Utils::load_client_files($client-files-head);
    
    # Pass the data to the view
    $this->template->content->user_name = $user_name;
    
    # Display the view
    echo $this->template;

		//view = View::instance('v_users_profile');
		//view->user_name = $user_name;	
		//echo $view;

    }

}
# end of the class
