<?php
class practice_controller extends base_controller  {

	/*-------------------------------------------------------------------------------------------------
        
        -------------------------------------------------------------------------------------------------*/
        public function test_db() {
        
                
                # INSERT PRACTICE
                $q = 'INSERT INTO users
                        SET first_name = "Albert",
                        last_name = "Macintosh"';
                        
                echo $q;
                DB::instance(DB_NAME)->query($q);
		
						
} 