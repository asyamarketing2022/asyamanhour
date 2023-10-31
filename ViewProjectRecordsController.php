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
    public $assigned_pic;
    public $conn;

    public function __construct($services = null, $phase_of_work = null, $assigned_employee = null, $assigned_pic = null)
    {
        $db = new DBconnection();
        $this->conn = $db->connection();

        // $this->service_phaseOfwork = $service_phaseOfwork;
        $this->services = $services;
        $this->phase_of_work = $phase_of_work;
        $this->assigned_employee = $assigned_employee;
        $this->assigned_pic = $assigned_pic;

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

    function service_report()
    {
        $projectID = $_GET['ID'];
        $output = '';
        // $spend_hours = 0;
       
        $query_projects = "SELECT * FROM pms_projects WHERE id = '$projectID'";
        $project = $this->conn->query($query_projects) or die ($this->conn->error);
        $row = $project->fetch_assoc();

        $services = $this->services;
        $phase_of_work = $this->phase_of_work;
        $employee_manager = $this->assigned_employee;
        $employee_pic = $this->assigned_pic;
        // $pic = $this->$assigned_pic;

        $managers_spend_hours = 0;
        $pic_total_hours = 0;
        $total_spend_hours = 0;

        $output .= "<table>
                        <tbody>
                            <tr>
                                <th>Services</th>
                                <th>Phase Of Work</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th>Task Name</th>
                                <th>Task Update</th>
                                <th>Task Spend Hours</th>
                            </tr>";

        if(!empty($row[$employee_manager])) {

            $phase_of_work_employee_manager = (explode(" ", $row[$employee_manager]));
            $phase_of_work_employee_manager_count = (empty($phase_of_work_employee_manager) ? "" : count($phase_of_work_employee_manager));

            for ($i = 0; $phase_of_work_employee_manager_count > $i; $i++) {

                $phase_of_work_manager = $phase_of_work_employee_manager[$i];

                $query_users_tasks = "SELECT * FROM employees_updates_task WHERE services = '$services' AND phase_of_work = '$phase_of_work' AND employee_id = '$phase_of_work_manager' AND project_id = '$projectID'";
                $users_tasks = $this->conn->query($query_users_tasks) or die ($this->conn->error);
                $user_task = $users_tasks->fetch_assoc();

                if ($users_tasks->num_rows > 0 ) {

                   $employeeId = $user_task['employee_id'];

                   $query_employees = "SELECT * FROM registered_users WHERE ID = '$employeeId'";
                   $employees = $this->conn->query($query_employees) or die ($this->conn->error);
                   $employee = $employees->fetch_assoc();

                    do {
                    
                        $output .= "<tr class='record-update'>
                                <td>$services</td>
                                <td>" . $user_task['phase_of_work'] . "</td>
                                <td>" . $user_task['employee_name'] . "</td>
                                <td>" . $employee['department'] . "</td>
                                <td>" . $employee['position'] . "</td>
                                <td>" . $user_task['task_title'] . "</td>
                                <td>" . $user_task['task_update'] . "</td>
                                <td>" . $user_task['spend_hours'] . "</td>
                                </tr>";

                        $managers_spend_hours += empty($user_task['spend_hours']) ? 0 : $user_task['spend_hours'];

                    } while($user_task = $users_tasks->fetch_assoc());  

                }
 
            }
        }

        if(!empty($row[$employee_pic])) {

            $phase_of_work_employee_pic = (explode(" ", $row[$employee_pic]));
            $phase_of_work_employee_pic_count = (empty($phase_of_work_employee_pic) ? "" : count($phase_of_work_employee_pic));

            for ($a = 0; $phase_of_work_employee_pic_count > $a; $a++) {

                $phase_of_work_pic = $phase_of_work_employee_pic[$a];
               
                $query_pic_tasks = "SELECT * FROM employees_updates_task WHERE services = '$services' AND phase_of_work = '$phase_of_work' AND employee_id = '$phase_of_work_pic' AND project_id = '$projectID'";
                $query_pic = $this->conn->query($query_pic_tasks) or die ($this->conn->error);
                $pic_task = $query_pic->fetch_assoc();

                if ($query_pic->num_rows > 0 ) {

                   $employeeId = $pic_task['employee_id'];

                   $query_employees = "SELECT * FROM registered_users WHERE ID = '$employeeId'";
                   $employees = $this->conn->query($query_employees) or die ($this->conn->error);
                   $employee = $employees->fetch_assoc();

                    do {
                    
                        $output .= "<tr class='record-update'>
                                <td>$services</td>
                                <td>" . $pic_task['phase_of_work'] . "</td>
                                <td>" . $pic_task['employee_name'] . "</td>
                                <td>" . $employee['department'] . "</td>
                                <td>" . $employee['position'] . "</td>
                                <td>" . $pic_task['task_title'] . "</td>
                                <td>" . $pic_task['task_update'] . "</td>
                                <td>" . $pic_task['spend_hours'] . "</td>
                                </tr>";

                        // echo empty($address['street2']) ? "Street2 is empty!" : $address['street2'];

                        $pic_total_hours += empty($pic_task['spend_hours']) ? 0 : $pic_task['spend_hours'];

                    } while($pic_task = $query_pic->fetch_assoc());  

                }

            }

        }

        $total_spend_hours = $managers_spend_hours += $pic_total_hours;

        $output .= "<tr class='record-update'>
                    <td></td>            
                    <td></td>            
                    <td></td>            
                    <td></td>            
                    <td></td>            
                    <td></td>            
                    <td><strong>Total Hours:</strong></td>            
                    <td>" . $total_spend_hours . "  </td>            
                </tr>";

        $output .= "<tr class='record-update'>
                    <td></td>            
                    <td></td>            
                    <td></td>            
                    <td></td>            
                    <td></td>            
                    <td></td>            
                    <td></td>            
                    <td></td>            
                </tr>";

        echo $output;
        
    }

}

?>