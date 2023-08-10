<?php 

include_once('connections/connection.php');
$con = connection();



if(isset($_POST['tableID'])) {

    $projectID = $_POST['tableID'];

    $projectSQL = "SELECT * FROM projects WHERE ID = $projectID";
    $project = $con->query($projectSQL) or die ($con->error);
    $assignProject = $project->fetch_assoc();

    $_SESSION['Update_projectID'] = $assignProject['id'];

        echo "<div class='content-info__wrapper'>
                    <div class='content__info'> 
                        <span>Project ID</span>
                        <input class='input' type='text' name='projectId' id='code formControlDefault' value=" . $assignProject['id'] . " required>
                    </div>
                    <div class='content__info'> 
                        <span>Code</span>
                        <input class='input' type='text' name='code' id='code formControlDefault' value=" . $assignProject['code'] . " required>
                    </div>
                    <div class='content__info'>
                        <span>Project Name</span>
                        <input class='input' type='text' name='projectName' id='projectName formControlDefault' value=" . $assignProject['project_name'] . " required>
                    </div>
                    <div class='content__info'>
                        <span>Quality Check</span>
                        <select name='qualityCheck' id='qualityCheck' aria-label='Default' value=" . $assignProject['quality_check'] . ">
                            <option value='Standard' selected>Standard</option>
                            <option value='Standard'>Standard</option>
                        </select>
                    </div>
                    <div class='content__info'>
                        <span>File Type</span>
                        <select name='fileType' id='file_type' aria-label='Default' value=" . $assignProject['file_type'] . ">
                            <option value='Gettext PO' selected>Gettext PO</option>
                            <option value='Gettext PO'>Gettext PO</option>
                        </select>
                    </div>
                    <div class='content__info'>
                        <span>Project Tree Style</span>
                        <select name='projectTreeStyle' id='projectTreeStyle' aria-label='Default' value=" . $assignProject['project_tree_style'] . ">
                            <option value='Gettext PO' selected>Gettext PO</option>
                            <option value='Gettext PO'>Gettext PO</option>
                        </select>
                    </div>
                    <div class='content__info'>
                        <span>Ignore Files</span>
                        <input type='text' name='ignoreFiles' id='mobile_number formControlDefault' value=" . $assignProject['ignore_files'] . ">
                    </div>
                    <div class='content__info'>
                        <span>String Errors Contact</span>
                        <input type='text' name='stringErrorsContact' id='stringErrorsContact formControlDefault' value=" . $assignProject['string_error_contact'] . " required>
                    </div>
                    <div class='content__info'>
                        <span>Screenshot Search Prefix</span>
                        <input type='text' name='screenSearch' id='address formControlDefault' value=" . $assignProject['screenshot_search_prefix'] .  " required>
                    </div>
                    <div class='content__info d-none'>
                        <span>Status</span>
                        <input type='text' name='status' id='address formControlDefault' value='waiting' required>
                    </div>
                    </div>";}

    if(isset($_POST['submitAssign'])) {

        $projectId = $_POST['projectId'];
        $code = $_POST['code'];
        $projectName = $_POST['projectName'];
        $qualityCheck = $_POST['qualityCheck'];
        $fileType = $_POST['fileType'];
        $projectTreeStyle = $_POST['projectTreeStyle'];
        $ignoreFiles = $_POST['ignoreFiles'];
        $stringErrorsContact = $_POST['stringErrorsContact'];
        $screenSearch = $_POST['screenSearch'];
        $dateEnd = $_POST['dateEnd'];
        // $employessId = $_POST['employees_id'];
        // $manager = $_POST['manager'];
        $managerId_array = $_POST['userID'];
        $projectManager_array = $_POST['user'];
        $status = $_POST['status'];
        $notif_status = 'new';

        // $managersId = implode(" ", $managersId_array);
        // $managers = implode(" ", $projectManager_array);

        foreach(array_combine($managerId_array, $projectManager_array) as $managerId => $projectManager) {
            $sql = "INSERT INTO `assign_project` (`project_id`, `project_code`, `project_name`, `quality_check`, `file_type`, `project_tree_style`, `ignores_files`, `string_error_contact`, `screenshot_search_prefix`, `date_end`,`manager_id`, `manager`, `status`, `notif_status`) VALUES ('$projectId', '$code', '$projectName', '$qualityCheck', '$fileType', '$projectTreeStyle', '$ignoreFiles', '$stringErrorsContact', '$screenSearch', '$dateEnd', '$managerId', '$projectManager', '$status', '$notif_status')";
            $con->query($sql) or die ($con->error);
        }
    }



    //////// This code for Manager page ///////////
    // if(isset($_POST['submitAssign'])) {

    //     $code = $_POST['update_code'];
    //     $projectName = $_POST['update_projectName'];
    //     $dateEnd = $_POST['dateEnd'];
    //     $employessId = $_POST['employees_id'];
    //     $manager = $_POST['manager'];
    //     $projectInvolve = $_POST['project_involve'];
    //     $status = $_POST['status'];

    //     //Convert the array to String ($_POST['pickEmployee'] is an array)
    //     $employees = implode(" ", $projectInvolve);

    //     $sql = "INSERT INTO `assign_project` (`project_code`, `project_name`, `date_end`, `employees_id`, `manager`, `project_involve`, `status`) VALUES ('$code', '$projectName', '$dateEnd', '$employessId', '$manager', '$employees', '$status')";

    //     $con->query($sql) or die ($con->error);
        
    //     }

?>