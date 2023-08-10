<?php 

include_once("connections/DBconnection.php");
include_once("login.php");

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['projectId'])) {

    $projectId = $_POST['projectId'];
    $projectTitle = $_POST['projectTitle'];
    $services = $_POST['services'];
    $phase_of_work = $_POST['phase_of_work'];
    $employeeId = $_POST['employeeId'];
    $employeeName = $_POST['employeeName'];
    $taskTitle = $_POST['taskTitle'];
    $new_task_notes = $_POST['newTask_notes'];
    $dateStart = $_POST['dateStart'];
    $dateEnd = $_POST['dateEnd'];
    $status = '';
    $invite_status = 'new';
    $projectName = $_POST['projectName'];
    $userfirstName = $_SESSION['UserLogin'];
    $userlastName = $_SESSION['Userlname'];
    $managerId = $_SESSION['UserId'];

    $sql = "INSERT INTO `employees_tasks`(`project_id`, `project_name`, `services`, `phase_of_work`, `employee_id`, `employee_name`, `task_title`, `notes`, `date_started`, `due_date`, `status`, `invite_status`, `sent_by`, `manager_id`) VALUES ('$projectId', '$projectTitle', '$services', '$phase_of_work', '$employeeId', '$employeeName', '$taskTitle', '$new_task_notes', '$dateStart', '$dateEnd', '$status', '$invite_status', '$userfirstName $userlastName', '$managerId')";

    $con->query($sql) or die ($con->error);

    $query_employee_tasks = "SELECT * FROM `employees_tasks` WHERE employee_id = '$employeeId' AND services = '$services' AND phase_of_work = '$phase_of_work' ORDER BY id DESC";
    $employee_tasks = $con->query($query_employee_tasks) or die ($con->error);
    $row = $employee_tasks->fetch_assoc();

    $output = '';
    $declineTask = '';
    $declineTask_count = 0;

    if($employee_tasks->num_rows != 0){

        $declineTask .= "
        <table>
            <h3 class='pt-5'>Decline Tasks</h3>
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

        $output .= "<h3>Tasks</h3>
                        <table>
                            <tbody>
                                <tr>
                                    <th class='d-none'>Manager Id</th>
                                    <th>Task Title</th>
                                    <th>Task Notes</th>
                                    <th>Date Started</th>
                                    <th>Due Date</th>
                                    <th>Status</th>
                                    <th>Upload File Path</th>
                                    <th>File Lists</th>
                                </tr>";

        do {

            if($row['invite_status'] == 'accept'){

            $output .= "<tr>
                            <td class='managerId d-none' value='". $row['manager_id'] ."'>". $row['manager_id'] ."</td>
                            <td class='taskId d-none' value='". $row['id'] ."'>". $row['id'] ."</td>
                            <td class='taskTitle'>". $row['task_title'] ."</td>
                            <td>". $row['notes'] ."</td>
                            <td class='taskStarted'>". $row['date_started'] ."</td>
                            <td class='taskDue-Date'>". $row['due_date'] ."</td>
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

                     
            } elseif($row['invite_status'] == 'decline') {   
            
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