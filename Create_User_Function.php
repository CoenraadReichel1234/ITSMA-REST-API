<?php
require '../DBConnect/dbcon.php';
function error422($message){
    $data = [
        'status' => 422,
        'message' => $message,
    ];
    header("HTTP/1.0 405 Invalid Input");
    echo json_encode($data);
    exit();
}

function storeUserInfo($userInput){
    global $conn;

    $isAdmin = isset($userInput['isAdmin']) ? intval($userInput['isAdmin']):0;
    $name = mysqli_real_escape_string($conn, $userInput['first_name']);
    $surname = mysqli_real_escape_string($conn, $userInput['surname']);
    $password = mysqli_real_escape_string($conn, $userInput['password']);
    $email = mysqli_real_escape_string($conn, $userInput['email']);
    $phone = mysqli_real_escape_string($conn, $userInput['phone']);

    


    #input validation
    

    if(empty(trim($name))){

        return error422('Enter Name');

    }
    elseif(empty(trim($surname))){

        return error422('Enter Surname');

    }
    elseif(empty(trim($password))){

        return error422('Enter password');

    }
    elseif(empty(trim($email))){

        return error422('Enter Email');

    }
    elseif(empty(trim($phone))){
        return error422('Enter phone number');
    }
    
    
    else{
        $query = "INSERT INTO users (isAdmin,first_name,surname,password,email,phone_number) VALUES ('$isAdmin','$name','$surname','$password','$email','$phone')";
        $result = mysqli_query($conn,$query);

        if($result){
            $data = [
                'status'=> 201,
                'message' => 'Data inserted',
                'success' => true,
            ];
            header("HTTP/1.0 201 Data inserted");
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