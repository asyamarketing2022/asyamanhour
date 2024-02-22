<?php 

include_once("connections/DBconnection.php");

ini_set('max_execution_time', '300'); //300 seconds = 5 minutes
ini_set('max_execution_time', '0'); // for infinite time of execution 

class ViewProjectRecordsController
{
    public $service_phaseOfwork;
    public $services;
    public $phase_of_work;
    public $assigned_employee;
    public $conn;

    public function __construct($services = null, $phase_of_work = null, $assigned_employee = null)
    {
        $db = new DBconnection();
        $this->conn = $db->connection();

        // $this->service_phaseOfwork = $service_phaseOfwork;
        $this->services = $services;
        $this->phase_of_work = $phase_of_work;
        $this->assigned_employee = $assigned_employee;

    }

    function view_tasks_report()
    {

        $projectID = $_GET['ID'];
        $output = '';

        $query_projects = "SELECT * FROM pms_projects WHERE id = '$projectID'";
        $project = $this->conn->query($query_projects) or die ($this->conn->error);
        $row = $project->fetch_assoc();

        // $service_phase_of_work = $this->service_phaseOfwork;
     
        $services = $this->services;
        $phase_of_work = $this->phase_of_work;
        $employee = $this->assigned_employee;

        // if($row[$service_phase_of_work] == 1) {

            if(!empty($row[$employee])) {

                $phase_of_work_employees = (explode(" ", $row[$employee]));
                $phase_of_work_employee_count = (empty($phase_of_work_employees) ? "" : count($phase_of_work_employees));

                for ($i = 0; $i < $phase_of_work_employee_count; $i++) {

                    $phase_of_work_employee = $phase_of_work_employees[$i];

                    $query_users_tasks = "SELECT * FROM employees_tasks WHERE services = '$services' AND phase_of_work = '$phase_of_work' AND employee_id = '$phase_of_work_employee' AND project_id = '$projectID' AND invite_status = 'accept'";
                    $users_tasks = $this->conn->query($query_users_tasks) or die ($this->conn->error);
                    $user_task = $users_tasks->fetch_assoc();

                    do {

                        if($users_tasks->num_rows != 0) {

                            $userId = $user_task['employee_id'];
                            $taskId = $user_task['id'];
    
                            // Fetch Task 
                            $query_users = "SELECT * FROM registered_users WHERE ID = '$userId'";
                            $users = $this->conn->query($query_users) or die ($this->conn->error);
                            $user = $users->fetch_assoc();
    
                            $output .= "<div class='manager-task'>
                                            <div class='taskUser'>
                                                <img src='img/upload/" . $user['user_image'] . "' alt=''>
                                                <div class='userInfo'>
                                                    <p>Name:
                                                    <span class='userName'>" . $user['first_name'] . " " . $user['last_name'] . "</span>
                                                    </p>
                                                    <p>Department:
                                                    <span class='userDepartment'>" . $user['department'] . "</span>
                                                    </p>
                                                    <p>Position:
                                                    <span class='userPosition'>" . $user['position'] . "</span>
                                                    </p>
                                                </div>
                                            </div>
                                                <div class='taskTitle'>
                                                    <h3>" . $user_task['task_title'] . "</h3>
                                                </div>
                                                <span style='margin: 0 15px; font-size: 20px;'><strong>Task Updates</strong></span>
                                            <div class='taskUpdates'>";

                                // Fetch Task Update
                                $query_tasks_updates = "SELECT * FROM employees_updates_task WHERE task_id = $taskId";
                                $tasks_updates = $this->conn->query($query_tasks_updates) or die ($this->conn->error);
      
                                if ( $tasks_updates->num_rows > 0){

                                    $output .= "<div class='taskUpdatesList'>";
                                                    
                                    while ($task_updates = $tasks_updates->fetch_assoc()) {

                                        $output .= "<span>" . $task_updates['task_update'] . "</span>";
                                        $output .= "<span>" . $task_updates['spend_hours'] . " hour(s)</span>";

                                    }

                                    $output .= "</div>";

                                } 

                            $output .= "</div>";

                            $output .= "<div class='taskTotalHours'>
                                            <span><strong>Total Spend Hours</strong>
                                            </span>
                                            <span><strong>" . $user_task['total_spend_hours'] . " hour(s)</strong></span>
                                        </div>
                                    </div>";

                        }
       
                    } while($user_task = $users_tasks->fetch_assoc());

                }

                echo $output;

            }   

        // }
    }

    function phase_of_work_total_spend_hours()
    {

        // Add the total spend hours every phase of work of project
        $projectID = $_GET['ID'];
        $output = '';

        $services = $this->services;
        $phase_of_work = $this->phase_of_work;

        $query_projects = "SELECT * FROM employees_tasks WHERE project_id = '$projectID' AND services = '$services' AND phase_of_work = '$phase_of_work'";
        $project = $this->conn->query($query_projects) or die ($this->conn->error);
        $row = $project->fetch_assoc();

        if ( $project->num_rows > 0 ){

            $total = 0;

            do {

                $output = $row['total_spend_hours'];

                $total += (int)$output;

            } while($row = $project->fetch_assoc());

            echo $total;

        } 

    }

}

?>