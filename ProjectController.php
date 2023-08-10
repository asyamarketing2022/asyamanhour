<?php 

class ProjectController
{

    public function __construct()
    {
        $db = new DBconnection();
        $this->conn = $db->connection();
    }

    public function create($inputData)
    {
        $projectName = $inputData['projectName'];
        $location = $inputData['location'];
        $lotAreas = $inputData['lotAreas'];
        $arch_conceptual_managers = $inputData['arch_conceptual_manager'];

        $projectQuery = "INSERT INTO `pms_projects` (`project_name`, `location`, `lot_areas`, `design`) VALUES ('$projectName', '$location', '$lotAreas', '$arch_conceptual_managers ')";

        $result = $this->conn->query($projectQuery);

        if($result){
            return true;
        } else {
            return false;
        }
    }
}


?>