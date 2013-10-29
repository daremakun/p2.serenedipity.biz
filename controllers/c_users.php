<?php
class users_controller extends base_controller {

    public function __construct() {
        parent::__construct();
 
    } 

    public function index() {
        echo "This is the index page";
    }

    public function signup() {
    
        # Set up the view
    	$this->template->content = View::instance('v_users_signup');
    	
    	# Render the view
    	echo $this->template;
    	
    }
    
    public function p_signup () {
    
		
		$_POST['created']  = Time::now();
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['PASSWORD']);
		$_POST['token']	   = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
		
		echo "<pre>";
		print_r($_POST);
		echo "<pre>";
		
		DB::instance(DB_NAME)->insert_row('users', $_POST);
		
		# Send them to the login page
		//Router::redirect('/users/login');

    }

    public function login() {
        echo "This is the login page";
    }

    public function logout() {
        echo "This is the logout page";
    }

    public function profile($user_name = NULL) {
    
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

} # end of the class
