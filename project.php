<?php $page = 'project'; include 'header.php'; ?>
<?php include 'add-project.php'; ?>
<?php include 'update-project.php'; ?>
<?php include 'project-table.php'; ?>
<?php include 'managers-table.php'; ?>
<?php include 'assign-project.php'; ?>
<?php include 'project-history.php'; ?>
<?php include 'departmentManager.php'; ?>


<?php include("sidebar.php"); ?>

        <div class="grid-right__content">
            <div class="search-action__wrapper mt-4">
                <div class="float-start">
                    <h1>Projects</h1>
                </div>
                <!-- <div class="search-action">
                    <input class="search" type="text">
                    <div class="search-button">Search</div>
                </div> -->

                <?php if(isset($_SESSION['UserLogin']) && $_SESSION['Access'] == "admin") { ?>

                <button type="button" class="btn add_project" data-toggle="modal" data-target="#add_project"><i class="fa fa-plus"></i> Add Project</button>

                <?php } ?>
            </div>
                    
            <!-- <div class="select-action__wrapper mt-4">
                <div class="select-action__sort">
                    <span><i class="fa fa-sort-amount-desc"></i> Sort by</span>
                    <select class="form-select" aria-label="Default select example">
                        <option selected>Name</option>
                        <option value="3">3</option>
                        <option value="5">5</option>
                        <option value="8">8</option>
                    </select>
                </div> 
            </div> -->

            <div class="content-table">
                <table>
                    <tr>
                        <th>Project Name</th>
                        <th>Location</th>
                        <th>Lot Areas</th>
                        <th>Typology</th>
                        <th>Company Name</th>
                        <th>Client Name</th>
                        <!-- <th></th> -->
                    </tr>
                    
                    <!-- project-table.php for SQL -->

                    <form action="" method="POST">

                        <?php if(!empty($projectInfo['id'])) { ?>

                            <?php do { ?>
                                <tr class="table-row_projects select_project table-form" value="<?php echo $projectInfo['id'] ?>" data-href="viewproject.php?ID=<?php echo $projectInfo['id'] ?>">
                                    <td><?php echo $projectInfo['project_name'] ?></td>
                                    <td><?php echo $projectInfo['location'] ?></td>
                                    <td><?php echo $projectInfo['lot_areas'] ?></td>
                                    <td><?php echo $projectInfo['typology'] ?></td>
                                    <td><?php echo $projectInfo['company_name'] ?></td>
                                    <td><?php echo $projectInfo['client_name'] ?></td>

                                    <?/* php if(isset($_SESSION['UserLogin']) && $_SESSION['Access'] == "admin") { */?>
         
                                        <!-- <td><a class="" href="viewproject.php?ID=<?/*php echo $projectInfo['id'] */?>">View</a></td> -->
                                        
                                    <?/*php } */?>

                                </tr>
                            <?php } while($projectInfo = $project->fetch_assoc()); ?>

                         <?php } ?>   

                    </form>
                </table>
            </div>
        </div>
    <!-- </div> -->

<!-- Add New Project - Modal -->    
<div class="modal fade pop-up__modal" id="add_project" tabindex="-1" role="dialog" aria-labelledby="addNewProjectTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">Add New Project</span>
            <form class="project-form " action="" method="post">
                    <div class="project">
                        <div class="content-info__wrapper assign">
                            <div class="content__info"> 
                                <span>Project Name</span>
                                <input type="text" name="projectName" required>
                            </div>
                            <div class="content__info"> 
                                <span>Location</span>
                                <input type="text" name="location" required>
                            </div>
                            <div class="content__info"> 
                                <span>Lot areas</span>
                                <input type="text" name="lotAreas" required>
                            </div>
                            <div class="content__info" id="services"> 
                                <span>Services</span>
                                <div class="services_wrapper"><img src="" alt="">
                                    <div class="form-check services">
                                        <input class="form-check-input cb-services" name="serviceArch" type="checkbox" value="1" id="architecture">
                                        <label class="form-check-label" for="flexCheckDefault">
                                            Architecture
                                        </label>
                                    </div>
                                    <div class="form-check services">
                                        <input class="form-check-input cb-services" name="serviceEngi" type="checkbox" value="1" id="engineering">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Engineering
                                        </label>
                                    </div>
                                    <div class="form-check services">
                                        <input class="form-check-input" name="serviceInterior" type="checkbox" value="1" id="interiorDesign">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Interior Design
                                        </label>
                                    </div>
                                    <div class="form-check services">
                                        <input class="form-check-input" name="serviceMasterplanning" type="checkbox" value="1" id="masterPlanning">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Master Planning
                                        </label>
                                    </div>
                                    <div class="form-check services">
                                        <input class="form-check-input" name="serviceScalemodel" type="checkbox" value="1" id="scaleModel">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Scale Model
                                        </label>
                                    </div>
                                    <div class="form-check services">
                                        <input class="form-check-input" name="serviceAnimation" type="checkbox" value="1" id="animation">
                                        <label class="form-check-label" for="flexCheckChecked">
                                            Animation
                                        </label>
                                    </div>
                                </div>
                            </div>
       
                            <div class="content__info"> 
                                <span>Typology</span>
                                <select name="typology" aria-label="Default select" required>
                                    <option value="" disabled selected>Select your option</option>
                                    <option value="residential">Residential</option>
                                    <option value="office">Office</option>
                                    <option value="commercial/retail">Commercial/Retail</option>
                                    <option value="hospitality">Hospitality</option>
                                    <option value="institutional">Institutional (Pls Specify)</option>
                                    <option value="industrial">Industrial (Pls Specify)</option>
                                    <option value="airport/aviation">Airport/Aviation</option>
                                    <option value="transportTerminal">Transport Terminal</option>
                                    <option value="religiousBuilding">Religious Building</option>
                                    <option value="mixedUse">Mixed Use (Pls Specify)</option>
                                </select>
                            </div>
                            <div class="content__info"> 
                                <span>Company Name</span>
                                <input type="text" name="companyName">
                             </div>
                            <div class="content__info"> 
                                <span>Client Name</span>
                                <input type="text" name="clientName">
                            </div>
                            <div class="content__info"> 
                                <span>Allotted Hours</span>
                                <input type="number" name="allottedHours">
                            </div>
                        </div>
                    </div>
                <div class="button-wrapper">
                    <input class="submit-button" name="submit_project" type="submit" value="Save"/>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Edit Project - Modal -->
