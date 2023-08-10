<?php 

if(!isset($_SESSION)){
    session_start();
}

include_once("connections/connection.php");
$con = connection();

if (!empty($_POST['DataLimit']) && !empty($_POST['searchVal'])) {

    $limitData = $_POST['DataLimit'];
    $searchVal = $_POST['searchVal'];

    $page_query = "SELECT * FROM users_record WHERE CONCAT(id, user_name) LIKE '%$searchVal%' ORDER BY id DESC";
    $page_result = mysqli_query($con, $page_query);
    $total_records = mysqli_num_rows($page_result);
    $total_pages = ceil($total_records/$limitData);

    // for($i=1; $i<=$total_pages; $i++)  
    // {  
    //     echo "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
    // }  


    for($i=1; $i<=$total_pages; $i++){  
        if($i == 4){
            echo "<span>...</span>";
        } else {
            echo "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
        }
    }  

} elseif(!empty($_POST['DataLimit']) && empty($_POST['searchVal'])) {

    $limitData = $_POST['DataLimit'];

    $page_query = "SELECT * FROM users_record ORDER BY id DESC";
    $page_result = mysqli_query($con, $page_query);
    $total_records = mysqli_num_rows($page_result);
    $total_pages = ceil($total_records/$limitData);

    // for($i=1; $i<=$total_pages; $i++)  
    // {  
    //     echo "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
    // }  

    for($i=1; $i<=$total_pages; $i++){  

        if ($i < 5 || $i == $total_pages ) {
            echo "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
        }
        elseif($i > 4 || $i != $total_pages ){
            echo "<span class='pagination_link hide' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>"; 

        } else {
            echo "<span class='pagination_link' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='".$i."'>".$i."</span>";  
        }

    }  

}


?>