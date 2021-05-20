<?php
    session_destroy();
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
<form style="width: 100px; min-height: 200px;"><br><br>
    <?php
        if(isset($_GET["error"])){

            if($_GET["error"] == "stmtfailed"){
                echo "<p style='margin: 20px 90px; color: tomato; text-align: center;'>***Something went wrong! Please try again!</p>";               
            }            
            
            else if($_GET["error"] == "none"){
                echo "<p style='margin: 20px 90px; color: black; text-align: center;'>Congratulations! Registration complete!</p>";               
            }
        }

    ?>

    <br><br>
            <a style="margin-left: 25%;" href="../login2.php">Click here to login</a> 
    </form>

    </div>
</body>
</html>