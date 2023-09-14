<?php include_once('connections/DBconnection.php'); ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['searchValue'])){

        $searchValue = $_POST['searchValue'];
        $setDate = $_POST['setDate'];

        $sql = "SELECT * FROM registered_users WHERE CONCAT(last_name) LIKE '%$searchValue%' ORDER BY id ASC";
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

                $count++;

                $output .= "<tr>
                                <td>$count</td>
                                <td class='deliverablesUserId' value=" . $employeeInfo['ID'] . ">" . $employeeInfo['first_name'] . " " . $employeeInfo['last_name'] . "</td>
                                <td>" . $employeeInfo['department'] . "</td>
                                <td>" . $employeeInfo['position'] . "</td>
                                <td class='deliverablesDate'>$setDate</td>
                                <td class='deliverablesDay'></td> 
                                <td class='deliverablesLogs'>0</td>
                                <td class='deliverablesTasks_wrapper'>
                                    <button class='deliverablesDailyTasks'>Daily Tasks</button>
                                    <div class='deliverablesTasks d-none'>

                                    </div>
                                </td>
                            </tr>";

            }

            echo $output;
               
        } else {

            echo "No Search Found";

        }


    }

?>