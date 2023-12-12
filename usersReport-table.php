<?php 

include_once("connections/connection.php");
$con = connection();

if (!empty($_POST['DataLimit']) && !empty($_POST['searchFilter']) or !empty($_POST['DataLimit']) && empty($_POST['searchFilter'])) {
    
    $limitData = $_POST['DataLimit'];
    $filtervalues = $_POST['searchFilter'];

    $query = "SELECT * FROM users_record WHERE CONCAT(id, user_name) LIKE '%$filtervalues%' ORDER BY id DESC LIMIT $limitData";
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
     
        $sql = "SELECT * FROM users_record ORDER BY id DESC";
        $userRecord = $con->query($sql) or die ($con->error);
        $userRecord_info = $userRecord->fetch_assoc();

    }

?>