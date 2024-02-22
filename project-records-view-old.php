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

                            </div>
                        </td>
                        <td>
                            <div class='employee-task-container'>

                                <?php 
                                    
                                // Architecture Schematic Phase Of Work (PIC)
                                $archSchematicpic = new ViewProjectRecordsController('Architecture', 'Schematic', 'arch_schematic_assigned_employee');
                                $archSchematicpic->view_tasks_report();

                                ?>  

                            </div>
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

                            </div>
                        </td>
                        <td>
                            <div class='employee-task-container'>

                                <?php 
                                    
                                    // Architecture Design Development Phase Of Work (Manager)
                                    $archDesigndevelopmentpic = new ViewProjectRecordsController('Architecture', 'Design Development', 'arch_designdevelopment_assigned_employee'); 
                                    $archDesigndevelopmentpic->view_tasks_report();

                                ?>  

                            </div>
                        </td>
                        <td>
                            <div class='pow_total_hours'>
                                
                                <?php 
                                
                                    // Architecture Design Development Phase Of Work Total Spend Hours
                                    $archDesigndevelopment_total_spend_hours = new ViewProjectRecordsController('Architecture', 'Design Development');
                                    $archDesigndevelopment_total_spend_hours->phase_of_work_total_spend_hours();
                                  
                                ?>
                                
                            </div>
                        </td>
                    </tr>
                    <?php } ?>

                    <?php if($row['arch_construction'] == 1) { ?>
                    <tr>
                        <td>Construction Drawing</td>
                        <td>
                            <div class='employee-task-container'>

                                <?php 
                                    
                                    // Architecture Construction Phase Of Work (Manager)
                                    $archConstruction = new ViewProjectRecordsController('Architecture', 'Construction Drawing', 'arch_construction_manager'); 
                                    $archConstruction->view_tasks_report();

                                ?>  

                            </div>
                        </td>
                        <td>
                            <div class='employee-task-container'>

                                <?php 
                                    
                                    // Architecture Constructiont Phase Of Work (Manager)
                                    $archConstructionpic = new ViewProjectRecordsController('Architecture', 'Construction Drawing', 'arch_construction_assigned_employee'); 
                                    $archConstructionpic->view_tasks_report();

                                ?>  

                            </div>
                        </td>
                        <td>
                            <div class='pow_total_hours'>
                                
                                <?php 
                                
                                    // Architecture Construction Phase Of Work Total Spend Hours
                                    $archConstruction_total_spend_hours = new ViewProjectRecordsController('Architecture', 'Construction Drawing');
                                    $archConstruction_total_spend_hours->phase_of_work_total_spend_hours();
                                  
                                ?>
                                
                            </div>
                        </td>
                    </tr>
                    <?php } ?>

                    <?php if($row['arch_site'] == 1) { ?>
                    <tr>
                        <td>Site Supervision</td>
                        <td>
                            <div class='employee-task-container'>

                                <?php 
                                    
                                    // Architecture Site Phase Of Work (Manager)
                                    $archSite = new ViewProjectRecordsController('Architecture', 'Site Supervision', 'arch_site_manager'); 
                                    $archSite->view_tasks_report();

                                ?>  

                            </div>
                        </td>
                        <td>
                            <div class='employee-task-container'>

                                <?php 
                                    
                                    // Architecture Site Phase Of Work (Manager)
                                    $archSitepic = new ViewProjectRecordsController('Architecture', 'Site Supervision', 'arch_site_assigned_employee'); 
                                    $archSitepic->view_tasks_report();

                                ?>  

                            </div>
                        </td>
                        <td>
                            <div class='pow_total_hours'>
                                
                                <?php 
                                
                                    // Architecture Site Phase Of Work Total Spend Hours
                                    $archSite_total_spend_hours = new ViewProjectRecordsController('Architecture', 'Site Supervision');
                                    $archSite_total_spend_hours->phase_of_work_total_spend_hours();
                                  
                                ?>
                                
                            </div>
                        </td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>


        <?php } ?>

       
        <?php if($row['service_engineering'] == 1) { ?>
            
            <table>
                <tbody>
                    <tr>
                        <th>Engineering</th>
                        <th>Manager</th>
                        <th>PIC</th>
                        <th>Total Hours</th>
                    </tr>
                    <?php if($row['engi_schematic'] == 1) { ?>
                    <tr>
                        <td>Conceptual</td>
                        <td>
                            <div class='employee-task-container'>
                            
                                <?php 
                                                    
                                    // Engineering Schematic Phase Of Work (Manager)
                                    $engiSchematic = new ViewProjectRecordsController('Engineering', 'Schematic', 'engi_schematic_manager');
                                    $engiSchematic->view_tasks_report();

                                ?>

                            </div>
                        </td>
                        <td>
                            <div class='employee-task-container'>
                            
                                <?php 
                                                        
                                    // Architecture Conceptual Phase Of Work (PIC)
                                    $engiSchematicpic = new ViewProjectRecordsController('Engineering', 'Schematic', 'engi_schematic_assigned_employee');
                                    $engiSchematicpic->view_tasks_report();

                                 ?>

                            </div>
                        </td>
                        <td>
                            <div class='pow_total_hours'>
                                
                                <?php 
                                
                                    // Architecture Conceptual Phase Of Work Total Spend Hours
                                    $engiSchematic_total_spend_hours = new ViewProjectRecordsController('Engineering', 'Schematic');
                                    $engiSchematic_total_spend_hours->phase_of_work_total_spend_hours();
                                  
                                ?>
                                
                            </div>
                        </td>
                    </tr>
                    <?php } ?>

                    <?php if($row['engi_designdevelopment'] == 1) { ?>
                    <tr>
                        <td>Design Development</td>
                        <td>
                            <div class='employee-task-container'>
                            
                                <?php 
                                                    
                                    // Engineering Schematic Phase Of Work (Manager)
                                    $engiDesignDev = new ViewProjectRecordsController('Engineering', 'Design Development', 'engi_designdevelopment_manager');
                                    $engiDesignDev->view_tasks_report();

                                ?>

                            </div>
                        </td>
                        <td>
                            <div class='employee-task-container'>
                            
                                <?php 
                                                        
                                    // Architecture Conceptual Phase Of Work (PIC)
                                    $engiDesignDevpic = new ViewProjectRecordsController('Engineering', 'Design Development', 'engi_designdevelopment_assigned_employee');
                                    $engiDesignDevpic->view_tasks_report();

                                 ?>

                            </div>
                        </td>
                        <td>
                            <div class='pow_total_hours'>
                                
                                <?php 
                                
                                    // Architecture Conceptual Phase Of Work Total Spend Hours
                                    $engiDesignDev_total_spend_hours = new ViewProjectRecordsController('Engineering', 'Design Development');
                                    $engiDesignDev_total_spend_hours->phase_of_work_total_spend_hours();
                                  
                                ?>
                                
                            </div>
                        </td>
                    </tr>
                    <?php } ?>


                    <?php if($row['engi_construction'] == 1) { ?>
                    <tr>
                        <td>Construction Drawing</td>
                        <td>
                            <div class='employee-task-container'>
                            
                                <?php 
                                                    
                                    // Engineering Schematic Phase Of Work (Manager)
                                    $engiDesignDev = new ViewProjectRecordsController('Engineering', 'Construction Drawing', 'engi_construction_manager');
                                    $engiDesignDev->view_tasks_report();

                                ?>

                            </div>
                        </td>
                        <td>
                            <div class='employee-task-container'>
                            
                                <?php 
                                                        
                                    // Architecture Conceptual Phase Of Work (PIC)
                                    $engiDesignDevpic = new ViewProjectRecordsController('Engineering', 'Construction Drawing', 'engi_construction_assigned_employee');
                                    $engiDesignDevpic->view_tasks_report();

                                 ?>

                            </div>
                        </td>
                        <td>
                            <div class='pow_total_hours'>
                                
                                <?php 
                                
                                    // Architecture Conceptual Phase Of Work Total Spend Hours
                                    $engiDesignDev_total_spend_hours = new ViewProjectRecordsController('Engineering', 'Construction Drawing');
                                    $engiDesignDev_total_spend_hours->phase_of_work_total_spend_hours();
                                  
                                ?>
                                
                            </div>
                        </td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>

        <?php } ?>

        <?php if($row['service_interior'] == 1) { ?>

            <table>
                <tbody>
                    <tr>
                        <th>Interior</th>
                        <th>Manager</th>
                        <th>PIC</th>
                        <th>Total Hours</th>
                    </tr>

                    <?php if($row['int_conceptual'] == 1) { ?>
                    <tr>
                        <td>Conceptual</td>
                        <td>
                            <div class='employee-task-container'>

                                <?php 
                                    
                                    // Interior Conceptual Phase Of Work (Manager)
                                    $intConceptual = new ViewProjectRecordsController('Interior', 'Conceptual', 'int_conceptual_manager'); 
                                    $intConceptual->view_tasks_report();

                                ?>  

                            </div>
                        </td>
                        <td>
                            <div class='employee-task-container'>

                                <?php 
                                    
                                    // Architecture Site Phase Of Work (Manager)
                                    $intConceptualpic = new ViewProjectRecordsController('Interior', 'Conceptual', 'int_conceptual_assigned_employee'); 
                                    $intConceptualpic->view_tasks_report();

                                ?>  

                            </div>
                        </td>
                        <td>
                            <div class='pow_total_hours'>
                                
                                <?php 
                                
                                    // Architecture Site Phase Of Work Total Spend Hours
                                    $intConceptual_total_spend_hours = new ViewProjectRecordsController('Interior Design', 'Conceptual');
                                    $intConceptual_total_spend_hours->phase_of_work_total_spend_hours();
                                  
                                ?>
                                
                            </div>
                        </td>
                    </tr>
                    <?php } ?>

                    <?php if($row['int_designdevelopment']) { ?>

                    <tr>
                        <td>Design Development</td>
                        <td>
                            <div class="employee-task-container">
                                
                                <?php 
                                
                                    // Interior Design Development Phase Of Work (PIC)
                                    $intDesign = new ViewProjectRecordsController('Interior', 'Design Development', 'int_designdevelopment_manager'); 
                                    $intDesign->view_tasks_report();
                                
                                ?>

                            </div>
                        </td>

                        <td>
                            <div class='employee-task-container'>

                                <?php 
                                
                                    // Architecture Site Phase Of Work (Manager)
                                    $intDesignpic = new ViewProjectRecordsController('Interior', 'Design Development', 'int_designdevelopment_assigned_employee'); 
                                    $intDesignpic->view_tasks_report();

                                ?>  

                            </div>
                        </td>

                        <td>
                            <div class='pow_total_hours'>
                                
                                <?php 
                                
                                    // Architecture Site Phase Of Work Total Spend Hours
                                    $intDesign_total_spend_hours = new ViewProjectRecordsController('Interior', 'Design Development');
                                    $intDesign_total_spend_hours->phase_of_work_total_spend_hours();
                                  
                                ?>
                                
                            </div>
                        </td>
                    </tr>

                    <?php } ?>

                    <?php if($row['int_construction']) { ?>

                        <tr>
                        <td>Construction Drawing</td>
                        <td>
                            <div class="employee-task-container">
                                
                                <?php 
                                
                                    // Interior Construction Phase Of Work (PIC)
                                    $intConstruction = new ViewProjectRecordsController('Interior', 'Construction Drawing', 'int_construction_manager'); 
                                    $intConstruction->view_tasks_report();
                                
                                ?>

                            </div>
                        </td>

                        <td>
                            <div class='employee-task-container'>

                                <?php 
                                
                                    // Interior Construction Phase Of Work (Manager)
                                    $intConstructionpic = new ViewProjectRecordsController('Interior', 'Construction Drawing', 'int_construction_assigned_employee'); 
                                    $intConstructionpic->view_tasks_report();

                                ?>  

                            </div>
                        </td>

                        <td>
                            <div class='pow_total_hours'>
                                
                                <?php 
                                
                                    // Interior Construction Of Work Total Spend Hours
                                    $intConstruction_total_spend_hours = new ViewProjectRecordsController('Interior', 'Construction Drawing');
                                    $intConstruction_total_spend_hours->phase_of_work_total_spend_hours();
                                  
                                ?>
                                
                            </div>
                        </td>
                    </tr>

                    <?php } ?>


                    <?php if($row['int_site']) { ?>

                    <tr>
                        <td>Site Supervision</td>
                        <td>
                            <div class="employee-task-container">
                                
                                <?php 
                                
                                    // Interior Construction Phase Of Work (PIC)
                                    $intSite = new ViewProjectRecordsController('Interior', 'Site Supervision', 'int_site_manager'); 
                                    $intSite->view_tasks_report();
                                
                                ?>

                            </div>
                        </td>

                        <td>
                            <div class='employee-task-container'>

                                <?php 
                                
                                    // Interior Construction Phase Of Work (Manager)
                                    $intSitepic = new ViewProjectRecordsController('Interior', 'Site Supervision', 'int_site_assigned_employee'); 
                                    $intSitepic->view_tasks_report();

                                ?>  

                            </div>
                        </td>

                        <td>
                            <div class='pow_total_hours'>
                                
                                <?php 
                                
                                    // Interior Construction Of Work Total Spend Hours
                                    $intSite_total_spend_hours = new ViewProjectRecordsController('Interior', 'Site Supervision');
                                    $intSite_total_spend_hours->phase_of_work_total_spend_hours();
                                
                                ?>
                                
                            </div>
                        </td>
                    </tr>

                    <?php } ?>

                </tbody>
            </table>

        <?php } ?>

        <?php if($row['service_masterplanning'] == 1) { ?>

            <table>
                <tbody>
                    <tr>
                        <th>Master Planning</th>
                        <th>Manager</th>
                        <th>PIC</th>
                        <th>Total Hours</th>
                    </tr>

                    <?php if($row['masterplanning_conceptual'] == 1) { ?>
                    <tr>
                        <td>Conceptual</td>
                        <td>
                            <div class='employee-task-container'>

                                <?php 
                                    
                                    // Interior Conceptual Phase Of Work (Manager)
                                    $masterConceptual = new ViewProjectRecordsController('Master Planning', 'Conceptual', 'masterplanning_conceptual_manager'); 
                                    $masterConceptual->view_tasks_report();

                                ?>  

                            </div>
                        </td>
                        <td>
                            <div class='employee-task-container'>

                                <?php 
                                    
                                    // Architecture Site Phase Of Work (Manager)
                                    $masterConceptualpic = new ViewProjectRecordsController('Master Planning', 'Conceptual', 'masterplanning_conceptual_assigned_employee'); 
                                    $masterConceptualpic->view_tasks_report();

                                ?>  

                            </div>
                        </td>
                        <td>
                            <div class='pow_total_hours'>
                                
                                <?php 
                                
                                    // Architecture Site Phase Of Work Total Spend Hours
                                    $masterConceptual_total_spend_hours = new ViewProjectRecordsController('Master Planning', 'Conceptual');
                                    $masterConceptual_total_spend_hours->phase_of_work_total_spend_hours();
                                  
                                ?>
                                
                            </div>
                        </td>
                    </tr>
                    <?php } ?>


                    <?php if($row['masterplanning_schematic'] == 1) { ?>
                    <tr>
                        <td>Schematic</td>
                        <td>
                            <div class='employee-task-container'>

                                <?php 
                                    
                                    // Interior Conceptual Phase Of Work (Manager)
                                    $masterSchematic = new ViewProjectRecordsController('Master Planning', 'Schematic', 'masterplanning_schematic_manager'); 
                                    $masterSchematic->view_tasks_report();

                                ?>  

                            </div>
                        </td>
                        <td>
                            <div class='employee-task-container'>

                                <?php 
                                    
                                    // Architecture Site Phase Of Work (Manager)
                                    $masterSchematicpic = new ViewProjectRecordsController('Master Planning', 'Schematic', 'masterplanning_schematic_assigned_employee'); 
                                    $masterSchematicpic->view_tasks_report();

                                ?>  

                            </div>
                        </td>
                        <td>
                            <div class='pow_total_hours'>
                                
                                <?php 
                                
                                    // Architecture Site Phase Of Work Total Spend Hours
                                    $masterSchematic_total_spend_hours = new ViewProjectRecordsController('Master Planning', 'Schematic');
                                    $masterSchematic_total_spend_hours->phase_of_work_total_spend_hours();
                                  
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