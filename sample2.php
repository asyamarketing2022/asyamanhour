<?php $page = 'usersReport'; include 'header.php'; 

?>
<?php include("sidebar.php"); ?>
<?php include("usersReport-table.php"); ?>

<div class="grid-right__content">

    <div class="select-action__wrapper mt-4">
        <div class="select-action__sort">
            <h1 class="xxx"></h1>
            <span>
                <i class="fa fa-sort-amount-desc"></i>
                Sort By
            </span>
            <select class="form-select" aria-label="Default select example">
                <option selected="">Name</option>
                <option value="1">One</option>
                <option value="2">Two</option>
                <option value="3">Three</option>
            </select>
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

            <form action="" method="GET">
                <div class="search-action__wrapper mt-4">
                    <div class="input-group search-action">
                        <input class="search" name="search" value="" type="text">
                        <button type="submit" class="search-button">Search</button>
                        &nbsp;
                        <a href="usersReport-table_csv.php" class="submit-button download button">Download CSV</a>
                        &nbsp;
                        <select class="form-select dataLimit" aria-label="Default select dataLimit">

                            <option value="3">Show 3 per Page</option>
                            <option value="10">Show 10 per Page</option>
                            <option value="200">Show 200 per Page</option>
                        </select>
                    </div>             
                </div>
                <tbody class="dito">
                <!-- usersReport-table.php -->

                
                </tbody>
            </form>
        </table>
    </div>
</div>

<?php include 'footer.php'; ?>