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

    public function signup($error = NULL) {
        
                # If user exists, don't allow to use this page
                if($this->user) {
                        Router::redirect('/');
                }
                
                # Setup view
                $this->template->content = View::instance('v_users_signup');
                $this->template->title = "Sign Up";
                
                $this->template->content->error = $error;
                
                # Render template
                echo $this->template;
        }
    /*-------------------------------------------------------------------------------------------------
Process the sign up form
-------------------------------------------------------------------------------------------------*/
    
   public function p_signup () {
    
                
                 # If user exists, don't allow to use this page
                if($this->user) {
                        Router::redirect('/');
                }
                                
                # Build the query to look for duplicate email
                $q = "SELECT user_id
                                FROM users
                                WHERE users.email = '".$_POST['email']."'";

                # Run the query
                $profile = DB::instance(DB_NAME)->select_rows($q);        
        
                # First check to see if there is a duplicate e-mail address already being used
                if(!empty($profile)) {        
        
                # If duplicate e-mail, send error message and send them back to the signup page
                Router::redirect("/users/signup/error_email");
                }        
        
                # Don't allow blank fields in the signup form
                if(!empty($_POST['first_name'])) {
                        if(!empty($_POST['last_name'])) {
                 if(!empty($_POST['email'])) {
                 if(!empty($_POST['password'])) {                                                
                                                                                                                                        
                                                # More data we want stored with the user
                                                $_POST['created'] = Time::now();
                                                $_POST['modified'] = Time::now();
                                
                                                # Encrypt the password
                                                $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
                                
                                                # Create an encrypted token via their email address and a random string
                                                $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());        
                                                
                                                # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
                                                $_POST = DB::instance(DB_NAME)->sanitize($_POST);        
                                                                                        
                                                # Insert this user into the database
                                                $user_id = DB::instance(DB_NAME)->insert('users', $_POST);
                                
                                                # Prepare data for user following himself to go into database
                                                $data = array(
                                                        "created" => Time::now(),
                                                        "user_id" => $user_id,
                                                        "user_id_followed" => $user_id
                                                );
                                
                                
                                                # Insert into users_users so the user always follows himself
                                                DB::instance(DB_NAME)->insert('users_users', $data);
                                
                                                # Send them to the login page
                                                Router::redirect("/users/login/");
                                        }                
                                }
                        }
         } else {
        
                 # Must be a blank field, send failed blank field message and go back to signup
                 Router::redirect("/users/signup/error_blank");         }        
        }
        

    public function login() {
        
        # If user exists, don't allow to use this page
                if($this->user) {
                        Router::redirect('/');
                }        
                
                # Setup view
                $this->template->content = View::instance('v_users_login');
                $this->template->title = "Log In";

                # Pass data to the view
                $this->template->content->error = $error;


                # Render template
                echo $this->template;
        }
        

         /*-------------------------------------------------------------------------------------------------
Process the login form
-------------------------------------------------------------------------------------------------*/
    public function p_login() {
                 
     # If user exists, don't allow to use this page
                if($this->user) {
                        Router::redirect('/');
                }
                
                # Sanitize the user entered data to prevent any funny-business (re: SQL Injection Attacks)
                $_POST = DB::instance(DB_NAME)->sanitize($_POST);
     
     
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
                        "last_name"         => $this->user->last_name,
                        "email"             => $this->user->email,
                        "created"           => $this->user->created,
                        "modified"          => $this->user->modified
                );
                                
                # Pass the data to the View
                $this->template->content->user_name = $user_name;
                
                # Display the view
                echo $this->template;
                                
    }

} # end of the class



