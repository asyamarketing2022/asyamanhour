<?php 

include_once("connections/DBconnection.php");

class ViewProjectRecordsController
{
    public $service_phaseOfwork;
    public $phase_of_work_manager;
    public $assigned_employee;
    public $phase_of_work;
    public $conn;

    public function __construct($service_phaseOfwork = null, $phase_of_work_manager = null, $assigned_employee = null, $services, $phase_of_work = null)
    {
        $db = new DBconnection();
        $this->conn = $db->connection();

        $this->service_phaseOfwork = $service_phaseOfwork;
        $this->phase_of_work_manager = $phase_of_work_manager;
        $this->assigned_employee = $assigned_employee;
        $this->services = $services;
        $this->phase_of_work = $phase_of_work;

    }

    function view_tasks_report()
    {

        $projectID = $_GET['ID'];
        $output = '';

        $query_projects = "SELECT * FROM pms_projects WHERE id = '$projectID'";
        $project = $this->conn->query($query_projects) or die ($this->conn->error);
        $row = $project->fetch_assoc();

        $service_phase_of_work = $this->service_phaseOfwork;
        $manager = $this->phase_of_work_manager;
        $services = $this->services;
        $phase_of_work = $this->phase_of_work;

        if($row[$service_phase_of_work] == 1) {

            if(!empty($row[$manager])) {

                $phase_of_work_managers = (explode(" ", $row[$manager]));
                $phase_of_work_manager_count = (empty($phase_of_work_managers) ? "" : count($phase_of_work_managers));

                for ($i = 0; $i < $phase_of_work_manager_count; $i++) {

                    $phase_of_work_manager = $phase_of_work_managers[$i];

                    $query_users_tasks = "SELECT * FROM employees_tasks WHERE services = '$services' AND phase_of_work = '$phase_of_work' AND employee_id = '$phase_of_work_manager' AND project_id = '$projectID'";
                    $users_tasks = $this->conn->query($query_users_tasks) or die ($this->conn->error);
                    $user_task = $users_tasks->fetch_assoc();

                    do {

                        $userId = $user_task['employee_id'];
                        $taskId = $user_task['id'];

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
                                        ";
       
                    } while($user_task = $users_tasks->fetch_assoc());

                    // do {

                    //     $query_tasks_updates = "SELECT * FROM employees_updates_task WHERE task_id = $taskId";
                    //     $tasks_updates = $this->conn->query($query_tasks_updates) or die ($this->conn->error);
                    //     $task_updates = $tasks_updates->fetch_assoc();

                    //     $output .= "<li>" . $task_updates['task_update'] . "</li>";

                    // } while($task_updates = $tasks_updates->fetch_assoc());

                    // $output .= "</ul>
                    //             </div>
                    //                 </div>
                    //                     </div>";


                    // do {

                    //     $taskId = $user_task['id'];

                    //     $query_task_updates = "SELECT * FROM employees_updates_task WHERE task_id = '$taskId'";
                    //     $task_updates = $this->conn->query($query_task_updates) or die ($this->conn->error);
                    //     $task_update = $task_updates->fetch_assoc();

                    //     $output .= "<div class='taskTitle'>
                    //                     <h3>" . $task_update['task_title'] . "</h3>
                    //                 </div>";


                    // } while($task_update = $task_updates->fetch_assoc());

                }

                echo $output;

            // foreach($tasksId as $taskId) {

            // echo $output;

            }   

        }
    }
}

?>