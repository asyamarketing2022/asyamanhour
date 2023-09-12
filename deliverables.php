<?php $page = 'deliverables'; include 'header.php'; ?>
<?php include_once("sidebar.php"); ?>
<?php include_once("deliverables_employee.php"); ?>

<div class='grid-right__content'>
    <div class='project-title mt-4'>
        <h1 class="float-start">
            Employee Timeline
        </h1>
    </div>
    <div class="content-table">
        <table>
            <tbody>
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Position</th>
                    <th>Date</th>
                    <th>Day</th>
                    <th>Spend Hours</th>
                    <th>Daily Tasks</th>
                </tr>

                <?php 
                
                $count = 0;
                
                do { 
                    
                    $count++

                ?>

                    <tr>
                        <td><?php echo $count; ?></td>
                        <td class='deliverablesUserId' value='<?php echo $employeeInfo['ID'] ?>'><?php echo $employeeInfo['first_name']; ?> <?php echo $employeeInfo['last_name']; ?></td>
                        <td><?php echo $employeeInfo['department']; ?></td>
                        <td><?php echo $employeeInfo['position']; ?></td>
                        <td class='deliverablesDate'></td>
                        <td class='deliverablesDay'></td> 
                        <td class='deliverablesLogs'>9</td>
                        <td><button>Daily Tasks</button></td>
                    </tr>

                <?php } while($employeeInfo = $employees->fetch_assoc()); ?>

            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>