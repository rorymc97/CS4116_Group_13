<?php
session_start();
require "signupheader.php";
?>

<html>

<head>
    <title> Munster jobs management </title>
    <link rel="stylesheet" type="text/css" href="CSS/signup.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>


<body>
    <div class="container">
        <form action="/signup/signupProcess.php" method="POST">
        <h2 font-family='DINPro',Arial,sans-serif;>Step 1/4: Personal Details</h2>
            <table font-family='DINPro',Arial,sans-serif;>
                <tr>
                    <td>
                        <input type="text" name="fname" id="fname" placeholder="First Name" required>
                    </td>
                    <td>
                        <input type="text" name="lname" id="lname" placeholder="Last Name" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="email" name="email" id="email" placeholder="Email" required>
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="Password" name="pwd" id="pwd" placeholder="Password" required>
                    </td>
                    <td>
                        <input type="Password" name="pwdRepeat" id="pwdRepeat" placeholder="Re-Enter Password" required>
                    </td>
                </tr>                               
                <tr>
                    <td>
                        <input type="text" name="bio" id="bio" placeholder="Bio" required>
                    </td>
                </tr>
            </table>
            
            <input class="btn" name="Submit" id="Submit" type="Submit" value="Continue"></input>
            <br><br>
            <a href="login2.php">Already have an account? Login here</a>
            <?php

        if(isset($_GET["error"])){

            if($_GET["error"] == "emptyinput"){
                echo "<p style='margin: 20px 90px; color: red; text-align: center;'>***Please fill in all fields!</p>";
            }

            else if($_GET["error"] == "invalidemail"){
                echo "<p style='margin: 20px 90px; color: red; text-align: center;'>***Please choose a proper email!</p>";               
            }

            else if($_GET["error"] == "emailexists"){
                echo "<p style='margin: 20px 90px; color: red; text-align: center;'>***Email already exists! Please try again!</p>";               
            }

            else if($_GET["error"] == "passwordmismatch"){
                echo "<p style='margin: 20px 90px; color: red; text-align: center;'>***Passwords didn't match! Please try again!</p>";               
            }

            else if($_GET["error"] == "stmtfailed"){
                echo "<p style='margin: 20px 90px; color: red; text-align: center;'>***Something went wrong! Please try again!</p>";               
            }               
            
            else if($_GET["error"] == "weakpassword"){
                echo "<p style='margin: 20px 90px; color: red; text-align: center;'>***Passwords must contain :</p>";               
                echo "<p style='margin: 5px 90px; color: red; text-align: center;'>At least 8 characters</p>";                           
                echo "<p style='margin: 5px 90px; color: red; text-align: center;'>At least 1 uppercase letter</p>";    
                echo "<p style='margin: 5px 90px; color: red; text-align: center;'>At least 1 number</p>";                           
                       
            }            
            
            else if($_GET["error"] == "none"){
                echo "<p style='color:tomato;'>Step 1 complete</p>";               
            }
        }


    ?>
        </form>
    </div>
</body>
</html>