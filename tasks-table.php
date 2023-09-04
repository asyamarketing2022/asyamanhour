<?php 

include_once("connections/DBconnection.php");
include_once('login.php');

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['managerId'])) {

    echo $_POST['managerId'];

}

//Only assigned manager can add new task
if(isset($_POST['assigned_managers_id'])){

    $access = $_SESSION['Access'];
    $login_userId = $_SESSION['UserId'];
    $managerId = $_POST['assigned_managers_id'];
    $userid_manager = $_POST['userid_manager'];
    
    if($login_userId == $managerId ){

        echo "<img class='addNewTaskBtn pic_add_new_task_btn' src='img/add-icon.png' alt='' width='25'>";

    } else if($login_userId == $userid_manager && $access == 'manager') {

        echo "<img class='addNewTaskBtn manager_add_new_task_btn' src='img/add-icon.png' alt='' width='25'>";

    }

}

if(isset($_POST['taskId'])) {

    echo $_POST['taskId'];

}

if(isset($_POST['taskTitle'])) {

    echo $_POST['taskTitle'];

}

if(isset($_POST['employee-name'])) {

    echo $_POST['employee-name'];

}

if(isset($_POST['userPhoto'])) {

    $fullName = $_POST['fullName'];
    $userPhoto = $_POST['userPhoto'];
    $employeeId = $_POST['employeeId'];
    
    echo "<img class='photoCircle' src='$userPhoto' alt='' width='200'>
        <h3 class='employee_fullName'>$fullName</h3>
        <span class='employeeId d-none' value='$employeeId'><strong>Employee Id:</strong> $employeeId</span>";

}

