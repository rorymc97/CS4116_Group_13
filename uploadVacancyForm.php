 
<?php
// Start the session
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <style>
        .error {color: #FF0000;}
        </style>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta charset="UTF-8">
        <!-- <link rel="stylesheet" type="text/css" href="CSS/footer.css"> -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
        <link rel="stylesheet" type="text/css" href="CSS/Profile.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> 
        <title>New Vacancy Page</title>
    </head>
    <body>

    

    <div class="menu">
            <?php 
            // just for testing
            //echo "userType: ".$_SESSION['userType'];

            if($_SESSION['userType'] == "jobseeker"){
                include 'header.php';
            }

            else if($_SESSION['userType'] == "company"){
                include 'headercompany.php';
            }

            else if($_SESSION['userType'] == "admin"){
                include 'headeradmin.php';
            }
    ?>
    </div>
<?php
/**
getting the vacancy details from a form and storing them in session variables
*/
$validRQ = false;
$validVD = false;
$validVN = false;
$vacancyNameErr = $vacancyDescriptionErr = $requiredQualificationErr = "";
$vacancyName = $vacancyDescription = $requiredQualification = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["vacancyName"])) {
    $vacancyNameErr = "Vacancy name is required";
    $validVN = false;
  } else {
    $vacancyName = test_input($_POST["vacancyName"]);
    
    if ((!(preg_match("/^[a-z\s]+$/i",$vacancyName)==1)) || (strlen($vacancyName))>20){
      $vacancyNameErr = "Only letters and white space allowed, max length 20 characters";
    } 
  }
  
  if (empty($_POST["vacancyDescription"])) {
    $vacancyDescriptionErr = "vacancyDescription is required";
    $validVD = false;
  } else {
    $vacancyDescription = test_input($_POST["vacancyDescription"]);
    
    if ((!(preg_match("/^[a-z0-9\s]+$/i",$vacancyDescription)==1)) || (strlen($vacancyDescription)>300)) {
      $vacancyDescriptionErr = "Only letters,numbers and white space allowed, max length 300 characters";
    } 
  }
    
  if (empty($_POST["requiredQualification"])) {
    $requiredQualification = "";
    $validRQ = true;
  } else  {
    $requiredQualification = test_input($_POST["requiredQualification"]);
    
    if (!preg_match("/^[a-z0-9\s]+$/i",$requiredQualification)||strlen($requiredQualification)>20) {
      $requiredQualificationErr = "Only letters, numbers and white space allowed, max length 20 characters";
    } 
  } 
}
// trim, stripslashes and change special chars
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>


<h2>New Vacancy</h2>
<HR>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Vacancy Name:  <input type="text" name="vacancyName" value="<?php echo $vacancyName;?>">
  <span class="error">* <?php echo $vacancyNameErr;?></span>
  <br><br>
  Vacancy Description: <input type="text" name="vacancyDescription" value="<?php echo $vacancyDescription;?>">
  <span class="error">* <?php echo $vacancyDescriptionErr;?></span>
  <br><br>
  Required Qualification: <input type="text" name="requiredQualification" value="<?php echo $requiredQualification;?>">
  <span class="error"><?php echo $requiredQualificationErr;?></span>
  <br><br>
  Choose Skills:
  <br>
  <select name = 'skills[]' multiple = 'multiple'>  
    <!--<select name = "chosen">-->
        <option selected="selected">Choose multiple using Ctrl click</option>
        <?php
        
        $skills = getAllSKills();
        
        foreach($skills as $key=>$item){
            echo "<option value='$item'>$item</option>";
        }
        ?>
    </select>
    <br><br>

  <input type="submit" name="submit" value="Submit">  
</form>


<?php
session_start();
//$choice = $_POST['chosen'];
$skillsChoice = [];
// Check if form is submitted successfully
    if(isset($_POST["submit"])) 
    {
        // Check if any option is selected
        if(isset($_POST["skills"])) 
        {
            // Retrieving each selected option
            foreach ($_POST['skills'] as $key=>$skill)
                if($skill!="Choose multiple using Ctrl click"){ 
                echo "You selected $skill<br/>";
                array_push($skillsChoice,$skill);
                }
        }
    else
        echo "Select an option first !!";
    }
