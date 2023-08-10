<?php 

include_once("connections/DBconnection.php");

class AssignedEmployeeController
{

    public $service_pow_assigned_employee;
    public $service_pow_assigned_manager;
    public $projectId;
    public $managerId;
    public $employeeId;

    public function __construct($service_pow_assigned_employee = null, $service_pow_assigned_manager = null, $projectId = null, $managerId = null, $employeeId = null)
    {
      $db = new DBconnection();
      $this->conn = $db->connection();

      $this->service_pow_assigned_employee = $service_pow_assigned_employee;
      $this->service_pow_assigned_manager = $service_pow_assigned_manager;
      $this->projectId = $projectId;
      $this->managerId = $managerId;
      $this->employeeId = $employeeId;
    }

    function assignProjectInCharge()
    {

        $service_pow_assignedEmployee = $this->service_pow_assigned_employee;
        $service_pow_assignedManager = $this->service_pow_assigned_manager;
        $managerIds = $this->managerId;
        $employeeIds = $this->employeeId;
        $id = $this->projectId;

        $query_project = "SELECT * FROM `pms_projects` WHERE id = '" . $this->projectId . "'";
        $project = $this->conn->query($query_project) or die ($this->conn->error);
        $row = $project->fetch_assoc();

        $employeesAssigned = "";
        $whoAssignedManager = "";

      if(!empty($row[$service_pow_assignedEmployee])) {

        $AssignedEmployee = $row[$service_pow_assignedEmployee];
        $container_assignedEmployee = array("$AssignedEmployee", "$employeeIds");
        $wrapper_employeesAssigned = implode($container_assignedEmployee, " ");

        $WhoAssignedManager = $row[$service_pow_assignedManager];
        $container_whoAssignedManager = array("$WhoAssignedManager", "$managerIds");
        $wrapper_whoAssignedManager = implode($container_whoAssignedManager, " ");

        $updateSQL = "UPDATE `pms_projects` SET `$service_pow_assignedEmployee` = '$wrapper_employeesAssigned', `$service_pow_assignedManager` = '$wrapper_whoAssignedManager' WHERE id = '" . $this->projectId . "'";

        $this->conn->query($updateSQL) or die ($this->conn->error);

      } else {

        $service_pow_assignedManager = (empty($this->service_pow_assigned_manager) ? "arch_schematic_who_assigned_manager" : $this->service_pow_assigned_manager);
        $service_pow_assignedEmployee = (empty($this->service_pow_assigned_employee) ? "arch_schematic_assigned_employee" : $this->service_pow_assigned_employee);
       
        $updateSQL = "UPDATE `pms_projects` SET `$service_pow_assignedEmployee` = '$employeeIds', `$service_pow_assignedManager` = '$managerIds' WHERE id = '$id'";
 
        $this->conn->query($updateSQL) or die ($this->conn->error);

      }
    }
}


$ex = new AssignedEmployeeController();
$ex->assignProjectInCharge();


?>