<?php 

include_once("connections/connection.php");
$con = connection();

if (isset($_POST['DataLimit'], $_GET['search'])) {
  
    $limitData = $_POST['DataLimit'];
    $filtervalues = $_GET['search'];

    $query = "SELECT * FROM users_record WHERE CONCAT(id, user_name) LIKE '%$filtervalues%' LIMIT $limitData";
    $query_run = mysqli_query($con, $query);
   
    if(mysqli_num_rows($query_run) > 0)
        {
            foreach($query_run as $items)
            {

            echo "<tr class='table-row_user Info_user table-form' value=" . $items['id'] . ">
                <td class='user-id'>" . $items['id'] . "</td>
                <td>" . $items['user_name'] . "</td>
                <td>" . $items['user_id'] . "</td>
                <td>" . $items['user_position'] . "</td>
                <td>" . $items['department'] . "</td>
                <td>" . $items['action'] . "</td>
                <td>" . $items['action_status'] . "</td>
                <td>" . $items['source'] . "</td>
                <td>" . $items['added_at'] . "</td>
            </tr>";

            }
        }

} elseif(isset($_POST['DataLimit'])) {

            $limitData = $_POST['DataLimit'];
        
            $sql = "SELECT * FROM users_record ORDER BY id ASC LIMIT $limitData";
            $userRecord = $con->query($sql) or die ($con->error);
            $userRecord_info = $userRecord->fetch_assoc();
        
            do { 
                
                echo "<tr class='table-row_user Info_user table-form' value=" . $userRecord_info['id'] .">
                    <td class='user-id'>" . $userRecord_info['id'] ."</td>
                    <td> ". $userRecord_info['user_name'] ."</td>
                    <td> ". $userRecord_info['user_id'] ." </td>
                    <td> ". $userRecord_info['user_position'] ." </td>
                    <td> ". $userRecord_info['department'] ."</td>
                    <td> ". $userRecord_info['action'] ."</td>
                    <td> ". $userRecord_info['action_status'] ."</td>
                    <td> ". $userRecord_info['source'] ."</td>
                    <td> ". $userRecord_info['added_at'] ."</td>
                </tr>";
        
            } while($userRecord_info = $userRecord->fetch_assoc());
        
} elseif(isset($_GET['search'])) {

    $filtervalues = $_GET['search'];

    $query = "SELECT * FROM users_record WHERE CONCAT(id, user_name) LIKE '%$filtervalues%'";
    $query_run = mysqli_query($con, $query);
   
    if(mysqli_num_rows($query_run) > 0)
        {
            foreach($query_run as $items)
            {

            echo "<tr class='table-row_user Info_user table-form' value=" . $items['id'] . ">
                <td class='user-id'>" . $items['id'] . "</td>
                <td>" . $items['user_name'] . "</td>
                <td>" . $items['user_id'] . "</td>
                <td>" . $items['user_position'] . "</td>
                <td>" . $items['department'] . "</td>
                <td>" . $items['action'] . "</td>
                <td>" . $items['action_status'] . "</td>
                <td>" . $items['source'] . "</td>
                <td>" . $items['added_at'] . "</td>
            </tr>";

            }
        }

} else {

    $sql = "SELECT * FROM users_record ORDER BY id ASC";
    $userRecord = $con->query($sql) or die ($con->error);
    $userRecord_info = $userRecord->fetch_assoc();

    
   do { 
                    
        echo "<tr class='table-row_user Info_user table-form' value=" . $userRecord_info['id'] .">
        
            <td class='user-id'>". $userRecord_info['id'] ."</td>
            <td>". $userRecord_info['user_name'] ."</td>
            <td>". $userRecord_info['user_id'] . "></td>
            <td>". $userRecord_info['user_position'] ."</td>
            <td>". $userRecord_info['department'] ."</td>
            <td>". $userRecord_info['action'] ."</td>
            <td>". $userRecord_info['action_status'] ."</td>
            <td>". $userRecord_info['source'] ."</td>
            <td>". $userRecord_info['added_at'] ."</td>
        </tr> ";
        
    } while($userRecord_info = $userRecord->fetch_assoc());

}

?>