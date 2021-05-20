<?php
// Start the session
session_start();
?>
<?php 

require "includes/dbh-inc.php";
echo "<br>";
// SQL query for all user qualificaionts
$sql = "SELECT Users.Email,Qualifications.Qualification_Type,Qualifications.Qualification_Field
FROM UserQualifications
LEFT JOIN Users ON UserQualifications.User_Id = Users.User_Id
LEFT JOIN Qualifications ON UserQualifications.Qualification_Id = Qualifications.Qualification_Id";
$userQualifications=[];
$result = $conn->query($sql);
// check that there is rows in result
if ($result->num_rows > 0){

// The fetch_assoc() / mysqli_fetch_assoc() function fetches a result row as an associative array.
// Note: Fieldnames returned from this function are case-sensitive.
// store the rows for current user in session variable userQualifications as an array of associative arrays
 while($row = $result->fetch_assoc())
 {
    
    if($row["Email"]==$_SESSION["userEmail"]){
        array_push($userQualifications,$row);
    }
 }
 
}
// store user qualifications in a session variable
$_SESSION['userQualifications'] = $userQualifications; 

$conn->close();
?>