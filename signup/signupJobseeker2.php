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
        <form style="min-height: 500px" action="signupProcess2.php" method="POST">
            <h2>Step 2/4: Education</h2>
            <table font-family='DINPro',Arial,sans-serif;>

            <tr>
                <td>
                    <select name="QType" id="QType" required>
                    <option value="" selected=true disabled="disabled">-- Choose a type --</option>
                    <option value="bachelors">Bachelors</option>
                    <option value="masters">Masters</option>
                    <option value="phd">PhD</option>
                    </select>
                </td>
            </tr>            
            
            <tr>
                <td>
                    <select name="QField" id="QField" required>
                    <option value="" selected=true disabled="disabled">-- Choose a field --</option>
                    <option value="ECE">ECE</option>
                    <option value="IT">IT</option>
                    <option value="CS">Computer Science</option>            
                    <option value="Data Analytics">Data Analytics</option>
                    <option value="Mobile Comms">Mobile Comms</option>
                    <option value="Games Development">Games Development</option>
                    </select>
                </td>
            </tr>

            <tr>
            <td>
            <input type="date" id="QDate" name="QDate"
                                value=""
                                min="1960-01-01" max="2021-04-23" required> 
            </td>
            </tr>

            </table>
            <input class="btn" name="Submit" id="Submit" type="Submit" value="Continue"></input>
            <br><br>
            <a href="../login2.php">Already have an account? Login here</a>
            
         <?php

        if(isset($_GET["error"])){

            if($_GET["error"] == "invaliddate"){
                echo "<p style='margin: 20px 90px; color: red; text-align: center;'>***Please enter a valid date!</p>";
            }
        }


    ?>
        </form>
        </div>
</body>
</html>