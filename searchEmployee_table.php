<?php include_once('connections/DBconnection.php'); ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['searchValue']) && !empty($_POST['userId_container'])){

        $searchValue = $_POST['searchValue'];

        $sql = "SELECT * FROM registered_users WHERE CONCAT(last_name) LIKE '%$searchValue%' AND access = 'employee'";
        $query_run = mysqli_query($con, $sql);

        $assignedEmployee = $_POST['userId_container'];
        $length = count($assignedEmployee);
        $loop = 0;
        $num = 0;
    
        if(mysqli_num_rows($query_run) > 0)
        {
            foreach($query_run as $query_employee)
            {
                for ($i = -1; $i < $length; $i++)
                {
                    if($loop < $length){

                        if($assignedEmployee[$loop] == $query_employee['ID']){

                            $num = 1;
                                
                        } 

                        $loop++;

                    } else {

                        if($num == 0){

                            echo "<div class='user_container' value='" . $query_employee['ID'] . "'>
                                <div class='user_photo'>
                                    <img class='photoCircle m-0' src='img/upload/" . $query_employee['user_image'] . "' alt='' width='100'>
                                    <button class='selectBtn'><a href='#'>Select Employee</a></button>
                                </div>
                                    <div class='user_info'>
                                        <div class='user_fullname'>
                                            <label>Name:</label>
                                            <span>" . $query_employee['first_name'] . " " . $query_employee['last_name'] . "</span>
                                        </div>
        
                                        <div class='user_position'>
                                            <label>Position:</label>
                                            <span>" . $query_employee['position'] . "</span>
                                        </div>
        
                                        <div class='user_department'>
                                            <label>Department:</label>
                                            <span>" . $query_employee['department'] . "</span>
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

    } elseif(isset($_POST['searchValue']) && empty($_POST['userId_container'])){

        $searchValue = $_POST['searchValue'];

        $sql = "SELECT * FROM registered_users WHERE CONCAT(last_name) LIKE '%$searchValue%' AND access = 'employee'";
        $query_run = mysqli_query($con, $sql);

        if(mysqli_num_rows($query_run) > 0)
        {
            foreach($query_run as $query_employee)
            {
               
             echo "<div class='user_container' value='" . $query_employee['ID'] . "'>
                        <div class='user_photo'>
                            <img class='photoCircle m-0' src='img/upload/" . $query_employee['user_image'] . "' alt='' width='100'>
                            <button class='selectBtn'><a href='#'>Select Employee</a></button>
                        </div>
                        <div class='user_info'>
                            <div class='user_fullname'>
                                <label>Name:</label>
                                <span>" . $query_employee['first_name'] . " " . $query_employee['last_name'] . "</span>
                            </div>
            
                            <div class='user_position'>
                                <label>Position:</label>
                                <span>" . $query_employee['position'] . "</span>
                            </div>
            
                            <div class='user_department'>
                                <label>Department:</label>
                                <span>" . $query_employee['department'] . "</span>
                            </div>
                        </div>
                    </div>";
                    
            }
   
        } else {

            echo "No Search Found";
        }
      
    
    } elseif(empty($_POST['userId_container'])) {

        $sql = "SELECT * FROM registered_users WHERE access = 'employee'";
        $query_run = mysqli_query($con, $sql);
        $query_employee = $query_run->fetch_assoc();


            do {

                echo "<div class='user_container' value='" . $query_employee['ID'] . "'>
                            <div class='user_photo'>
                                <img class='photoCircle m-0' src='img/upload/" . $query_employee['user_image'] . "' alt='' width='100'>
                                <button class='selectBtn'><a href='#'>Select Employee</a></button>
                            </div>
                            <div class='user_info'>
                                <div class='user_fullname'>
                                    <label>Name:</label>
                                    <span>" . $query_employee['first_name'] . " " . $query_employee['last_name'] . "</span>
                                </div>
                                <div class='user_position'>
                                    <label>Position:</label>
                                    <span>" . $query_employee['position'] . "</span>
                                </div>
                    
                                <div class='user_department'>
                                    <label>Department:</label>
                                    <span>" . $query_employee['department'] . "</span>
                                </div>
                            </div>
                        </div>";


            } while($query_employee = $query_run->fetch_assoc());
            

    } elseif(!empty($_POST['userId_container']) && !isset($_POST['searchValue'])) {

        $sql = "SELECT * FROM registered_users WHERE access = 'employee'";
        $query_run = mysqli_query($con, $sql);

        $assignedEmployee = $_POST['userId_container'];
        $length = count($assignedEmployee);
        $loop = 0;
        $num = 0;

            if(mysqli_num_rows($query_run) > 0)
            {
                foreach($query_run as $query_employee)
                {
                    for ($i = -1; $i < $length; $i++)
                    {
                        if($loop < $length){
    
                            if($assignedEmployee[$loop] == $query_employee['ID']){
    
                                $num = 1;
                                    
                            } 
    
                            $loop++;
    
                        } else {
    
                            if($num == 0){
    
                                echo "<div class='user_container' value='" . $query_employee['ID'] . "'>
                                    <div class='user_photo'>
                                        <img class='photoCircle m-0' src='img/upload/" . $query_employee['user_image'] . "' alt='' width='100'>
                                        <button class='selectBtn'><a href='#'>Select Employee</a></button>
                                    </div>
                                        <div class='user_info'>
                                            <div class='user_fullname'>
                                                <label>Name:</label>
                                                <span>" . $query_employee['first_name'] . " " . $query_employee['last_name'] . "</span>
                                            </div>
            
                                            <div class='user_position'>
                                                <label>Position:</label>
                                                <span>" . $query_employee['position'] . "</span>
                                            </div>
            
                                            <div class='user_department'>
                                                <label>Department:</label>
                                                <span>" . $query_employee['department'] . "</span>
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

?>