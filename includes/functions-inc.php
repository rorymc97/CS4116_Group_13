<?php

function emptyInputSignup($fname, $lname, $email, $password, $passwordrepeat, $bio) {
    $result;

    if(empty($fname) || empty($lname) || empty($email) || empty($password) || empty($passwordrepeat) || empty($bio)){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;

}

function emptyInputSignupRole($role) {
    $result;

    if(empty($role)){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;

}

function invalidEmail($email) {
    $result;

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;

}

function pwdMatch($pwd, $pwdRepeat) {
    $result;

    if($pwd !== $pwdRepeat){
        $result = true;
    }
    else{
        $result = false;
    }

    return $result;

}

function emailExists($conn, $email) {
    $sql = "select * from Users where Email = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ./signupJobseeker.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }

    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function companyExists($conn, $cname) {
    $sql = "select * from Users where Firstname = ?;";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ./signupCompany.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $cname);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }

    else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function weakPassword($pwd){
    $result;

    if (strlen($pwd) <= 8) {
        $result = true;
    }

    elseif(!preg_match("#[0-9]+#",$pwd)) {
        $result = true;
    }
    elseif(!preg_match("#[A-Z]+#",$pwd)) {
        $result = true;
    }

    else{
        $result = false;
    }

    return $result;
}

function isRealDate($date) { 
    if (false === strtotime($date)) { 
        return false;
    } 
    list($year, $month, $day) = explode('-', $date); 
    return checkdate($month, $day, $year);
}

function createUser($conn, $fname, $lname, $email, $password, $bio){
    $type = 'jobseeker';
    $status = 'active';
    
    $sql = "INSERT INTO Users (Firstname, Lastname, Email, Password, Bio, Type, Status) VALUES (?, ?, ?, ?, ?, ?,  ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ./signupJobseeker.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssss", $fname, $lname, $email, $password, $bio, $type, $status);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    //header("location: ./signupJobseeker2.php?error=none");
    //exit();
}

function createCompany($conn, $cname, $lname, $email, $pwd, $bio, $industry, $phone){
    $lname = '';
    $type = 'company';
    $status = 'active';
    
    $sql = "INSERT INTO Users (Firstname, Lastname, Email, Password, Bio, Type, Status) VALUES (?, ?, ?, ?, ?, ?,  ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ./signupJobseeker.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sssssss", $cname, $lname, $email, $pwd, $bio, $type, $status);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    //need to get most recent user_id
    $sql = "select User_Id from Users order by User_Id desc limit 1;";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $uid = $row["User_Id"];

    $sql = "INSERT INTO Companies (company_name, industry_type, bio, email, phone, user_id) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ./signupJobseeker.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssss", $cname, $industry, $bio, $email, $phone, $uid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    //header("location: ./signupJobseeker2.php?error=none");
    //exit();
}

function createUserQualification($conn, $type, $field, $date){

    //need to get most recent user_id
    $sql = "select User_Id from Users order by User_Id desc limit 1;";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $uid = $row["User_Id"];

    // need to find the correct Qualification_Id from given Type and Field
    $sql = "select Qualification_Id from Qualifications where Qualification_Type = '$type' and Qualification_Field = '$field';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $qid = $row["Qualification_Id"];

    $sql = "INSERT INTO UserQualifications (User_Id, Qualification_Id, Qualified_Date) VALUES (?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ./signupJobseeker2.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "iis", $uid, $qid, $date);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    //header("location: ./signupJobseeker3.php?error=none");
    //exit();
}

function createUserSkills($conn, &$skills){

    //need to get most recent user_id
    $sql = "select User_Id from Users order by User_Id desc limit 1;";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $uid = $row["User_Id"];

    // need to find the correct Skill_Id from given Skill_Name for each value in $skills array
    foreach($skills as $skill_name){
        $sql = "select Skill_Id from Skills where Skill_Name = '$skill_name';";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $sid = $row["Skill_Id"];

        $sql = "INSERT INTO UserSkills (User_Id, Skill_Id) VALUES (?, ?);";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ./signupJobseeker3.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ii", $uid, $sid);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    
    //header("location: ./signupJobseeker4.php?error=none");
    //exit();
}

function createUserEmployment($conn, $company, $role, $start, $end){

    //need to get most recent user_id
    $sql = "select User_Id from Users order by User_Id desc limit 1;";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $uid = $row["User_Id"];

    // need to find the correct Qualification_Id from given Type and Field
    $sql = "select Company_Id from Companies where company_name = '$company';";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $cid = $row["Company_Id"];

    $sql = "INSERT INTO EmploymentHistory (User_Id, Company_Id, Role, Start_Date, End_Date) VALUES (?, ?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);

    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ./signupJobseeker4.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "iisss", $uid, $cid, $role, $start, $end);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    //header("location: ./signupJobseekerConfirm.php?error=none");
    //exit();
}

function endBeforeStart($start, $end){
    $result;

    if (strtotime($start) > strtotime($end)){
        $result = true;
    }

    else{
        $result = false;
    }

    return $result;
}