<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="CSS/footer.css">
        <link rel="stylesheet" type="text/css" href="CSS/search.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <title>Network Page</title>
    </head>
    <body>
        
        <div class="menu">
            <?php require 'header.php';?>
        </div>
        
<?php

// given a user ID return the users connections's user id's
function getConnectionsFromUserID($userID){
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

// given a user ID return connections connections ids
function getConnectionsConnectionsIDs($userConnections){
    
    $userConnectionsConnections=[];
    foreach($userConnections as $k=>$v){
        
        array_push($userConnectionsConnections,getConnectionsFromUserID($v));
    }
    return $userConnectionsConnections;
}
    
// display suggested connections given users connections' connections
function displayUserConnectionsConnections($userConnectionsConnections){
    
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
    foreach($userConnectionsConnections as $k1=>$v1){
        
        foreach($v1 as $k2=>$v2){
            if($v2!=$currentUserId){
                if(!in_array($v2,$displayedUsers)){
                array_push($displayedUsers,$v2);
                
                $user = getUserFromID($v2);
            
                $toConnectUserId = $v2;
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
    }
    echo "</table>";
}


?>
<?php
$userId = $_SESSION['userID'];

$userConnections = getConnectionsFromUserID($userId);
//echo "<br>userConnections<br>";
//print_r($userConnections);
$userConnectionsConnections = getConnectionsConnectionsIDs($userConnections);
//echo "<br>userConnectionsConnections<br>";
//print_r($userConnectionsConnections);
echo "<h3>You have mutual connections with: </h3>";
displayUserConnectionsConnections($userConnectionsConnections);

$conn->close();

?>

    </body>
</html>
    
  
   