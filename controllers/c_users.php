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
                $_POST['token']    = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
                
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
        
        //echo $q    
              
        echo "Success. You are logged in!";
                        
     # Send them to the homepage
            Router::redirect('/');
                }
                # Fail
                else {
                        echo "Login failed! <a href='/users/login'>Try again?</a>";                }
        
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
                
                # Only logged in users are allowed...
                if(!$this->user) {
            	 die('Members only. <a href="/users/login">Login</a>');
                }
                
                # Set up the View
                $this->template->content = View::instance('v_users_profile');
                $this->template->title = "Profile";
                
                $data = Array(
                        "first_name"        => $this->user->first_name,
                        "last_name"                => $this->user->last_name,
                        "email"                        => $this->user->email,
                        "created"                => $this->user->created,
                        "modified"                => $this->user->modified
                );
                                
                # Pass the data to the View
                $this->template->content->user_name = $user_name;
                
                # Display the view
                echo $this->template;
                                
    }

} # end of the class



