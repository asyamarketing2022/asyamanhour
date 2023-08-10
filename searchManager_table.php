<?php include_once('connections/DBconnection.php'); ?>
<?php include_once('SearchManagerController.php'); ?>

<?php 

$db = new DBconnection();
$con = $db->connection();


    if(isset($_POST['searchValue']) && !empty($_POST['userId_container']) || isset($_POST['searchValue']) && empty($_POST['userId_container'])){

        $phase_of_work = $_POST['phase_of_work'];
        $service = $_POST['service'];

        $searchValue = $_POST['searchValue'];
        $userId_container = (!empty($_POST['userId_container']) ? $_POST['userId_container'] : "");

        if($service == 'Architecture') {

            if($phase_of_work == 'Conceptual'){

                $ArchConceptual = new SearchManagerController('design', $searchValue, $userId_container);
                $ArchConceptual->searchManager();

            } elseif($phase_of_work == 'Schematic') {

                $ArchSchematic = new SearchManagerController('design', $searchValue, $userId_container);
                $ArchSchematic->searchManager();
 
    
            } elseif($phase_of_work == 'Design Development') {

                $ArchDesignDevelopment = new SearchManagerController('production', $searchValue, $userId_container);
                $ArchDesignDevelopment->searchManager();
 
            } elseif($phase_of_work == 'Construction Drawing') {

                $ArchConstruction = new SearchManagerController('project management', $searchValue, $userId_container);
                $ArchConstruction->searchManager();
 
            } elseif($phase_of_work == 'Site Supervision') {

                $ArchSite = new SearchManagerController('project management', $searchValue, $userId_container);
                $ArchSite->searchManager();

            }

        } elseif($service == 'Engineering') {

            if($phase_of_work == 'Schematic'){
    
                $EngiSchematic = new SearchManagerController('mechanical electrical fire-protection plumbing structural', $searchValue, $userId_container);
                $EngiSchematic->searchEngrManager();

            } elseif($phase_of_work == 'Design Development') {

                $EngiSchematic = new SearchManagerController('mechanical electrical fire-protection plumbing structural', $searchValue, $userId_container);
                $EngiSchematic->searchEngrManager();

            } elseif($phase_of_work == 'Construction Drawing') {

                $EngiSchematic = new SearchManagerController('mechanical electrical fire-protection plumbing structural', $searchValue, $userId_container);
                $EngiSchematic->searchEngrManager();

            }

        } elseif($service == 'Interior') {

            if($phase_of_work == 'Conceptual'){

                $IntConceptual = new SearchManagerController('interior design', $searchValue, $userId_container);
                $IntConceptual->searchManager();

            } elseif($phase_of_work == 'Design Development') {

                $IntDesignDevelopment = new SearchManagerController('interior design', $searchValue, $userId_container);
                $IntDesignDevelopment->searchManager();

            } elseif($phase_of_work == 'Construction Drawing') {

                $IntConstruction = new SearchManagerController('interior design', $searchValue, $userId_container);
                $IntConstruction->searchManager();

            } elseif($phase_of_work == 'Site Supervision') {

                $IntSite = new SearchManagerController('interior design', $searchValue, $userId_container);
                $IntSite->searchManager();
            
            }

        } elseif($service == 'Master Planning') {

            if($phase_of_work == 'Conceptual'){

                $MasterPlanningConceptual = new SearchManagerController('master planning', $searchValue, $userId_container);
                $MasterPlanningConceptual->searchManager();

            } elseif($phase_of_work == 'Schematic') {

                $MasterPlanningSchematic = new SearchManagerController('master planning', $searchValue, $userId_container);
                $MasterPlanningSchematic->searchManager();

            }

        }

    } elseif(!empty($_POST['userId_container']) || empty($_POST['userId_container'])){

        $phase_of_work = $_POST['phase_of_work'];
        $service = $_POST['service'];

        $searchValue = !empty($_POST['searchValue']) ? $_POST['searchValue'] : "";
        $userId_container = (!empty($_POST['userId_container']) ? $_POST['userId_container'] : "");

        if($service == 'Architecture') {

            if($phase_of_work == 'Conceptual'){
                

                $ArchConceptual = new SearchManagerController('design', $searchValue, $userId_container);
                $ArchConceptual->searchManager();

            } elseif($phase_of_work == 'Schematic') {

                $ArchSchematic = new SearchManagerController('design', $searchValue, $userId_container);
                $ArchSchematic->searchManager();
 
    
            } elseif($phase_of_work == 'Design Development') {

                $ArchDesignDevelopment = new SearchManagerController('production', $searchValue, $userId_container);
                $ArchDesignDevelopment->searchManager();
 
            } elseif($phase_of_work == 'Construction Drawing') {

                $ArchConstruction = new SearchManagerController('project management', $searchValue, $userId_container);
                $ArchConstruction->searchManager();
 
            } elseif($phase_of_work == 'Site Supervision') {

                $ArchSite = new SearchManagerController('project management', $searchValue, $userId_container);
                $ArchSite->searchManager();

            } 

        } elseif($service == 'Engineering') {

            if($phase_of_work == 'Schematic'){
    
                $EngiSchematic = new SearchManagerController('mechanical electrical fire-protection plumbing structural', $searchValue, $userId_container);
                $EngiSchematic->searchEngrManager();

            } elseif($phase_of_work == 'Design Development') {

                $EngiSchematic = new SearchManagerController('mechanical electrical fire-protection plumbing structural', $searchValue, $userId_container);
                $EngiSchematic->searchEngrManager();

            } elseif($phase_of_work == 'Construction Drawing') {

                $EngiSchematic = new SearchManagerController('mechanical electrical fire-protection plumbing structural', $searchValue, $userId_container);
                $EngiSchematic->searchEngrManager();

            }


        } elseif($service == 'Interior') {

            if($phase_of_work == 'Conceptual'){

                $IntConceptual = new SearchManagerController('interior design', $searchValue, $userId_container);
                $IntConceptual->searchManager();

            } elseif($phase_of_work == 'Design Development') {

                $IntDesignDevelopment = new SearchManagerController('interior design', $searchValue, $userId_container);
                $IntDesignDevelopment->searchManager();

            } elseif($phase_of_work == 'Construction Drawing') {

                $IntConstruction = new SearchManagerController('interior design', $searchValue, $userId_container);
                $IntConstruction->searchManager();

            } elseif($phase_of_work == 'Site Supervision') {

                $IntSite = new SearchManagerController('interior design', $searchValue, $userId_container);
                $IntSite->searchManager();
            
            }

        } elseif($service == 'Master Planning') {

            if($phase_of_work == 'Conceptual'){

                $MasterPlanningConceptual = new SearchManagerController('master planning', $searchValue, $userId_container);
                $MasterPlanningConceptual->searchManager();

            } elseif($phase_of_work == 'Schematic') {

                $MasterPlanningSchematic = new SearchManagerController('master planning', $searchValue, $userId_container);
                $MasterPlanningSchematic->searchManager();

            }

        }

    }
        
        

?>