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

        // Number 8 is admin id

        // Architecture
        explode(" ", (empty($pms_project['arch_conceptual_manager']) ? 8 : $pms_project['arch_conceptual_manager'])),
        explode(" ", (empty($pms_project['arch_conceptual_assigned_employee']) ? 8 : $pms_project['arch_conceptual_assigned_employee'])),
        explode(" ", (empty($pms_project['arch_schematic_manager']) ? 8 : $pms_project['arch_schematic_manager'])),
        explode(" ", (empty($pms_project['arch_schematic_assigned_employee']) ? 8 : $pms_project['arch_schematic_assigned_employee'])),
        explode(" ", (empty($pms_project['arch_designdevelopment_manager']) ? 8 : $pms_project['arch_designdevelopment_manager'])),
        explode(" ", (empty($pms_project['arch_designdevelopment_assigned_employee']) ? 8 : $pms_project['arch_designdevelopment_assigned_employee'])),
        explode(" ", (empty($pms_project['arch_construction_manager']) ? 8 : $pms_project['arch_construction_manager'])),
        explode(" ", (empty($pms_project['arch_construction_assigned_employee']) ? 8 : $pms_project['arch_construction_assigned_employee'])),
        explode(" ", (empty($pms_project['arch_site_manager']) ? 8 : $pms_project['arch_site_manager'])),
        explode(" ", (empty($pms_project['arch_site_assigned_employee']) ? 8 : $pms_project['arch_site_manager'])),

        // Engineering
        explode(" ", (empty($pms_project['engi_schematic_manager']) ? 8 : $pms_project['engi_schematic_manager'])),
        explode(" ", (empty($pms_project['engi_schematic_assigned_employee']) ? 8 : $pms_project['engi_schematic_assigned_employee'])),
        explode(" ", (empty($pms_project['engi_designdevelopment_manager']) ? 8 : $pms_project['engi_designdevelopment_manager'] )),
        explode(" ", (empty($pms_project['engi_designdevelopment_assigned_employee']) ? 8 : $pms_project['engi_designdevelopment_assigned_employee'])),
        explode(" ", (empty($pms_project['engi_construction_manager']) ? 8 : $pms_project['engi_construction_manager'])),
        explode(" ", (empty($pms_project['engi_construction_assigned_employee']) ? 8 : $pms_project['engi_construction_assigned_employee'])),

        // Interior
        explode(" ", (empty($pms_project['int_conceptual_manager']) ? 8 : $pms_project['int_conceptual_manager'])),
        explode(" ", (empty($pms_project['int_conceptual_assigned_employee']) ? 8 : $pms_project['int_conceptual_assigned_employee'])),
        explode(" ", (empty($pms_project['int_designdevelopment_manager']) ? 8 : $pms_project['int_designdevelopment_manager'])),
        explode(" ", (empty($pms_project['int_designdevelopment_assigned_employee']) ? 8 : $pms_project['int_designdevelopment_assigned_employee'])),
        explode(" ", (empty($pms_project['int_construction_manager']) ? 8 : $pms_project['int_construction_manager'])),
        explode(" ", (empty($pms_project['int_construction_assigned_employee']) ? 8 : $pms_project['int_construction_assigned_employee'])),
        explode(" ", (empty($pms_project['int_site_manager']) ? 8 : $pms_project['int_site_manager'])),
        explode(" ", (empty($pms_project['int_site_assigned_employee']) ? 8 : $pms_project['int_site_assigned_employee'])),

        //Master Planning
        explode(" ", (empty($pms_project['masterplanning_conceptual_manager']) ? 8 : $pms_project['masterplanning_conceptual_manager'])),
        explode(" ", (empty($pms_project['masterplanning_conceptual_assigned_employee']) ? 8 : $pms_project['masterplanning_conceptual_assigned_employee'])),
        explode(" ", (empty($pms_project['masterplanning_schematic_manager']) ? 8 : $pms_project['masterplanning_schematic_manager'])),
        explode(" ", (empty($pms_project['masterplanning_schematic_assigned_employee']) ? 8 : $pms_project['masterplanning_schematic_assigned_employee'])),
    );

    // Count the container array for employees id
    $employees_id_count = (empty($employees_id_assigned_pow) ? 0 : count($employees_id_assigned_pow));
    $output = '';

    // Marge all employees id from phase of work and convert to string
    for($num = 0; $num < $employees_id_count; $num++){
        
        $output .= implode(" ", $employees_id_assigned_pow[$num])." ";

    }

    // After marged all employees id convert again to array to get 1 by 1
    $employees_id_output_array = explode(" ", $output);
    $array_filter =  array_filter($employees_id_output_array);    

    // Count the employees id
    // $employees_id_output_array_count = (empty($array_filter) ? "" : count($array_filter));
    $employees_id_output_array_count = (empty($array_filter) ? 0 : count($array_filter));
  
    $userId = $_SESSION['UserId'];
   

    // echo "$employees_id_output_array_count &nbsp;";

        for($i = 0; $i < $employees_id_output_array_count; $i++) {

            if($employees_id_output_array[$i] == $userId) {

                $projectId = $pms_project['id'];
                $projectName = $pms_project['project_name'];
                $projectLocation = $pms_project['location'];
                $projectLot_areas = $pms_project['lot_areas'];
                $projectTypology = $pms_project['typology'];
                $projectCompany_name = $pms_project['company_name'];
                $projectClient_name = $pms_project['client_name'];
                $projectActive_status = $pms_project['project_status'];

                    $pms_project_table .= " <tr class='table-row_projects select_project table-form $projectActive_status' value='$projectId' data-href='viewproject.php?ID=$projectId'>
                                                <td>$projectName</td>
                                                <td>$projectLocation</td>
                                                <td>$projectLot_areas</td>
                                                <td>$projectTypology</td>
                                                <td>$projectCompany_name</td>
                                                <td>$projectClient_name</td>
                                                <td>$projectActive_status</td>
                                            </tr>";
                
                break;

            }

        }

    } while($pms_project = $projects_query->fetch_assoc());

} 

?>