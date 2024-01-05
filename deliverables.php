<?php include 'force_login.php'; ?>
<?php $page = 'deliverables'; include 'header.php'; ?>
<?php include_once("sidebar.php"); ?>
<?php include_once("deliverables_employee.php"); ?>

<div class='grid-right__content'>
    <div class='project-title mt-4'>
        <div class="float-start">
            <h1>Employee Timeline</h1>
            <div class="searchEmployee">
               
                <label>Search Employee:</label>
                <input class='deliverablesSearch' type="text" placeholder="Last Name or Department" size="25">
         
            </div>
        </div>

        <div class='deliverablesCalendar'>
            <label for="">Select Date:</label>
            <input class='deliverablesDates' type="date">
        </div>
    </div>
    <div class="content-table deliverablesContent">

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
                        <td class='deliverablesLogs'></td>
                        <td class='deliverablesTasks_wrapper'>
                            <button class='deliverablesDailyTasks'>Daily Tasks</button>
                            <div class='deliverablesTasks d-none'>

                            </div>
                        </td>
                    </tr>

                <?php } while($employeeInfo = $employees->fetch_assoc()); ?>

            </tbody>
        </table>

    </div>

    <!-- <div class="loading-content-overlay"></div>    -->
    <!-- <div class="loading-content d-none">
        <img src="img/loading-3.gif" alt="">
    </div>  -->
</div>

<?php include 'footer.php'; ?>