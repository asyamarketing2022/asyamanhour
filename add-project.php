<?php 
if(!isset($_SESSION)){
    session_start();
}

include_once("connections/DBconnection.php");
include_once("EngrController.php");
// include_once("ProjectController.php");

$db = new DBconnection();
$con = $db->connection();

// $con = connection();

    if(isset($_POST['submit_project'])){

        $projectName = $_POST['projectName'];
        $location = $_POST['location'];
        $lotAreas = $_POST['lotAreas'];

        $serviceArch = isset($_POST['serviceArch']);

        $archConceptual = isset($_POST['arch_conceptual']);
        $manager_archConceptual_array = isset($_POST['conceptual_design']) ? $_POST['conceptual_design'] : [];
        $manager_archConceptual = implode(" ", $manager_archConceptual_array);

        $archSchematic = isset($_POST['arch_schematic']);
        $manager_archSchematic_array = isset($_POST['schematic_design']) ? $_POST['schematic_design'] : [];
        $manager_archSchematic = implode(" ", $manager_archSchematic_array);

        $archdesigndevelopment = isset($_POST['arch_designdevelopment']);
        $manager_archDesignDevelopment_array = isset($_POST['designDevelopment_production']) ? $_POST['designDevelopment_production'] : [];
        $manager_archDesignDevelopment = implode(" ", $manager_archDesignDevelopment_array);

        $archconstruction = isset($_POST['arch_construction']);
        $manager_archConstructionDrawings_array = isset($_POST['constructionDrawings_projectmanagement']) ? $_POST['constructionDrawings_projectmanagement'] : [];
        $manager_archConstructionDrawings = implode(" ", $manager_archConstructionDrawings_array);

        $archsite = isset($_POST['arch_site']);
        $manager_archSiteSupervision_array = isset($_POST['siteSupervision_projectmanagement']) ? $_POST['siteSupervision_projectmanagement'] : [];
        $manager_archSiteSupervision = implode(" ", $manager_archSiteSupervision_array);




        $serviceEngi = isset($_POST['serviceEngi']);

        $engiSchematic = isset($_POST['engi_schematic']);

        $engidesigndevelopment = isset($_POST['engi_designdevelopment']);

        $engiconstruction = isset($_POST['engi_construction']);






        $serviceInt = isset($_POST['serviceInterior']);

        $intConceptual = isset($_POST['interior_conceptual']);
        $manager_intConceptual_array = isset($_POST['conceptual_interiordesign']) ? $_POST['conceptual_interiordesign'] : [];
        $manager_intConceptual = implode(" ", $manager_intConceptual_array);

        $intdesignDevelopment = isset($_POST['interior_designdevelopment']);
        $manager_intDesignDevelopment_array = isset($_POST['designDevelopment_interiordesign']) ? $_POST['designDevelopment_interiordesign'] : [];
        $manager_intDesignDevelopment = implode(" ", $manager_intDesignDevelopment_array);

        $intConstruction = isset($_POST['interior_construction']);
        $manager_intConstruction_array = isset($_POST['constructionDrawings_interiordesign']) ? $_POST['constructionDrawings_interiordesign'] : [];
        $manager_intConstruction = implode(" ", $manager_intConstruction_array);

        $intSite = isset($_POST['interior_site']);
        $manager_intSite_array = isset($_POST['siteSupervision_interiordesign']) ? $_POST['siteSupervision_interiordesign'] : [];
        $manager_intSite = implode(" ", $manager_intSite_array);

        $serviceMaster = isset($_POST['serviceMasterplanning']);

        $masterConceptual = isset($_POST['masterplan_conceptual']);
        $manager_masterConceptual_array = isset($_POST['conceptual_masterplanning']) ? $_POST['conceptual_masterplanning'] : [];
        $manager_masterConceptual = implode(" ", $manager_masterConceptual_array);

        $masterSchematic = isset($_POST['masterplan_schematic']);
        $manager_masterSchematic_array = isset($_POST['schematic_masterplanning']) ? $_POST['schematic_masterplanning'] : [];
        $manager_masterSchematic = implode(" ", $manager_masterSchematic_array);

        $typology = $_POST['typology'];
        $companyName = $_POST['companyName'];
        $clientName = $_POST['clientName'];
        
        $sql = "INSERT INTO `pms_projects`(`project_name`, `location`, `lot_areas`, `service_architecture`, `arch_conceptual`, `arch_conceptual_manager`, `arch_schematic`, `arch_schematic_manager`, `arch_designdevelopment`, `arch_designdevelopment_manager`, `arch_construction`, `arch_construction_manager`, `arch_site`, `arch_site_manager`, `service_engineering`, `engi_schematic`, `engi_designdevelopment`, `engi_construction`, `service_interior`, `int_conceptual`, `int_conceptual_manager`, `int_designdevelopment`, `int_designdevelopment_manager`, `int_construction`, `int_construction_manager`, `int_site`, `int_site_manager`,`service_masterplanning`, `masterplanning_conceptual`, `masterplanning_conceptual_manager`, `masterplanning_schematic`, `masterplanning_schematic_manager`, `typology`, `company_name`, `client_name`) VALUES ('$projectName', '$location', '$lotAreas', '$serviceArch', '$archConceptual', '$manager_archConceptual', '$archSchematic', '$manager_archSchematic', '$archdesigndevelopment', '$manager_archDesignDevelopment', '$archconstruction', '$manager_archConstructionDrawings', '$archsite', '$manager_archSiteSupervision', '$serviceEngi', '$engiSchematic', '$engidesigndevelopment', '$engiconstruction', '$serviceInt', '$intConceptual', '$manager_intConceptual', '$intdesignDevelopment', '$manager_intDesignDevelopment', '$intConstruction', '$manager_intConstruction', '$intSite', '$manager_intSite', '$serviceMaster', '$masterConceptual', '$manager_masterConceptual', '$masterSchematic', '$manager_masterSchematic', '$typology', '$companyName', '$clientName')";

        $con->query($sql) or die ($con->error);

        $engrMechanical = new EngrController("mechanical_schematic", "mechanical_designdevelopment", "mechanical_constructiondrawing", "mechanical_manager");
        $engrMechanical->get_engr();
        
        $engrElectrical = new EngrController("electrical_schematic", "electrical_designdevelopment", "electrical_constructiondrawing", "electrical_manager");
        $engrElectrical->get_engr();

        $engrPlumbing = new EngrController("plumbing_schematic", "plumbing_designdevelopment", "plumbing_constructiondrawing", "plumbing_manager");
        $engrPlumbing->get_engr();

        $engrFirepro = new EngrController("fireprotection_schematic", "fireprotection_designdevelopment", "fireprotection_constructiondrawing", "fireprotection_manager");
        $engrFirepro->get_engr();

        $engrFirepro = new EngrController("structural_schematic", "structural_designdevelopment", "structural_constructiondrawing", "structural_manager");
        $engrFirepro->get_engr();

    }


    // if(isset($_POST['submit'])){

    //     $code = $_POST['code'];
    //     $projectName = $_POST['projectName'];
    //     $qualityCheck = $_POST['qualityCheck'];
    //     $fileType = $_POST['file_type'];
    //     $projectStyle = $_POST['projectTreeStyle'];
    //     $ignoreFile = $_POST['ignoreFiles'];
    //     $stringContact = $_POST['stringErrorsContact'];
    //     $screenSearch = $_POST['screenSearch'];
        
    //     $check = mysqli_query($con, "SELECT * FROM projects WHERE code = '$code'");
    //     $checkrows = mysqli_num_rows($check);

    //     if($checkrows > 0){

    //         echo "Project code was already registered";

    //     } else {

    //         $sql = "INSERT INTO `projects`(`code`, `project_name`, `quality_check`, `file_type`, `project_tree_style`, `ignore_files`, `string_error_contact`, `screenshot_search_prefix`) VALUES ('$code', '$projectName', '$qualityCheck', '$fileType', '$projectStyle', '$ignoreFile', '$stringContact', '$screenSearch')";

    //         $con->query($sql) or die ($con->error);

    //     }

    // }


//     if(isset($_POST['submit_project']))
// {

//     $design_manager_array = $_POST['design'];
//     $design_manager = implode(" ", $design_manager_array);

//     $inputData = [
//         'projectName' => mysqli_real_escape_string($conn,$_POST['projectName']),
//         'location' => mysqli_real_escape_string($conn,$_POST['location']),
//         'lotAreas' => mysqli_real_escape_string($conn,$_POST['lotAreas']),
//         'arch_conceptual_manager' => mysqli_real_escape_string($conn,$_POST['design']),
//     ];

//     $project = new ProjectController;
//     $result = $project->create($inputData);

//     if($result)
//     {
//         $_SESSION['message'] = "Project Added Successfully";
//         header("Location: project.php");
//         exit(0);
//     }
//     else
//     {
//         $_SESSION['message'] = "Not Inserted";
//         header("Location: project.php");
//         exit(0);
//     }
// }


    

?>