<div class="modal fade pop-up__modal" id="edit_project" tabindex="-1" role="dialog" aria-labelledby="addNewProjectTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">Edit Project</span>
            <form class="project-form" action="" method="post">
                 <!-- update-project.php -->
                <div class="updateform-project">

                </div>
                <div class="button-wrapper">
                    <input class="submit-button" name="submit-updateProject" type="submit" value="Save">
                </div>
             </form>
        </div>
    </div>
</div>


<!-- View Project - Modal -->
<!-- <div class="modal fade pop-up__modal" id="view_project" tabindex="-1" role="dialog" aria-labelledby="addNewProjectTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">View Project</span>
            <form class="project-form" action="" method="">
                <div class="assignform-project">
                                
                </div>
                <div class="button-wrapper">
                    <input class="submit-button" name="" type="button" data-toggle="modal" data-target="#pick_project" value="Pick">
                </div>
            </form>
        </div>
    </div>
</div> -->

<!-- Assign Project - Modal -->
<div class="modal fade pop-up__modal" id="assign_project" tabindex="-1" role="dialog" aria-labelledby="assignProject" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document" style="max-width: 1700px;">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <span class="modal-title">Assign Project</span>
            <form class="project-form" action="" method="POST">
                <div class="pick-project_form">
                    <div class="assignform-project">
                        <!-- kindly check assign-project.php for dynamic content -->   
                    </div>

                    <div class='assign-form'>
                        <div class='content-info__wrapper assign'>
                            <div class='content__info'> 
                                <span>Date Start</span>
                                <p>Date will start when all participants accept the project invation</p>
                                <!-- <input class='input dateToday' name='dateStart' type='date' id='formControlDefault' value=''> -->
                            </div>
                            <div class='content__info'> 
                                <span>Target End Date</span>
                                <input class='input' type='date' name='dateEnd' id='formControlDefault' value='' required>
                            </div>

                            <div class='content__info'> 
                                <span>Manager</span>
                                <div class="search-action__wrapper">
                                    <div class="search-action search-nb">
                                        <input class="searchUser-input" type="text">
                                        <div class="search-button">Search</div>
                                    </div>
                                    <table class="">
                                        <!-- managers-table.php for php code -->
                                        
                                        <form action="" method="POST">

                                            <?php if(!empty($managerInfo['ID'])) { ?>

                                                <?php do { ?>   
                                                <tr class="search-user <?php echo $managerInfo['ID'] ?>" id="<?php echo $managerInfo['ID'] ?>" value="<?php echo $managerInfo['ID'] ?>" >
                                                    <td class='nameofuser'><?php echo $managerInfo['first_name'] ?> <?php echo $managerInfo['last_name'] ?></td>
                                                    <td><?php echo $managerInfo['position'] ?></td>
                                                    <td><?php echo $managerInfo['email'] ?></td>
                                                    <td><?php echo $managerInfo['department'] ?></td>
                                            
                                                    <td><span class="pickBtn" value="<?php echo $managerInfo['ID'] ?>">Add</span></td>
                                                </tr>
                                                <?php } while($managerInfo= $manager->fetch_assoc()); ?>

                                            <?php } ?>
                                        </form>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                    
                <div class="button-wrapper">
                    <!-- <input class="submit-button" name="submit" type="submit" value="Save"/> -->
                    <input class="submit-button" name="submitAssign" type="submit" value="Assign">
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>