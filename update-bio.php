<?php include_once 'login.php'; ?>

<?php

    $userId = $_SESSION['UserId'];

    if(isset($_POST['new_bio_text'])){

        $newBio = $_POST['new_bio_text']; 
        
        $sql = "UPDATE `registered_users` SET `user_bio` = '$newBio' WHERE ID = '$userId'";
        
        $con->query($sql) or die ($con->error);

    }

?>