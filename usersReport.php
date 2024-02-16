<?php include 'force_login.php'; ?>
<?php $page = 'usersReport'; include 'header.php'; 

?>
<?php include("sidebar.php"); ?>
<?php include("usersReport-table.php"); ?>
<?php include("pagination.php"); ?>

<div class="grid-right__content">


    <div class="content-table">
        <div class="select-action__sort show pagination-filter">
            <select class="form-select dataLimit" aria-label="Default select dataLimit">
                <option value="10" selected disabled>Sort By</option>
                <option value="3">3</option>
                <option value="10">10</option>
                <option value="50">50</option>
                <option value="100">100</option>
            </select>   

            <div class="pageBtn_container">

                <!-- usersReport-table.php  -->

                <span class='pagination_link_prev' style='cursor:pointer; padding:6px; border:1px solid #ccc;'><</span>

                <div class="pageBtn">

                    <?php echo $pages;?>

                </div>

                <span class='pagination_link_next' style='cursor:pointer; padding:6px; border:1px solid #ccc;' id='2'>></span>

            </div>

            <div class="employee_filter">
                <div class="search-action">
                    <input class="searchFilter" name="search" value="" type="text">
                    <button type="button" class="search-button submitFilter">Search</button>
                    &nbsp;
                    <!-- <a href="usersReport-table_csv.php" class="submit-button download button">Download CSV</a> -->
                    <!-- <p type="text" class="submit-button dl_csv">Download CSV</p> -->

                    <button type="submit" class="submit-button dl_csv">Download</button>

                </div>

            </div>
            
        </div>

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
           
                <?php 
                
                // do {  

                for($i = 0; $i != 10; $i++) {

                ?>
                    
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
                    
                <?php 

                }

            
                // } while($userRecord_info = $userRecord->fetch_assoc()); 
            
                ?>

                </tbody>

            </form>
            <!-- <div class="container">  
             
                <div class="table-responsive" id="pagination_data">  
                </div>  
           </div>  -->
        </table>
    </div>

</div>

<?php include 'footer.php'; ?>