<?php include 'force_login.php'; ?>
<?php $page = 'project'; include 'header.php'; ?>

<?php include_once("connections/DBconnection.php"); ?>
<?php include_once("phase-of-work_status.php"); ?>
<?php include_once("sidebar.php"); ?>
<?php include_once("upload_file_path.php"); ?>
<?php include_once("ViewProjectController.php"); ?>
<?php include_once("SearchManagerController.php"); ?>
<?php include_once('login.php'); ?>
<?php include_once('postUsersManager_in_modal.php'); ?>
<?/*php include_once("employees_auto_create_date_logs.php"); */?>


<?/*php include_once("searchEmployee_table.php"); */?>


<?php 

//Get Project ID 
$projectID = $_GET['ID'];

//Database connection
$db = new DBconnection();
$con = $db->connection();

$query_projects = "SELECT * FROM pms_projects WHERE id = '$projectID'";
$project = $con->query($query_projects) or die ($con->error);
$row = $project->fetch_assoc();

// $archConceptualStatus = str_replace(' ', '', $row['arch_conceptual_status']);
// $archConceptualStatus = ltrim($row['arch_conceptual_status'], " ");

?>

<!-- <div class="col-lg-12"> -->
  <!-- <div class="loading">
    <img src="img/loading2.gif" alt="">
  </div>     -->
<!-- </div> -->

