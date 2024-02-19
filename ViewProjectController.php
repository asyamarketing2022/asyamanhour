<?php 

include_once("connections/DBconnection.php");


class ViewProjectController
{
    public $service_phaseOfwork;
    public $phase_of_work_manager;
    public $assigned_employee;
    public $phase_of_work;
    public $who_assigned_manager;
    public $status;
    public $name;
    public $conn;

    public function __construct($service_phaseOfwork = null, $phase_of_work_manager = null, $assigned_employee = null, $phase_of_work = null, $who_assigned_manager = null, $status = null, $name = null )
    {
        $db = new DBconnection();
        $this->conn = $db->connection();

        $this->service_phaseOfwork = $service_phaseOfwork;
        $this->phase_of_work_manager = $phase_of_work_manager;
        $this->assigned_employee = $assigned_employee;
        $this->phase_of_work = $phase_of_work; 
        $this->who_assigned_manager = $who_assigned_manager;
        $this->status = $status;
        $this->name = $name;
    }
    
    function view_phase_of_work_status()
    {

        $projectID = $_GET['ID'];

        $query_projects = "SELECT * FROM pms_projects WHERE id = '$projectID'";
        $project = $this->conn->query($query_projects) or die ($this->conn->error);
        $row = $project->fetch_assoc();

        $service_phase_of_work = $this->service_phaseOfwork;
        $manager = $this->phase_of_work_manager;
        $assignedEmployee = $this->assigned_employee;
        $phaseOfwork = $this->phase_of_work;

        $whoAssignedManager = $this->who_assigned_manager;
        $currentStatus = $this->status;
        $inputName = $this->name;
        $dueDate = $this->name;

        // $URL = 'http://asyamanhour';

        if($row[$service_phase_of_work] == 1) {  

            if(!empty($row[$manager])) {

                $phase_of_work_managers = (explode(" ", $row[$manager]));
                $phase_of_work_manager_count = (empty($phase_of_work_managers) ? "" : count($phase_of_work_managers));

                for ($i = 0; $i < $phase_of_work_manager_count; $i++) {

                    $phase_of_work_manager = $phase_of_work_managers[$i];

                    $query_users = "SELECT * FROM registered_users WHERE ID = '$phase_of_work_manager'";
                    $phase_of_work_manager_run = $this->conn->query($query_users) or die ($this->conn->error);
                    $phase_of_work_manager_info = $phase_of_work_manager_run->fetch_assoc();

                    $phase_of_work_manager_image_array[] = $phase_of_work_manager_info['user_image'];
                    $phase_of_work_manager_id_array[] = $phase_of_work_manager_info['ID'];
                    
                }

            } else {

                //If on manager assign creating variable with empty array
                $phase_of_work_manager_image_array = [];
                $phase_of_work_manager_id_array = [];
            }


            if(!empty($row[$assignedEmployee])) {

                $assigned_employees = explode(" ", $row[$assignedEmployee]);
                $employees_count = (empty($assigned_employees) ? "" : count($assigned_employees));

                        for($num = 0; $num < $employees_count; $num++) {
        
                            $assigned_employeesId = $assigned_employees[$num];
        
                            $query_employee = "SELECT * FROM registered_users WHERE ID = '$assigned_employeesId'";
                            $assigned_employees_run = $this->conn->query($query_employee) or die ($con->error);
                            $assigned_employees_info = $assigned_employees_run->fetch_assoc();
        
                            $assigned_employee_image_array[] = $assigned_employees_info['user_image'];
                            $assigned_employeeId_array[] = $assigned_employees_info['ID'];
        
                        }

                } else {

                    $assigned_employee_image_array = [];
                    $assigned_employeeId_array = [];

                }

                echo "<tr class='table-row_projects table-form' value=''>
                <td class='td_phase_of_work'>$phaseOfwork</td>";
                // <td>". $phase_of_work_manager_info['department'] ."</td>"

                // echo " <td class='manager_photo_id' data-toggle='modal' data-target='#view_managers' value='";
                echo " <td class='manager_photo_id' value='";

                foreach($phase_of_work_manager_id_array as $phase_of_work_manager_id){


                    echo "$phase_of_work_manager_id ";

                }

                echo "'>";

                     foreach($phase_of_work_manager_image_array as $phase_of_work_manager_image){
                
                        echo "<img src='img/upload/$phase_of_work_manager_image' alt='' class='table_image_small photoCircle mini-photo'>";

                     };

                echo "</td>";


                echo "<td class='who_assigned_manager d-none' value='" . $row[$whoAssignedManager] . "'></td>";

                // echo "<td class='projectIncharge_table_row' data-toggle='modal' data-target='#view_project_in_charge' value=
                // '";
                echo "<td class='projectIncharge_table_row' value=
                '";

                foreach($assigned_employeeId_array as $assigned_employeeId) {

                    echo "$assigned_employeeId ";
                    
                };

                echo "'>";

                foreach($assigned_employee_image_array as $assigned_employee_image) {

                    echo "<img class='photoCircle mini-photo' src='img/upload/$assigned_employee_image' alt='' class='table_image_small'>";
            
                }

                echo "</td>";

                echo "<td class='pow_status' value='$currentStatus'>
                    <div class='text_status'><span>$row[$currentStatus]</span></div>
                    <div class='status_tooltip d-none'>

                        <div class='employees_task_list_container'>
                            
                        </div>
                       
                    </div>
                </td>
                <td>" . $row['added_at'] . "</td>
                <td><input class='dueDate dis_previous_dates' name='$inputName' type='date' value='" . $row[$dueDate] . "'></td>
       
                <td><button class='viewfilepathBtn' data-toggle='modal' data-target='#viewfilepath'>Check Files</button></td>
            </tr>";

            //     echo "<td class='pow_status' value='$currentStatus'>
            //         <div class='text_status'><span>$row[$currentStatus]</span></div>
            //         <div class='status_tooltip d-none'>
            //             <span class='status orangeStatus'>Working on it</span>
            //             <span class='status redStatus'>Stuck</span>
            //             <span class='status greenStatus'>Done</span>
            //             <input type='text' onkeypress='return /[ A-Za-z0-9]/i.test(event.key)' onpaste='return false;' ondrop='return false;' autocomplete='off' >
                        
            //         </div>
            //     </td>
            //     <td>" . $row['added_at'] . "</td>
            //     <td><input class='dueDate dis_previous_dates' name='$inputName' type='date' value='" . $row[$dueDate] . "'></td>
            //     <td><button class='uploadPathBtn' data-toggle='modal' data-target='#uploadPath'>Upload File Path</button></td>
            //     <td><button class='viewfilepathBtn' data-toggle='modal' data-target='#viewfilepath'>Check Files</button></td>
            // </tr>";
           
        }
    }
}


?>