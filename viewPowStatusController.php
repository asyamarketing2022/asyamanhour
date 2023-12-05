<?php 

include_once("connections/DBconnection.php");

class ViewPowStatatusController
{
    
    public $projectId;
    public $services;
    public $phase_of_work;
    public $services_phaseOfwork;

    public function __construct($projectId = null, $services = null, $phase_of_work = null, $services_phaseOfwork = null)
    {
        $db = new DBconnection();
        $this->conn = $db->connection();

        $this->projectId = $projectId;
        $this->services = $services;
        $this->phase_of_work = $phase_of_work;
        $this->services_phaseOfwork = $services_phaseOfwork;
    }

    function change_phase_of_work_status()
    {

        $projectId = $this->projectId;
        $services = $this->services;
        $phase_of_work = $this->phase_of_work;
        $services_phaseOfwork = $this->services_phaseOfwork;

        $query_users_tasks_status = "SELECT * FROM employees_tasks WHERE project_id = '$projectId' AND services = '$services' AND phase_of_work = '$phase_of_work' AND invite_status = 'accept'";
        $users_tasks_status = $this->conn->query($query_users_tasks_status) or die ($this->conn->error);
        $tasks_status = $users_tasks_status->fetch_assoc();

        $workonit = 0;

        do {

            $status[] = $tasks_status['status'];
            $count = count($status);

            for($i = 0; $count != $i; $i++){

                if($status[$i] == 'Working on it' || $status[$i] == 'Stuck' || $status[$i] == '') {

                    $workonit++;

                    $update_project_phase_of_work = "UPDATE `pms_projects` SET `$services_phaseOfwork` = 'Working on it' WHERE id = '$projectId'";
                    $this->conn->query($update_project_phase_of_work) or die ($this->conn->error);

                } elseif($workonit == 0) {

                    $update_project_phase_of_work = "UPDATE `pms_projects` SET `$services_phaseOfwork` = 'Done' WHERE id = '$projectId'";
                    $this->conn->query($update_project_phase_of_work) or die ($this->conn->error);

                }

            }

        } while($tasks_status = $users_tasks_status->fetch_assoc());

    }

}

// $archSchematic = new ViewPowStatatusController();
// $archSchematic->change_phase_of_work_status();