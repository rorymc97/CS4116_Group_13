<?php
/**
* Organizations should be able to advertise vacancies 
* that require specific skills and/or experience.  
* These should be visible on the organization profile page
*/
session_start();
?>
<?php
// just for testing
//$_SESSION['userId'] = 6;
//$_SESSION['userType'] = 'company';

$userId = $_SESSION['userID'];
$userType = $_SESSION['userType'];

require "advertiseVacanciesFunctions.php";

//echo "user id: ".$userId;
//echo "<br>userType: ".$userType;

if(isCompany()){
   
    $companyId = getCompanyIdFromUserId($userId);
 
    $vacancyIds = getVacancyIdsFromCompanyId($companyId);
    //echo "<br>wha<br>";
    displayVacancies($vacancyIds);
    //echo "<br>wha<br>";
}

/**
* functions below
*/

// given a user Id check if that user is a company
function isCompany(){
    if($_SESSION['userType']=='company'){
        return true;
    }
    else {
        return false;
    }
}
// get company id from user id
function getCompanyIdFromUserId($userId){
    //echo "two";
    $companyId = [];
    if(isCompany()){
        //echo "three";
        require "includes/dbh-inc.php";
        
        $sql = "SELECT Company_Id
                FROM Companies
                WHERE user_id = {$userId};";
        $result = $conn->query($sql);
        //echo "<br>result: ";
        //print_r($result);
        // check that there is rows in result
        if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($companyId,$row);
            }
        }
    }
    $conn->close();
    return $companyId[0]['Company_Id'];
}

// get vacancies for that company
function getVacancyIdsFromCompanyId($companyId){ 
    //echo "six";   
    require "includes/dbh-inc.php";
    // an array to store the vacancy ids for the company
    $companyVacancies = [];
    //echo "seven";
    $sql = "SELECT vacancy_id
            FROM Vacancies
            WHERE company_id = $companyId;";
    //echo "eight";
    $result = $conn->query($sql);
    //echo "nine";
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            array_push($companyVacancies,$row);
        }
    }
    $conn->close();
    //print_r($companyVacancies);
    return $companyVacancies;
           
}

// a function to get all vacancy information from its iD
function getVacancyFromId($vacancyId){
    require "includes/dbh-inc.php";
    $vacancy = [];
    $sql = "SELECT Vacancies.vacancy_name,Vacancies.vacancy_description, Companies.company_name
            FROM Vacancies
            LEFT JOIN Companies ON Vacancies.company_id = Companies.Company_Id
            WHERE Vacancies.vacancy_id = {$vacancyId};";
    $result = $conn->query($sql);
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            array_push($vacancy,$row);
        }
    }
    return $vacancy;
}

// display vacancies given vacancyIds
function displayVacancies($vacancyIds){
    require "includes/dbh-inc.php";
    //echo "twelve";
    //print_r($vacancyIds);
    $displayedVacancies = [];
    //echo $currentUserId;
    echo "<table>";
            echo "<tr>
                <th>  Vacancy Name  </th>
                <th>  Vacancy Description  </th>
                <th>  Company  </th>
                <th>  Vacancy Skills  </th>
                <th>  Vacancy Qualifications  </th> 
                <th> Remove Vacancy</th>
                </tr>";
    //echo "thirteen";
    foreach($vacancyIds as $k=>$v){
        foreach($v as $key=>$value){
        //echo "fourteen";
                if(!in_array($value,$displayedVacancies)){
                   // echo "fifteen";
                array_push($displayedVacancies,$value);
                  //  echo "sixteen";
                //echo "value: ".$value;
                $vacancy = getVacancyFromId($value);
                $stringVS = stringVacancySkills(getVacancySkills($value));
                $stringVQ = stringVacancyQualifications(getRequiredQualifications($value));
                  //  echo "seventeen";
                //print_r($vacancy);
                foreach($vacancy as $no=>$array){
                echo "<tr>";
                echo "<td> {$array["vacancy_name"]} </td>
                    <td> {$array["vacancy_description"]} </td>
                    <td> {$array["company_name"]} </td>
                    <td> $stringVS </td>
                    <td> $stringVQ </td>
                    <td> <a href='companyDeleteVacancy.php?vid=$value'>delete</a> <td>";   
                echo "</tr>"; 
                
                
                
                }   
        }
    }
    }
    echo "</table>";
}
$conn->close();
?>