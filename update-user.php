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

    $position = $updateUser['position'];
    $password = $updateUser['password'];

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
                                <select name='update_department' id='department'>
                                    <option value='design' " . ($updateUser['department'] == 'design' ? ' selected ' : '') . ">Design</option>
                                    <option value='production' " . ($updateUser['department'] == 'production' ? ' selected ' : '') . ">Production</option>
                                    <option value='project management' " . ($updateUser['department'] == 'project management' ? ' selected ' : '') . ">Project Management</option>
                                    <option value='interior design' " . ($updateUser['department'] == 'interior design' ? ' selected ' : '') . ">Interior Design</option>
                                    <option value='master planning' " . ($updateUser['department'] == 'master planning' ? ' selected ' : '') . ">Master Planning</option>
                                    <option value='mechanical' " . ($updateUser['department'] == 'mechanical' ? ' selected ' : '') . ">Mechanical</option>
                                    <option value='electrical' " . ($updateUser['department'] == 'electrical' ? ' selected ' : '') . ">Electrical</option>
                                    <option value='plumbing' " . ($updateUser['department'] == 'plumbing' ? ' selected ' : '') . ">Plumbing</option>
                                    <option value='fire protection' " . ($updateUser['department'] == 'fire protection' ? ' selected ' : '') . ">Fire Protection</option>
                                    <option value='structural' " . ($updateUser['department'] == 'structural' ? ' selected ' : '') . ">Structural</option>
                                    <option value='contract & billing' " . ($updateUser['department'] == 'contract & billing' ? ' selected ' : '') . ">Contract & Billing</option>
                                </select>
                            </div>
                            <div class='profile-info__content'>
                                <span>Position</span>
                    
                                <input type='text' name='update_position' id='position' value='$position' required>
                            </div>
                            <div class='profile-info__content'>
                                <span>Password</span>
                                <input type='text' name='update_password' id='password' value='$password' required>
                            </div>
                            <div class='profile-info__content'>
                                <span>Access</span>
                                <select name='update_access' id='access'>
                                   
                                    <option value='admin' " . ($updateUser['access'] == 'admin' ? ' selected ' : '') . ">Admin</option>
                                    <option value='contract & billing' " . ($updateUser['access'] == 'contract & billing' ? ' selected ' : '') . ">Contract & Billing</option>
                                    <option value='manager' " . ($updateUser['access'] == 'manager' ? ' selected ' : '') . ">Manager</option>
                                    <option value='employee' " . ($updateUser['access'] == 'employee' ? ' selected ' : '') . ">Employee</option>
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