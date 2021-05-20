<?php
session_start();
?>
<?php
include 'getUserFromId.php';
include 'getUserIdFromEmail.php';
// display suggested connections given users connections' connections
function displayUserConnectionsConnections($userConnectionsConnections){
    $currentUserId = getUserIdFromEmail('patrick@gmail.com');
    
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
            
            $user = getUserFromId($v2);
            

            echo "<tr>";
            echo "<td>{$user[0]["Firstname"]}</td>
                    <td>{$user[0]["Lastname"]}</td>
                    <td>{$user[0]["Bio"]}</td>
                    <td>{$user[0]["Type"]}</td>
                    
                    <td><a href='connect.php?currentUserId=$currentUserId&toConnectUserId=$v2'>connect</a></td>";   
                    echo "</tr>";
 
            
            
        }
    }
    echo "</table>";
}
?>
<?php 
//test the function
include 'getConnectionsConnectionsIds.php';
include 'getConnectionsFromUserId.php';
include 'getUserIdFromEmail.php';
include 'getUserFromId.php';
echo "<br>connections from user id 2<br>";
print_r(getConnectionsFromUserId(2));
echo "<br>connections connections<br>";
print_r(getConnectionsConnectionsIds(getConnectionsFromUserId(2)));
displayUserConnectionsConnections(getConnectionsConnectionsIds(getConnectionsFromUserId(2)));
?>