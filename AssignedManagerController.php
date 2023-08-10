<?php 

include_once("connections/DBconnection.php");

class AssignedManagerController
{
    public $managerId;
    public $projectId;
    public $service_pow_assign_manager;

    public function __construct($managerId = null, $projectId = null, $service_pow_assign_manager = null) 
    {
        $db = new DBconnection();
        $this->conn = $db->connection();

        $this->managerId = $managerId;
        $this->projectId = $projectId;
        $this->service_pow_assign_manager = $service_pow_assign_manager;
    }

    function assignManager()
    {

        $service_pow_assignManager = $this->service_pow_assign_manager;
        $managerIds = $this->managerId;


        $query_project = "SELECT * FROM `pms_projects` WHERE id = '" . $this->projectId . "'";
        $project = $this->conn->query($query_project) or die ($this->conn->error);
        $row = $project->fetch_assoc();

        if(!empty($row[$service_pow_assignManager])) {

           $assignedManager = $row[$service_pow_assignManager];
           $container_assignedManager = array("$assignedManager", $this->managerId);
           $wrapper_assignedManager  = implode($container_assignedManager, " ");

            $updateSQL = "UPDATE `pms_projects` SET `$service_pow_assignManager` =  '$wrapper_assignedManager' WHERE id = '" . $this->projectId . "'";

            $this->conn->query($updateSQL) or die ($this->conn->error);

        } else {

            $service_pow_assignManager = (empty($this->service_pow_assign_manager) ? "arch_conceptual_manager" : $this->service_pow_assign_manager);

            $updateSQL = "UPDATE `pms_projects` SET `$service_pow_assignManager` = '$managerIds' WHERE id = '" . $this->projectId . "'";

            $this->conn->query($updateSQL) or die ($this->conn->error);

        }
    }
}

    $ex = new AssignedManagerController;
    $ex->assignManager();

?>