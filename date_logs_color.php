<?php include_once('connections/DBconnection.php'); ?>
<?php include_once 'login.php'; ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['calendarDate'])){

        $userId = $_SESSION['UserId'];
        $calendarDate = $_POST['calendarDate'];
        $dateNumber = $_POST['dateNumber'];

        $query_date_logs_hours = "SELECT * FROM employees_logs_hours WHERE employee_id = '$userId' AND date_logs = '$calendarDate'";
        $date_logs_hours = $con->query($query_date_logs_hours) or die ($con->error);
        $row = $date_logs_hours->fetch_assoc();

        if(!empty($date_logs_hours->num_rows)){

            if($row['total_of_work_hours'] >= 9){

                echo "bg-green";

            } else {

                echo "bg-red";

            }

        } else {

            echo "bg-red";

        }

    }


?>