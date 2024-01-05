<?php include_once 'login.php'; ?>
<?php include_once 'notification-box.php'; ?>
<?php include_once 'notification-task.php'; ?>
<?php include_once 'users-table.php'; ?>
<?php include_once 'userProfile.php'; ?>
<?php include_once 'notification-file-path.php'; ?>

<?php

 $URL = 'http://dev.asyamanhour.local';

?>

<div class="manage-project__wrapper">

    <div class="top-bar">
        <a href="/homepage.php">
            <div class="asyamanhour-logo">
                <img src="img/asya-manhours-logo.png" alt="">
            </div>
        </a>
        <div class="userLog">
            <ul>
                <li><i class="fa fa-wechat"></i></li>
                <!-- For dynamic codes - notification-count.php -->
                <li>
                    <i class="fa fa-bell">
                        <span class="notif_count"></span>
                    </i>
                </li>

                <?php if(isset($_SESSION['UserLogin'])){ ?>

                    <li style='margin-left: 20px; margin-right: 0; font-weight: 900;'>
                        <a href="/profile.php">
                            <span><?php echo $_SESSION['UserLogin']; ?></span> <span><?php echo $_SESSION['Userlname']; ?></span>
                        </a>
                    </li>

                <?php } ?>


                <!-- for php code users-table.php -->
                <li>
                    <a href="/profile.php">
                        <img class='top-profile-photo' src="img/upload/<?php echo $user_profile['user_image']; ?>"  width="50px" alt="">
                    </a>
                </li>

                <!-- <li><a href="logout.php"><i class="fa fa-arrow-down"></i></a></li> -->
                <li><a href="logout.php"><img src="img/right-from-bracket-solid.svg" alt=""></a></li>
            </ul>

                <div class="notif-list">
                    <div class="notif_container">

                        <!-- New Task Notification  -->
                        <?php if (mysqli_num_rows($tasks) > 0){ ?>

                                <?php do { ?>

                                    <?php if($newtask_notif['invite_status'] == 'new') { ?>
                                        
                                        <div class="notif_box">
                                            <a href="/profile.php">
                                                <div class="notif-photo">
                                                    <?php 
                                                    
                                                    // do {

                                                    //     if($newtask_notif['invite_status'] == 'new') {
                                                    
                                                            $sent_by = $newtask_notif['manager_id'];
                                                    
                                                            $query_employees_tasks = "SELECT * FROM registered_users WHERE ID = $sent_by";
                                                            $query_employees = $con->query($query_employees_tasks) or die ($con->error);
                                                            $user_sent_by = $query_employees->fetch_assoc();
                                                    
                                                            $user_sent_by_photo = $user_sent_by['user_image'];

                                                            echo  "<img src='img/upload/$user_sent_by_photo' width='25px'>";

                                                    //     }
                                                    
                                                    // } while($newtask_notif = $tasks->fetch_assoc());
                                                    
                                                    ?>
        
                                                </div>  
                                                <div class="notif-text pb-2">
                                                    <!-- <span class='notif-message'><strong>You have new Task</strong></span></br> -->
                                                    <p class='sent_by'><strong><?php echo $newtask_notif['sent_by']?></strong></p>
                                                    <p class='notif-message'>Sent a new task</p>
                                                    <p><strong><?php echo $newtask_notif['project_name'] ?></strong> project</p>
                                                    <p>Task TItle: <strong><?php echo $newtask_notif['task_title'] ?></strong></p>
                                                </div>
                                                <div class="notif-date">
                                                    <span class='newTask-date'><?php echo $newtask_notif['added_at']?></span>
                                                </div>
                                            </a>
                                        </div>
                                        
                                    <?php } ?>

                                <?php } while($newtask_notif = $tasks->fetch_assoc()); ?>
        
                        <?php } ?>

                        <!-- New File Path Notification -->
                        <?php if (mysqli_num_rows($filePath) > 0){ ?>

                            <?php do { ?>

                                <?php if($filePath_notif['file_path_status'] == 'new') { ?>
                                    <div class="notif_box">
                                        <a href="/viewproject.php?ID=<?php echo $filePath_notif['project_id']; ?>">
                                            <div class="notif-text pb-2">
                                                <span class='notif-message' style='font-size: 20px;'><strong>New File Path Sent</strong></span></br>
                                            </div>
                                        </a>
                                    </div>
                                <?php } ?>

                            <?php } while($filePath_notif = $filePath->fetch_assoc()); ?>

                        <?php } ?>
                
                </div>    
            </div>    

        </div>
    </div>

    <div class="manage-employee__content">
    <span class='popup-btn-menu'><img src="img/bars-solid.svg" alt=""></span>
        <div class="grid-left__menu">
            <span class='close-btn-menu'><img src="img/x-solid.svg" alt=""></span>
            <ul>
                <li class="<?php if($page=='homepage'){echo 'active';} ?>" ><a href="<?php echo $URL ?>/homepage.php"><i class="fa fa-check"></i> Homepage</a></li>
                <li class="<?php if($page=='profile'){echo 'active';} ?>"><a href="<?php echo $URL ?>/profile.php"> <i class="fa fa-users"></i> Profile</a></li>
                <?php if(isset($_SESSION['UserLogin']) && $_SESSION['Access'] == "admin" ) { ?>

                    <li class="<?php if($page=='admin'){echo 'active';} ?>"><a href="<?php echo $URL ?>/admin.php"><i class="fa fa-plus"></i> Employees</a></li>
            
                <?php } ?> 

                <li class="<?php if($page=='project'){echo 'active';} ?>" ><a href="<?php echo $URL ?>/project.php"><i class="fa fa-clipboard"></i> Projects</a></li>
               
                <li class="<?php if($page=='deliverables'){echo 'active';} ?>"><a href="<?php echo $URL ?>/deliverables.php"><i class="fa fa-newspaper-o"></i>Deliverables </a></li>

                <li class="<?php if($page=='project-records'){echo 'active';} ?>"><a href="<?php echo $URL ?>/project-records.php"><i class="fa fa-file"></i>Project Records</a></li>

                <li class="<?php if($page=='usersReport'){echo 'active';} ?>"><a href="<?php echo $URL ?>/usersReport.php"><i class="fa fa-book"></i>Users Logs</a></li>
                <!-- <li><a href="#"><i class="fa fa-bitcoin"></i> Financial</a></li> -->

            </ul>

            <div class="version-button_container">
                <span class='version-button_update'>Version 1.0.0.0</span>
                
            </div>
        </div>