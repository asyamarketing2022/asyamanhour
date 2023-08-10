<?php include_once('connections/DBconnection.php'); ?>
<?php include 'login.php'; ?>
<?php include_once('AssignedEmployeeController.php'); ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['projectId'])) {

    $projectId = $_POST['projectId'];
    $employeeId = $_POST['employeeId'];
    $searchEmployee_pow = $_POST['searchEmployee_pow'];
    $searchEmployee_service = $_POST['searchEmployee_service'];
    $managerId = $_SESSION['UserId'];

    if($searchEmployee_service == 'Architecture') {

        if($searchEmployee_pow == 'Conceptual') {

            $ArchConceptual = new AssignedEmployeeController('arch_conceptual_assigned_employee', 'arch_conceptual_who_assigned_manager', $projectId, $managerId, $employeeId);
            $ArchConceptual->assignProjectInCharge();

        } elseif($searchEmployee_pow == 'Schematic') {

            $ArchSchematicss = new AssignedEmployeeController('arch_schematic_assigned_employee', 'arch_schematic_who_assigned_manager', $projectId, $managerId, $employeeId);
            $ArchSchematicss->assignProjectInCharge();

        } elseif($searchEmployee_pow == 'Design Development') {

            $ArchDesignDevelopment = new AssignedEmployeeController('arch_designdevelopment_assigned_employee', 'arch_designdevelopment_who_assigned_manager', $projectId, $managerId, $employeeId);
            $ArchDesignDevelopment->assignProjectInCharge();

        } elseif($searchEmployee_pow == 'Construction Drawing') {

            $ArchConstruction = new AssignedEmployeeController('arch_construction_assigned_employee', 'arch_construction_who_assigned_manager', $projectId, $managerId, $employeeId);
            $ArchConstruction->assignProjectInCharge();

        } elseif($searchEmployee_pow == 'Site Supervision') {

            $ArchSite = new AssignedEmployeeController('arch_site_assigned_employee', 'arch_site_who_assigned_manager', $projectId, $managerId, $employeeId);
            $ArchSite->assignProjectInCharge();

        }

    }elseif($searchEmployee_service == 'Interior') {

        if($searchEmployee_pow == 'Conceptual') {

            $IntConceptual = new AssignedEmployeeController('int_conceptual_assigned_employee', 'int_conceptual_who_assigned_manager', $projectId, $managerId, $employeeId);
            $IntConceptual->assignProjectInCharge();

        } elseif($searchEmployee_pow == 'Design Development') {

            $IntDesignDevelopment = new AssignedEmployeeController('int_designdevelopment_assigned_employee', 'int_designdevelopmen_who_assigned_manager', $projectId, $managerId, $employeeId);
            $IntDesignDevelopment->assignProjectInCharge();

        } elseif($searchEmployee_pow == 'Construction Drawing') {

            $IntConstruction = new AssignedEmployeeController('int_construction_assigned_employee', 'int_construction_who_assigned_manager', $projectId, $managerId, $employeeId);
            $IntConstruction->assignProjectInCharge();

        } elseif($searchEmployee_pow == 'Site Supervision'){

            $IntConstruction = new AssignedEmployeeController('int_site_assigned_employee', 'int_site_who_assigned_manager', $projectId, $managerId, $employeeId);
            $IntConstruction->assignProjectInCharge();

        }

    } elseif($searchEmployee_service == 'Master Planning') {

        if($searchEmployee_pow == 'Conceptual') {

            $masterplanningConceptual = new AssignedEmployeeController('masterplanning_conceptual_assigned_employee', 'masterplanning_conceptual_who_assigned_manager', $projectId, $managerId, $employeeId);
            $masterplanningConceptual->assignProjectInCharge();

        } elseif($searchEmployee_pow == 'Schematic') {

            $masterplanningSchematic = new AssignedEmployeeController('masterplanning_schematic_assigned_employee', 'masterplanning_schematic_who_assigned_manager', $projectId, $managerId, $employeeId);
            $masterplanningSchematic->assignProjectInCharge();

        }

    }


}


// if (isset($_GET['tableID'])) {

//     var_dump($_GET['tableID']);


// };


