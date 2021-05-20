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
        <title>Network Page</title>
    </head>
    <body>
        
        <div class="menu">
            <?php require 'header.php';?>
        </div>
            
    </body>
</html>
<?php
// takes current user and another user and deletes connection

    require "includes/dbh-inc.php";
    
    if($_GET['currentUserId']&&$_GET['toDisconnectUserId']){
        
        $currentUserId = $_GET['currentUserId'];
        $toDisconnectUserId = $_GET['toDisconnectUserId'];
    
        $sql = "DELETE From Connections 
                WHERE UserA_Id={$currentUserId} AND UserB_Id={$toDisconnectUserId};";

        if ($conn->query($sql) === TRUE) {
            echo "Disconnected";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    $conn->close();
    }

?>
