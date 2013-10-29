<?php
class practice_controller extends base_controller  {

	/*-------------------------------------------------------------------------------------------------
        
        -------------------------------------------------------------------------------------------------*/
    
        public function test_db() {
        
        /*  
            # INSERT PRACTICE
            $q = 'INSERT INTO users
                        SET first_name = "Albert",
                        last_name = "Macintosh"';
                        
            echo $q;
            DB::instance(DB_NAME)->query($q);
        */
               
               
        /*    $q = 'UPDATE users
               		SET email = "almert@aol.com"
               		WHERE first_name = 'Albert'';    
               
        	DB::instance(DB_NAME)->query($q);
		
			
		*/
		
		
		$new_user = Array(
			'first_name'->'Albert',
			'last_name'->'Macintosh',
			'email'->'albert@aol.com',
		);
			
			DB::instance(DB_NAME)->insert('users',$new_user);				
}









}