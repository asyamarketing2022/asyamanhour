<?php 

include_once("connections/connection.php");
$con = connection();

//Fetch records from database
$queryUsersReport = $con->query("SELECT * FROM users_record ORDER BY id ASC");

if($queryUsersReport->num_rows > 0) {
    $delimiter = ",";
    $filename = "users-history_" . date('Y-m-d') . ".csv";

    //Create a file pointer
    $f = fopen('php://memory', 'w');

    //Set column headers
    $fields = array('ID', 'Name', 'User ID', 'Position', 'Department', 'Action', 'Action Status', 'Source', 'Added at');
    fputcsv($f, $fields, $delimiter);

    //Output each row of the data, format line as csv and write to file pointer
    while($row = $queryUsersReport->fetch_assoc()){
        $status = ($row['status'] == 1)?'Active':'Inactive';
        $lineData = array($row['id'], $row['user_name'], $row['user_id'], $row['user_position'], $row['department'], $row['action'], $row['action_status'], $row['source'], $row['added_at'], $status);
        fputcsv($f, $lineData, $delimiter);
    }

    //Move back to beginning of file
    fseek($f, 0);

    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');

    fpassthru($f);
}
exit;

?>