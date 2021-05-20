<?php
session_start();
?>

<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="CSS/login.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>      
	<div class="container">
		<form action="loginProcess2.php" method="POST">
			<h2>Login Required</h2>
			<img src="logo.jpg">
			<div class="form-group">
				<label for="">Email:</label>
				<input class="form-control" type="text" name="em" required>      
			</div>
			<div class="form-group">
				<label for="">Password:</label>
				<input class="form-control" type="password" name="pwd" required>      
			</div>      
			<input type="Submit" name="Submit" class="btn" value="Log in" > 
			<br><br>
			<a href="signup.php">No Account? Register here!</a> 
                        
        <?php

            if(isset($_GET["error"])){

                if($_GET["error"] == "invalidlogin"){
                    echo "<p style='color:white;'>whitespace</p>";
                    echo "<p style='color:red;'>****Invalid email/password</p>";
                }      

                else if($_GET["error"] == "userbanned"){
                    echo "<p style='color:white;'>whitespace</p>";
                    echo "<p style='color:red;'>****This account has been banned</p>";
                }      
            
            }

        ?>
		 </form>
    </div>  
 </body>
</html>