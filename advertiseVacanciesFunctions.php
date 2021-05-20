<?php
session_start();
?>
<?php
require "includes/dbh-inc.php";
//$vacancySkills = getVacancySkills(1);
//print_r($vacancySkills);
//displayVacancySkills($vacancySkills);
//echo "<br>";
//$vacancyQualifications = getRequiredQualifications(1);
//isplayVacancyQualifications($vacancyQualifications);
// get vacancy skills from vacancy id
function getVacancySkills($vacancyId){
    require "includes/dbh-inc.php";
     // an array to store the vacancy skills for the vacancy
    $vacancySkills = [];
    
    $sql = "SELECT Skills.Skill_Name
            FROM VacancySkills
            LEFT JOIN Skills ON VacancySkills.skill_id = Skills.Skill_Id
            WHERE VacancySkills.vacancy_id = {$vacancyId};";
    
    $result = $conn->query($sql);
    
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            array_push($vacancySkills,$row['Skill_Name']);
        }
    }
    $conn->close();
   
    //print_r($companyVacancies);
    return $vacancySkills;
}
// display vacancy skills
function displayVacancySkills($vacancySkills){
    echo "<br>Required Skills: ";
    foreach($vacancySkills as $key=>$value){
        echo $value."  ";
    }
}
// return vacancy skills as a string
function stringVacancySkills($vacancySkills){
    $VS = "";
    foreach($vacancySkills as $key=>$value){
        $VS = $VS." ".$value;
    }
    return $VS;
}
// get required qualifications from vacancy id
function getRequiredQualifications($vacancyId){
    require "includes/dbh-inc.php";
     // an array to store the vacancy skills for the vacancy
    $vacancyQualifications = [];
    
    $sql = "SELECT Vacancies.required_qualification
            FROM Vacancies
            WHERE Vacancies.vacancy_id = {$vacancyId};";
    
    $result = $conn->query($sql);
    
    if($result->num_rows>0){
        while($row=$result->fetch_assoc()){
            array_push($vacancyQualifications,$row['required_qualification']);
        }
    }
    $conn->close();
   
    //print_r($vacancyQualifications);
    return $vacancyQualifications;
}
// display vacancy qualifications
function displayVacancyQualifications($vacancyQualifications){
    echo "<br>Required Qualifications: ";
    foreach($vacancyQualifications as $key=>$value){
        echo $value."  ";
    }
}
// get vacancy qualifications as a string
function stringVacancyQualifications($vacancyQualifications){
    $VQ = "";
    foreach($vacancyQualifications as $key=>$value){
        $VQ = $VQ." ".$value;
    }
    return $VQ;
}
?>