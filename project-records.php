<?php include 'force_login.php'; ?>
<?php $page = 'project-records'; include 'header.php'; ?>
<?php include_once("sidebar.php"); ?>
<?php include_once("deliverables_employee.php"); ?>
<?php include 'project-table.php'; ?>


<div class='grid-right__content'>
    <div class='project-title mt-4'>
        <div class="float-start">
            <h1>Project Records</h1>
        </div>
    </div>

    <div class="content-table">
        <table>
            <tr>
                <th>Project Name</th>
                <th>Location</th>
                <th>Lot Areas</th>
                <th>Typology</th>
                <th>Company Name</th>
                <th>Client Name</th>
                <th></th>
            </tr>
            
            <!-- project-table.php for SQL -->

            <form action="" method="POST">

                <?php if(!empty($projectInfo['id'])) { ?>

                    <?php do { ?>
                        <tr class="table-row_projects table-form" value="<?php echo $projectInfo['id'] ?>">
                            <td><?php echo $projectInfo['project_name'] ?></td>
                            <td><?php echo $projectInfo['location'] ?></td>
                            <td><?php echo $projectInfo['lot_areas'] ?></td>
                            <td><?php echo $projectInfo['typology'] ?></td>
                            <td><?php echo $projectInfo['company_name'] ?></td>
                            <td><?php echo $projectInfo['client_name'] ?></td>

                            <?/* php if(isset($_SESSION['UserLogin']) && $_SESSION['Access'] == "admin") { */?>
    
                                <td><a class="" href="project-records-view.php?ID=<?php echo $projectInfo['id'] ?>">View</a></td>
                                
                            <?/*php } */?>

                        </tr>
                    <?php } while($projectInfo = $project->fetch_assoc()); ?>

                <?php } ?>   

            </form>
        </table>
    </div>
</div>


<?php include 'footer.php'; ?>