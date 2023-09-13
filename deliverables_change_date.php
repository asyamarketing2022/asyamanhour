<?php include_once('connections/DBconnection.php'); ?>
<?php include_once('login.php') ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['selectedDate'])) {

        $selectedDate = $_POST['selectedDate'];

        $sql_employees = "SELECT * FROM registered_users ORDER BY id ASC";
        $employees = $con->query($sql_employees) or die ($con->error);
        $employeeInfo = $employees->fetch_assoc();

        $output = '';
        $count = 0;

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

            $count++;

            $output .= "<tr>
                            <td>$count</td>
                            <td class='deliverablesUserId' value=" . $employeeInfo['ID'] . ">" . $employeeInfo['first_name'] . " " . $employeeInfo['last_name'] . "</td>
                            <td>" . $employeeInfo['department'] . "</td>
                            <td>" . $employeeInfo['position'] . "</td>
                            <td class='deliverablesDate'></td>
                            <td class='deliverablesDay'></td> 
                            <td class='deliverablesLogs'></td>
                            <td class='deliverablesTasks_wrapper'>
                                <button class='deliverablesDailyTasks'>Daily Tasks</button>
                                <div class='deliverablesTasks d-none'>

                                </div>
                            </td>
                        </tr>";

        } while($employeeInfo = $employees->fetch_assoc());

        echo $output;

    }

?>