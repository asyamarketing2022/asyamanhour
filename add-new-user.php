<?php 

include_once("connections/connection.php");
$con = connection();

include_once("user-record.php");

   if(isset($_POST['addSubmit'])){

    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];
    $gender = $_POST['gender'];
    $birthday = $_POST['birthday'];
    $mobilenumber = $_POST['mobile_number'];
    $address = $_POST['address'];

    $email = $_POST['email'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $password = $_POST['password'];
    $access = $_POST['access'];
    $userImage = 'placeholder-user.png';
    $userBio = 'Place Your Bio Here';

    $check = mysqli_query($con, "SELECT * FROM registered_users WHERE email = '$email'");
    $checkrows = mysqli_num_rows($check);

    if($checkrows > 0){

        echo "Email enter was already registered";

    } else {

        $sql = "INSERT INTO `registered_users`(`user_image`, `first_name`, `last_name`, `user_bio`, `gender`, `date_of_birth`, `mobile_number`, `address`, `email`, `department`, `position`, `password`, `access`) VALUES ('$userImage', '$fname', '$lname', '$userBio', '$gender', '$birthday', '$mobilenumber', '$address','$email', '$department', '$position', '$password', '$access')";

        $con->query($sql) or die ($con->error); 

        //User Record Action Add
        $userDetails = $fname  . ' ' . $lname ;
              
        userRecord('add user', $userDetails);

    }

   }

?>


   


