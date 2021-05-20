<?php
session_start();
?>
<?php
// given a users email return the user ID
function getUserIdFromEmail($userEmail){
    require "includes/dbh-inc.php";    
    $sql = "SELECT User_Id
            FROM Users
            WHERE Email LIKE '{$userEmail}' ";   
    $userId = [];
    $result = $conn->query($sql);   
    // check that there is rows in result
    if ($result->num_rows > 0){   
    // The fetch_assoc() / mysqli_fetch_assoc() function fetches a result row as an associative array.
    // Note: Fieldnames returned from this function are case-sensitive.
        while($row = $result->fetch_assoc())
        {           
            array_push($userId,$row);       
        }
    }
    
    return $userId[0]['User_Id'];
}
?>
<?php
/**
// test the function
echo "<br>getUserIdFromEmail<br>";
print_r(getUserIdFromEmail('patrick@gmail.com'));*/
?>