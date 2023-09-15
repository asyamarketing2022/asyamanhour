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

                <li><span><?php echo $_SESSION['UserLogin']; ?></span></li>
                <li><span><?php echo $_SESSION['Userlname']; ?></span></li>

                <?php } ?>


                <!-- for php code users-table.php -->
                <li><img class='top-profile-photo' src="img/upload/<?php echo $user_profile['user_image']; ?>"  width="50px" alt=""></li>


                <li><a href="logout.php"><i class="fa fa-arrow-down"></i></a></li>
            </ul>

                <div class="notif-list">
                    <div class="notif_container">

                        <!-- New Task Notification  -->
                        <?php if (mysqli_num_rows($tasks) > 0){ ?>

                                <?php do { ?>

                                    <?php if($newtask_notif['invite_status'] == 'new') { ?>
                                        <div class="notif_box">
                                            <a href="<?php echo $URL ?>/profile.php">
                                                <div class="notif-text pb-2">
                                                    <span class='notif-message' style='font-size: 20px;'><strong>You have new Task</strong></span></br>
                                                    <span><?php echo $newtask_notif['sent_by']?> sent a new task from </span></br>
                                                    <span><strong><?php echo $newtask_notif['project_name'] ?></strong> project</span></br>
                                                    <span>Task TItle: <strong><?php echo $newtask_notif['task_title'] ?></strong></span></br>
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
                <li class="<?php if($page=='homepage'){echo 'active';} ?>" ><a href="<?php echo $URL ?>/homepage.php"><i class="fa fa-clipboard"></i> Homepage</a></li>
                <li class="<?php if($page=='profile'){echo 'active';} ?>"><a href="<?php echo $URL ?>/profile.php"> <i class="fa fa-users"></i> Profile</a></li>
                <?php if(isset($_SESSION['UserLogin']) && $_SESSION['Access'] == "admin" ) { ?>

                    <li class="<?php if($page=='admin'){echo 'active';} ?>"><a href="<?php echo $URL ?>/admin.php"><i class="fa fa-plus"></i> Employees</a></li>
            
                <?php } ?> 

                <li class="<?php if($page=='project'){echo 'active';} ?>" ><a href="<?php echo $URL ?>/project.php"><i class="fa fa-clipboard"></i> Projects</a></li>
               
                <li class="<?php if($page=='deliverables'){echo 'active';} ?>"><a href="<?php echo $URL ?>/deliverables.php"><i class="fa fa-newspaper-o"></i>Deliverables </a></li>

                <li class="<?php if($page=='project-records'){echo 'active';} ?>"><a href="<?php echo $URL ?>/project-records.php"><i class="fa fa-newspaper-o"></i>Project Records</a></li>

                <li class="<?php if($page=='usersReport'){echo 'active';} ?>"><a href="<?php echo $URL ?>/usersReport.php"><i class="fa fa-newspaper-o"></i>Users Log</a></li>
                <!-- <li><a href="#"><i class="fa fa-bitcoin"></i> Financial</a></li> -->

            </ul>
        </div>