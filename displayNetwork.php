
<?php
// Start the session
session_start();
?>

<?php 

require "includes/dbh-inc.php";
require 'getUserIdFromEmail.php';
$currentUserId = getUserIdFromEmail($_SESSION['userEmail']);
echo "<br>";

$sql = "SELECT Connections.UserA_Id, UserA.Email AS EmailA, Connections.UserB_Id, UserB.Email AS EmailB,UserB.Firstname,UserB.Lastname,UserB.Bio
FROM Connections
LEFT JOIN Users UserA ON UserA.User_Id = Connections.UserA_Id 
LEFT JOIN Users UserB ON UserB.User_Id = Connections.UserB_Id";
// Store the result of the query in $result
$result = $conn->query($sql);
// check that there is rows in result
if ($result->num_rows > 0){
echo "<table>";
echo "<tr>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Bio</th>
        <th>Disconnect</th>
        
    </tr>";
// output the data of each row
 while($row = $result->fetch_assoc())
 {
    if($row["EmailA"]==$_SESSION["userEmail"]){
        $userBId = $row['UserB_Id'];
        echo "<tr>";
        echo "<td>{$row["Firstname"]}</td>
        <td>{$row["Lastname"]}</td>
        <td>{$row["EmailB"]}</td>
        <td>{$row["Bio"]}</td>
        <td><a href='disconnect.php?currentUserId=$currentUserId&toDisconnectUserId=$userBId'>disconnect</a></td>";
   
    
        echo "</tr>";
    }
    else{
        //echo "Problem";
    }
 }
 echo "</table>";
} else{
    echo "0 results";
}


$conn->close();
?>