<div class="grid-right__content">
    <div class="project-title mt-4 row">
    <h1 id="projectTitle" value='<?php echo $projectID ?>'><?php echo $row['project_name'] ?></h1>
        <div class="col-6 d-flex align-items-end">
            <div class="info-icon mx-2 mb-2" data-toggle="modal" data-target="#projectInfo"><img src="img/info-icon.png" alt="" width="30"></div>
        </div>

        <?php 
        
        if($_SESSION['Access'] == 'admin' || $_SESSION['Access'] == 'contract & billing') {

        ?>

        <div class="col-6 mt-auto p-2 bd-highlight">
            <div class="btn-container float-end">
                <button type='button' class='add-services mx-2'>Add Services</button>
                <button type='button' class='add-revice'>Add Revise</button>
                <div class="add_services_container d-none">

                </div>
            </div>
        </div>

        <?php 
        
        }

        ?>


    </div>

    <!-- Architecture table  -->
    <?php if($row['service_architecture'] == 1) { ?>

    <div class="content-table project_services_table">

        <table>
            <tr>
                <th class="th_services">Architecture</th>
                <th>Department</th>
                <th>Manager</th>
                <th>Project In Charge</th>
                <th>Status</th>
                <th>Date Receive</th>
                <th>Due Date</th>
                <th>File Upload</th>
                <th>File Lists</th>
            </tr>

            <?php 
            
            // Architecture Conceptual Phase Of Work
            if($row['arch_conceptual'] == 1) {  

                $archConceptual = new ViewProjectController('arch_conceptual', 'arch_conceptual_manager', 'arch_conceptual_assigned_employee', 'Conceptual', 'arch_conceptual_who_assigned_manager', 'arch_conceptual_status', 'arch_conceptual_duedate');
                $archConceptual->view_phase_of_work_status();

             } ?> 
         

            <?php 
            
            // Architecture Schematic Phase Of Work
            if($row['arch_schematic'] == 1) {  

                $archSchematic = new ViewProjectController('arch_schematic', 'arch_schematic_manager', 'arch_schematic_assigned_employee', 'Schematic', 'arch_schematic_who_assigned_manager', 'arch_schematic_status', 'arch_schematic_duedate');
                $archSchematic->view_phase_of_work_status();

             } ?>


            <?php 
            
            // Architecture Design Development Phase Of Work
            if($row['arch_designdevelopment'] == 1) {  

                $archDesignDevelopment = new ViewProjectController('arch_designdevelopment', 'arch_designdevelopment_manager', 'arch_designdevelopment_assigned_employee', 'Design Development', 'arch_designdevelopment_who_assigned_manager', 'arch_designdevelopment_status', 'arch_designdevelopment_duedate');
                $archDesignDevelopment->view_phase_of_work_status();

            } ?>


            <?php 
            
            // Architecture Construction Phase Of Work
            if($row['arch_construction'] == 1) {  

                $archConstructionDrawing = new ViewProjectController('arch_construction', 'arch_construction_manager', 'arch_construction_assigned_employee', 'Construction Drawing', 'arch_construction_who_assigned_manager', 'arch_construction_status', 'arch_construction_duedate');
                $archConstructionDrawing->view_phase_of_work_status();

            } ?>


            <?php 
            
            // Architecture Site Supervision Phase Of Work
            if($row['arch_site'] == 1) {  

                $archSite = new ViewProjectController('arch_site', 'arch_site_manager', 'arch_site_assigned_employee', 'Site Supervision', 'arch_site_who_assigned_manager', 'arch_site_status', 'arch_site_duedate');
                $archSite->view_phase_of_work_status();

             } ?>

        </table>

        <?php 
             
             //
             if($row['arch_conceptual'] != 1 || $row['arch_schematic'] != 1 || $row['arch_designdevelopment'] != 1 || $row['arch_construction'] != 1 || $row['arch_site'] != 1 && $_SESSION['Access'] == 'admin') {

                echo "<img class='add_phase_of_work_btn' id='archi_pow' src='img/add-icon.png' width='30'>";

             } else if($row['arch_conceptual'] != 1 || $row['arch_schematic'] != 1 || $row['arch_designdevelopment'] != 1 || $row['arch_construction'] != 1 || $row['arch_site'] != 1 && $_SESSION['Access'] == 'contract & billing') {

                echo "<img class='add_phase_of_work_btn' id='archi_pow' src='img/add-icon.png' width='30'>";

             }
             
        ?>

        <div class='phase_of_work d-none'>


        </div>
    
    </div>

    <?php } ?>

    <!-- Architecture table  -->
    <?php if($row['service_engineering'] == 1) { ?>

        <div class="content-table project_services_table">
            <table>
                <tr>
                    <th class="th_services">Engineering</th>
                    <th>Department</th>
                    <th>Manager</th>
                    <th>Project In Charge</th>
                    <th>Status</th>
                    <th>Date Receive</th>
                    <th>Due Date</th>
                    <th>File Upload</th>
                    <th>File Lists</th>
                </tr>

        <?php 

         // Architecture Conceptual Phase Of Work
        if($row['engi_schematic'] == 1) {  

            $engiSchematic = new ViewProjectController('engi_schematic', 'engi_schematic_manager', 'engi_schematic_assigned_employee', 'Schematic', 'engi_schematic_who_assigned_manager', 'engi_schematic_status', 'engi_schematic_duedate');
            $engiSchematic->view_phase_of_work_status();

        } ?> 

        
        <?php 
            
        // Architecture Design Development Phase Of Work
        if($row['engi_designdevelopment'] == 1) {  

            $engiDesignDevelopment = new ViewProjectController('engi_designdevelopment', 'engi_designdevelopment_manager', 'engi_designdevelopment_assigned_employee', 'Design Development', 'engi_designdevelopment_who_assigned_manager', 'engi_designdevelopment_status', 'engi_designdevelopment_duedate');
            $engiDesignDevelopment->view_phase_of_work_status();

        } ?>

        <?php 
        
        // Architecture Construction Phase Of Work
        if($row['engi_construction'] == 1) {  

            $engiConstructionDrawing = new ViewProjectController('engi_construction', 'engi_construction_manager', 'engi_construction_assigned_employee', 'Construction Drawing', 'engi_construction_who_assigned_manager', 'engi_construction_status', 'engi_construction_duedate');
            $engiConstructionDrawing->view_phase_of_work_status();

        } ?>

        </table>

        <?php 
             
            // Engineering 
            if($row['engi_schematic'] != 1 || $row['engi_designdevelopment'] != 1 || $row['engi_construction'] != 1 && $_SESSION['Access'] == 'admin') {

                echo "<img class='add_phase_of_work_btn' id='engi_pow' src='img/add-icon.png' width='30'>";

            } else if($row['engi_schematic'] != 1 || $row['engi_designdevelopment'] != 1 || $row['engi_construction'] != 1 && $_SESSION['Access'] == 'contract & billing' ) {

                echo "<img class='add_phase_of_work_btn' id='engi_pow' src='img/add-icon.png' width='30'>";

            }
             
        ?>

        <div class='phase_of_work d-none'>

        </div>

    </div>

    <?php } ?>

    <!-- Interior table  -->
    <?php if($row['service_interior'] == 1) { ?>

        <div class="content-table project_services_table">
            <table>
                <tr>
                    <th class="th_services">Interior</th>
                    <th>Department</th>
                    <th>Manager</th>
                    <th>Project In Charge</th>
                    <th>Status</th>
                    <th>Date Receive</th>
                    <th>Due Date</th>
                    <th>File Upload</th>
                    <th>File Lists</th>
                </tr>

                <?php 
                
                // Interior Conceptual Phase of Work
                if($row['int_conceptual'] == 1) {  

                    $intConceptual = new ViewProjectController('int_conceptual', 'int_conceptual_manager', 'int_conceptual_assigned_employee', 'Conceptual', 'int_conceptual_who_assigned_manager', 'int_conceptual_status', 'int_conceptual_duedate');
                    $intConceptual->view_phase_of_work_status();

                } ?>


                <?php  
                
                // Interior Design Development Phase of Work
                if($row['int_designdevelopment'] == 1) {  
                
                    $intDesignDevelopment = new ViewProjectController('int_designdevelopment', 'int_designdevelopment_manager', 'int_designdevelopment_assigned_employee', 'Design Development', 'int_designdevelopment_who_assigned_manager', 'int_designdevelopment_status', 'int_designdevelopment_duedate');
                    $intDesignDevelopment->view_phase_of_work_status();
                
                } ?>

                <?php 
                
                 // Interior Construction Development Phase of Work
                 if($row['int_construction'] == 1) {  

                    $intConstruction = new ViewProjectController('int_construction', 'int_construction_manager', 'int_construction_assigned_employee', 'Construction Drawing', 'int_construction_who_assigned_manager', 'int_construction_status', 'int_construction_duedate');
                    $intConstruction->view_phase_of_work_status();
                
                } ?>

                <?php 
                
                // Interior Site Supervision Phase of Work
                if($row['int_site'] == 1) {  

                    $intSite = new ViewProjectController('int_site', 'int_site_manager', 'int_site_assigned_employee', 'Site Supervision', 'int_site_who_assigned_manager', 'int_site_status', 'int_site_duedate');
                    $intSite->view_phase_of_work_status();
                
                } ?>

            </table>

            
            <?php 
                
                // Engineering 
                if($row['int_conceptual'] != 1 || $row['int_designdevelopment'] != 1 || $row['int_construction'] != 1 || $row['int_site'] != 1 && $_SESSION['Access'] == 'admin') {
    
                    echo "<img class='add_phase_of_work_btn' id='int_pow' src='img/add-icon.png' width='30'>";
    
                } else if($row['int_conceptual'] != 1 || $row['int_designdevelopment'] != 1 || $row['int_construction'] != 1 || $row['int_site'] != 1 && $_SESSION['Access'] == 'contract & billing') {

                    echo "<img class='add_phase_of_work_btn' id='int_pow' src='img/add-icon.png' width='30'>";

                }
                
            ?>
 
            <div class='phase_of_work d-none'>
    
            </div>

        </div>

    <?php } ?>


    <!-- Master Planning table  -->
    <?php if($row['service_masterplanning'] == 1) { ?>

        <div class="content-table project_services_table">
            <table>
                <tr>
                    <th class="th_services">Master Planning</th>
                    <th>Department</th>
                    <th>Manager</th>
                    <th>Project In Charge</th>
                    <th>Status</th>
                    <th>Date Receive</th>
                    <th>Due Date</th>
                    <th>File Upload</th>
                    <th>File Lists</th>
                </tr>

                <?php 
                
                // Master Planning Conceptual Phase of Work
                if($row['masterplanning_conceptual'] == 1) {  

                    $masterplanningConceptual = new ViewProjectController('masterplanning_conceptual', 'masterplanning_conceptual_manager', 'masterplanning_conceptual_assigned_employee', 'Conceptual', 'masterplanning_conceptual_who_assigned_manager', 'masterplanning_conceptual_status', 'masterplanning_conceptual_duedate');
                    $masterplanningConceptual->view_phase_of_work_status();

                } ?>


                <?php 
                
                // Master Planning Schematic Phase of Work
                if($row['masterplanning_schematic'] == 1) {  

                    $masterplanningSchematic = new ViewProjectController('masterplanning_schematic', 'masterplanning_schematic_manager', 'masterplanning_schematic_assigned_employee', 'Schematic', 'masterplanning_schematic_who_assigned_manager', 'masterplanning_schematic_status', 'masterplanning_schematic_duedate');
                    $masterplanningSchematic->view_phase_of_work_status();

                } ?>

            </table>

            <?php 
                
                // Engineering 
                if($row['masterplanning_conceptual'] != 1 || $row['masterplanning_schematic'] != 1 && $_SESSION['Access'] == 'admin') {
    
                    echo "<img class='add_phase_of_work_btn' id='masterplanning_pow' src='img/add-icon.png' width='30'>";
    
                } elseif($row['masterplanning_conceptual'] != 1 || $row['masterplanning_schematic'] != 1 && $_SESSION['Access'] == 'contract & billing') {

                    echo "<img class='add_phase_of_work_btn' id='masterplanning_pow' src='img/add-icon.png' width='30'>";

                }
                
            ?>
 
            <div class='phase_of_work d-none'>
    
            </div>

        </div>

    <?php } ?>

