<!DOCTYPE html>
<html lang="en">
     <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <title>Basic-Web Search</title>
        <link rel="stylesheet" type="text/CSS" href="CSS/lists.css">

    </head>
    <body style="background-image: url('background.jpg')">
        <div class="menu">
            <?php 
            include 'headeradmin.php';
            ?>
        </div>
    <div class="container p-4" style="background-color: white; width: 1000px; min-width:700px;margin-top: 20px; margin-bottom: 20px; ">        
    <center>
        <h1>Vacancies</h1>
        <HR>
        <p>Displayed below are open vacancies</p> 
        <table id="customers">

        </table>
        <div class="vacancies_display">
            <?php 

                require "includes/dbh-inc.php";
                echo "<br>";

                $sql = "SELECT Vacancies.vacancy_id, Vacancies.vacancy_name, Vacancies.vacancy_description, Vacancies.required_qualification,Companies.company_name FROM Vacancies LEFT JOIN Companies ON      Vacancies.company_id=Companies.company_id";                
                
                // Store the result of the query in $result
                $result = $conn->query($sql);
                // check that there is rows in result

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
                    echo "<td><a onclick='clicked(event)' href='deleteVacancy.php?vid=$vid'>Delete</a></td>";
                    
                    echo "</tr>";
                }
                echo "</table>";


                $conn->close();
        ?>
        </div>   
      
    </div> 
            <script>
                function clicked(e)
                {
                    if(!confirm('Are you sure?')) {
                        e.preventDefault();
                    }
                }
            </script>
    </body>
    <?php
 require "footer.php";
 ?>
</html>