<?php
// Start the session
session_start();
?>
<?php 

require "includes/dbh-inc.php";
echo "<br>";
require "getUserSkills.php";
echo "<table>";
echo "<tr>
        <th>Skills</th>
    </tr>";
// $_SESSION["userSkills"] is an associative array 
foreach($_SESSION["userSkills"] as $x=>$x_value){
    echo "<tr><td>".$x_value."</td></tr>";
}


?>