</div>


<div class="view_project_user d-none" id="view_managers">
    <div class="modal-content" style="height: 900px; background: transparent; border: none;">
            <div class="view_managers_overlay"></div>
    
                <div class="modal-left-content">
                    <div class="modal-title">
                        <div class="modal-title-text">
                            Managers
                        </div>

                        <div class="closeBtn">×</div>
                    </div>
                    <div class="modal-header border-0">
                        <!-- <h5></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button> -->
                    </div>
                 
                    <div class="managers_container">
                            <!-- postUsersManager_in_modal.php -->

                    </div>

                    <?php if(isset($_SESSION['UserLogin']) && $_SESSION['Access'] == "admin" ) { ?>

                        <img class="addManagerBtn" data-toggle="modal" data-target="#addManager" src="img/add-icon.png" alt="" width="50">

                    <?php } ?>
                </div>

                <div class="modal-right-content">
                    <div class="tasks-content_container">
                        <div class="tasks-content">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float: right;">
                                <span aria-hidden="true">×</span>
                            </button>
                            <div class="user_photo">
                                <!-- tasks-table.php for dynamic content -->
        
                            </div>
                            <div class="user-tasks">
                                <div class="content-table">
                                    <!-- tasks-table.php for dynamic content -->

                                </div>

                                <div class="add_new_task_wrapper">
                                    <!-- <img class='addNewTaskBtn' src='img/add-icon.png' alt='' width='25'> -->
                                </div>
                                    
                                <div class="addNewTask_form_container manager_add_new_task_form">
                                    <div class='content-info__wrapper'>
                                            <div class='content__info'>
                                                <span>Task Title:</span>
                                                <input class='taskTitle_field' type='text' name='taskTitle' required>
                                            </div>
                                            <div class='content__info'>
                                                <span>Date Start:</span>
                                                <input class='date_start dis_previous_dates new_task_dateStart' name='dateStart' type='date' required>
                                            </div>
                                            <div class='content__info'>
                                                <span>Due Date:</span>
                                                <input class='date_end dis_previous_dates new_task_dueDate' name='dueDate' type='date' required>
                                            </div>
                                            <div class='content__info'>
                                                <span>Allot Hours:</span>
                                                <input class='manager_allot_time' type='number' min='0' required>
                                            </div>
                                            <div class='content__info'>
                                                <span>Notes</span>
                                                <textarea class='newTask_notes' name='notes' id='' cols='30' rows='10' required></textarea>
                                            </div>
                                            <div class='button-wrapper'>
                                                <input class='submit-button manager-submit-new-task' type="button" value='Submit' required>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

    </div>
