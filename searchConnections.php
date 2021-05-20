<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
       <!-- <link rel="stylesheet" type="text/css" href="CSS/footer.css">-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="CSS/search.css">
        <title>Network Page</title>
    </head>
    <body>
        
        <div class="menu">
            <?php require 'header.php';?>
        </div>
            
    </body>
  
</html>
<?php
session_start();
$userEmail = $_SESSION['userEmail'];
require "includes/dbh-inc.php";

$input = $_POST['search'];

//echo "<br>Current user email: ".$userEmail."<br>";
$currentUserId = $_SESSION['userID'];
//echo "current user id: ".$currentUserId;
$toConnectUserId;
// want to be able to search by firstname, lastname, 

$sql = "SELECT Users.User_Id

FROM Users  
LEFT JOIN UserSkills ON Users.User_Id = UserSkills.User_Id
LEFT JOIN UserQualifications ON Users.User_Id = UserQualifications.User_Id
LEFT JOIN Skills ON Skills.Skill_Id = UserSkills.Skill_Id
LEFT JOIN Qualifications ON Qualifications.Qualification_Id = UserQualifications.Qualification_Id

WHERE Users.Firstname LIKE '%$input%' OR Users.Lastname LIKE '%$input%' OR Users.Bio LIKE '%$input%' 
OR Skills.Skill_Name LIKE '%$input%' OR 
Qualifications.Qualification_Type LIKE '%$input%' OR Qualifications.Qualification_Field LIKE '%$input%';";
$userIds = [];
$result = $conn->query($sql);
if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            array_push($userIds,$row['User_Id']);
        }
    }
$userIds = array_unique($userIds);
//print_r($userIds);
displayUsers($userIds);
// given a  user ID return the user details
function getUserFromID($userID){
    require "includes/dbh-inc.php";
    $user = [];
    $sql = "SELECT User_Id,Firstname,Lastname,Email,Bio,Type 
            FROM Users 
            WHERE User_Id = {$userID} AND Status = 'active';";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            array_push($user,$row);
        }
    }
    return $user;
}
// display suggested connections given users connections' connections
function displayUsers($userIds){
    
    $currentUserId = $_SESSION['userID'];
    $user;
    $toConnectUserId;
    $displayedUsers = [];
    //echo $currentUserId;
    echo "<table>";
            echo "<tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Bio</th>
                <th>Type</th>
                <th>Connect</th>
        
                </tr>";
    foreach($userIds as $key=>$value){
        
        
            if($value!=$currentUserId){
                if(!in_array($value,$displayedUsers)){
                array_push($displayedUsers,$value);
                
                $user = getUserFromID($value);
            
                $toConnectUserId = $value;
                echo "<tr>";
                echo "<td>{$user[0]["Firstname"]}</td>
                    <td>{$user[0]["Lastname"]}</td>
                    <td>{$user[0]["Bio"]}</td>
                    <td>{$user[0]["Type"]}</td>
                   <td><a href='connect.php?currentUserId=$currentUserId&toConnectUserId=$toConnectUserId'>connect</a></td>";   
                echo "</tr>";
 
                
            }
        }
    }
    echo "</table>";
}/**
$count;

// Code Continues.

if ($_POST['search'] != null ) {

    
    while($row = $result->fetch_assoc()) {
        
        $count++;
        
        if($count != 0) {
            $thisUserEmail = $row['Email'];
            $toConnectUserId = getUserIDFromEmail($thisUserEmail);
            echo "<table border=2>";
        
            echo 
                "<tr>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Bio</th>
                <th>Connect</th>
                </tr>";

            // Output our SQL Query
            echo "<tr>";
            echo 
                "<td>{$row["Firstname"]}</td>
                <td>{$row["Lastname"]}</td>
                <td>{$row["Bio"]}</td>
                <td><a href='connect.php?currentUserId={$currentUserId}&toConnectUserId={$toConnectUserId}'>connect</a></td>";        
        
            echo "</tr>";

            echo "</table>";
           

        }   
             
    }

    if($count == 0) {
        echo "Couldn't Find Connections Please Try Again";
    }


}

else {
    echo "Couldn't Find any Connnections Please Try Again!!!";
}*/
    //Closing Our Connection to the Database
    $conn->close();

    //require "footer.php";




?>