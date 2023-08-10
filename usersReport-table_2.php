<?php 

if(!isset($_SESSION)){
    session_start();
}

include_once("usersReport-table.php");
include_once("connections/connection.php");
$con = connection();


if(isset($_POST['page']) && !empty($_POST['pageLimit']) && !empty($_POST['searchVal'])) {

$page = $_POST['page'];  
$pageLimit = $_POST['pageLimit'];
$searchVal = $_POST['searchVal'];

$start_from = ($page - 1)*$pageLimit;  
$query = "SELECT * FROM users_record WHERE CONCAT(id, user_name) LIKE '%$searchVal%' ORDER BY id DESC LIMIT $start_from, $pageLimit";
$query_run = mysqli_query($con, $query);

if(mysqli_num_rows($query_run) > 0)
    {
        while($items = mysqli_fetch_array($query_run))  
        {  
            echo "  
            <tr class='table-row_user Info_user table-form' value=" . $items['id'] . ">
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


} elseif(isset($_POST['page']) && !empty($_POST['pageLimit'])) {

$page = $_POST['page'];  
$pageLimit = $_POST['pageLimit'];

$start_from = ($page - 1)*$pageLimit;  
$query = "SELECT * FROM users_record ORDER BY id DESC LIMIT $start_from, $pageLimit";
$query_run = mysqli_query($con, $query);

if(mysqli_num_rows($query_run) > 0)
    {
        while($items = mysqli_fetch_array($query_run))  
        {  
            echo "  
            <tr class='table-row_user Info_user table-form' value=" . $items['id'] . ">
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

    echo 'error';
}

?>