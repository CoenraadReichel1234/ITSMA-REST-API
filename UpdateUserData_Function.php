<?php

require('../DBConnect/dbcon.php');

function error422($message){
    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header("HTTP/1.0 405 Invalid Input");
    echo json_encode($data);
    exit();
}

function getUserInfo($email){
    global $conn;
    $email = mysqli_real_escape_string($conn, $email);
    $query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0){
        return mysqli_fetch_assoc($result);
    }else{
        return null;
    }
}

function updateUserInfo($userInput){
    global $conn;

    $isAdmin = mysqli_real_escape_string($conn, $userInput['isAdmin']);
    $name = mysqli_real_escape_string($conn, $userInput['first_name']);
    $surname = mysqli_real_escape_string($conn, $userInput['surname']);
    $password = mysqli_real_escape_string($conn,$userInput['password']);
    $email = mysqli_real_escape_string($conn, $userInput['email']);
    $phone = mysqli_real_escape_string($conn, $userInput['phone_number']);

    #input validation
    if(!isset($isAdmin) || !is_string($isAdmin)){
        return error422('Enter privilidges');
    }
    elseif(empty(trim($name))){
        return error422('Enter Name');
    }
    elseif(empty(trim($surname))){
        return error422('Enter Surname');
    }
    elseif(empty(trim($password))){
        return error422('Enter Password');
    }
    elseif(empty(trim($email))){
        return error422('Enter Email');
    }
    elseif(empty(trim($phone))){
        return error422('Enter Phone number');
    }
    else{
        $query = "UPDATE users SET isAdmin = '$isAdmin', first_name='$name', surname='$surname', password='$password', email='$email', phone_number='$phone' WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn,$query);

        if($result){
            $data = [
                'status'=> 200,
                'message' => 'Data Updated',
                'success' => true,
            ];
            header("HTTP/1.0 200 Data Updated");
            return json_encode($data);
        }else{
            $data = [
                'status'=> 500,
                'message' => 'Internal Server Error',
            ];
            header("HTTP/1.0 500 Server Error");
            return json_encode($data);
        }
    }
}

?>
