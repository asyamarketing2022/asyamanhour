<?php include_once 'connections/DBconnection.php'; 


?>

<?php 

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['projectId'])) {

        $projectId = $_POST['projectId'];
        $services = $_POST['services'];
        $phase_of_work = $_POST['phase_of_work'];
        $PIC_ids = $_POST['PIC_ids'];
        $manager_ids = $_POST['manager_ids'];
        $output = "";

        if(!empty($PIC_ids) || !empty($manager_ids)) {
            
            //For PIC array
            $PIC_ids_array = (explode(" ", $PIC_ids));
            array_pop($PIC_ids_array);
            $pic_ids_count = (empty($PIC_ids_array) ? "" : count($PIC_ids_array));

            //For manager array
            $manager_ids_array = (explode(" ", $manager_ids));
            array_pop($manager_ids_array);
            $manager_ids_count = (empty($manager_ids_array) ? "" : count($manager_ids_array));

            for($a = 0; $manager_ids_count >= $a; $a++) {

                //Check if the loop number same with managers id count
                if($manager_ids_count == $a) {

                    for($i = 0; $pic_ids_count > $i; $i++){

                        $PIC_id = $PIC_ids_array[$i];
        
                        //Show PIC 
                        $query_users_pic = "SELECT * FROM registered_users WHERE ID = $PIC_id";
                        $users_pic = $con->query($query_users_pic) or die ($con->error);
                        $pic = $users_pic->fetch_assoc();
        
                        //Show PIC tasks
                        $query_user_tasks = "SELECT * FROM employees_tasks WHERE employee_id = '$PIC_id' AND project_id = '$projectId' AND services = '$services' AND phase_of_work = '$phase_of_work' AND invite_status = 'accept'";
                        $user_tasks = $con->query($query_user_tasks) or die ($con->error);
                        $user_task = $user_tasks->fetch_assoc();
        
                        $output .= "<div class='employee_container'>
                                        <div class='employee_details'>
                                            <img src='img/upload/" . $pic['user_image'] . "' alt='' class=''>
                                            <h3>" . $pic['first_name'] . " " . $pic['last_name'] . "</h3>
                                        </div>
                                        <div class='employee_tasks_status'>";
                    
                        $output .= "<h3>Tasks</h3>
                                    <h3>Status</h3>";
        
                        // Fetch employee tasks title
                        if(!empty($user_task['task_title'])){
        
                            do {
        
                                $output .= "<h4>" . $user_task['task_title'] . "</h4>";
        
                                if($user_task['status'] == 'Done') {
        
                                    $output .= "<h4 class='done'>" . $user_task['status'] . "</h4>";
        
                                } elseif($user_task['status'] == 'Working on it') {
        
                                    $output .= "<h4 class='working'>" . $user_task['status'] . "</h4>";
        
                                } elseif($user_task['status'] == 'Stuck') {
        
                                    $output .= "<h4 class='stuck'>" . $user_task['status'] . "</h4>";
        
                                } else {
        
                                    $output .= "<h4 class='blue'>" . $user_task['status'] . "</h4>";
        
                                }
        
                            } while($user_task = $user_tasks->fetch_assoc());
                       
                        }
        
                        $output .= "</div></div>";

                    } 

                } else {

                    $manager_id = $manager_ids_array[$a];
        
                    //Show manager 
                    $query_users_manager = "SELECT * FROM registered_users WHERE ID = $manager_id";
                    $users_manager = $con->query($query_users_manager) or die ($con->error);
                    $manager = $users_manager->fetch_assoc();
    
                    //Show manager tasks
                    $query_user_tasks = "SELECT * FROM employees_tasks WHERE employee_id = '$manager_id' AND project_id = '$projectId' AND services = '$services' AND phase_of_work = '$phase_of_work' AND invite_status = 'accept'";
                    $user_tasks = $con->query($query_user_tasks) or die ($con->error);
                    $user_task = $user_tasks->fetch_assoc();
    
                    $output .= "<div class='employee_container'>
                                    <div class='employee_details'>
                                        <img src='img/upload/" . $manager['user_image'] . "' alt='' class=''>
                                        <h3>" . $manager['first_name'] . " " . $manager['last_name'] . "</h3>
                                    </div>
                                    <div class='employee_tasks_status'>";
                
                    $output .= "<h3>Tasks</h3>
                                <h3>Status</h3>";
    
                    // Fetch employee tasks title
                    if(!empty($user_task['task_title'])){
    
                        do {
    
                            $output .= "<h4>" . $user_task['task_title'] . "</h4>";
    
                            if($user_task['status'] == 'Done') {
    
                                $output .= "<h4 class='done'>" . $user_task['status'] . "</h4>";
    
                            } elseif($user_task['status'] == 'Working on it') {
    
                                $output .= "<h4 class='working'>" . $user_task['status'] . "</h4>";
    
                            } elseif($user_task['status'] == 'Stuck') {
    
                                $output .= "<h4 class='stuck'>" . $user_task['status'] . "</h4>";
    
                            } else {
    
                                $output .= "<h4 class='blue'>" . $user_task['status'] . "</h4>";
    
                            }
    
                        } while($user_task = $user_tasks->fetch_assoc());
                   
                    }

                    $output .= "</div></div>";
             
                }

            }

        }

        echo $output;

    }

?>