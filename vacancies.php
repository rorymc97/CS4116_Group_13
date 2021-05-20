<!DOCTYPE html>
<html lang="en">
     <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="CSS/footer.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <title>Basic-Web Search</title>
    </head>
    <body>
        <div class="menu">
            <?php 
            include 'header.php';
            ?>
        </div>
    <div class="container p-4"> 
        <h1>Vacancies</h1>
        <HR>
        <p>Displayed below are open vacancies</p> 
        <div class="vacancies_display">
          <table class="table table-striped">
            <?php include 'displayVacancies.php'?>
          </table >  
        </div>   
        <!--
        <div class="vacancies_search">
            <form method="POST" action="Cormacsearch.php">

                <input type="text" name="search" id="search" placeholder="Look for Vacancies" />
                <input type="submit" value="SUBMIT" />

            </form>
        </div>-->
        <div class="vacancies_search">
            <form method="POST" action="searchVacancies.php">

                <input type="text" name="search" id="search" placeholder="Look for Vacancies" />
                <input type="submit" value="SUBMIT" />

            </form>
        </div>
        <div class="suggested_vacancies">
            <p>Displayed below are suggested vacancies based on your skills</p>
            <?php require 'getSuggestedVacancies.php'?>
        </div>
        
        <!--<div class = "suggestedconnections">
            <p>Displayed below are suggested connections</p>
            <?php require 'getSuggestedConnections.php'?>
            </div>-->

    </div> 
        
   
       

    </body>
</html>