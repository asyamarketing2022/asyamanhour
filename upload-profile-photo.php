<?php include_once 'login.php'; ?>

<?php

// $target_dir = "img/upload/";
$target_dir = "img/upload/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit-new-photo"])) {
  
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  $featured_img = $_FILES['fileToUpload']['name'];
  $userId = $_SESSION['UserId'];

  if($check !== false) {

    move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $target_file);

    $sql = "UPDATE `registered_users` SET `user_image` =  '$featured_img' WHERE ID = '$userId'";

    $con->query($sql) or die ($con->error);

    header('Location: profile.php');

    // echo "File is an image - " . $check["mime"] . ".";
    // $uploadOk = 1;
   

  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}
?>