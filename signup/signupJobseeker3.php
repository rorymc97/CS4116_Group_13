<?php
    session_start();
    require "signupheader.php";

?>

<html>

<head>

    <title> Munster jobs management </title>
<link rel="stylesheet" href="dropdown.css" type="text/css"/>
<link rel="stylesheet" href="signup.css" type="text/css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>
<body>
<div class="container">
        <form style="max-width: 300px; min-height: 650px"action="signupProcess3.php" method="POST">
        <h2>Step 3/4: Skills</h1>
        <ul>
            <li><input type="checkbox" value="Java" name='skills[]'/>   Java </li>
            <li><input type="checkbox" value="PHP" name='skills[]'/>    PHP </li>
            <li><input type="checkbox" value="Python" name='skills[]'/> Python </li>
            <li><input type="checkbox" value="C" name='skills[]'/>  C </li>
            <li><input type="checkbox" value="C++" name='skills[]'/>    C++ </li>
            <li><input type="checkbox" value="Scala" name='skills[]'/>  Scala </li>
            <li><input type="checkbox" value="HTML" name='skills[]'/>   HTML </li>
            <li><input type="checkbox" value="CSS" name='skills[]'/>    CSS </li>
            <li><input type="checkbox" value="SQL" name='skills[]'/>    SQL </li>
            <li><input type="checkbox" value="NoSQL" name='skills[]'/>  NoSQL </li>
            <li><input type="checkbox" value="R" name='skills[]'/>  R </li>
            <li><input type="checkbox" value="Go" name='skills[]'/> Go </li>
            <li><input type="checkbox" value=".NET" name='skills[]'/>   .NET </li>
        </ul>
            <input class="btn" name="Submit" id="Submit" type="Submit" value="Continue"></input>
            <br><br>
            <a href="../login2.php">Already have an account? Login here</a>        
            
        <?php

        if(isset($_GET["error"])){

            if($_GET["error"] == "emptyskills"){
                echo "<p style='margin: 20px 90px; color: red; text-align: center;'>***Please select at least 1 skill!</p>";
            }

            else if($_GET["error"] == "stmtfailed"){
                echo "<p style='margin: 20px 90px; color: red; text-align: center;'>***Something went wrong! Please try again!</p>";               
            }  
        }

    ?>
            </form>
</div>
</body>
</html>