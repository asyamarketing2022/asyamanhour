<?php 

include_once("connections/connection.php");
$con = connection();

include_once("user-record.php");

if(isset($_POST['deleteUser'])){

    if(!empty($_POST['lang'])) {

        foreach($_POST['lang'] as $value ) {

            //User Record Action Delete
            $sql_userRecord = "SELECT * FROM registered_users WHERE ID = '$value'";
            $user = $con->query($sql_userRecord) or die ($con->error);
            $userInfo = $user->fetch_assoc();

            $userDetails = $userInfo['ID'] . ' ' . $userInfo['first_name'] . ' ' . $userInfo['last_name'];
      
            userRecord('delete user', $userDetails);

            //Delete User
            $sql = "DELETE FROM registered_users WHERE ID = '$value'";
            $con->query($sql) or die ($con->error);
            echo header("Location: admin.php");

        }

    } else {

         echo header("Location: admin.php");
         
    }

}


?>