<?php
// session start
session_start();
?>
<?php
// given a  user ID return the user details
function getUserFromId($userID){
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
?>
<?php 
// test the function
//print_r(getUserFromId(2));
?>