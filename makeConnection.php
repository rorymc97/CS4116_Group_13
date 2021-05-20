<?php
session_start();
?>
<?php
// make a button that says connect
function connectButton(){

}
// make a button that says disconnect
// takes current user and a new user and makes a connection
function connect($currentUserId, $toConnectUserId){
    require "includes/dbh-inc.php";
    
    $sql = "INSERT INTO Connections (UserA_Id,UserB_Id,Connection_Date)
        VALUES ({$currentUserId}, {$toConnectUserId}, curdate());";

    if ($conn->query($sql) === TRUE) {
        echo "You are now connected!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
// disconnect two users: delete the row
function disconnect($currentUserId,$toDisconnectUserId){
    require "includes/dbh-inc.php";
    
    $sql = "DELETE From Connections 
    WHERE UserA_Id={$currentUserId} AND UserB_Id={$toDisconnectUserId};";

    if ($conn->query($sql) === TRUE) {
        echo "Connection deleted";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
// given a users email return the user ID
function getUserIDFromEmail($userEmail){
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
$userId = getUserIDFromEmail('patrick@gmail.com');
echo $userId;
connect($userId,6);
disconnect($userId,6);
*/
?>