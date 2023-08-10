<?php 

include_once("connections/DBconnection.php");

class EngrController
{
    public $schematic;
    public $designDevelopment;
    public $constructionDrawings;
    public $manager;
    public $conn;

    public function __construct($schematic = null, $designDevelopment = null, $constructionDrawings = null, $manager = null)
    {
        $db = new DBconnection();
        $this->conn = $db->connection();

        $this->schematic = $schematic;
        $this->designDevelopment = $designDevelopment;
        $this->constructionDrawings = $constructionDrawings;
        $this->manager = $manager;
    }

    function get_engr()
    {

        if(isset($_POST[$this->manager])) {

        $managerInput = $_POST[$this->manager];
        $managerCount = count($managerInput);

        for ($i = 0; $i < $managerCount; $i++) {

            $rowSchematic = $this->schematic;
            $rowdesignDevelopment = $this->designDevelopment;
            $rowconstructionDrawings = $this->constructionDrawings;

            if(isset($_POST[$this->schematic][$i]) && isset($_POST[$this->designDevelopment][$i]) && isset($_POST[$this->constructionDrawings][$i])){

                $container_array[] = $managerInput[$i];
                $managerName = implode(" ", $container_array);

                $serviceEngr = isset($_POST['serviceEngi']);

                $last = "SELECT * FROM pms_projects ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($this->conn, $last);
                $row = $result->fetch_assoc();
                $last_data = $row['id'];

                $sql = "UPDATE `pms_projects` SET `service_engineering` = '$serviceEngr', `$rowSchematic` = '$managerName', `$rowdesignDevelopment` =  '$managerName', `$rowconstructionDrawings` = '$managerName' WHERE id = '$last_data'";

                $this->conn->query($sql) or die ($this->conn->error);

            } elseif(isset($_POST[$this->schematic][$i]) && isset($_POST[$this->designDevelopment][$i])) {

                $container_array[] = $managerInput[$i];
                $managerName = implode(" ", $container_array);

                $last = "SELECT * FROM pms_projects ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($this->conn, $last);
                $row = $result->fetch_assoc();
                $last_data = $row['id'];

                $sql = "UPDATE `pms_projects` SET `$rowSchematic` = '$managerName', `$rowdesignDevelopment` = '$managerName' WHERE id = '$last_data'";

                $this->conn->query($sql) or die ($this->conn->error);

            } elseif(isset($_POST[$this->schematic][$i]) && isset($_POST[$this->constructionDrawings][$i])){

                $container_array[] = $managerInput[$i];
                $managerName = implode(" ", $container_array);

                $last = "SELECT * FROM pms_projects ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($this->conn, $last);
                $row = $result->fetch_assoc();
                $last_data = $row['id'];

                $sql = "UPDATE `pms_projects` SET `$rowSchematic` = '$managerName', `$rowconstructionDrawings` = '$managerName' WHERE id = '$last_data'";

                $this->conn->query($sql) or die ($this->conn->error);

            } elseif(isset($_POST[$this->designDevelopment][$i]) && isset($_POST[$this->constructionDrawings][$i])){

                $container_array[] = $managerInput[$i];
                $managerName = implode(" ", $container_array);

                $last = "SELECT * FROM pms_projects ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($this->conn, $last);
                $row = $result->fetch_assoc();
                $last_data = $row['id'];

                $sql = "UPDATE `pms_projects` SET `$rowdesignDevelopment` = '$managerName', `$rowconstructionDrawings` = '$managerName' WHERE id = '$last_data'";

                $this->conn->query($sql) or die ($this->conn->error);

            } elseif(isset($_POST[$this->schematic][$i])){

                $container_array[] = $managerInput[$i];
                $managerName = implode(" ", $container_array);

                $last = "SELECT * FROM pms_projects ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($this->conn, $last);
                $row = $result->fetch_assoc();
                $last_data = $row['id'];

                $sql = "UPDATE `pms_projects` SET `$rowSchematic` = '$managerName'";

                $this->conn->query($sql) or die ($this->conn->error);

            } elseif(isset($_POST[$this->designDevelopment][$i])){
            
                $container_array[] = $managerInput[$i];
                $managerName = implode(" ", $container_array);

                $last = "SELECT * FROM pms_projects ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($this->conn, $last);
                $row = $result->fetch_assoc();
                $last_data = $row['id'];

                $sql = "UPDATE `pms_projects` SET `$rowdesignDevelopment` = '$managerName' WHERE id = '$last_data'";

                $this->conn->query($sql) or die ($this->conn->error);

            } elseif(isset($_POST[$this->constructionDrawings][$i])){

                $container_array[] = $managerInput[$i];
                $managerName = implode(" ", $container_array);

                $last = "SELECT * FROM pms_projects ORDER BY id DESC LIMIT 1";
                $result = mysqli_query($this->conn, $last);
                $row = $result->fetch_assoc();
                $last_data = $row['id'];

                $sql = "UPDATE `pms_projects` SET `$rowconstructionDrawings` = '$managerName' WHERE id = '$last_data'";

                $this->conn->query($sql) or die ($this->conn->error);

            } else {

                echo error_log();

            }
                   
            } 
        }
      
    }


}

?>