echo "<br>";
//print_r($skillsChoice);
//$_SESSION['skillsChoice'] = $skillsChoice;
$SC = $skillsChoice;
//print_r($_SESSION['skillsChoice']);
//echo $choice;
// get all skills
function getAllSkills(){
    $skills = [];
    require "includes/dbh-inc.php";
    $sql = "SELECT Skill_Name FROM Skills;";
    
    $result = $conn->query($sql);
    //print_r($result);
    
    if ($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                array_push($skills,$row['Skill_Name']);
            }
        }
    //echo "<br>Skills array<br>";
    //print_r($skills);
    return $skills;
}

echo "<h2>Your Input:</h2>";
/**
echo $vacancyName;
echo "<br>";
echo $vacancyDescription;
echo "<br>";
echo $requiredQualification;
echo "<br>";
*/

if (preg_match("/^[a-z0-9\s]+$/i",$requiredQualification)&&strlen($requiredQualification)<=20) {
      //$_SESSION['requiredQualification'] = $requiredQualification;
      $RQ = $requiredQualification;
      $validRQ = true;
}
if (preg_match("/^[a-z\s]+$/i",$vacancyName) && strlen($vacancyName)<=20){
      //$_SESSION['vacancyName'] = $vacancyName;
    $VN = $vacancyName;
    $validVN = true;
} 
if (preg_match("/^[a-z0-9\s]+$/i",$vacancyDescription)&& strlen($vacancyDescription)<=300) {
      //$_SESSION['vacancyDescription'] = $vacancyDescription;
      $VD =  $vacancyDescription;
      $validVD = true;
} 
//echo "<br>vn: ".$_SESSION['vacancyName'];
//echo "<br>vd: ".$_SESSION['vacancyDescription'];
//echo "<br>rq: ".$_SESSION['requiredQualification'];
echo "<br>vn: ".$VN;
echo "<br>vd: ".$VD;
echo "<br>rq: ".$RQ;
echo "<br>sc: ";
foreach( $SC as $key=> $skill){
    echo " ".$skill;
}
//echo "<br>the user id : ".$_SESSION['userID'];

// entering the form input into the database
if($validRQ && $validVD && $validVN){
    //echo "one";
    require "testCreateNewVacancyFunctions.php";
    //echo "two";
    test();
    $userId = $_SESSION['userID'];
    //k
    //$userId = 12;
    //test();
    insertVacancyForm($SC,$userId,$VN,$VD,$RQ);
    //echo "three";
}
/**
function test(){
    echo "test works";
}
function insertVacancyForm($skillChoices,$userId,$vacancyName,$vacancy_description,$required_qualification){
    echo "in insert vacancy form";
    echo $userId." ".$vacancy_name." ".$vacancy_description." ".$required_qualification."<br>";
    print_r($skillChoices);
    
    echo "but";
    //$_SESSION['userType']='company';
    if(isCompany()){
    
    
    $skillIds = [];
    echo skillIdFromSkillName($skillChoices[1]);

    foreach($skillChoices as $key=>$skillName){
        echo $skillName;
        $skillId = skillIdFromSkillName($skillName);
        echo $skillId;
        array_push($skillIds,$skillId);
    }

    
    $company_id = getCompanyIdFromUserId($userId);
    
    echo "<br>$company_id<br>";

    insertIntoVacancyTable($company_id,$vacancy_name,$vacancy_description,      $required_qualification);

    $vacancy_id = getVacancyId($company_id,$vacancy_name,          $vacancy_description, $required_qualification);
    
    echo $vacancy_id;

    foreach($skillIds as $key=>$skill_id){
        insertIntoVacancySkills($vacancy_id,$skill_id);
    }
   
    }
}
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
}*/

?>


</body>

</html>
