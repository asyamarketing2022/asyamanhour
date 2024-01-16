<?php include 'force_login.php'; ?>
<?php $page = 'profile'; include 'header.php'; ?>
<?php include_once 'sidebar.php'; ?>
<?php include_once 'assign-project.php'; ?>
<?php include_once 'projectIncharge_table.php'; ?>
<?php include_once 'view-myproject.php'; ?>
<?php include_once 'picproject-table.php'; ?>
<?php include_once 'project-history.php'; ?>
<?php include_once 'tasks-new.php'; ?>
<?php include_once 'tasks-table-profile.php'; ?>
<?php include_once 'userProfile.php'; ?>
<?/*php include 'assign-projectIncharge.php'; */?>

<div class="grid-right__content pt-0 position-relative">
    <div class="profile">
        <div class="profile-container">
            <div class="profile-column">
                <div class="myprofile-info">
                    <div class="myphoto">
                      
                        <img src="img/upload/<?php echo $user_profile['user_image']; ?>" alt="">

                        <div class="change-photo">
                            <button class='change-photo-btn'><a href="#">Change Photo</a></button>

                            <form class='profile-photo_form d-none' action="upload-profile-photo.php" method="post" enctype="multipart/form-data">
                                Select image to upload:

                                <input type="file" name="fileToUpload" id="fileToUpload">
                                <input type="submit" value="Upload Image" name="submit-new-photo">
                            </form>
                        </div>
                    </div>
                    <div class="profile-info">
                        <?php if(isset($_SESSION['UserLogin'])){ ?>
                            <div class="profile-info__content d-none">
                                <span>User Id</span>
                                <p class='profile-userId'><?php echo $user_profile['ID']; ?></p>
                            </div>
                            <div class="profile-info__content">
                                <span>Name</span>
                                <p ><?php echo $_SESSION['UserLogin']; ?> <?php echo $_SESSION['Userlname']; ?></p>
                            </div>
                            <div class="profile-info__content">
                                <span>Position</span>
                                <p><?php echo $_SESSION['Position']; ?></p>
                            </div>
                            <div class="profile-info__content">
                                <span>Department</span>
                                <p><?php echo $_SESSION['Department']; ?></p>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="mydesc">
                        <h3>About</h3>
                        <!-- <div><p class="exeee">clickkkkkkkkkkkkkk</p></div> -->
                        <p class='current-bio'><?php echo $user_profile['user_bio']; ?></p>
                        <div class="edit-bio">
                            <button class="edit_bio_btn"><a href="#">Edit</a></button>
                            <div class="edit_bio_tooltip d-none">
                                <div class="edit_bio_wrapper">
                                    <span>Edit Bio</span>
                                    <div class="edit_bio__form">
                                        <div class="content-info__wrapper">
                                            <div class="content__info">
                                                <span>Bio:</span>
                                                <textarea class="bio-textarea" cols="25" rows="5" value=''><?php echo $userInfo['user_bio']; ?></textarea>
                                            </div>
                            
                                            <div class="button-wrapper">
                                                <input class="submit-button submit-bio" name="" type="submit" value="Submit">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="myprojects">
                    <h1>My Projects</h1>
                  
                    <div class="content-table">
                        <div class="search-action__wrapper">
                            <div class="search-action">
                                <input class="search-task-input" type="text">
                                <div class="search-task">Search</div>
                            </div>

                            <div class="calendar-logs">
                                <img class='calendar-icon' id='calendarIcon' src="img/calendar-days-solid.svg" alt="">
                            </div>
                        </div>
            
                        <table class="w-100">
                            <tbody>
                                <tr>
                                    <th>Project Name</th>
                                    <th>Service</th>
                                    <th>Phase of work</th>
                                    <th>Task Title</th>
                                    <th>Task Notes</th>
                                    <th>Date Started</th>
                                    <th>Due Date</th>
                                    <th>Allot Time</th>
                                    <th>Manager</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </tbody>
                        <tbody>

                                <!-- tasks-new.php -->

                                    <?php if(!empty($newTasks_info['id'])) { ?>

                                        <?php do { ?>

                                            <?php if($newTasks_info['invite_status'] == 'new'){ ?>

                                                    <tr class="task-table_row table-row-green" value="<?php echo $newTasks_info['id']; ?>">
                                                        
                                                        <td><?php echo $newTasks_info['project_name']; ?></td>
                                                        <td><?php echo $newTasks_info['services']; ?></td>
                                                        <td><?php echo $newTasks_info['phase_of_work']; ?></td>
                                                        <td><?php echo $newTasks_info['task_title']; ?></td>
                                                        <td><?php echo $tasks_info['notes']; ?></td>
                                                        <td><?php echo $newTasks_info['date_started']; ?></td>
                                                        <td><?php echo $newTasks_info['due_date']; ?></td>
                                                        <td class='allot_time'><?php echo $newTasks_info['allot_time']; ?></td>
                                                        <td><?php echo $newTasks_info['sent_by']; ?></td>
                                                        <td><?php echo $newTasks_info['status']; ?></td>
                                                        <td class='invite_status_td'>
                                                            <button class='new-task-btn'>
                                                                <?php echo $newTasks_info['invite_status']; ?>
                                                            </button>
                                                            <div class="invite_status_tooltip d-none">
                                                                <div class="invite_status_wrapper">
                                                                    <div class="invite_status_form">
                                                                        <div class="content-info__wrapper">
                                                                            <div class="button-wrapper pb-0">
                                                                                <button class='accept' type='button'><span>Accept</span>
                                                                                    <img class='check-icon' src="img/check-solid-white.svg" alt="">
                                                                                </button>
                                                                                <button class='decline' type='button'>Decline 
                                                                                    <img class='x-icon' src="img/x-solid-white.svg" alt="">
                                                                                </button>
                                                                            </div>
                                                                            <div class="decline-note_wrapper pt-3 d-none">
                                                                                <div class="content__info">
                                                                                    <span>Notes:</span>
                                                                                    <textarea class="decline-notes" name="notes" id="" cols="25" rows="5"  placeholder="Why you decline the task?" required></textarea>
                                                                                </div>
                                                                                <div class="button-wrapper">
                                                                                    <input class="submit-button submit-decline" name="" type="submit" value="Submit">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                 
                                                    </tr>

                                            <?php } ?>
                                     
                                        <?php } while($newTasks_info = $newTasks->fetch_assoc()); ?>
                                        

                                    <?php } ?>
                                </tbody>
                                <tbody  class="usertasks-table">

                                <?php if(!empty($tasks_info['id'])) { ?>

                                    <?php do { ?>

                                        <?php if($tasks_info['invite_status'] == 'accept' || $tasks_info['invite_status'] == 'decline') { ?>

                                                <tr class="task-table_row clickable-row" data-href='viewproject.php?ID=<?php echo $tasks_info['project_id'] ?>' value="<?php echo $tasks_info['id']; ?>">
                                                    <td><?php echo $tasks_info['project_name']; ?></td>
                                                    <td><?php echo $tasks_info['services']; ?></td>
                                                    <td><?php echo $tasks_info['phase_of_work']; ?></td>
                                                    <td><?php echo $tasks_info['task_title']; ?></td>
                                                    <td>
                                                        <button type="button" class="btn btn-outline-dark tooltip-btn task_title_btn" data-bs-toggle="tooltip" data-bs-placement="bottom" title="<?php echo $tasks_info['notes']; ?>" data-placement="bottom" data-original-title="<?php echo $tasks_info['notes']; ?>" style='font-size: 10px;'>Task Title</button>
                                                    </td>
                                                    <td><?php echo $tasks_info['date_started']; ?></td>
                                                    <td><?php echo $tasks_info['due_date']; ?></td>
                                                    <td class='allot_time'><?php echo $tasks_info['allot_time']; ?></td>
                                                    <td><?php echo $tasks_info['sent_by']; ?></td>
                                                    <td><?php echo $tasks_info['status']; ?></td>
                                                    <td><?php echo $tasks_info['invite_status'] ?></td>
                                                </tr>
                                       
                                        <?php } ?>

                                    <?php } while($tasks_info = $tasks->fetch_assoc()); ?>

                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>

<!-- View My Project - Modal -->
<div class="modal fade pop-up__modal" id="view_project" tabindex="-1" role="dialog" aria-labelledby="addNewProjectTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 1700px;">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">Project Name</span>
            <div class="here"></div>
            <form class="project-form" action="profile.php" method="POST">
                <div class="myProject-form">
                    <div class='myProject-details'>
                        <!-- view-myproject.php for php code -->
                    </div>
                    <div class='myProject-status'>
                        <div class='content-info__wrapper assign'>
                            <div class='content__info'>
                                <span>Status</span>
                                <p></p>
                            </div> 
                            <div class='content__info'>
                                <span>Date Start</span>
                                <p></p>
                            </div> 
                            <div class='content__info'>
                                <span>Target End Date</span>
                                <p></p>
                            </div> 

                            <?php if (isset($_SESSION['UserLogin']) && $_SESSION['Access'] == "admin" || $_SESSION['Access'] == "manager") { ?>

                                <div class='content__info'> 
                                    <span>Project In Charge</span>
                                    <div class='search-action__wrapper'>
                                        <div class='search-action search-nb'>
                                            <input class='searchUser-input' type='text'>
                                            <div class='search-button'>Search</div>
                                        </div>
                                        <table class=''>
                                        <form action="" method="POST">
                                                <?php do {  ?>   
                                                <tr class='search-user' id=" <?php echo $employeeInfo['ID']; ?> " value=" <?php echo $employeeInfo['ID']; ?> " >
                                                    <td class='nameofuser'> <?php echo $employeeInfo['first_name']; ?> <?php echo $employeeInfo['last_name']; ?></td>
                                                    <td><?php echo $employeeInfo['position']; ?></td>
                                                    <td><?php echo $employeeInfo['email']; ?></td>
                                                    <td><?php echo $employeeInfo['department']; ?></td>
                                            
                                                    <td><span class='pickBtn' value='<?php echo $employeeInfo['first_name']; ?> <?php echo $employeeInfo['last_name']; ?>'>Adds</span></td>
                                                </tr>
                                            <?php } while($employeeInfo = $employee->fetch_assoc()); ?>
                                            </form>
                                        </table>
                                    </div>
                                </div>

                            <?php } ?>

                        </div>
                    </div>
                </div>

                <div class="button-wrapper">
                    <input class="submit-button prevent" name="submitPIC" type="submit" value="Submit">
                    <input class="submit-button" name="" type="button" value="Cancel">
                </div>
            </form>
        </div>
    </div>
</div>

    
<div class="calendar-overlay d-none"></div>
    <div class="calendar d-none">
        <div class="calendar-header">
            <button id="prevBtn">&lt;</button>
            <h1 id="monthYear"></h1>
            <button id="nextBtn">&gt;</button>
        </div>
            <div class="days">
                <div class="day">Sun</div>
                <div class="day">Mon</div>
                <div class="day">Tue</div>
                <div class="day">Wed</div>
                <div class="day">Thu</div>
                <div class="day">Fri</div>
                <div class="day">Sat</div>
            </div>
        <div class="dates " id="dates">
            <div class="date" data-day="1">1</div>
            <div class="date" data-day="2">2</div>
            <div class="date" data-day="3">3</div>
            <div class="date" data-day="4">4</div>
            <div class="date" data-day="5">5</div>
            <div class="date" data-day="6">6</div>
        </div>
    </div>

      <!-- Modal for Event Details -->
    <div class="modal modal-logs event show-modal hidden" id="eventModal">
        <div class="modal-content">

         <!-- <span class="close">&times;</span> -->
            <h2 id="eventDate"></h2>
            <textarea class="area d-none" id="eventDescription"></textarea>
            <button class='d-none' id="saveEventBtn">Save</button>
            <div class="content-table">
                <table class='calendarModal_logs'>
                    <tbody>
                        <tr class="mylogs_table_header">
                            <th class="d-none">Update Task Id</th>
                            <th>Project Name</th>
                            <th>Service</th>
                            <th>Phase of work</th>
                            <th>Task Title</th>
                            <th>Updates</th>
                            <th>Spend Hours</th>
                            <th></th>
                        </tr>

                        <!-- For dynamic content (viewlogs.php) -->

                        <tr>
                            <td class='add_logs_td'>
                                <img class='add_logs' src='img/add-icon.png' width='25'>
                                <div class='add_logs_tooltip d-none'>
                                    <table>
                                        <tbody>
                                            <tr class='add_logs_header'>
                                                <th>My Project</th>
                                                <th>My Task</th>
                                                <th>Task Update</th>
                                                <th>Spend Hours</th>
                                                <th></th>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <select id="select_project"></select>
                                                </td>
                                                <td>
                                                    <select id="select_task"></select>
                                                </td>
                                                <td>
                                                    <input id="add_logs_task_update" type="text">
                                                </td>
                                                <td>
                                                    <input id="add_logs_task_spend_hours" type="number">
                                                </td>
                                                <td>
                                                    <img class='add_logs_save' src="img/add-icon.png" alt="" width="25">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                            <td></td>
                            <td> <!-- <button class='save_update_logs'>Save</button> --></td>
                            <td></td>
                            <td>Total Hours:</td>
                            <td class='total_spend_hours'></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php include 'footer.php'; ?>
