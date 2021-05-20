<?php
// Start the session
session_start();
?>

<?php 

require "includes/dbh-inc.php";
echo "<br>";
require "getUserQualifications.php";

echo "<table>";
echo "<tr>
        <th>Qualification Type</th>
        <th>Qualification Field</th>             
    </tr>";
// output the data of each row
foreach($_SESSION["userQualifications"] as $x=>$x_value){
        echo "<tr>";
        foreach($x_value as $y=>$y_value){
            if($y!="Email"){
    	    echo "<td>". $y_value."</td>";
            }
        }
        echo "</tr>";
    }
    
$conn->close();
?>