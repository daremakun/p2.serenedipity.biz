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
                 
                 $this->template->content->error = $error; 
        
                echo $this->template;
        }
    /*-------------------------------------------------------------------------------------------------
Process the sign up form
-------------------------------------------------------------------------------------------------*/
    
    public function p_signup(){
        
                $_POST['created'] = Time::now();
                $_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
            $_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
                #checks for duplicate email.
                $email_unique = $this->userObj->confirm_unique_email($_POST["email"]);
                
                if($email_unique) {
                 DB::instance(DB_NAME)->insert_row('users', $_POST);
                 #Send them to the login page
                 Router::redirect('/users/login');
                }
                
                 else {
            	 Router::redirect("/users/signup/error");
           }
        
         		echo"<pre>";
         		#  print_r($_POST);
              	 echo "You have successfully signed up";
                 echo"<pre>";
    }



    public function login($error = NULL) {

    			# Set up the view
    			$this->template->content = View::instance("v_users_login");

    			# Pass data to the view
    			$this->template->content->error = $error;

    			# Render the view
    			echo $this->template;

	}

        
         /*-------------------------------------------------------------------------------------------------
Process the login form
-------------------------------------------------------------------------------------------------*/
   public function p_login(){
                # This will hash the password entered so it can be compared with the one in the database.
        		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);

                # Set up the query to find matching email/password in the DB
                $q =
                 'SELECT token
                         FROM users
                         WHERE email = "'.$_POST['email'].'"
                         AND password ="'.$_POST['password'].'"';
                
                $token = DB::instance(DB_NAME)->select_field($q);

                #Successful
                if($token){
                        setcookie('token',$token,strtotime('+1 year'), '/');
                         #Send user to the homepage
                 Router::redirect('/');
                 echo "Success. You are logged in!";                
                }
                #Fail
                else{
             	Router::redirect("/users/login/error");
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
       
                echo "You have logged out successfully.";
        		#Router::redirect('/');
         		echo "<br>";
        		die('To log back in click <a href="/users/login">here.</a>');
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

