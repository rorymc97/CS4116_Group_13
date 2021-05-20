<?php //dbase001.php

require "includes/dbh-inc.php";
echo "<br>";

$sql = "select * from Users;";
$result = $conn->query($sql);

if ($result->num_rows > 0){
echo "<table>";
echo "<tr>
        <th>UID</th>
        <th>Email</th>
        <th>Type</th>
        <th>Status</th>
        
    </tr>";
// output the data of each row
 while($row = $result->fetch_assoc())
 {
   
    echo "<tr>";
    echo "<td>{$row["User_Id"]}</td>
    <td>{$row["Email"]}</td>
    <td>{$row["Type"]}</td>
    <td>{$row["Status"]}</td>";
   
    
    echo "</tr>";
 }
 echo "</table>";
} else{
    echo "0 results";
}


$conn->close();
?>