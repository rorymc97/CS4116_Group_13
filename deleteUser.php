<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
     <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="CSS/lists.css">
        <title>List Users</title>
    </head>
    <body style="background-image: url('background.jpg')";>
        <div class="menu">
            <?php

            include "headeradmin.php";
            require "includes/dbh-inc.php";
            
            if($_GET['uid']){
                
                $uid = $_GET['uid'];
            
                $sql1 = "DELETE FROM Users 
                        WHERE User_Id IN (
                            SELECT User_Id FROM (
                                SELECT User_Id FROM Users WHERE User_Id={$uid}
                                ) as u
                            );";

                $sql2 = "DELETE FROM Companies 
                        WHERE user_id IN (
                            SELECT user_id FROM (
                                SELECT user_id FROM Companies WHERE user_id={$uid}
                                ) as t
                            );";

                $sql3 = "DELETE FROM UserQualifications 
                        WHERE User_Id IN (
                            SELECT User_Id FROM (
                                SELECT User_Id FROM UserQualifications WHERE User_Id={$uid}
                                ) as t
                            );";

                $sql4 = "DELETE FROM UserSkills
                        WHERE User_Id IN (
                            SELECT User_Id FROM (
                                SELECT User_Id FROM UserSkills WHERE User_Id={$uid}
                                ) as t
                            );";

                $sql5 = "DELETE FROM EmploymentHistory
                        WHERE User_Id IN (
                            SELECT User_Id FROM (
                                SELECT User_Id FROM EmploymentHistory WHERE User_Id={$uid}
                                ) as t
                            );";

                $sql6 = "DELETE FROM Connections
                        WHERE UserA_Id IN (
                            SELECT UserA_Id FROM (
                                SELECT UserA_Id FROM Connections WHERE UserA_Id={$uid}
                                ) as t
                            );";

                $sql7 = "DELETE FROM Connections
                        WHERE UserB_Id IN (
                            SELECT UserB_Id FROM (
                                SELECT UserB_Id FROM Connections WHERE UserB_Id={$uid}
                                ) as t
                            );";

                if (($conn->query($sql1) 
                &&  $conn->query($sql2)
                &&  $conn->query($sql3)
                &&  $conn->query($sql4)
                &&  $conn->query($sql5)
                &&  $conn->query($sql6)
                &&  $conn->query($sql7))=== TRUE) {
                    echo "User deleted successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

            $conn->close();
            }

        ?>
        </div>
    <div class="container p-4" style="background-color: white; width: 1000px; min-width:700px; margin-top: 20px; margin-bottom: 20px; "> 
        <center><h1>Users</h1>
        <HR>
        <p>Displayed below are all users</p> 
        <div class="vacancies_display">
            <?php //dbase001.php

                require "includes/dbh-inc.php";
                echo "<br>";

                $sql = "select * from Users;";
                $result = $conn->query($sql);

                if ($result->num_rows > 0){
                echo "<table id='lists'>";
                echo "<tr>
                        <th>UID</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th> </th>
                        <th> </th>
                        <th> </th>
                        
                    </tr>";
                // output the data of each row
                while($row = $result->fetch_assoc())
                {
                    $uid = $row["User_Id"];
                    echo "<tr>";
                    echo "<td>{$row["User_Id"]}</td>
                    <td>{$row["Email"]}</td>
                    <td>{$row["Type"]}</td>
                    <td>{$row["Status"]}</td>";

                    if($status=='banned'){
                        echo "<td><a onclick='clicked(event)' href='banUser.php?uid=$uid&status=$status'>Unban</a></td>";
                    }

                    else{
                        echo "<td><a onclick='clicked(event)' href='banUser.php?uid=$uid&status=$status'>Ban</a></td>";
                    }

                    echo "<td><a onclick='clicked(event)' href='deleteUser.php?uid=$uid'>Delete</a></td>";
                    echo "<td><a href='editProfile.php?uid=$uid'>Edit Profile</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
                } else{
                    echo "0 results";
                }


                $conn->close();
            ?>
        </div>   
      
    </div> 
    </body>
         <?php
 require "footer.php";
 ?>
</html>