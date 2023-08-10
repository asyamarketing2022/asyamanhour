<?php 

include_once("connections/DBconnection.php");

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['dept'])){

        $dept = $_POST['dept'];

            $sql = "SELECT * FROM registered_users WHERE department = '$dept' AND access = 'manager'";
            $manager = $con ->query($sql) or die ($con->error);
            $managerInfo = $manager->fetch_assoc();

            $department = str_replace(' ', '', $managerInfo['department']);

            if(!empty($managerInfo)){

                $output = '<span>Select Manager</span>';

                do {
                    $output .= "<div class='form-check managerCheckbox_container'>
                             <input class='form-check-input managersCheckbox ". $managerInfo['department'] ."' name='". $managerInfo['department'] ."_manager[]' type='checkbox' value='". $managerInfo['ID'] ."'>
                             <label class='form-check-label' for='flexCheckDefault'>". $managerInfo['first_name'] ." " . $managerInfo['last_name'] . "</label>
                            </div>";
                } while($managerInfo = $manager->fetch_assoc());
        
                echo $output;

            } 

    } 




?>