</div>



<!---------------------- Working ----------------------------------->

<!-- View My Managers - Modal -->
<?/*?>
<div class="modal fade pop-up__modal view_project_user" id="view_managers" tabindex="-1" role="dialog" aria-labelledby="viewManagers" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 100%;">
            <div class="modal-content" style="height: 900px; background: transparent; border: none;">

                <div class="modal-left-content">
                    <div class="modal-header border-0">
                        <h5></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <span class="modal-title">Managers</span>
                    <div class="managers_container">
                            <!-- postUsersManager_in_modal.php -->

                    </div>

                    <?php if(isset($_SESSION['UserLogin']) && $_SESSION['Access'] == "admin" ) { ?>

                        <img class="addManagerBtn" data-toggle="modal" data-target="#addManager" src="img/add-icon.png" alt="" width="50">

                    <?php } ?>
                </div>

                <div class="modal-right-content">
                    <div class="tasks-content_container">
                        <div class="tasks-content">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float: right;">
                                <span aria-hidden="true">×</span>
                            </button>
                            <div class="user_photo">
                                <!-- tasks-table.php for dynamic content -->
        
                            </div>
                            <div class="user-tasks">
                                <div class="content-table">
                                    <!-- tasks-table.php for dynamic content -->

                                </div>

                                <div class="add_new_task_wrapper">
                                    <!-- <img class='addNewTaskBtn' src='img/add-icon.png' alt='' width='25'> -->
                                </div>
                                    
                                <div class="addNewTask_form_container manager_add_new_task_form">
                                    <div class='content-info__wrapper'>
                                            <div class='content__info'>
                                                <span>Task Title:</span>
                                                <input class='taskTitle_field' type='text' name='taskTitle' required>
                                            </div>
                                            <div class='content__info'>
                                                <span>Date Start:</span>
                                                <input class='date_start dis_previous_dates new_task_dateStart' name='dateStart' type='date' required>
                                            </div>
                                            <div class='content__info'>
                                                <span>Due Date:</span>
                                                <input class='date_end dis_previous_dates new_task_dueDate' name='dueDate' type='date' required>
                                            </div>
                                            <div class='content__info'>
                                                <span>Allot Hours:</span>
                                                <input class='manager_allot_time' type='number' min='0' required>
                                            </div>
                                            <div class='content__info'>
                                                <span>Notes</span>
                                                <textarea class='newTask_notes' name='notes' id='' cols='30' rows='10' required></textarea>
                                            </div>
                                            <div class='button-wrapper'>
                                                <input class='submit-button manager-submit-new-task' type="button" value='Submit' required>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </div>
</div>
<?*/?>

