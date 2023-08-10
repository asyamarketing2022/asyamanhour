<?php 

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASSWORD','');
define('DB_DATABASE','pms_db');

class DBconnection
{
        public function connection()
        {
            $con = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
    
            if($con->connect_error){
    
                echo $con->connect_error;
    
            } else {
    
                return $con;
    
            }
        }
}

    
?>