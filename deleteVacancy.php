<!DOCTYPE html>
<html lang="en">
     <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="CSS/lists.css">
        <title>Basic-Web Search</title>
    </head>
    <body style="background-image: url('background.jpg')";>
        <div class="menu">
            <?php 
            include 'headeradmin.php';
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
        </div>
    <div class="container p-4" style="background-color: white; width: 1000px; min-width:700px; margin-top: 20px; margin-bottom: 20px; "> 
        <center><h1>Vacancies</h1>
        <HR>
        <p>Displayed below are open vacancies</p> 
        <div class="vacancies_display">
            <?php 

                require "includes/dbh-inc.php";
                echo "<br>";

                $sql = "SELECT Vacancies.vacancy_id, Vacancies.vacancy_name, Vacancies.vacancy_description, Vacancies.required_qualification,Companies.company_name FROM Vacancies LEFT JOIN Companies ON Vacancies.company_id=Companies.company_id";
                // Store the result of the query in $result
                $result = $conn->query($sql);
                // check that there is rows in result
                if ($result->num_rows > 0){
                echo "<table id='lists'>";
                echo "<tr>
                        <th>Role</th>
                        <th>Company</th>
                        <th>Description</th>
                        <th>Required Qualification</th>
                        <th> </th>
                        
                    </tr>";
                // output the data of each row
                while($row = $result->fetch_assoc())
                {
                    $vid = $row["vacancy_id"];
                    echo "<tr>";
                    echo "<td>{$row["vacancy_name"]}</td>
                    <td>{$row["company_name"]}</td>
                    <td>{$row["vacancy_description"]}</td>
                    <td>{$row["required_qualification"]}</td>";
                    echo "<td><a href='deleteVacancy.php?vid=$vid'>Delete</a></td>";
                    
                    echo "</tr>";
                }
                echo "</table>";
                } else{
                    echo "0 results";
                }


                $conn->close();
        ?>
        </div>   
      
    </div> 
    </body>
<?php
 require "footer.php";
 ?>
</html>