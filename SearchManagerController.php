<?php 

include_once("connections/DBconnection.php");

class SearchManagerController
{

    public $department;
    public $searchValue;
    public $userId_container;

    public function __construct($department = null, $searchValue = null, $userId_container = null)
    {
        $db = new DBconnection();
        $this->conn = $db->connection();
        
        $this->department = $department;
        $this->searchValue = $searchValue;
        $this->userId_container = $userId_container;

    }

    function searchManager()
    {

        $URL = 'http://asyamanhour';

        if(isset($this->searchValue) && !empty($this->userId_container)){
   
            $sql = "SELECT * FROM registered_users WHERE CONCAT(last_name) LIKE '%" . $this->searchValue ."%' AND department = '". $this->department . "' AND access = 'manager'";
            $query_run = mysqli_query($this->conn, $sql);
    
            $assignedManager = $this->userId_container;
            $length = count($assignedManager);
            $loop = 0;
            $num = 0;

   
            if(mysqli_num_rows($query_run) > 0)
            {
                foreach($query_run as $query_manager)
                {
                    for ($i = -1; $i < $length; $i++)
                    {
                        if($loop < $length){
    
                            if($assignedManager[$loop] == $query_manager['ID']){
    
                                $num = 1;
                                    
                            } 
    
                            $loop++;
    
                        } else {
    
                            if($num == 0){
    
                                echo "<div class='user_container' value='" . $query_manager['ID'] . "'>
                                    <div class='user_photo'>
                                        <img class='photoCircle m-0' src='img/upload/" . $query_manager['user_image'] . "' alt='' width='100'>
                                        <button class='selectBtn'><a href='#'>Select Manager</a></button>
                                    </div>
                                        <div class='user_info'>
                                            <div class='user_fullname'>
                                                <label>Name:</label>
                                                <span>" . $query_manager['first_name'] . " " . $query_manager['last_name'] . "</span>
                                            </div>
            
                                            <div class='user_position'>
                                                <label>Position:</label>
                                                <span>" . $query_manager['position'] . "</span>
                                            </div>
            
                                            <div class='user_department'>
                                                <label>Department:</label>
                                                <span>" . $query_manager['department'] . "</span>
                                            </div>
                                        </div>
                                    </div>";
  
                            } 
                            
                            $loop = 0;
                            $num = 0;
    
                        } 
        
                    }
                }
       
            } else {
    
                echo "No Search Found";
            }

        } elseif(isset($this->searchValue) && empty($this->userId_container)){


            $sql = "SELECT * FROM registered_users WHERE CONCAT(last_name) LIKE '%" . $this->searchValue . "%' AND department = '". $this->department ."' AND access = 'manager'";
            $query_run = mysqli_query($this->conn, $sql);

            if(mysqli_num_rows($query_run) > 0)
            {
                foreach($query_run as $query_manager)
                {
                
                echo "<div class='user_container' value='" . $query_manager['ID'] . "'>
                            <div class='user_photo'>
                                <img class='photoCircle m-0' src='img/upload/" . $query_manager['user_image'] . "' alt='' width='100'>
                                <button class='selectBtn'><a href='#'>Select Manager</a></button>
                            </div>
                            <div class='user_info'>
                                <div class='user_fullname'>
                                    <label>Name:</label>
                                    <span>" . $query_manager['first_name'] . " " . $query_manager['last_name'] . "</span>
                                </div>
                
                                <div class='user_position'>
                                    <label>Position:</label>
                                    <span>" . $query_manager['position'] . "</span>
                                </div>
                
                                <div class='user_department'>
                                    <label>Department:</label>
                                    <span>" . $query_manager['department'] . "</span>
                                </div>
                            </div>
                        </div>";
                        
                }
    
            } else {

                echo "No Search Found";
            }
        
        
        } elseif(!empty($_POST['userId_container'])) {

            $sql = "SELECT * FROM registered_users WHERE department = '". $this->department ."' AND access = 'manager'";
            $query_run = mysqli_query($this->conn, $sql);
            $query_manager = $query_run->fetch_assoc();

                do {

                    echo "<div class='user_container' value='" . $query_manager['ID'] . "'>
                                <div class='user_photo'>
                                    <img class='photoCircle m-0' src='img/upload/" . $query_manager['user_image'] . "' alt='' width='100'>
                                    <button class='selectBtn'><a href='#'>Select Manager</a></button>
                                </div>
                                <div class='user_info'>
                                    <div class='user_fullname'>
                                        <label>Name:</label>
                                        <span>" . $query_manager['first_name'] . " " . $query_manager['last_name'] . "</span>
                                    </div>
                                    <div class='user_position'>
                                        <label>Position:</label>
                                        <span>" . $query_manager['position'] . "</span>
                                    </div>
                        
                                    <div class='user_department'>
                                        <label>Department:</label>
                                        <span>" . $query_manager['department'] . "</span>
                                    </div>
                                </div>
                            </div>";


                } while($query_manager = $query_run->fetch_assoc());
                

        } elseif(!empty($_POST['userId_container'])) {

            $sql = "SELECT * FROM registered_users WHERE department = '". $this->department ."' AND access = 'manager'";
            $query_run = mysqli_query($this->conn, $sql);

            $assignedManager = $_POST['userId_container'];
            $length = count($assignedManager);
            $loop = 0;
            $num = 0;

        
                if(mysqli_num_rows($query_run) > 0)
                {
                    foreach($query_run as $query_manager)
                    {
                        for ($i = -1; $i < $length; $i++)
                        {
                            if($loop < $length){
        
                                if($assignedManager[$loop] == $query_manager['ID']){
        
                                    $num = 1;
                                        
                                } 
        
                                $loop++;
        
                            } else {
        
                                if($num == 0){
        
                                    echo "<div class='user_container' value='" . $query_manager['ID'] . "'>
                                        <div class='user_photo'>
                                            <img class='photoCircle m-0' src='img/upload/" . $query_manager['user_image'] . "' alt='' width='100'>
                                            <button class='selectBtn'><a href='#'>Select Manager</a></button>
                                        </div>
                                            <div class='user_info'>
                                                <div class='user_fullname'>
                                                    <label>Name:</label>
                                                    <span>" . $query_manager['first_name'] . " " . $query_manager['last_name'] . "</span>
                                                </div>
                
                                                <div class='user_position'>
                                                    <label>Position:</label>
                                                    <span>" . $query_manager['position'] . "</span>
                                                </div>
                
                                                <div class='user_department'>
                                                    <label>Department:</label>
                                                    <span>" . $query_manager['department'] . "</span>
                                                </div>
                                            </div>
                                        </div>";
        
                                } 
        
                                $loop = 0;
                                $num = 0;
        
                            }
            
                        }
                    }
                } 

        } 
    }

