<?php $page = 'project-records'; include 'header.php'; ?>
<?php include_once("sidebar.php"); ?>

<?php include_once("ViewProjectRecordsController.php"); ?>

<?php 

$projectID = $_GET['ID'];

$query_projects = "SELECT * FROM pms_projects WHERE id = '$projectID'";
$project = $con->query($query_projects) or die ($con->error);
$row = $project->fetch_assoc();

?>


<div class="grid-right__content">
    <div class='project-title mt-4 row'>
        <div class="col-6">
            <h1 class='float-start'><?php echo $row['project_name']; ?></h1>
        </div>
        <div class="col-6">
            <div class="btn-container float-end">
                <button class='btn btn-primary download-project-record'>Download Records</button>
            </div>
        </div>
        
    </div>

    <div class="content-table project_report_table">

        <!-- Architecture table  -->
        <?php if($row['service_architecture'] == 1) { ?>

            <?php if($row['arch_conceptual'] == 1) { ?>

                <?php 
                                        
                    // Architecture Conceptual Phase Of Work (Manager)
                    $archConceptual = new ViewProjectRecordsController('Architecture', 'Conceptual', 'arch_conceptual_manager', 'arch_conceptual_assigned_employee');
                    $archConceptual->service_report();
    
                ?>

                <?php 
                                        
                    // Architecture Schematic Phase Of Work (Manager)
                    $archSchamatic = new ViewProjectRecordsController('Architecture', 'Schematic', 'arch_schematic_manager', 'arch_schematic_assigned_employee');
                    $archSchamatic->service_report();
    
                ?>

                <?php 
                                        
                    // Architecture Design Development Phase Of Work (Manager)
                    $archDesign = new ViewProjectRecordsController('Architecture', 'Design Development', 'arch_designdevelopment_manager', 'arch_designdevelopment_assigned_employee');
                    $archDesign->service_report();
    
                ?>

            <?php } ?>

        <?php } ?>

    </div>
</div>




<?php include 'footer.php'; ?>