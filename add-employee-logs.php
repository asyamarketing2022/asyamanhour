<?php include_once('connections/DBconnection.php'); ?>
<?php include_once 'login.php'; ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['dateClick'])){

        $userId = $_SESSION['UserId'];
        $dateSelected = $_POST['dateClick'];

        $sql_projects = "SELECT * FROM employees_tasks WHERE employee_id = $userId";
        $projects = $con->query($sql_projects) or die ($con->error);
        $project = $projects->fetch_assoc();

        $option_project = '';

        do {

            $option_project .= "<option>".$project['project_name']."</option>";

        } while($project = $projects->fetch_assoc());

        echo $option_project;

    }


?>