    function searchEngrManager()
    {
        if(isset($this->searchValue) && !empty($this->userId_container)){

            $departments = (explode(" ",  $this->department));
            $department_length = count($departments);

            for($count = 0; $department_length > $count; $count++){

            $dept = str_replace("-", " ", $departments[$count]);
            $no_result = "";

            $sql = "SELECT * FROM registered_users WHERE CONCAT(last_name) LIKE '%" . $this->searchValue ."%' AND department = '$dept' AND access = 'manager'";
            $query_run = mysqli_query($this->conn, $sql);
    
            $assignedManager = $this->userId_container;
            $length = count($assignedManager);
            $loop = 0;
            $num = 0;
        
            if(mysqli_num_rows($query_run) > 0)
            {
                foreach($query_run as $query_manager)
                {
                    for ($i = -1; $i < $length; $i++)
                    {
                        if($loop < $length){
    
                            if($assignedManager[$loop] == $query_manager['ID']){
    
                                $num = 1;
                                    
                            } 
    
                            $loop++;
    
                        } else {
    
                            if($num == 0){
    
                                echo "<div class='user_container' value='" . $query_manager['ID'] . "'>
                                    <div class='user_photo'>
                                        <img class='photoCircle m-0' src='img/upload/" . $query_manager['user_image'] . "' alt='' width='100'>
                                        <button class='selectBtn'><a href='#'>Select Manager</a></button>
                                    </div>
                                        <div class='user_info'>
                                            <div class='user_fullname'>
                                                <label>Name:</label>
                                                <span>" . $query_manager['first_name'] . " " . $query_manager['last_name'] . "</span>
                                            </div>
            
                                            <div class='user_position'>
                                                <label>Position:</label>
                                                <span>" . $query_manager['position'] . "</span>
                                            </div>
            
                                            <div class='user_department'>
                                                <label>Department:</label>
                                                <span>" . $query_manager['department'] . "</span>
                                            </div>
                                        </div>
                                    </div>";
  
                            } 
                            
                            $loop = 0;
                            $num = 0;
    
                        } 
        
                    }
                }
       
                } else {
        
                    $no_result = "No Search Found";
                }

            }

            echo $no_result;


        } elseif(isset($this->searchValue) && empty($this->userId_container)){

            $departments = (explode(" ", $this->department));
            $department_length = count($departments);

            for($count = 0; $department_length > $count; $count++){

                $dept = str_replace("-", " ", $departments[$count]);
                $no_result = "";

                $sql = "SELECT * FROM registered_users WHERE CONCAT(last_name) LIKE '%" . $this->searchValue . "%' AND department = '$dept' AND access = 'manager'";
                $query_run = mysqli_query($this->conn, $sql);

                if(mysqli_num_rows($query_run) > 0)
                {
                    foreach($query_run as $query_manager)
                    {
                    
                    echo "<div class='user_container' value='" . $query_manager['ID'] . "'>
                                <div class='user_photo'>
                                    <img class='photoCircle m-0' src='img/upload/" . $query_manager['user_image'] . "' alt='' width='100'>
                                    <button class='selectBtn'><a href='#'>Select Manager</a></button>
                                </div>
                                <div class='user_info'>
                                    <div class='user_fullname'>
                                        <label>Name:</label>
                                        <span>" . $query_manager['first_name'] . " " . $query_manager['last_name'] . "</span>
                                    </div>
                    
                                    <div class='user_position'>
                                        <label>Position:</label>
                                        <span>" . $query_manager['position'] . "</span>
                                    </div>
                    
                                    <div class='user_department'>
                                        <label>Department:</label>
                                        <span>" . $query_manager['department'] . "</span>
                                    </div>
                                </div>
                            </div>";
                            
                    }
        
                } else {

                    $no_result = "No Search Found";
                }
            }

            echo $no_result;

        } elseif(empty($_POST['userId_container'])) {

            $departments = (explode(" ", $this->department));
            $department_length = count($departments);

            for($count = 0; $department_length > $count; $count++){

            $dept = str_replace("-", " ", $departments[$count]);

            $sql = "SELECT * FROM registered_users WHERE department = '$dept' AND access = 'manager'";
            $query_run = mysqli_query($this->conn, $sql);
            $query_manager = $query_run->fetch_assoc();

                do {

                    echo "<div class='user_container' value='" . $query_manager['ID'] . "'>
                                <div class='user_photo'>
                                    <img class='photoCircle m-0' src='img/upload/" . $query_manager['user_image'] . "' alt='' width='100'>
                                    <button class='selectBtn'><a href='#'>Select Manager</a></button>
                                </div>
                                <div class='user_info'>
                                    <div class='user_fullname'>
                                        <label>Name:</label>
                                        <span>" . $query_manager['first_name'] . " " . $query_manager['last_name'] . "</span>
                                    </div>
                                    <div class='user_position'>
                                        <label>Position:</label>
                                        <span>" . $query_manager['position'] . "</span>
                                    </div>
                        
                                    <div class='user_department'>
                                        <label>Department:</label>
                                        <span>" . $query_manager['department'] . "</span>
                                    </div>
                                </div>
                            </div>";


                } while($query_manager = $query_run->fetch_assoc());
            }

        } elseif(!empty($_POST['userId_container'])) {

            $departments = (explode(" ", $this->department));
            $department_length = count($departments);

            for($count = 0; $department_length > $count; $count++){

            $dept = str_replace("-", " ", $departments[$count]);

            $sql = "SELECT * FROM registered_users WHERE department = '$dept' AND access = 'manager'";
            $query_run = mysqli_query($this->conn, $sql);

            $assignedManager = $_POST['userId_container'];
            $length = count($assignedManager);
            $loop = 0;
            $num = 0;

        
            if(mysqli_num_rows($query_run) > 0)
            {
                foreach($query_run as $query_manager)
                {
                    for ($i = -1; $i < $length; $i++)
                    {
                        if($loop < $length){
        
                            if($assignedManager[$loop] == $query_manager['ID']){
        
                                $num = 1;
                                        
                            } 
        
                            $loop++;
        
                        } else {
        
                            if($num == 0){
        
                                echo "<div class='user_container' value='" . $query_manager['ID'] . "'>
                                        <div class='user_photo'>
                                            <img class='photoCircle m-0' src='$URL/img/upload/" . $query_manager['user_image'] . "' alt='' width='100'>
                                            <button class='selectBtn'><a href='#'>Select Manager</a></button>
                                        </div>
                                            <div class='user_info'>
                                                <div class='user_fullname'>
                                                    <label>Name:</label>
                                                    <span>" . $query_manager['first_name'] . " " . $query_manager['last_name'] . "</span>
                                                </div>
                
                                                <div class='user_position'>
                                                    <label>Position:</label>
                                                    <span>" . $query_manager['position'] . "</span>
                                                </div>
                
                                                <div class='user_department'>
                                                    <label>Department:</label>
                                                    <span>" . $query_manager['department'] . "</span>
                                                </div>
                                            </div>
                                        </div>";
        
                            } 
        
                            $loop = 0;
                            $num = 0;
        
                        }
            
                    }
                }
            } 

            }
        } 

    }
}

// $ex = new SearchManagerController();
// $ex->searchEngrManager();


?>