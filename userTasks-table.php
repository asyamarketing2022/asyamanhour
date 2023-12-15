<?php 

include_once("connections/connection.php");
$con = connection();

if (!empty($_POST['searchFilter'])) {
    
    // $limitData = $_POST['DataLimit'];
    $filtervalues = $_POST['searchFilter'];
    $profile_userId = $_POST['profile_userId'];

    $query = "SELECT * FROM employees_tasks WHERE employee_id = $profile_userId AND invite_status = 'accept' AND task_title LIKE '%$filtervalues%' ORDER BY id DESC";
    $query_run = mysqli_query($con, $query);
   
    if(mysqli_num_rows($query_run) > 0)
        {
            foreach($query_run as $tasks_info)
            {

            echo "<tr class='task-table_row clickable-row' data-href='/viewproject.php?ID=". $tasks_info['project_id'] . "' value='" . $tasks_info['id'] . "'>
                    <td>" . $tasks_info['project_name'] . "</td>
                    <td>" . $tasks_info['services'] . "</td>
                    <td>" . $tasks_info['phase_of_work'] . "</td>
                    <td>" . $tasks_info['task_title'] . "</td>
                    <td>
                        <button type='button' class='btn btn-outline-dark tooltip-btn task_title_btn' data-bs-toggle='tooltip' data-bs-placement='bottom' title=" . $tasks_info['notes'] ." data-placement='bottom' data-original-title=" . $tasks_info['notes'] . " style='font-size: 10px;'>Task Title</button>
                    </td>
                    <td>" . $tasks_info['date_started'] . "</td>
                    <td>" . $tasks_info['due_date'] . "</td>
                    <td>" . $tasks_info['allot_time'] . "</td>
                    <td>" . $tasks_info['sent_by'] . "</td>
                    <td>" . $tasks_info['status'] . "</td>
                    <td>" . $tasks_info['invite_status'] . "</td>
                </tr>";

            }
        } 

    } else {

        $profile_userId = $_POST['profile_userId'];
     
        $sql = "SELECT * FROM employees_tasks WHERE employee_id = $profile_userId AND invite_status = 'accept' ORDER BY id DESC";
        $query_usertasks = $con->query($sql) or die ($con->error);
        $tasks_info = $query_usertasks->fetch_assoc();

        if(!empty($tasks_info['id'])) {
            
            do { 

                echo "<tr class='task-table_row clickable-row' data-href='/viewproject.php?ID=". $tasks_info['project_id'] . "' value='" . $tasks_info['id'] . "'>
                        <td>" . $tasks_info['project_name'] . "</td>
                        <td>" . $tasks_info['services'] . "</td>
                        <td>" . $tasks_info['phase_of_work'] . "</td>
                        <td>" . $tasks_info['task_title'] . "</td>
                        <td>
                            <button type='button' class='btn btn-outline-dark tooltip-btn task_title_btn' data-bs-toggle='tooltip' data-bs-placement='bottom' title=" . $tasks_info['notes'] ." data-placement='bottom' data-original-title=" . $tasks_info['notes'] . " style='font-size: 10px;'>Task Title</button>
                        </td>
                        <td>" . $tasks_info['date_started'] . "</td>
                        <td>" . $tasks_info['due_date'] . "</td>
                        <td>" . $tasks_info['allot_time'] . "</td>
                        <td>" . $tasks_info['sent_by'] . "</td>
                        <td>" . $tasks_info['status'] . "</td>
                        <td>" . $tasks_info['invite_status'] . "</td>
                    </tr>";
    
            } while($tasks_info = $query_usertasks->fetch_assoc()); 

        }



    }

?>