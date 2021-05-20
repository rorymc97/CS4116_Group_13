<?php
session_start();
require "signupheader.php";

?>

<html>

<head>

    <title> Munster jobs management </title>
    <link rel="stylesheet" href="CSS/signup.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>


<body>
<div class="container">
        <form action="/signup/signupCompanyProcess.php" method="POST">
        <h2>Enter Company Details</h2>
            <table>
                <tr>
                    <td>
                        <input type="text" name="fname" id="fname" placeholder="Company Name" required>
                    </td>
                    <td>
                        <select name="industry" id="industry" required>
                            <option value="" disabled selected >--Select Industry--</option>
                            <option value="Video Games">Video Games</option>
                            <option value="Electronics">Electronics</option>
                            <option value="SAAS">SAAS</option>
                            <option value="Networking">Networking</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="email" name="email" id="email" placeholder="Email Address" required>
                    </td>
                    <td>
                        <input type="text" name="phone" id="phone" placeholder="Phone" required>
                    </td>
                </tr>                
                <tr>
                    <td>
                        <input type="Password" name="pwd" id="pwd" placeholder="Password" required>
                    </td>
                    <td>
                        <input type="Password" name="pwdRepeat" id="pwdRepeat" placeholder="Re-enter Password" required>
                    </td>
                </tr>                                
                <tr>
                    <td>
                        <input type="text" name="bio" id="bio" placeholder="Company Description" required>
                        </td>
                </tr>
                        
            </table>
            <input class="btn" name="Submit" id="Submit" type="Submit" value="Register"></input>
            <br><br>
            <a href="login2.php">Already have an account? Login here</a>

            <?php

        if(isset($_GET["error"])){

            if($_GET["error"] == "emptyinput"){
                echo "<p style='margin: 20px 90px; color: tomato; text-align: center;'>***Please fill in all fields!</p>";
            }

            else if($_GET["error"] == "invalidemail"){
                echo "<p style='margin: 20px 90px; color: tomato; text-align: center;'>***Please choose a proper email!</p>";               
            }

            else if($_GET["error"] == "emailexists"){
                echo "<p style='margin: 20px 90px; color: tomato; text-align: center;'>***Email already exists! Please try again!</p>";               
            }

            else if($_GET["error"] == "passwordmismatch"){
                echo "<p style='margin: 20px 90px; color: tomato; text-align: center;'>***Passwords didn't match! Please try again!</p>";               
            }

            else if($_GET["error"] == "stmtfailed"){
                echo "<p style='margin: 20px 90px; color: tomato; text-align: center;'>***Something went wrong! Please try again!</p>";               
            }               
            
            else if($_GET["error"] == "weakpassword"){
                echo "<p style='margin: 20px 90px; color: red; text-align: center;'>***Passwords must contain :</p>";               
                echo "<p style='margin: 5px 90px; color: red; text-align: center;'>At least 8 characters</p>";                           
                echo "<p style='margin: 5px 90px; color: red; text-align: center;'>At least 1 uppercase letter</p>";    
                echo "<p style='margin: 5px 90px; color: red; text-align: center;'>At least 1 number</p>";                           
            }           
            
            else if($_GET["error"] == "companyexists"){
                echo "<p style='color:tomato;'>***Company already exists! Please try again!</p>";               
            }             
                    
            
        }

    ?>
        </form>
</div>
</body>
</html>