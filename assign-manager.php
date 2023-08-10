<?php include_once('connections/DBconnection.php'); ?>
<?php include_once('AssignedManagerController.php'); ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['projectId'])) {

    $managerId = $_POST['managerId'];
    $projectId = $_POST['projectId'];
    $searchManager_pow = $_POST['searchManager_pow'];
    $searchManager_service = $_POST['searchManager_service'];

    if($searchManager_service == 'Architecture') {

        if($searchManager_pow == 'Conceptual') {

            $ArchConceptual = new AssignedManagerController($managerId, $projectId, 'arch_conceptual_manager');
            $ArchConceptual->assignManager();
            
        } elseif($searchManager_pow == 'Schematic') {

            $ArchSchematic = new AssignedManagerController($managerId, $projectId, 'arch_schematic_manager');
            $ArchSchematic->assignManager();

        } elseif($searchManager_pow == 'Design Development') {

            $ArchDesignDevelopment = new AssignedManagerController($managerId, $projectId, 'arch_designdevelopment_manager');
            $ArchDesignDevelopment->assignManager();

        } elseif($searchManager_pow == 'Construction Drawing') {

            $ArchConstruction = new AssignedManagerController($managerId, $projectId, 'arch_construction_manager');
            $ArchConstruction->assignManager();

        } elseif($searchManager_pow == 'Site Supervision') {

            $ArchSite = new AssignedManagerController($managerId, $projectId, 'arch_site_manager');
            $ArchSite->assignManager();

        }

    }elseif($searchManager_service == 'Engineering') {

         if($searchManager_pow == 'Schematic') {

            $EngrSchematic = new AssignedManagerController($managerId, $projectId, 'engi_schematic_manager');
            $EngrSchematic->assignManager();

        } elseif($searchManager_pow == 'Design Development'){

            $EngrDesignDevelopment = new AssignedManagerController($managerId, $projectId, 'engi_designdevelopment_manager');
            $EngrDesignDevelopment->assignManager();

        } elseif($searchManager_pow == 'Construction Drawing'){

            $EngrConstruction = new AssignedManagerController($managerId, $projectId, 'engi_construction_manager');
            $EngrConstruction->assignManager();

        }

    }elseif($searchManager_service == 'Interior') {

        if($searchManager_pow == 'Conceptual') {

            $IntConceptual = new AssignedManagerController($managerId, $projectId, 'int_conceptual_manager');
            $IntConceptual->assignManager();

        } elseif($searchManager_pow == 'Design Development') {

            $IntDesignDevelopment = new AssignedManagerController($managerId, $projectId, 'int_designdevelopment_manager');
            $IntDesignDevelopment->assignManager();

        } elseif($searchManager_pow == 'Construction Drawing') {

            $IntConstruction = new AssignedManagerController($managerId, $projectId, 'int_construction_manager');
            $IntConstruction->assignManager();

        } elseif($searchManager_pow == 'Site Supervision'){

            $IntSite = new AssignedManagerController($managerId, $projectId, 'int_site_manager');
            $IntSite->assignManager();

        }

    }elseif($searchManager_service == 'Master Planning') {

        if($searchManager_pow == 'Conceptual') {

            $masterplanningConceptual = new AssignedManagerController($managerId, $projectId, 'masterplanning_conceptual_manager');
            $masterplanningConceptual->assignManager();

        } elseif($searchManager_pow == 'Schematic') {

            $masterplanningDesignDevelopment = new AssignedManagerController($managerId, $projectId, 'masterplanning_schematic_manager');
            $masterplanningDesignDevelopment->assignManager();

        } 
    }

}

?>