<!---------------------- Working ----------------------------------->


<div class="view_project_user d-none" id="view_project_in_charge">
    <div class="modal-content" style="height: 900px; background: transparent; border: none;">
            <div class="view_project_user_overlay"></div>

            <div class="modal-left-content">
                <div class="modal-title">
                    <div class="modal-title-text">
                        Project In Charge
                    </div>

                    <div class="closeBtn">×</div>
                </div>
                <div class="modal-header border-0">
                    <!-- <h5></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button> -->
                </div>
                <!-- <span class="modal-title">Project In Charge</span> -->
                <div class="assigned_managers_container d-none">

                </div>
                <div class='totalworkhours'></div>
    
                <div class="project_in_charge_container">
                    <!-- postUsersProjectInCharge_in_modal.php -->
                        
                </div>

                <div class="add_project_button_wrapper">
                    <!-- <img class="addProjectInChargeBtn" data-toggle="modal" data-target="#addProjectInCharge" src="img/add-icon.png" alt="" width="50"> -->
                </div>
                
            </div>
            <div class="modal-right-content">
                <div class="tasks-content_container">
                    <div class="tasks-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float: right;">
                            <span aria-hidden="true">×</span>
                        </button>
                        <div class="user_photo">
                              <!-- tasks-table.php for dynamic content -->
      
                        </div>
                        <div class="user-tasks">
                            <div class="content-table">
                                <!-- tasks-table.php for dynamic content -->

                            </div>

                            <div class="add_new_task_wrapper">
                                <!-- <img class='addNewTaskBtn' src='img/add-icon.png' alt='' width='25'> -->
                            </div>
                                
                            <div class="addNewTask_form_container pic_add_new_task_form">
                                <div class='content-info__wrapper'>
                                    <div class='content__info'>
                                        <span>Task Title:</span>
                                        <input class='taskTitle_field' type='text' name='taskTitle' required>
                                    </div>
                                    <div class='content__info'>
                                        <span>Date Start:</span>
                                        <input class='date_start dis_previous_dates new_task_dateStart' name='dateStart' type='date' required>
                                    </div>
                                    <div class='content__info'>
                                        <span>Due Date:</span>
                                        <input class='date_end dis_previous_dates new_task_dueDate' name='dueDate' type='date' required>
                                    </div>
                                    <div class='content__info'>
                                        <span>Allot Hours:</span>
                                        <input class='pic_allot_time' type='number' min='0' required>
                                    </div>
                                    <div class='content__info'>
                                        <span>Notes</span>
                                        <textarea class='newTask_notes' name='notes' id='' cols='30' rows='10' required></textarea>
                                    </div>
                                    <div class='button-wrapper'>
                                        <input class='submit-button pic-submit-new-task' type="button" value='Submit'>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

