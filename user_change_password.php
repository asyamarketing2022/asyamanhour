<?php include_once('connections/DBconnection.php'); ?>
<?php include_once('login.php') ?>

<?php 

    if(isset($_POST['currentPassword'])){

        $userId = $_SESSION['UserId'];
        $currentPassword = $_POST['currentPassword'];
        $newPassword = $_POST['newPassword'];
        $retypeNew_password = $_POST['retypeNew_password'];

        $query_user = "SELECT * FROM registered_users WHERE ID = '$userId'";
        $users = $con->query($query_user) or die ($con->error);
        $user = $users->fetch_assoc();

        if($user['password'] == $currentPassword){

            $sql_update_password = "UPDATE `registered_users` SET `password` = '$newPassword' WHERE ID = '$userId'";

            $con->query($sql_update_password) or die ($con->error);

            echo 'successful';

        } 
        
    }


?>