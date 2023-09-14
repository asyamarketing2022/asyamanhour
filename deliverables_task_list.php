<?php include_once('connections/DBconnection.php'); ?>
<?php include_once('login.php') ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['deliverablesDate'])){

        $deliverablesDate = $_POST['deliverablesDate'];
        $userId = $_POST['userId'];

        $sql_employees_tasks = "SELECT * FROM employees_updates_task WHERE date = '$deliverablesDate' AND employee_id = '$userId'";
        $employees_tasks = $con->query($sql_employees_tasks) or die ($con->error);
        $employee_tasks = $employees_tasks->fetch_assoc();

        $output = '';
        $count = 0;

        if($employees_tasks->num_rows != 0){

            $output .= "<table>
                            <tbody>
                                <tr>
                                    <th></th>
                                    <th>Project Name</th>
                                    <th>Services</th>
                                    <th>Phase of work</th>
                                    <th>Task Title</th>
                                    <th>Task Update</th>
                                    <th>Spend Hours</th>
                                </tr>";

            do {

                $count++;

                $output .= "<tr>
                                <td>$count</td>
                                <td>" . $employee_tasks['project_name'] . "</td>
                                <td>" . $employee_tasks['services'] . "</td>
                                <td>" . $employee_tasks['phase_of_work'] . "</td>
                                <td>" . $employee_tasks['task_title'] . "</td>
                                <td>" . $employee_tasks['task_update'] . "</td>
                                <td>" . $employee_tasks['spend_hours'] . "</td>
                            </tr>";
                
            } while($employee_tasks = $employees_tasks->fetch_assoc());


        } 

            echo $output;

    }


?>
