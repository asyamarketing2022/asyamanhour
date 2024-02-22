<?php include_once('connections/DBconnection.php'); ?>
<?php include 'login.php'; ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

$sql = "SELECT * FROM pms_projects ORDER BY id ASC";
$projects_query = $con->query($sql) or die ($con->error);
$pms_project = $projects_query->fetch_assoc();

// Select the project if the user assigned
$userId = $_SESSION['UserId'];
$userAccess = $_SESSION['Access'];
$pms_project_table = '';

if(!empty($pms_project['id'])) {

    do {

    // Get all employees id assigned in every phase of work 
    $employees_id_assigned_pow = array(

        // Architecture
        explode(" ", $pms_project['arch_conceptual_manager']),
        explode(" ", $pms_project['arch_conceptual_assigned_employee']),
        explode(" ", $pms_project['arch_schematic_manager']),
        explode(" ", $pms_project['arch_schematic_assigned_employee']),
        explode(" ", $pms_project['arch_designdevelopment_manager']),
        explode(" ", $pms_project['arch_designdevelopment_assigned_employee']),
        explode(" ", $pms_project['arch_construction_manager']),
        explode(" ", $pms_project['arch_construction_assigned_employee']),
        explode(" ", $pms_project['arch_site_manager']),
        explode(" ", $pms_project['arch_site_assigned_employee']),

        // Engineering
        explode(" ", $pms_project['engi_schematic_manager']),
        explode(" ", $pms_project['engi_schematic_assigned_employee']),
        explode(" ", $pms_project['engi_designdevelopment_manager']),
        explode(" ", $pms_project['engi_designdevelopment_assigned_employee']),
        explode(" ", $pms_project['engi_construction_manager']),
        explode(" ", $pms_project['engi_construction_assigned_employee']),

        // Interior
        explode(" ", $pms_project['int_conceptual_manager']),
        explode(" ", $pms_project['int_conceptual_assigned_employee']),
        explode(" ", $pms_project['int_designdevelopment_manager']),
        explode(" ", $pms_project['int_designdevelopment_assigned_employee']),
        explode(" ", $pms_project['int_construction_manager']),
        explode(" ", $pms_project['int_construction_assigned_employee']),
        explode(" ", $pms_project['int_site_manager']),
        explode(" ", $pms_project['int_site_assigned_employee']),
        

        //Master Planning
        explode(" ", $pms_project['masterplanning_conceptual_manager']),
        explode(" ", $pms_project['masterplanning_conceptual_assigned_employee']),
        explode(" ", $pms_project['masterplanning_schematic_manager']),
        explode(" ", $pms_project['masterplanning_schematic_assigned_employee']),
    );

    // Count the container array for employees id
    $employees_id_count = (empty($employees_id_assigned_pow) ? "" : count($employees_id_assigned_pow));
    $output = '';

    // Marge all employees id from phase of work and convert to string
    for($num = 0; $num < $employees_id_count; $num++){
        
        $output .= implode(" ", $employees_id_assigned_pow[$num])." ";

    }

    // After marged all employees id convert again to array to get 1 by 1
    $employees_id_output_array = explode(" ", $output);
    array_pop($employees_id_output_array);    

    // Count the employees id
    $employees_id_output_array_count = (empty($employees_id_output_array) ? "" : count($employees_id_output_array));
  
    $userId = $_SESSION['UserId'];

        for($i = 0; $i < $employees_id_output_array_count; $i++) {

            if($employees_id_output_array[$i] == $userId) {

                $projectId = $pms_project['id'];
                $projectName = $pms_project['project_name'];
                $projectLocation = $pms_project['location'];
                $projectLot_areas = $pms_project['lot_areas'];
                $projectTypology = $pms_project['typology'];
                $projectCompany_name = $pms_project['company_name'];
                $projectClient_name = $pms_project['client_name'];

                $pms_project_table .= " <tr class='table-row_projects select_project table-form' value='$projectId' data-href='viewproject.php?ID=$projectId'>
                                            <td>$projectName</td>
                                            <td>$projectLocation</td>
                                            <td>$projectLot_areas</td>
                                            <td>$projectTypology</td>
                                            <td>$projectCompany_name</td>
                                            <td>$projectClient_name</td>
                                        </tr>";

                break;
                
            }

        }

    } while($pms_project = $projects_query->fetch_assoc());

} 

?>