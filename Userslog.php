<?php 
include_once("connections/DBconnection.php");
include_once("login.php");

if(!isset($_SESSION)){
    session_start();
}

class Userslog {

    public $action;
    public $source;

    public function __construct($action = null, &$source = null) {

        $this->action = $action;
        $this->source = $source;
    }

    public function userRecord()
    {
        $firstName = $_SESSION['UserLogin'];
        $lastName = $_SESSION['Userlname'];
        $userId = $_SESSION['UserId'];
        $userPostion = $_SESSION['Position'];
        $userDepartment = $_SESSION['Department'];

        $actionStatus = 'success';

        $db = new DBconnection();
        $con = $db->connection();
        if($con->connect_error){

            echo $con->connect_error;

        } else {

            $con->query("INSERT INTO `users_record`(`user_name`, `user_id`, `user_position`, `department`, `action`, `source`, `action_status`) VALUE ('$firstName $lastName', $userId, '$userPostion', '$userDepartment', '$this->action', '$this->source', '$actionStatus')");

        }


        // // Database Connection
        // // global $dbconn;
        // $dbconn = new DBconnection();

        // $con = $dbconn->Connect();

        // $set = mysqli_query($dbconn, "INSERT INTO `users_record`(`user_name`, `user_id`, `user_position`, `department`, `action`, `source`, `action_status`)");

        // $dbconn = mysqli_connect("localhost","root","","pms_db");
        // $con = $dbconn->Connect();

        // $firstName = $_SESSION['UserLogin'];
        // $lastName = $_SESSION['Userlname'];
        // $userId = $_SESSION['UserId'];
        // $userPostion = $_SESSION['Position'];
        // $userDepartment = $_SESSION['Department'];

        // $actionStatus = 'success';

        // $set = mysqli_query($dbconn, "INSERT INTO `users_record`(`user_name`, `user_id`, `user_position`, `department`, `action`, `source`, `action_status`) VALUE ('$firstName $lastName', $userId, '$userPostion', '$userDepartment', '$this->action', '$this->source', '$actionStatus')");
 
        // return $set;
      
    }

}

// $dbcon = new userslog();
// $dbcon->userRecord();

?>