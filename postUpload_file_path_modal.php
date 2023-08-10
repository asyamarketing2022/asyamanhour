<?php include_once('connections/DBconnection.php'); ?>
<?php include 'login.php'; ?>

<?php 

$db = new DBconnection();
$con = $db->connection();

if(isset($_POST['projectId'])){

    $userfirstName = $_SESSION['UserLogin'];
    $userlastName = $_SESSION['Userlname'];
    $projectId = $_POST['projectId'];
    $projectName = $_POST['projectName'];
    $projectService = $_POST['projectService'];
    $phase_of_work = $_POST['text_phaseofwork'];

    echo "<form action='' method='POST'>
            <div class='content-info__wrapper tab-position_right'>
                <div class='content__info'>
                    <span>Notes:</span>
                    <textarea name='notes' id='' cols='30' rows='10'></textarea>
                </div>
                <div class='content__info'>
                    <span>File Name:</span>
                    <input name='fileName' type='text' required>
                </div>
                <div class='content__info'>
                    <span>Insert File Path:</span>
                    <input name='filePath' type='url' required>
                </div>
                <div class='content__info d-none'>
                    <span>Project ID:</span>
                    <input name='projectId' type='hidden' value='$projectId'>
                </div>
                <div class='content__info d-none'>
                    <span>Project Name:</span>
                    <input name='projectName' type='hidden' value='$projectName' >
                </div>
                <div class='content__info d-none'>
                    <span>Project Service:</span>
                    <input name='projectService' type='hidden' value='$projectService'>
                </div>
                <div class='content__info d-none'>
                    <span>Phase of Work:</span>
                    <input name='phaseofwork' type='hidden' value='$phase_of_work'>
                </div>
                <div class='content__info d-none'>
                    <span>User First Name:</span>
                    <input name='userfirstName' type='hidden' value='$userfirstName'>
                </div>
                <div class='content__info d-none'>
                    <span>User Last Name:</span>
                    <input name='userlastName' type='hidden' value='$userlastName'>
                </div>
            </div>
            <div class='button-wrapper'>
                <input class='submit-button' name='uploadfilepath' type='submit' value='Save'>
            </div>
        </form>";
}

?>