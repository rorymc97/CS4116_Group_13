<!DOCTYPE html>
<html lang="en">
     <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>List Users</title>
        <link rel="stylesheet" type = "text/CSS" href="CSS/lists.css">
    </head>
    <body style="background-image: url('background.jpg');">
        <div class="menu">
            <?php 
            include 'headeradmin.php';
            include 'editProfileProcess.php';
            ?>
        </div>
    <div class="container p-4" style="background-color: white; width: 1000px; min-width:700px; margin-top: 20px; margin-bottom: 20px; "> 
        <center>
        <h1>Users</h1>
        <HR>
        <p>Displayed below are all users</p> 
        <div class="vacancies_display">
            <?php //dbase001.php

                require "includes/dbh-inc.php";
                
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
                    $uid = $row['User_Id'];
                    $status = $row["Status"];
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

                    echo "<td><a href='deleteUser.php?uid=$uid'>Delete</a></td>";
                    echo "<td><a href='editProfile.php?uid=$uid'>Edit Profile</a></td>";
                    echo "</tr>";
                }

                echo "</table>";
                } else{
                    echo "0 results";
                }


                $conn->close();
            ?>

            <script>
                function clicked(e)
                {
                    if(!confirm('Are you sure?')) {
                        e.preventDefault();
                    }
                }
            </script>

        </div>   
      
    </div> 
    </body>
<?php
 require "footer.php";
 ?>
</html>