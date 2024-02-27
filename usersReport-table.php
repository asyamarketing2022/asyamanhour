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

        $limitData = 10;

        $page_result = mysqli_query($con, $sql);
        $total_records = mysqli_num_rows($page_result);
        $total_pages = ceil($total_records/$limitData);

        $pages = '';

        for($i=1; $i<=$total_pages; $i++){  

            if ($i < 5 || $i == $total_pages ) {
                $pages .= "<span class='pagination_link' style='cursor:pointer; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
            }
            elseif($i > 4 || $i != $total_pages ){
                $pages .= "<span class='pagination_link hide' style='cursor:pointer; border:1px solid #ccc;' id='".$i."'>".$i."</span>"; 
    
            } else {
                $pages .="<span class='pagination_link' style='cursor:pointer; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
            }
    
        }  

        $pages;

    }

?>