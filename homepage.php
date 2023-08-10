<?php include 'login.php'; ?>
<?php $page = 'homepage'; include 'header.php'; ?>
<?php include "sidebar.php"; ?>


<?php 

include_once("connections/connection.php");

$con = connection();

    if(isset($_POST['submit'])){

        $project = $_POST['project'];
        // $conversation = $_POST['conversation'];
        $person = $_POST['person'];
        $status = $_POST['status'];
        $date_start = $_POST['date_start'];
        $dead_line = $_POST['dead_line'];
        $timeline = $_POST['timeline'];

        $sql = "INSERT INTO `board` (`project`, `person`, `status`, `date_start`, `dead_line`, `timeline`) VALUES ('$project', '$person', '$status', '$date_start', '$dead_line', '$timeline')";

        $con->query($sql) or die ($con->error);
    }

?>

<div class="container-fluid " style="
background-image: url('img/coming-soon.jpg'); 
background-size: cover; 
background-position: center center; 
height: 100vh; 
width: 100%;">
    <div class="row">
        <?php if(isset($_SESSION['Access']) == "Admin") { ?> 

        <!-- <div class="position-fixed">
            <a href="admin.php">Register</a>
        </div> -->

        <?php } ?>

        <!-- <div class="header-container">
            <div class="header shadow-sm p-3 mb-5 bg-body rounded w-100 h-auto">
                <h1>Home</h1>
            </div>
        </div> -->

        <!-- <div class="col-lg-12">
            <div class="content shadow">
                <div class="container">
                    <form action="" method="post">
                        <table>
                            <tr>
                                <th><input type="checkbox"></th>
                                <th>Project</th>
                                <th>Person</th>
                                <th>Status</th>
                                <th>Date Start</th>
                                <th>Date Dead Line</th>
                                <th>Timeline</th>
                                <th>+</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox">
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="project">
                                </td>
                                <td>
                                    <input class="form-control" type="text" name="person">
                                </td>
                                <td>
                                    <select name="status" id="">
                                        <option value="working on it">Working on it</option>
                                        <option value="stuck">Stuck</option>
                                        <option value="sone">Done</option>
                                        <option value="blank"></option>
                                    </select>
                                </td>
                                <td>
                                    <input class="datepicker" name="date_start" data-provide="datepicker">
                                </td>
                                <td>
                                    <input class="datepicker" name="dead_line" data-provide="datepicker">
                                </td>
                                <td>
                                    <input class="multidate" name="timeline" data-provide="datepicker">
                                </td>
                                <td></td>
                            </tr>
                        </table>
                        <input type="submit" name="submit" value="submit form" >
                    </form>
                </div>
            </div>
        </div> -->
    </div>
</div>

<!-- <div class="swiper-slide">
    <div class="photo-wrapper">
        <a href="" alt=""></a>
    </div>
    <div class="caption" style="left: 0">
        <p></p>
    </div>
</div> -->





<?php include 'footer.php'; ?>