<!---------------------- Working ----------------------------------->

<!-- View My Project In Charge - Modal -->
<?/*?>
<div class="modal fade pop-up__modal view_project_user" id="view_project_in_charge" tabindex="-1" role="dialog" aria-labelledby="viewPIC" aria-hidden="true" style='overflow: hidden;'>
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 100%;">
        <div class="modal-content" style="height: 900px; background: transparent; border: none;">

            <div class="modal-left-content">
                <div class="modal-header border-0">
                    <h5></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <span class="modal-title">Project In Charge</span>
                <div class="assigned_managers_container d-none">

                </div>
                <div class='totalworkhours'></div>
    
                <div class="project_in_charge_container">
                    <!-- postUsersProjectInCharge_in_modal.php -->
                        
                </div>

                <div class="add_project_button_wrapper">
                    <!-- <img class="addProjectInChargeBtn" data-toggle="modal" data-target="#addProjectInCharge" src="img/add-icon.png" alt="" width="50"> -->
                </div>
                
            </div>

            <div class="modal-right-content">
                <div class="tasks-content_container">
                    <div class="tasks-content">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="float: right;">
                            <span aria-hidden="true">×</span>
                        </button>
                        <div class="user_photo">
                              <!-- tasks-table.php for dynamic content -->
      
                        </div>
                        <div class="user-tasks">
                            <div class="content-table">
                                <!-- tasks-table.php for dynamic content -->

                            </div>

                            <div class="add_new_task_wrapper">
                                <!-- <img class='addNewTaskBtn' src='img/add-icon.png' alt='' width='25'> -->
                            </div>
                                
                            <div class="addNewTask_form_container pic_add_new_task_form">
                                <div class='content-info__wrapper'>
                                    <div class='content__info'>
                                        <span>Task Title:</span>
                                        <input class='taskTitle_field' type='text' name='taskTitle' required>
                                    </div>
                                    <div class='content__info'>
                                        <span>Date Start:</span>
                                        <input class='date_start dis_previous_dates new_task_dateStart' name='dateStart' type='date' required>
                                    </div>
                                    <div class='content__info'>
                                        <span>Due Date:</span>
                                        <input class='date_end dis_previous_dates new_task_dueDate' name='dueDate' type='date' required>
                                    </div>
                                    <div class='content__info'>
                                        <span>Allot Hours:</span>
                                        <input class='pic_allot_time' type='number' min='0' required>
                                    </div>
                                    <div class='content__info'>
                                        <span>Notes</span>
                                        <textarea class='newTask_notes' name='notes' id='' cols='30' rows='10' required></textarea>
                                    </div>
                                    <div class='button-wrapper'>
                                        <input class='submit-button pic-submit-new-task' type="button" value='Submit'>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?*/?>

