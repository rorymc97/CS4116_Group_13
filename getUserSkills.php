<?php
// Start the session
session_start();
?>
<?php 

require "includes/dbh-inc.php";
echo "<br>";
// SQL query for all user skills
$sql = "SELECT Users.Email,Skills.Skill_Name
FROM UserSkills
LEFT JOIN Users ON Users.User_Id = UserSkills.User_Id
LEFT JOIN Skills ON Skills.Skill_Id = UserSkills.Skill_Id";
$userSkills=[];
$result = $conn->query($sql);
// check that there is rows in result
if ($result->num_rows > 0){

// The fetch_assoc() / mysqli_fetch_assoc() function fetches a result row as an associative array.
// Note: Fieldnames returned from this function are case-sensitive.
// store the rows for current user in session variable
 while($row = $result->fetch_assoc())
 {
    
    if($row["Email"]==$_SESSION["userEmail"]){
        array_push($userSkills,$row["Skill_Name"]);
        
        
    }
    
 }
 
}
// store user qualifications in a session variable
$_SESSION['userSkills'] = $userSkills; 

$conn->close();
?>