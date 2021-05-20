<?php
// Start the session
session_start();
?>

<?php

// given a user ID return the users connections's user id's
function getConnectionsFromUserId($userID){
    require "includes/dbh-inc.php";
    $userConnectionsIDs = [];
    $sql = "SELECT Connections.UserB_Id
        FROM Connections
        WHERE Connections.UserA_Id = {$userID};";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            array_push($userConnectionsIDs,$row['UserB_Id']);
        }
    }
    
    return $userConnectionsIDs;
}
?>
<?php/
// test the function
/**
echo "<br>getConnectionsFromUserId<br>";
print_r(getConnectionsFromUserId(2));*/
?>