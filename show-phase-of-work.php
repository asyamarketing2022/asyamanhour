<?php 

include_once("connections/connection.php");
$con = connection();


if(isset($_POST['phaseOfwork'])) {

    $projectId = $_POST['projectId'];

    if($_POST['phaseOfwork'] == 'archi_pow'){

        $query_projects = "SELECT * FROM pms_projects WHERE id = '$projectId'";
        $project = $con->query($query_projects) or die ($con->error);
        $row = $project->fetch_assoc();

        $output = '';

        if($row['arch_conceptual'] == 0) {

            $output .= "<span class='arch_conceptual'>Conceptual</span>";

        }

        if($row['arch_schematic'] == 0) {

            $output .= "<span class='arch_schematic'>Schematic</span>";

        }

        if($row['arch_designdevelopment'] == 0) {

            $output .= "<span class='arch_designdevelopment'>Design Development</span>";

        }

        if($row['arch_construction'] == 0) {
            
            $output .= "<span class='arch_construction'>Construction Drawing</span>";

        }
        
        if($row['arch_site'] == 0) {

            $output .= "<span class='arch_site'>Site Supervision</span>";
            
        }

        echo $output;
        
    } else if($_POST['phaseOfwork'] == 'engi_pow') {

        $query_projects = "SELECT * FROM pms_projects WHERE id = '$projectId'";
        $project = $con->query($query_projects) or die ($con->error);
        $row = $project->fetch_assoc();

        $output = '';

        if($row['engi_schematic'] == 0) {

            $output .= "<span class='engi_schematic'>Schematic</span>";

        }

        if($row['engi_designdevelopment'] == 0) {

            $output .= "<span class='engi_designdevelopment'>Design Development</span>";

        }

        if($row['engi_construction'] == 0) {

            $output .= "<span class='engi_construction'>Construction Drawing</span>";

        }

        echo $output;

    } else if($_POST['phaseOfwork'] == 'int_pow') {

        $query_projects = "SELECT * FROM pms_projects WHERE id = '$projectId'";
        $project = $con->query($query_projects) or die ($con->error);
        $row = $project->fetch_assoc();

        $output = '';

        if($row['int_conceptual'] == 0) {

            $output .= "<span class='int_conceptual'>Conceptual</span>";

        }

        if($row['int_designdevelopment'] == 0) {

            $output .= "<span class='int_designdevelopment'>Design Development</span>";

        }

        if($row['int_construction'] == 0) {

            $output .= "<span class='int_construction'>Construction Drawing</span>";

        }

        if($row['int_site'] == 0) {

            $output .= "<span class='int_site'>Site Supervision</span>";

        }

        echo $output;

    }

}

?>