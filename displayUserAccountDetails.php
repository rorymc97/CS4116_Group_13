<?php
// Start the session
session_start();
?>
<?php 

require "includes/dbh-inc.php";
echo "<br>";

$sql = "SELECT Email, Password, Type, Status
FROM Users";
// Store the result of the query in $result
$result = $conn->query($sql);
// check that there is rows in result
if ($result->num_rows > 0){
echo "<table>";
echo "<tr>
        <th>Email</th>
        <th>Password</th>
        <th>Type</th>
        <th>Status</th>
        
    </tr>";
// output the data of each row
 while($row = $result->fetch_assoc())
 {
    if($row["Email"]==$_SESSION["userEmail"]){
        echo "<tr>";
        echo "<td>{$row["Email"]}</td>
        <td>{$row["Password"]}</td>
        <td>{$row["Type"]}</td>
        <td>{$row["Status"]}</td>";
   
    
        echo "</tr>";
    }
    else{
       // echo "Problem";
    }
 }
 echo "</table>";
} else{
    echo "0 results";
}


$conn->close();
?>