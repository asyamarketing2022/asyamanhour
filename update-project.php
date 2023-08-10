<?php 
if(!isset($_SESSION)){
    session_start();
}

include_once('connections/connection.php');
$con = connection();

if(isset($_POST['tableID'])) {

    $projectID = $_POST['tableID'];

    $projectSQL = "SELECT * FROM projects WHERE ID = $projectID";
    $project = $con->query($projectSQL) or die ($con->error);
    $updateProject = $project->fetch_assoc();

    $_SESSION['Update_projectID'] = $updateProject['id'];

        echo "
                <div class='content-info__wrapper'>
                    <div class='content__info'> 
                        <span>Code</span>
                        <input class='input' type='text' name='update_code' id='code formControlDefault' value=" . $updateProject['code'] . " required>
                    </div>
                    <div class='content__info'>
                        <span>Project Name</span>
                        <input class='input' type='text' name='update_projectName' id='projectName formControlDefault' value=" . $updateProject['project_name'] . " required>
                    </div>
                    <div class='content__info'>
                        <span>Quality Check</span>
                        <select name='update_qualityCheck' id='qualityCheck' aria-label='Default' value=" . $updateProject['quality_check'] . ">
                            <option value='Standard' selected>Standard</option>
                            <option value='Standard'>Standard</option>
                        </select>
                    </div>
                    <div class='content__info'>
                        <span>File Type</span>
                        <select name='update_file_type' id='file_type' aria-label='Default' value=" . $updateProject['file_type'] . ">
                            <option value='Gettext PO' selected>Gettext PO</option>
                            <option value='Gettext PO'>Gettext PO</option>
                        </select>
                    </div>
                    <div class='content__info'>
                        <span>Project Tree Style</span>
                        <select name='update_projectTreeStyle' id='projectTreeStyle' aria-label='Default' value=" . $updateProject['project_tree_style'] . ">
                            <option value='Gettext PO' selected>Gettext PO</option>
                            <option value='Gettext PO'>Gettext PO</option>
                        </select>
                    </div>
                    <div class='content__info'>
                        <span>Ignore Files</span>
                        <input type='text' name='update_ignoreFiles' id='mobile_number formControlDefault' value=" . $updateProject['ignore_files'] . ">
                    </div>
                    <div class='content__info'>
                        <span>String Errors Contact</span>
                        <input type='text' name='update_stringErrorsContact' id='stringErrorsContact formControlDefault' value=" . $updateProject['string_error_contact'] . " required>
                    </div>
                    <div class='content__info'>
                        <span>Screenshot Search Prefix</span>
                        <input type='text' name='update_screenSearch' id='address formControlDefault' value=" . $updateProject['screenshot_search_prefix'] .  " required>
                    </div>
                    <div class='content__info d-none'>
                        <span>Status</span>
                        <input type='text' name='status' id='address formControlDefault' value='waiting' required>
                    </div>
                </div>";}

    if(isset($_POST['submit-updateProject'])){

        $update_projectID = $_SESSION['Update_projectID'];

        $code = $_POST['update_code'];
        $projectName = $_POST['update_projectName'];
        $qualityCheck = $_POST['update_qualityCheck'];
        $fileType = $_POST['update_file_type'];
        $projectTreeStyle = $_POST['update_projectTreeStyle'];
        $ignoreFiles = $_POST['update_ignoreFiles'];
        $stringErrorContact = $_POST['update_stringErrorsContact'];
        $screenSearch = $_POST['update_screenSearch'];
        $status = $_POST['status'];
        
        $sql = "UPDATE `projects` SET `code` = '$code', `project_name` = '$projectName', `quality_check` = '$qualityCheck', `file_type` = '$fileType', `project_tree_style` = '$projectTreeStyle', `ignore_files` = '$ignoreFiles', `string_error_contact` = '$stringErrorContact', `screenshot_search_prefix` = '$screenSearch', `status` = '$status' WHERE id = '$update_projectID'";

        $con->query($sql) or die ($con->error);

    }

?>