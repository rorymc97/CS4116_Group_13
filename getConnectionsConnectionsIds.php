<?php
session_start();
?>
<?php
// given a user ID return connections connections ids
function getConnectionsConnectionsIds($userConnections){
    
    $userConnectionsConnections=[];
    foreach($userConnections as $k=>$v){
        
        array_push($userConnectionsConnections,getConnectionsFromUserId($v));
    }
    return $userConnectionsConnections;
}
?>
<?php/**
// test the function
echo "<br>getConnectionsConnectionsIds<br>";
include 'getConnectionsFromUserId.php';
print_r(getConnectionsConnectionsIds(getConnectionsFromUserID(2)));*/
?>