// if(isset($_POST['tableID'])) {

    // echo $_POST['tableID'];
    // print_r($_POST['tableID']);

    // if(isset($_POST['submitPIC'])) {


    //    print_r($users_array);

    // };

        // if(isset($_POST['submitPIC'])) {



        // echo $_POST['tableID'];


        // if(!empty($_POST['tableID'])) {

            // if(isset($_POST['submitPIC'])) {
            //     $users_array = $_POST['users'];
            //     $users = implode(" ", $users_array);
    
            //     $assignId = $_POST['tableID'];
            
            //     $sql = "UPDATE `assign_project` SET `project_in_charge` = '$users' WHERE id = '$assignId'";
            //     $con->query($sql) or die ($con->error);
            // };

            // echo $_POST['tableID'];


            // $assignId = $_POST['tableID'];

            // echo $assignId;

            // if(!empty($_POST['tableID'])) {

            //     $_SESSION['x'] = $_POST['tableID'];

            // }

            // if(!empty($_POST['users'])) {
           
            //     // $users_array = $_POST['users'];
            //     // $users = implode(" ", $users_array);
        
            //     // $assignId = $_POST['tableID'];

            //     // echo $assignId;
                
            //     $sql = "UPDATE `assign_project` SET `project_in_charge` = '$users' WHERE id = '$assignId'";
            //     $con->query($sql) or die ($con->error);

            //     $users_array = $_POST['users'];
            //     $users = implode(" ", $users_array);

        
            //     echo $users;
            //     echo $_SESSION['x'];
            //     // echo $_POST['tableID'];
            
            //     // echo $assignId;
            //     // echo $_POST['tableID'];
            
            // }

            // if(isset($_POST['submitPIC'])) {

            //     $assignId = $_GET['tableID'];

            //     $users_array = $_GET['users'];
            //     $users = implode(" ", $users_array);


            //     $sql = "UPDATE `assign_project` SET `project_in_charge` = '$users' WHERE id = '$assignId'";
            //     $con->query($sql) or die ($con->error);

            // }

            

            // echo $_POST['tableID'];
            // $users_array = $_POST['users'];
            // $users = implode(" ", $users_array);
        
            // echo $users;
        // };
 



            // if(isset($_POST['submitPIC'])) {

            //     $users_array = $_POST['user'];
            //     $users = implode(" ", $users_array);
    
            //     $assignId = $_POST['tableID'];

            //     var_dump($users);
            
            //     $sql = "UPDATE `assign_project` SET `project_in_charge` = '$users' WHERE id = '$assignId'";
            //     $con->query($sql) or die ($con->error);
            // };
      

            // if(isset($_POST['tableID'])) {

            //     $_SESSION['id'] = $_POST['tableID'];
                // print_r($_POST['tableID']);
    
                // $users_array = $_POST['user'];
                // $users = implode(" ", $users_array);
        
                // $assignId = $_POST['tableID'];
        
                // $sql = "UPDATE `assign_project` SET `project_in_charge` = '$users' WHERE id = '$assignId'";
                // $con->query($sql) or die ($con->error);

            // };

            // echo $_POST['tableID'];

        // };

    // };
// };


// if(isset($_POST['submitPIC'])) { 

//     $assignId = $_POST['tableID'];

//     $users_array = $_POST['user'];
    
//     $users = implode(" ", $users_array);

//     $sql = "UPDATE `assign_project` SET `project_in_charge` = '$users' WHERE id = '$assignId'";
//     $con->query($sql) or die ($con->error);
    
// };


// echo $GLOBALS['assignId'];

// if(isset($_POST['submitPIC'])) { 

//     $assignId = $_POST['tableID'];

//     $users_array = $_POST['user'];
    
//     $users = implode(" ", $users_array);

//     $sql = "UPDATE `assign_project` SET `project_in_charge` = '$users' WHERE id = '$assignId'";
//     $con->query($sql) or die ($con->error);
    
// };





// if(isset($_POST['submitPIC']) && ($_POST['tableID'])){

//     echo $_POST['tableID'];

//     // $users_array = $_POST['user'];
    
//     // $users = implode(" ", $users_array);

 

//     // if (isset($_GET['tableID'])) {

//     //     $assignId = $_GET['tableID'];

//     //     $sql = "UPDATE `assign_project` SET `project_in_charge` = '$users' WHERE id = $assignId";
//     //     $con->query($sql) or die ($con->error);

//     // };

// };


    // if(isset($_POST['submitPIC'])) {

    //     $_SESSION['assignId'] = $_POST['tableID'];

    //     $assignId = $_SESSION['assignId'];
    //     $users_array = $_POST['user'];

    //     $users = implode(" ", $users_array);

    //     $sql = "UPDATE `assign_project` SET `project_in_charge` = '$users' WHERE id = '$assignId'";
    //     $con->query($sql) or die ($con->error);
    // };   


?>