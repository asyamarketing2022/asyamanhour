<?php include_once('connections/DBconnection.php'); ?>
<?php include_once('login.php') ?>

<?php 

    $projectID = $_GET['ID'];

    $db = new DBconnection();
    $con = $db->connection();

    $query_projects = "SELECT * FROM pms_projects WHERE id = '$projectID'";
    $projects = $con->query($query_projects) or die ($con->error);
    $pms_project = $projects->fetch_assoc();

    if(isset($pms_project['id'])) {

            // Get all employees id assigned in every phase of work 
            $employees_id_assigned_pow = array(
        
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
            $array_filter = array_filter($employees_id_output_array);    
        
            // Count the employees id
            $employees_id_output_array_count = (empty($array_filter) ? 0 : count($array_filter));
          
            $userId = $_SESSION['UserId'];
    
                for($i = 0; $i <= $employees_id_output_array_count; $i++) {
        
                    if($employees_id_output_array[$i] == $userId || $_SESSION['Access'] == 'admin' || $_SESSION['Access'] == "contract & billing") {
        
                        break;
    
                    } else if($employees_id_output_array_count == $i) {
    
                        // Project page redirect to project restriction when the user not assign on specific project
                        header("Location: /page-restriction.php");
                      
    
                    }
    
                }
    
    } else {

        header("Location: /404.php");

    }

?>