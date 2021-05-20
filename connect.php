
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
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Network Page</title>
    </head>
    <body>
        
        <div class="menu">
            <?php require 'header.php';?>
        </div>
            
    </body>
</html>
<?php
// takes current user and a new user and makes a connection

    require "includes/dbh-inc.php";
    
    
    if($_GET['currentUserId'] && $_GET['toConnectUserId']){
    if($_GET['currentUserId']!=$_SESSION['toConnectUserId']){
    $currentConnections = getConnectionsFromUserID($_GET['currentUserId']);
    //echo "current connections: ";
    //print_r($currentConnections);
    
        if(!(in_array($_GET['toConnectUserId'],$currentConnections))){

            $currentUserId = $_SESSION['userID'];
            $toConnectUserId = $_GET['toConnectUserId'];
            //echo "<br>currentUserId".$currentUserId;
            //echo "<br>toConnectUserId".$toConnectUserId;
            $sql = "INSERT INTO Connections (UserA_Id,UserB_Id,Connection_Date)
            VALUES ({$currentUserId}, {$toConnectUserId}, curdate())";

            if ($conn->query($sql) === TRUE) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else{
            echo "<br>Already a connection!";
        }

    $conn->close();
    }
    else if($_GET['currentUserId'] && !$_GET['toConnectUserId']){
        echo "current user Id but no to connect user id ";
    }
    else if(!$_GET['currentUserId'] && $_GET['toConnectUserId']){
        echo "no current user Id but have to connect user id ";
    }
    else if(!$_GET['currentUserId']&&!$_GET['toConnectUserId']){
        echo "have neither currentUserId or toConnectUserId";
    }
    }

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

//print_r(getConnectionsFromUserID(2));
?>
