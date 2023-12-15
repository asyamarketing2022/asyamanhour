<?php $page = 'usersReport'; include 'header.php'; 

?>
<?php include("sidebar.php"); ?>
<?php include("usersReport-table.php"); ?>
<?php include("pagination.php"); ?>

<div class="grid-right__content">

    <div class="employee_filter">
        <div class="search-action">
            <input class="searchFilter" name="search" value="" type="text">
            <button type="button" class="search-button submitFilter">Search</button>
            &nbsp;
            <!-- <a href="usersReport-table_csv.php" class="submit-button download button">Download CSV</a> -->
            <!-- <p type="text" class="submit-button dl_csv">Download CSV</p> -->

            <button type="submit" class="submit-button dl_csv">Download</button>
            <div class="select-action__sort show float-start float-sm-end">
                <select class="form-select dataLimit" aria-label="Default select dataLimit">
                    <option value="100" selected disabled>Sort By</option>
                    <option value="3">3</option>
                    <option value="5">5</option>
                    <option value="8">8</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>

    </div>
    <div class="content-table">
        <table>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>User ID</th>
                <th>Position</th>
                <th>Department</th>
                <th>Action</th>
                <th>Action Status</th>
                <th>Source</th>
                <th>Added At</th>
            </tr>

            <form action="" method="POST">
                <tbody class="userhistory-table">
                <!-- usersReport-table.php -->
           
                <?php  do {  ?>
                    
                    <tr class='table-row_user Info_user table-form' value="<?php echo $userRecord_info['id'] ?>">
                        <td class='user-id'><?php echo $userRecord_info['id'] ?></td>
                        <td><?php echo $userRecord_info['user_name'] ?></td>
                        <td><?php echo $userRecord_info['user_id'] ?></td>
                        <td><?php echo $userRecord_info['user_position'] ?></td>
                        <td><?php echo $userRecord_info['department'] ?></td>
                        <td><?php echo $userRecord_info['action'] ?></td>
                        <td><?php echo $userRecord_info['action_status'] ?></td>
                        <td><?php echo $userRecord_info['source'] ?></td>
                        <td><?php echo $userRecord_info['added_at'] ?></td>
                    </tr>
                    
                <?php } while($userRecord_info = $userRecord->fetch_assoc());  ?>

                </tbody>

            </form>
            <div class="pageBtn">
   
            </div>
            <!-- <div class="container">  
             
                <div class="table-responsive" id="pagination_data">  
                </div>  
           </div>  -->
        </table>
    </div>

</div>

<?php include 'footer.php'; ?>