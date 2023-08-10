<?php 

include_once("connections/DBconnection.php");

$db = new DBconnection();
$con = $db->connection();

    if(isset($_POST['Department'])){

        $dept = $_POST['Department'];
        
        $sql = "SELECT * FROM registered_users WHERE department = '$dept' AND access = 'manager'";
        $manager  = $con->query($sql) or die ($con->error);
        $managerInfo = $manager->fetch_assoc();

        do {

        //     echo "<form action='' method='POST'>
        //         <tr class='search-user ". $managerInfo['ID'] ."' id=". $managerInfo['ID'] ." value=". $managerInfo['ID'] ." ' >
        //             <td class='nameofuser'>" . $managerInfo['first_name'] . " " . $managerInfo['last_name'] . "</td>
        //             <td>" . $managerInfo['position'] . "</td>
        //             <td>" . $managerInfo['email'] . "</td>
        //             <td>" . $managerInfo['department'] . "</td>
        //             <td><span class='pickBtn' value='" . $managerInfo['ID'] . "'>Add</span></td>
        //         </tr>
        //         </form>
        //   ";

        echo "<ul class='search-user ". $managerInfo['ID'] ."' id=". $managerInfo['ID'] ." value=". $managerInfo['ID'] ." >
            <li>" . $managerInfo['ID'] . "</li>
            <li class='nameofuser'>" . $managerInfo['first_name'] . "  " . $managerInfo['last_name'] . "</li>
            <li>" . $managerInfo['position'] . "</li>

            <li><span class='addBtn' value='" . $managerInfo['ID'] . "'>Add</span></li>
        </ul>";

        } while($managerInfo = $manager->fetch_assoc());

    } else {

        echo "";

    }

?>