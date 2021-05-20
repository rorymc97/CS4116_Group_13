<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
       <!-- <link rel="stylesheet" type="text/css" href="CSS/footer.css">-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <title>Network Page</title>
    </head>
    <body>
        
        <div class="menu">
            <?php require 'headercompany.php';?>
        </div>
            
    </body>
</html>
<?php 
            
            include 'includes/dbh-inc.php';

            if($_GET['vid']){
                $vid = $_GET['vid'];

                $sql1 = "delete from Vacancies where vacancy_id={$vid};";
                $sql2 = "delete from VacancySkills where vacancy_id={$vid};";

                if(($conn->query($sql1) && $conn->query($sql2)) === TRUE){
                    echo "Vacancy deleted successfully";
                }

                else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

            $conn->close();

            }
?>