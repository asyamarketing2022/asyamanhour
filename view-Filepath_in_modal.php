<?php include_once('connections/DBconnection.php'); ?>


<?php 

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['projectId'])){

    $projectId = $_POST['projectId'];
    $projectService = $_POST['projectService'];
    $phase_of_work = $_POST['text_phaseofwork'];
    $count = 1;

    $query_filepath = "SELECT * FROM upload_file_path WHERE project_id = '$projectId' AND service = '$projectService' AND phase_of_work = '$phase_of_work'";
    $file_path = $con->query($query_filepath) or die ($con->error);

    $output = "<div class='content-table' style='height: 50vh'>
                <table>
                    <tbody>
                        <tr>
                            <th></th>
                            <th>File Name</th>
                            <th>Date Upload</th>
                            <th>Uploaded By</th>
                            <th>Notes</th>
                            <th>File Path</th>
                        </tr>";
    
    while($file_path_info = mysqli_fetch_array($file_path)){

        $output .= "<tr>
                        <td>$count</td>
                        <td>" . $file_path_info['file_name'] . "</td>
                        <td>" . $file_path_info['added_at'] . "</td>
                        <td>" . $file_path_info['uploaded_by'] . "</td>
                        <td><button type='button' class='btn btn-secondary tooltip-btn' data-bs-toggle='tooltip' data-bs-placement='bottom' title='" . $file_path_info['notes'] . "' data-placement='bottom'>Notes</button>
                        
                        </td>
                        <td>
                        <input type='text' value='" . $file_path_info['file_path'] . "'>
                        
                        </td>
                    </tr>";

        $count++;
    }

    echo $output;

}

?>