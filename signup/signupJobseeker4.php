<?php
    session_start();
    require "signupheader.php";

?>

<html>
<head>
    <title> Munster jobs management </title>
    <link rel="stylesheet" type="text/css" href="signup.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
<div class="container">
        <form style="max-width: 300px; "action="signupProcess4.php" method="POST">
            <h2>Step 4/4: Employment History</h2>
            <table>
                <tr>
                <td>Company</td> 
                    <td>
                        <select name="company" id="company" required>
                        <option value="" disabled selected>--Select Company--</option>
                        <option value="Dell">Dell</option>
                        <option value="Analog Devices">Analog Devices</option>
                        <option value="Vistakon">Vistakon</option>            
                        <option value="Ericson">Ericson</option>
                        <option value="Genesys">Genesys</option>
                        <option value="Microsoft">Microsoft</option>
                        <option value="Amazon">Amazon</option>
                        </select>
                    </td>
                </tr>  
                <tr> 
                <td>Role</td>                  
                    <td>
                        <input type="text" name="role" id="role" placeholder="Role" required>
                    </td> 
                </tr>
                <tr><br>
                    <td>Start Date</td>                   
                    <td>
                        <input type="date" id="start" name="start"
                                value="dd-mm-yyyy"
                                min="1960-01-01" max="2021-03-23" required>
                    </td>  
                </tr> 
                <tr>                 
                    <td>End Date</td>                    
                    <td>
                        <input type="date" id="end" name="end"
                                value="dd-mm-yyyy"
                                min="1960-01-01" max="2021-03-23" required>
                    </td>
                </tr>
            </table>
            <input class="btn" name="Submit" id="Submit" type="Submit" value="Continue"></input>
            <br><br>
            <a href="../login2.php">Already have an account? Login here</a>  

            
       <?php

        if(isset($_GET["error"])){

            if($_GET["error"] == "emptyinput"){
                echo "<p style='margin: 20px 90px; color: red; text-align: center;'>***Please fill in all fields!</p>";
            }

            else if($_GET["error"] == "stmtfailed"){
                echo "<p style='margin: 20px 90px; color: red; text-align: center;'>***Something went wrong! Please try again!</p>";               
            }  

            else if($_GET["error"] == "wrongdates"){
                echo "<p style='margin: 20px 90px; color: red; text-align: center;'>***End date must be later than start date!</p>";               
            }

            else if($_GET["error"] == "invaliddate"){
                echo "<p style='margin: 20px 90px; color: red; text-align: center;'>***Please enter a valid date!</p>";
            }
        }

        ?>
        </form>
        </div>
</body>
</html>