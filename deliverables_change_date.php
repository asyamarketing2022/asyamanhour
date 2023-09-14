<?php include_once('connections/DBconnection.php'); ?>
<?php include_once('login.php') ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['selectedDate'])) {

        $selectedDate = $_POST['selectedDate'];
        $dayToday = $_POST['dayToday'];

        $sql_employees = "SELECT * FROM registered_users ORDER BY id ASC";
        $employees = $con->query($sql_employees) or die ($con->error);
        $employeeInfo = $employees->fetch_assoc();

        $output = '';
        $count = 0;
        $taskCount = 0;
 
        $output .= "<table>
                        <tbody>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th>Date</th>
                                <th>Day</th>
                                <th>Spend Hours</th>
                                <th>Daily Tasks</th>
                            </tr>";

        do {

            $employeeId = $employeeInfo['ID'];

            //Query all employees logs
            $sql_employees_logs = "SELECT * FROM employees_logs_hours WHERE employee_id = '$employeeId' AND date_logs = '$selectedDate'";
            $employees_logs = $con->query($sql_employees_logs) or die ($con->error);
            $employee_logs = $employees_logs->fetch_assoc();

            //Query all employees tasks
            $sql_employees_tasks = "SELECT * FROM employees_updates_task WHERE employee_id = '$employeeId' AND date = '$selectedDate'";
            $employees_tasks = $con->query($sql_employees_tasks) or die ($con->error);
            $employee_tasks = $employees_tasks->fetch_assoc();

            $count++;

            if($employees_logs->num_rows != 0){

                $output .= "<tr>
                                <td>$count</td>
                                <td class='deliverablesUserId' value=" . $employeeInfo['ID'] . ">" . $employeeInfo['first_name'] . " " . $employeeInfo['last_name'] . "</td>
                                <td>" . $employeeInfo['department'] . "</td>
                                <td>" . $employeeInfo['position'] . "</td>
                                <td class='deliverablesDate'>$selectedDate</td>
                                <td class='deliverablesDay'>$dayToday</td> 
                                <td class='deliverablesLogs'>" . $employee_logs['total_of_work_hours'] . "</td>
                                <td class='deliverablesTasks_wrapper'>
                                    <button class='deliverablesDailyTasks'>Daily Tasks</button>
                                    <div class='deliverablesTasks d-none'>
                                    </div>
                                </td>
                            </tr>";

            } else {

                $output .= "<tr>
                                <td>$count</td>
                                <td class='deliverablesUserId' value=" . $employeeInfo['ID'] . ">" . $employeeInfo['first_name'] . " " . $employeeInfo['last_name'] . "</td>
                                <td>" . $employeeInfo['department'] . "</td>
                                <td>" . $employeeInfo['position'] . "</td>
                                <td class='deliverablesDate'>$selectedDate</td>
                                <td class='deliverablesDay'>$dayToday</td> 
                                <td class='deliverablesLogs'>0</td>
                                <td class='deliverablesTasks_wrapper'>
                                    <button class='deliverablesDailyTasks'>Daily Tasks</button>
                                    <div class='deliverablesTasks d-none'>

                                    </div>
                                </td>
                            </tr>";
        
            }

        } while($employeeInfo = $employees->fetch_assoc());

        // $output .= "<div class='loading-content'>
        //                 <img src='/img/loading-3.gif'>
        //                 <div class='loading-content-overlay'></div>   
        //             </div>";

        echo $output;

    }

?>