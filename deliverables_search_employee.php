<?php include_once('connections/DBconnection.php'); ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['searchValue'])){

        $searchValue = $_POST['searchValue'];
        $selectedDate = $_POST['selectedDate'];
        $daySet = $_POST['daySet'];

        $sql = "SELECT * FROM registered_users WHERE CONCAT(last_name) LIKE '%$searchValue%' OR CONCAT(department) LIKE '%$searchValue%' ORDER BY id ASC";
        $query_run = mysqli_query($con, $sql);

        $output = '';
        $count = 0;

        if(mysqli_num_rows($query_run) > 0) {

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

                foreach($query_run as $employeeInfo) {

                $employeeId = $employeeInfo['ID'];
                    
                $sql_employees_logs = "SELECT * FROM employees_logs_hours WHERE employee_id = '$employeeId' AND date_logs = '$selectedDate'";
                $employees_logs = $con->query($sql_employees_logs) or die ($con->error);
                $employee_logs = $employees_logs->fetch_assoc();

                $count++;

                if($employees_logs->num_rows != 0){

                    $output .= "<tr>
                                    <td>$count</td>
                                    <td class='deliverablesUserId' value=" . $employeeInfo['ID'] . ">" . $employeeInfo['first_name'] . " " . $employeeInfo['last_name'] . "</td>
                                    <td>" . $employeeInfo['department'] . "</td>
                                    <td>" . $employeeInfo['position'] . "</td>
                                    <td class='deliverablesDate'>$selectedDate</td>
                                    <td class='deliverablesDay'>$daySet</td> 
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
                                    <td class='deliverablesDay'>$daySet</td> 
                                    <td class='deliverablesLogs'>0</td>
                                    <td class='deliverablesTasks_wrapper'>
                                        <button class='deliverablesDailyTasks'>Daily Tasks</button>
                                        <div class='deliverablesTasks d-none'>

                                        </div>
                                    </td>
                                </tr>";

                }

            }

            echo $output;
               
        } else {

            echo "No Search Found";

        }


    }

?>