<?php 

include_once('connections/connection.php');
$con = connection();
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

include_once("Userslog.php");
// include_once("user-record.php");

if(isset($_POST['tableID'])) {

    $userID =  $_POST['tableID'];

    $userSQL = "SELECT * FROM registered_users WHERE ID = $userID";
    $user = $con->query($userSQL) or die ($con->error);
    $updateUser = $user->fetch_assoc();

    $_SESSION['Update_userID'] = $updateUser['ID'];

        echo "<div class='tab-content' id='profile-tab'>
                <div class='tab-pane tab-content__info fade show active' id='profile_edit' role='tabpanel' aria-labelledby='profile-tab'>
                    <div class='tab-content__profile'>
                        <div class='placeholder-left'></div>
                        <div class='profile-info'>
                            <div class='profile-info__content'>
                                <span>First Name</span>
                                <input type='text' name='update_firstname' id='firstname formControlDefault' value=" . $updateUser['first_name'] ." required>
                            </div>
                            <div class='profile-info__content'>
                                <span>Last Name</span>
                                <input type='text' name='update_lastname' id='lastname formControlDefault' value=" . $updateUser['last_name'] . " required>
                            </div>
                            <div class='profile-info__content'>
                                <span>Gender</span>
                                <select name='update_gender' id='gender' class='' aria-label='' value=" . $updateUser['gender'] . ">
                                    <option value='Male' selected>Male</option>
                                    <option value='Female'>Female</option>
                                </select>
                            </div>
                            <div class='profile-info__content'>
                                <span>Birthday</span>
                                <input type='date' name='update_birthday' id='birthday formControlDefault' value=" . $updateUser['date_of_birth'] . ">
                            </div>
                            <div class='profile-info__content'>
                                <span>Phone</span>
                                <input type='text' name='update_mobile_number' id='mobile_number formControlDefault' value=" . $updateUser['mobile_number'] . ">
                            </div>
                            <div class='profile-info__content'>
                                <span>Address</span>
                                <input type='text' name='update_address' id='address formControlDefault' value=" . $updateUser['address'] .  " required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class='tab-pane tab-content__info fade' id='department_edit' role='tabpanel' aria-labelledby='department-tab'>
                    <div class='tab-content__profile'>
                        <div class='placeholder-left'></div>
                        <div class='profile-info'>
                            <div class='profile-info__content'>
                                <span>Email</span>
                                <input type='email' name='update_email' id='email formControlDefault' value=" . $updateUser['email'] . " required>
                            </div>
                            <div class='profile-info__content'>
                                <span>Department</span>
                                <select name='update_department' id='department' value=" . $updateUser['department'] . ">
                                    <option value='design' selected>Design</option>
                                    <option value='production'>Production</option>
                                    <option value='project management'>Project Management</option>
                                    <option value='interior design'>Interior Design</option>
                                    <option value='master planning'>Master Planning</option>
                                    <option value='mechanical'>Mechanical</option>
                                    <option value='electrical'>Electrical</option>
                                    <option value='plumbing'>Plumbing</option>
                                    <option value='fire protection'>Fire Protection</option>
                                    <option value='structural'>Structural</option>
                                </select>
                            </div>
                            <div class='profile-info__content'>
                                <span>Position</span>
                    
                                <input type='text' name='update_position' id='position formControlDefault' value=" . $updateUser['position'] . " required>
                            </div>
                            <div class='profile-info__content'>
                                <span>Password</span>
                                <input type='text' name='update_password' id='password formControlDefault' value=" . $updateUser['password'] . " required>
                            </div>
                            <div class='profile-info__content'>
                                <span>Access</span>
                                <select name='update_access' id='access' value=" . $updateUser['access'] . ">
                                    <option value='employee'>Employee</option>
                                    <option value='admin'>Admin</option>
                                    <option value='manager'>Manager</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>";}


    if(isset($_POST['submit-updateUser'])){

        $userID = $_SESSION['Update_userID'];
    
        $fname = $_POST['update_firstname'];
        $lname = $_POST['update_lastname'];
        $gender = $_POST['update_gender'];
        $birthday = $_POST['update_birthday'];
        $mobilenumber = $_POST['update_mobile_number'];
        $address = $_POST['update_address'];
    
        $email = $_POST['update_email'];
        $department = $_POST['update_department'];
        $position = $_POST['update_position'];
        $password = $_POST['update_password'];
        $access = $_POST['update_access'];
    
        $sql = "UPDATE `registered_users` SET `first_name` = '$fname', `last_name` = '$lname', `gender` = '$gender', `date_of_birth` = '$birthday', `mobile_number` = '$mobilenumber', `address` = '$address', `email` = '$email', `department` = '$department', `position` = '$position', `password` = '$password', `access` = '$access' WHERE ID = '$userID'";
    
        $con->query($sql) or die ($con->error);

        $userDetails = $userID . ' ' . $fname  . ' ' . $lname ;

        // userRecord();
        //User Record Action Edit
        $update = new Userslog('edit info of user', $userDetails);
        $update->userRecord();

    }

?>