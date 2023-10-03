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
    <div class='project-title mt-4'>
        <h1><?php echo $row['project_name']; ?></h1>
    </div>

    <div class="content-table project_report_table">

    
        <!-- Architecture table  -->
        <?php if($row['service_architecture'] == 1) { ?>

           
            <table>
                <tbody>
                    <tr>
                        <th>Architecture</th>
                        <th>Manager</th>
                        <th>PIC</th>
                        <th>Total Hours</th>
                    </tr>
                    <?php if($row['arch_conceptual'] == 1) { ?>
                    <tr>
                        <td>Conceptual</td>
                        <td>
                            <div class='employee-task-container'>
                            
                                <?php 
                                                    
                                    // Architecture Conceptual Phase Of Work (Manager)
                                    $archConceptual = new ViewProjectRecordsController('Architecture', 'Conceptual', 'arch_conceptual_manager');
                                    $archConceptual->view_tasks_report();

                                ?>

                            </div>
                        </td>
                        <td>
                            <div class='employee-task-container'>
                            
                                <?php 
                                                        
                                    // Architecture Conceptual Phase Of Work (PIC)
                                    $archConceptualpic = new ViewProjectRecordsController('Architecture', 'Conceptual', 'arch_conceptual_assigned_employee');
                                    $archConceptualpic->view_tasks_report();

                                 ?>

                            </div>
                        </td>
                        <td>
                            <div class='pow_total_hours'>
                                
                                <?php 
                                
                                    // Architecture Conceptual Phase Of Work Total Spend Hours
                                    $archConceptual_total_spend_hours = new ViewProjectRecordsController('Architecture', 'Conceptual');
                                    $archConceptual_total_spend_hours->phase_of_work_total_spend_hours();
                                  

                                ?>
                                
                            </div>
                        </td>
                    </tr>
                    <?php } ?>

                    <?php if($row['arch_schematic'] == 1) { ?>
                    <tr>
                        <td>Schematic</td>
                        <td>
                            <div class='employee-task-container'>

                                <?php 
                                    
                                // Architecture Schematic Phase Of Work (Manager)
                                $archSchematic = new ViewProjectRecordsController('Architecture', 'Schematic', 'arch_schematic_manager');
                                $archSchematic->view_tasks_report();
            
                                ?>  

                            <div>
                        </td>
                        <td>
                            <div class='employee-task-container'>

                                <?php 
                                    
                                // Architecture Schematic Phase Of Work (PIC)
                                $archSchematicpic = new ViewProjectRecordsController('Architecture', 'Schematic', 'arch_schematic_assigned_employee');
                                $archSchematicpic->view_tasks_report();

                                ?>  

                            <div>
                        </td>
                        <td>
                            <div class='pow_total_hours'>
                                
                                <?php 
                                
                                    // Architecture Schematic Phase Of Work Total Spend Hours
                                    $archSchematic_total_spend_hours = new ViewProjectRecordsController('Architecture', 'Schematic');
                                    $archSchematic_total_spend_hours->phase_of_work_total_spend_hours();
                                  
                                ?>
                                
                            </div>
                        </td>
                    </tr>
                    <?php } ?>

                    <?php if($row['arch_designdevelopment'] == 1) { ?>
                    <tr>
                        <td>Design Development</td>
                        <td>
                            <div class='employee-task-container'>

                                <?php 
                                    
                                    // Architecture Design Development Phase Of Work (Manager)
                                    $archDesigndevelopment = new ViewProjectRecordsController('Architecture', 'Design Development', 'arch_designdevelopment_manager'); 
                                    $archDesigndevelopment->view_tasks_report();

                                ?>  

                            <div>
                        </td>
                        <td>
                            <div class='employee-task-container'>

                                <?php 
                                    
                                    // Architecture Design Development Phase Of Work (Manager)
                                    $archDesigndevelopmentpic = new ViewProjectRecordsController('Architecture', 'Design Development', 'arch_designdevelopment_assigned_employee'); 
                                    $archDesigndevelopmentpic->view_tasks_report();

                                ?>  

                            <div>
                        </td>
                        <td>
                            <div class='pow_total_hours'>
                                
                                <?php 
                                
                                    // Architecture Schematic Phase Of Work Total Spend Hours
                                    $archDesigndevelopment_total_spend_hours = new ViewProjectRecordsController('Architecture', 'Design Development');
                                    $archDesigndevelopment_total_spend_hours->phase_of_work_total_spend_hours();
                                  
                                ?>
                                
                            </div>
                        </td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
        <?php } ?>
    </div>
</div>




<?php include 'footer.php'; ?>