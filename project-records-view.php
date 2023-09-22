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
        <h1>A Place</h1>
    </div>

    <div class="content-table project_report_table">
        <table>
            <tbody>
                <tr>
                    <th>Architecture</th>
                    <th>Manager</th>
                    <th>PIC</th>
                    <th>Total Hours</th>
                    <!-- <th></th> -->
                </tr>

                <!-- Architecture table  -->
                <?php if($row['service_architecture'] == 1) { ?>

                    <tr>

                        <td>Conceptual</td>

                        <td>
                            <div class='managers-task-container'>
                            
                                    <?php 
                                                        
                                        // Architecture Conceptual Phase Of Work
                                        if($row['arch_conceptual'] == 1) {  

                                            $archConceptual = new ViewProjectRecordsController('arch_conceptual', 'arch_conceptual_manager', 'arch_conceptual_assigned_employee', 'Architecture', 'Conceptual');
                                            $archConceptual->view_tasks_report();
                                        
                                        }

                                    ?>

                            </div>
                        </td>
                        
                    </tr>

                <?php } ?>

 
    

                <!-- <tr>
                    <td>Conceptual</td>
                    <td>
                        <div class='managers-task-container'>
                            <div class="manager-task">
                                <div class="taskUser">
                                    <img src="img/upload/istockphoto-149070491-1024x1024.jpg" alt="">
                                    <div class='userInfo'>
                                        <p>Name:
                                        <span class='userName'>David Doe</span>
                                        </p>
                                        <p>Department:
                                        <span class='userDepartment'>Design</span>
                                        </p>
                                        <p>Position:
                                        <span class='userPosition'>Manager</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="taskTitle">
                                    <h3>Task 1</h3>
                                </div>
                                <div class="taskUpdates">
                                    <div class="updateList">
                                        <ul class='Updates p-0'>
                                            <li>Update 1</li>
                                            <li>Update 2</li>
                                            <li>Update 3</li>
                                            <li><span>Total Hours:</span></li>
                                        </ul>
                                    </div>
                                    <div class="updateHours">
                                        <ul class='p-0'>
                                            <li>5</li>
                                            <li>5</li>
                                            <li>10</li>
                                            <li class='task_total_hours'><span>20</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="manager-task">
                                <div class="taskUser">
                                    <img src="img/upload/istockphoto-149070491-1024x1024.jpg" alt="">
                                    <div class='userInfo'>
                                        <p>Name:
                                        <span class='userName'>David Doe</span>
                                        </p>
                                        <p>Department:
                                        <span class='userDepartment'>Design</span>
                                        </p>
                                        <p>Position:
                                        <span class='userPosition'>Manager</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="taskTitle">
                                    <h3>Task 1</h3>
                                </div>
                                <div class="taskUpdates">
                                    <div class="updateList">
                                        <ul class='Updates p-0'>
                                            <li>Update 1</li>
                                            <li>Update 2</li>
                                            <li>Update 3</li>
                                            <li><span>Total Hours:</span></li>
                                        </ul>
                                    </div>
                                    <div class="updateHours">
                                        <ul class='p-0'>
                                            <li>5</li>
                                            <li>5</li>
                                            <li>10</li>
                                            <li class='task_total_hours'><span>20</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class='pic-task-container'>
                            <div class="pic-task">
                                <div class="taskUser">
                                    <img src="img/upload/istockphoto-149070491-1024x1024.jpg" alt="">
                                    <div class='userInfo'>
                                        <p>Name:
                                        <span class='userName'>David Doe</span>
                                        </p>
                                        <p>Department:
                                        <span class='userDepartment'>Design</span>
                                        </p>
                                        <p>Position:
                                        <span class='userPosition'>Manager</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="taskTitle">
                                    <h3>Task 1</h3>
                                </div>
                                <div class="taskUpdates">
                                    <div class="updateList">
                                        <ul class='Updates p-0'>
                                            <li>Update 1</li>
                                            <li>Update 2</li>
                                            <li>Update 3</li>
                                            <li><span>Total Hours:</span></li>
                                        </ul>
                                    </div>
                                    <div class="updateHours">
                                        <ul class='p-0'>
                                            <li>5</li>
                                            <li>5</li>
                                            <li>10</li>
                                            <li class='task_total_hours'><span>20</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>100 Hours</td>
                </tr> -->


                <!-- <tr>
                    <td>Schematic</td>
                    <td>
                        <div class='managers-task-container'>
                            <div class="manager-task">
                                <div class="taskUser">
                                    <img src="img/upload/istockphoto-149070491-1024x1024.jpg" alt="">
                                    <div class='userInfo'>
                                        <p>Name:
                                        <span class='userName'>David Doe</span>
                                        </p>
                                        <p>Department:
                                        <span class='userDepartment'>Design</span>
                                        </p>
                                        <p>Position:
                                        <span class='userPosition'>Manager</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="taskTitle">
                                    <h3>Task 1</h3>
                                </div>
                                <div class="taskUpdates">
                                    <div class="updateList">
                                        <ul class='Updates p-0'>
                                            <li>Update 1</li>
                                            <li>Update 2</li>
                                            <li>Update 3</li>
                                            <li><span>Total Hours:</span></li>
                                        </ul>
                                    </div>
                                    <div class="updateHours">
                                        <ul class='p-0'>
                                            <li>5</li>
                                            <li>5</li>
                                            <li>10</li>
                                            <li class='task_total_hours'><span>20</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="manager-task">
                                <div class="taskUser">
                                    <img src="img/upload/istockphoto-149070491-1024x1024.jpg" alt="">
                                    <div class='userInfo'>
                                        <p>Name:
                                        <span class='userName'>David Doe</span>
                                        </p>
                                        <p>Department:
                                        <span class='userDepartment'>Design</span>
                                        </p>
                                        <p>Position:
                                        <span class='userPosition'>Manager</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="taskTitle">
                                    <h3>Task 1</h3>
                                </div>
                                <div class="taskUpdates">
                                    <div class="updateList">
                                        <ul class='Updates p-0'>
                                            <li>Update 1</li>
                                            <li>Update 2</li>
                                            <li>Update 3</li>
                                            <li><span>Total Hours:</span></li>
                                        </ul>
                                    </div>
                                    <div class="updateHours">
                                        <ul class='p-0'>
                                            <li>5</li>
                                            <li>5</li>
                                            <li>10</li>
                                            <li class='task_total_hours'><span>20</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class='pic-task-container'>
                            <div class="pic-task">
                                <div class="taskUser">
                                    <img src="img/upload/istockphoto-149070491-1024x1024.jpg" alt="">
                                    <div class='userInfo'>
                                        <p>Name:
                                        <span class='userName'>David Doe</span>
                                        </p>
                                        <p>Department:
                                        <span class='userDepartment'>Design</span>
                                        </p>
                                        <p>Position:
                                        <span class='userPosition'>Manager</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="taskTitle">
                                    <h3>Task 1</h3>
                                </div>
                                <div class="taskUpdates">
                                    <div class="updateList">
                                        <ul class='Updates p-0'>
                                            <li>Update 1</li>
                                            <li>Update 2</li>
                                            <li>Update 3</li>
                                            <li><span>Total Hours:</span></li>
                                        </ul>
                                    </div>
                                    <div class="updateHours">
                                        <ul class='p-0'>
                                            <li>5</li>
                                            <li>5</li>
                                            <li>10</li>
                                            <li class='task_total_hours'><span>20</span></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>100 Hours</td>
                </tr> -->

           
            </tbody>
        </table>
    </div>
</div>




<?php include 'footer.php'; ?>