if(isset($_POST['userId'])) {

    $userId = $_POST['userId'];
    $login_userId = $_SESSION['UserId'];
    $phase_of_work = $_POST['phase_of_work'];
    $services = $_POST['services'];
    $projectId = $_POST['projectId'];
    $projectName = $_POST['projectName'];

    $query_employee_tasks = "SELECT * FROM `employees_tasks` WHERE employee_id = '$userId' AND services = '$services' AND phase_of_work = '$phase_of_work' ORDER BY id DESC";
    $employee_tasks = $con->query($query_employee_tasks) or die ($con->error);
    $row = $employee_tasks->fetch_assoc();

    $output = '';
    $declineTask = '';
    $declineTask_count = 0;

    if($employee_tasks->num_rows != 0){

        $declineTask .= "
            <table>
                <h3 class='pt-3'>Decline Tasks</h3>
                <tbody>
                    <tr>
                        <th class='d-none'>Manager Id</th>
                        <th>Task Title</th>
                        <th>Decline Notes</th>
                        <th>Task Notes</th>
                        <th>Date Started</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th></th>
                        <th></th>
                    </tr>";

        $output .= "
                    <table>
                        <h3>Tasks</h3>
                            <tbody>
                                <tr>
                                    <th class='d-none'>Manager Id</th>
                                    <th>Task Title</th>
                                    <th>Task Notes</th>
                                    <th>Task Update</th>
                                    <th>Date Started</th>
                                    <th>Status</th>
                                    <th>Upload File Path</th>
                                    <th>File Lists</th>
                                </tr>";
        
        do {

            if($row['invite_status'] == 'accept'){

                if($userId == $login_userId) {

                    $output .= "<tr>
                    <td class='managerId d-none' value='". $row['manager_id'] ."'>". $row['manager_id'] ."</td>
                    <td class='taskId d-none' value='". $row['id'] ."'>". $row['id'] ."</td>
                    <td class='taskTitle'>". $row['task_title'] ."</td>
                    <td>". $row['notes'] ."</td>
                    <td class='taskUpdate'>
                        <button class='taskUpdate_btn'>Task Update</button>
                        <div class='taskUpdate_tooltip d-none'>
                            <table>
                                <tbody class='taskUpdate_tbody'>
                                    <tr class='taskUpdate_header'>
                                        <th>Updates</th>
                                        <th>Date</th>
                                        <th>Spend Hour</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td><img class='add_newUpdate_btn' src='img/add-icon.png' width='25'></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                    <td class='taskStarted'>". $row['date_started'] ."</td>
                    <td class='pow_status'>
                        <div class='text_status'>
                            <span>" . $row['status'] . "</span> 
                        </div>
                        <div class='status_tooltip d-none'>
                            <span class='status orangeStatus'>Working on it</span>
                            <span class='status redStatus'>Stuck</span>
                            <span class='status greenStatus'>Done</span>
                            <input onkeypress='return /[ A-Za-z0-9]/i.test(event.key)' onpaste='return false;' ondrop='return false;' autocomplete='off'>
                        </div>
                    </td>
                    <td class='upload_filepath_td'>
                        <button class='uploadPathBtn'>Upload File Path</button>
                        <div class='upload_filepath_tooltip d-none'>
                            <div class='upload_filepath_wrapper'>
                                <span>Upload File Path</span>
                                <div class='upload_filepath_form'>
                                    <div class='content-info__wrapper'>
                                        <div class='content__info'>
                                            <span>Notes:</span>
                                            <textarea class='new-task-notes' name='notes' id='' cols='25' rows='5'></textarea>
                                        </div>
                                        <div class='content__info'>
                                            <span>File Name:</span>
                                            <input class='file-name' name='fileName' 'type='text' required=''>
                                        </div>
                                        <div class='content__info'>
                                            <span>Insert File Path:</span>
                                            <input class='file-path' name='filePath' type='url' required=''>
                                        </div>
                                        <div class='content__info d-none'>
                                            <span>Manager Id:</span>
                                            <span class='manager-id'></span>
                                        </div>
                                        <div class='content__info d-none'>
                                            <span>Employee Name:</span>
                                            <span class='employee-name'></span>
                                        </div>
                                            <div class='content__info d-none'>
                                            <span>Task Id:</span>
                                            <span class='task-id'></span>
                                        </div>
                                        <div class='content__info d-none'>
                                            <span>Task Title:</span>
                                            <span class='task-title'></span>
                                        </div>
                                        <div class='content__info d-none'>
                                            <span>Project Id:</span>
                                            <input class='project-Id' name='projectId' type='hidden' value='$projectId'>
                                        </div>
                                        <div class='content__info d-none'>
                                        <span>Project Name:</span>
                                            <input class='project-name' name='projectName' type='hidden' value='$projectName'>
                                        </div>
                                        <div class='content__info d-none'>
                                            <span>Phase of Work:</span>
                                            <input class='phase-of-work' name='phaseOfwork' type='hidden' value='$phase_of_work'>
                                        </div>
                                        <div class='content__info d-none'>
                                            <span>Services:</span>
                                            <input class='services' name='services' type='hidden' value='$services'>
                                        </div>
                                        <div class='button-wrapper'>
                                            <input class='submit-button submit-file-path' name='' type='submit' value='Submit'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class='check_filepath_td'>
                        <button class='checkfilepathBtn'>Check Files</button>
                        <div class='check_filepath_tooltip d-none'>
                        <div class='check_filepath_wrapper'>
                            <span>Check File Path</span>
                            <div class='content-table'>

                            </div>
                        </div>
                        </div>
                    </td>
                </tr>";
                    
                } else {

                    $output .= "<tr>
                    <td class='managerId d-none' value='". $row['manager_id'] ."'>". $row['manager_id'] ."</td>
                    <td class='taskId d-none' value='". $row['id'] ."'>". $row['id'] ."</td>
                    <td class='taskTitle'>". $row['task_title'] ."</td>
                    <td>". $row['notes'] ."</td>
                    <td class='taskUpdate'>
                        <button class='taskUpdate_btn'>Task Update</button>
                        <div class='taskUpdate_tooltip d-none'>
                            <table>
                                <tbody class='taskUpdate_tbody'>
                                    <tr class='taskUpdate_header'>
                                        <th>Updates</th>
                                        <th>Date</th>
                                        <th>Spend Hour</th>
                                        <th></th>
                                    </tr>
                                    <tr>
                                        <td><img class='add_newUpdate_btn' src='img/add-icon.png' width='25'></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </td>
                    <td class='taskStarted'>". $row['date_started'] ."</td>
                    <td class='pow_status'>
                        <div class='text_status'>
                            <span>" . $row['status'] . "</span> 
                        </div>
                        <div class='status_tooltip d-none'>
                            <span class='status orangeStatus'>Working on it</span>
                            <span class='status redStatus'>Stuck</span>
                            <span class='status greenStatus'>Done</span>
                            <input onkeypress='return /[ A-Za-z0-9]/i.test(event.key)' onpaste='return false;' ondrop='return false;' autocomplete='off'>
                        </div>
                    </td>
                    <td class='upload_filepath_td'>
                        <button class='button-disable'>Upload File Path</button>
                        <div class='upload_filepath_tooltip d-none'>
                            <div class='upload_filepath_wrapper'>
                                
                            </div>
                        </div>
                    </td>
                    <td class='check_filepath_td'>
                        <button class='checkfilepathBtn'>Check Files</button>
                        <div class='check_filepath_tooltip d-none'>
                        <div class='check_filepath_wrapper'>
                            <span>Check File Path</span>
                            <div class='content-table'>

                            </div>
                        </div>
                        </div>
                    </td>
                </tr>";

                }


            } elseif($row['invite_status'] == 'decline') {

                if($row['manager_id'] == $login_userId) {

                    $declineTask .= "<tr>
                    <td class='managerId d-none' value='". $row['manager_id'] ."'>". $row['manager_id'] ."</td>
                    <td class='taskId d-none' value='". $row['id'] ."'>". $row['id'] ."</td>
                    <td class='task_title_td'>
                        <button type='button' class='btn btn-secondary tooltip-btn task_title_btn' data-bs-toggle='tooltip' data-bs-placement='bottom' title='" . $row['task_title'] . "' data-placement='bottom'>Task Title</button>
                        <div class='task_title_tooltip d-none'>
                            <div class='task_title_wrapper'>
                                <span>Change Task Title</span>
                                <div class='task_title_form'>
                                    <div class='content-info__wrapper'>
                                        <div class='content__info'>
                                            <span>Task Title:</span>
                                            <input class='input_task_title' name='input_task_title' value='". $row['task_title']."'>
                                        </div>
                                        <div class='button-wrapper'>
                                            <input class='update-button close-tooltip' name='' type='submit' value='Update'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class='declineTask_note_td'>
                        <button type='button' class='btn btn-secondary tooltip-btn decline_notes_btn' data-bs-toggle='tooltip' data-bs-placement='bottom' title='" . $row['decline_notes'] . "' data-placement='bottom'>Decline Notes</button>
                        <div class='declineTask_note_tooltip d-none'>
                            <div class='declineTask_note_wrapper'>
                                <span>Decline Notes</span>
                                <div class='declineTask_note_form'>
                                    <div class='content-info__wrapper'>
                                        <div class='content__info'>
                                            <span>Notes:</span>
                                            <textarea class='new-task-notes' name='notes' id='' cols='25' rows='5' spellcheck='false' disabled>" . $row['decline_notes'] . "</textarea>
                                       
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class='task_note_td'>
                    <button type='button' class='btn btn-secondary tooltip-btn tasknotes-btn' data-bs-toggle='tooltip' data-bs-placement='bottom' data-placement='bottom'  title=" . $row['notes'] . ">Task Notes</button>
                        <div class='task_note_tooltip d-none'>
                            <div class='task_note_wrapper'>
                                <span>Update Task Notes</span>
                                <div class='task_note_form'>
                                    <div class='content-info__wrapper'>
                                        <div class='content__info'>
                                            <span>Notes:</span>
                                            <textarea class='update_task_note' name='notes' id='' cols='25' rows='5' spellcheck='false'>" . $row['notes'] . "</textarea>
                                        </div>
                                        <div class='button-wrapper'>
                                            <input class='update-button close-tooltip' name='' type='submit' value='Update'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
               
                    <td><input class='date_start dis_previous_dates' name='dateStart' type='date' value='". $row['date_started'] ."' required></td>
                    <td><input class='due_date dis_previous_dates' name='dueDate' type='date' value='". $row['due_date'] ."' required=''></td>
                    <td class='decline-td text-center'>". $row['invite_status'] ."</td>
                    <td class=''><button class='updateTask'>Update</button></td>
                    <td class=''><button class='deleteTask'>Delete</button></td>
                </tr>";

                $declineTask_count++;      

                } else {

                    $declineTask .= "<tr>
                    <td class='managerId d-none' value='". $row['manager_id'] ."'>". $row['manager_id'] ."</td>
                    <td class='taskId d-none' value='". $row['id'] ."'>". $row['id'] ."</td>
                    <td class='task_title_td'>
                        <button type='button' class='btn btn-secondary tooltip-btn task_title_btn' data-bs-toggle='tooltip' data-bs-placement='bottom' title='" . $row['task_title'] . "' data-placement='bottom'>Task Title</button>
                        <div class='task_title_tooltip d-none'>
                            <div class='task_title_wrapper'>
                                <span>Change Task Title</span>
                                <div class='task_title_form'>
                                    <div class='content-info__wrapper'>
                                        <div class='content__info'>
                                            <span>Task Title:</span>
                                            <input class='input_task_title' name='input_task_title' value='". $row['task_title']."'>
                                        </div>
                                        <div class='button-wrapper'>
                                            <input class='update-button close-tooltip' name='' type='submit' value='Update'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class='declineTask_note_td'>
                        <button type='button' class='btn btn-secondary tooltip-btn decline_notes_btn' data-bs-toggle='tooltip' data-bs-placement='bottom' title='" . $row['decline_notes'] . "' data-placement='bottom'>Decline Notes</button>
                        <div class='declineTask_note_tooltip d-none'>
                            <div class='declineTask_note_wrapper'>
                                <span>Decline Notes</span>
                                <div class='declineTask_note_form'>
                                    <div class='content-info__wrapper'>
                                        <div class='content__info'>
                                            <span>Notes:</span>
                                            <textarea class='new-task-notes' name='notes' id='' cols='25' rows='5' spellcheck='false' disabled>" . $row['decline_notes'] . "</textarea>
                                       
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class='task_note_td'>
                    <button type='button' class='btn btn-secondary tooltip-btn tasknotes-btn' data-bs-toggle='tooltip' data-bs-placement='bottom' data-placement='bottom'  title=" . $row['notes'] . ">Task Notes</button>
                        <div class='task_note_tooltip d-none'>
                            <div class='task_note_wrapper'>
                                <span>Update Task Notes</span>
                                <div class='task_note_form'>
                                    <div class='content-info__wrapper'>
                                        <div class='content__info'>
                                            <span>Notes:</span>
                                            <textarea class='update_task_note' name='notes' id='' cols='25' rows='5' spellcheck='false'>" . $row['notes'] . "</textarea>
                                        </div>
                                        <div class='button-wrapper'>
                                            <input class='update-button close-tooltip' name='' type='submit' value='Update'>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
               
                    <td><input class='date_start dis_previous_dates' name='dateStart' type='date' value='". $row['date_started'] ."' required></td>
                    <td><input class='due_date dis_previous_dates' name='dueDate' type='date' value='". $row['due_date'] ."' required=''></td>
                    <td class='decline-td text-center'>". $row['invite_status'] ."</td>
                    <td class=''></td>
                    <td class=''></td>
                </tr>";

                $declineTask_count++;    


                }

            }

        } while($row = $employee_tasks->fetch_assoc());

        echo $output;

        if($declineTask_count != 0) {

            echo $declineTask;

        }


    } else {

        echo "
        <h3>Tasks</h3>
            <table>
                <tbody>
                    <tr>
                        <th>Task Title</th>
                        <th>Notes</th>
                        <th>Date Started</th>
                        <th>Due Date</th>
                        <th>Status</th>
                        <th>Upload File Path</th>
                        <th>File Lists</th>
                    </tr>
                </tbody>
            </table>
       ";

    }
    
}


?>