<!---------------------- Working ----------------------------------->

<!-- View Project Info - Modal -->
<div class="modal fade pop-up__modal" id="projectInfo" tabindex="-1" role="dialog" aria-labelledby="viewProjectInfo" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">Project Info</span>
            <div class="projectInfo_container">
                <!-- postProjectInfo_in_modal.php -->

            </div>
        </div>
    </div>
</div>

<!-- Upload file path - Modal -->
<div class="modal fade pop-up__modal" id="uploadPath" tabindex="-1" role="dialog" aria-labelledby="uploadPath" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">Upload File Path</span>
            <div class="uploadFilePath_container">
                <!-- postUpload_file_path_modal.php -->

            </div>
        </div>
    </div>
</div>

<!-- View file path - Modal -->
<div class="modal fade pop-up__modal" id="viewfilepath" tabindex="-1" role="dialog" aria-labelledby="viewfilepath" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 800px;">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">View File Paths</span>
            <div class="viewFilePath_container">
                <!-- view-Filepath_in_modal.php -->

            </div>
        </div>
    </div>
</div>

<!-- Add Project In Charge - Modal -->
<div class="modal fade pop-up__modal" id="addProjectInCharge" tabindex="-1" role="dialog" aria-labelledby="addProjectInCharge" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document" style="max-width: 750px;">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">Add Project In Charge</span>
            <div class="_container">
                <!-- view-Filepath_in_modal.php -->
                <div class="search-employee_container content-info__wrapper tab-position_right">
                    <div class="content__info">
                        <span>Search Employee:</span>
                        <div class="search_wrapper" style="max-width: 500px;">
                            <input class="searchFilter w-100" name="search" value="" type="text" placeholder="Employee Lastname">
                            <!-- <button type="submit" class="search-button submitFilter">Search</button> -->
                            <div class="search_employee_wrapper">

                                <!-- searchEmployee_table.php -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Manager - Modal -->
<div class="modal fade pop-up__modal" id="addManager" tabindex="-1" role="dialog" aria-labelledby="addManager" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document" style="max-width: 750px;">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">Add Manager</span>
            <div class="_container">
                <!-- view-Filepath_in_modal.php -->
                <div class="search-manager_container content-info__wrapper tab-position_right">
                    <div class="content__info">
                        <span>Allot Time:</span>
                        <span><input class='manager_allot_time' type='number'></span>
                    </div>
                    <div class="content__info">
                        <span>Search Manager:</span>
                        <div class="search_wrapper" style="max-width: 500px;">
                            <input class="searchManager w-100" name="search" value="" type="text" placeholder="Manager Lastname">
                            <!-- <button type="submit" class="search-button submitFilter">Search</button> -->
                            <div class="search_manager_wrapper">

                                <!-- searchManager_table.php -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'footer.php'; ?>