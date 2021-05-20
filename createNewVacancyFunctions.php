<?php
/**
* We will need a form on the companies profile page where they can upload a new vacancy, or a button to link them to where they can upload a new vacancy
* We will need input validation / error checking on this form
* 
* The necessary inputs on the vacancy for vacancy table: vacancy_id, company_id, vacancy_name, vacancy_description, required_qualification, status
* vacancy_id is auto-increment, 
* company_id can be got from the session user id, 
* vacancy name will have to be an input string of max length 20, 
* vacancy description will have to be an input string of max length 300, 
* required qualification will have to be an input string of max length 20,
* status will just have to be 1
*
* The necessary inputs to the VacancySkills table will have to be 
* vacancy_skill_id is auto increment
* vacancy_id will have to be got from the current vacancy
* skill_id will have to be got from user input, using a drop down table selecting the skill name, returning the skill_id
*
*/
//echo "above session start";
session_start();

//echo "in create new vacancy functions";
// insert into Vacancies table
function insertIntoVacancyTable($company_id,$vacancy_name, $vacancy_description, $required_qualification){
    require "includes/dbh-inc.php";
    if(!getVacancyId($company_id,$vacancy_name,$vacancy_description,$required_qualification)){
    $sql = "INSERT INTO Vacancies (company_id,vacancy_name,
    vacancy_description,required_qualification, status) VALUES ({$company_id},'{$vacancy_name}','{$vacancy_description}', '{$required_qualification}',1);";
    
    
    if($conn->query($sql) == true){
        echo "<br>Vacancies table updated<br>";
    } else {
        echo "<br>Vacancies table not updated<br>";
        echo "<br>Error: ".$sql."<br>".$conn->error;
    }
    } else{
        echo "<br>This vacancy already exists!<br>";
    }
}
// get vacancy_id where company_id,vacancy_name,vacancy_description,
// required_qualification = x,y,w,z
function getVacancyId($company_id,$vacancy_name,$vacancy_description,$required_qualification){
    $vacancy_id;
    require "includes/dbh-inc.php";
    $sql = "SELECT vacancy_id FROM Vacancies WHERE 
    company_id=$company_id AND
    vacancy_name = '$vacancy_name' AND
    vacancy_description = '$vacancy_description' AND
    required_qualification = '$required_qualification';";
    if($conn->query($sql) == true){
       // echo "<br>vacancy id retrieved<br>";
    } else {
        echo "<br>not retrieved<br>";
        echo "<br>Error: ".$sql."<br>".$conn->error;
    }
    $result = $conn->query($sql);
    //print_r($result);
    if ($result->num_rows > 0){
        while($row=$result->fetch_assoc()){ 
            $vacancy_id = $row['vacancy_id'];
        }
     }
     return $vacancy_id;
}
// insert into VacancySkills Table
function insertIntoVacancySkills($vacancy_id,$skill_id){
    require "includes/dbh-inc.php";
    if(!getVacancySkillId($vacancy_id,$skill_id)){
    $sql = "INSERT INTO VacancySkills(vacancy_id, skill_id) 
    VALUES ($vacancy_id, $skill_id);";
    if($conn->query($sql)==true){
        echo "<br>VacanySkills Table updated";

    }else {
        echo "<br>VacancySkills Table not updated";
    }
    } else {
        echo "<br>vacancy skill already exists!";
    }
}
// get vacancy_skill_id from skill_id and vacancy_id
function getVacancySkillId($vacancy_id,$skill_id){
    $vacancy_skill_id;
    require "includes/dbh-inc.php";
    $sql = "SELECT vacancy_skill_id FROM VacancySkills WHERE 
    vacancy_id=$vacancy_id AND
    skill_id = '$skill_id' ;";
    if($conn->query($sql) == true){
       // echo "<br>vacancy skill id retrieved<br>";
    } else {
        echo "<br>not retrieved<br>";
        echo "<br>Error: ".$sql."<br>".$conn->error;
    }
    $result = $conn->query($sql);
    //print_r($result);
    if ($result->num_rows > 0){
        while($row=$result->fetch_assoc()){ 
            $vacancy_skill_id = $row['vacancy_skill_id'];
        }
     }
     return $vacancy_skill_id;
}

// get skill id from skill name
function skillIdFromSkillName($skill_name){
    $skill_id;
    require "includes/dbh-inc.php";

    $sql = "SELECT Skill_Id FROM Skills WHERE Skill_Name = '$skill_name';";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0){
        while($row=$result->fetch_assoc()){ 
            $skill_id = $row['Skill_Id'];
        }
     }
     return $skill_id;
}
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

?>
