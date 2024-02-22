<?php include_once 'connections/DBconnection.php'; ?>
<?php include_once 'viewPowStatusController.php'; ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['projectId'])){

        $projectId = $_POST['projectId'];
        $services = $_POST['services'];
        $phase_of_work = $_POST['phase_of_work'];

        if($services == 'Architecture') {

            if($phase_of_work == 'Conceptual') {

                $archConceptual = new ViewPowStatatusController($projectId, $services, $phase_of_work, 'arch_conceptual_status');
                $archConceptual->change_phase_of_work_status();

            } else if($phase_of_work == 'Schematic') {

                $archSchematic = new ViewPowStatatusController($projectId, $services, $phase_of_work, 'arch_schematic_status');
                $archSchematic->change_phase_of_work_status();

            } else if($phase_of_work == 'Design Development') {

                $archDesignDevelopment = new ViewPowStatatusController($projectId, $services, $phase_of_work, 'arch_designdevelopment_status');
                $archDesignDevelopment->change_phase_of_work_status();

            } else if($phase_of_work == 'Construction Drawing') {

                $archConstructionDrawing = new ViewPowStatatusController($projectId, $services, $phase_of_work, 'arch_construction_status');
                $archConstructionDrawing->change_phase_of_work_status();

            } else if($phase_of_work == 'Site Supervision') {

                $archSite = new ViewPowStatatusController($projectId, $services, $phase_of_work, 'arch_site_status');
                $archSite->change_phase_of_work_status();

            }

        } else if($services == 'Engineering') {

            if($phase_of_work == 'Schematic') {

                $engiSchematic = new ViewPowStatatusController($projectId, $services, $phase_of_work, 'engi_designdevelopment_status');
                $engiSchematic->change_phase_of_work_status();

            } else if($phase_of_work == 'Design Development') {

                $engiDesignDevelopment = new ViewPowStatatusController($projectId, $services, $phase_of_work, 'engi_designdevelopment_status');
                $engiDesignDevelopment->change_phase_of_work_status();

            } else if($phase_of_work == 'Construction Drawing') {

                $engiConstructionDrawing = new ViewPowStatatusController($projectId, $services, $phase_of_work, 'engi_construction_status');
                $engiConstructionDrawing->change_phase_of_work_status();

            }

        } else if($services == 'Interior') {

            if($phase_of_work == 'Conceptual') {

                $intConceptual = new ViewPowStatatusController($projectId, $services, $phase_of_work, 'int_conceptual_status');
                $intConceptual->change_phase_of_work_status();

            } else if($phase_of_work == 'Design Development') {

                $intDesignDevelopment = new ViewPowStatatusController($projectId, $services, $phase_of_work, 'int_designdevelopment_status');
                $intDesignDevelopment->change_phase_of_work_status();

            } else if($phase_of_work == 'Construction Drawing') {

                $intConstructionDrawing = new ViewPowStatatusController($projectId, $services, $phase_of_work, 'int_construction_status');
                $intConstructionDrawing->change_phase_of_work_status();

            } else if($phase_of_work == 'Site Supervision') {
            
                $intSiteDrawing = new ViewPowStatatusController($projectId, $services, $phase_of_work, 'int_site_status');
                $intSiteDrawing->change_phase_of_work_status();

            }

        }

    }

?>