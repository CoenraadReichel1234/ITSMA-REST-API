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

function deleteUserInfo($userInput){
    global $conn;

    if(!isset($userInput['email'])){
        return error422('Email not found in input');
    }elseif($userInput['email'] == null){
        return error422('Enter Email');
    }
    else{
        $email = mysqli_real_escape_string($conn, $userInput['email']);

        $query = "DELETE FROM users WHERE email='$email' LIMIT 1";
        $result = mysqli_query($conn,$query);

        if($result){
            $data = [
                'status' => 200,
                'message' => 'User Deleted!!',
            ];
            header("HTTP/1.0 200 User Deleted");
            return json_encode($data);

        }else{
            $data = [
                'status' => 404,
                'message' => 'User Not Found',
            ];
            header("HTTP/1.0 404 User Not Found");
            return json_encode($data);
        }
    }
}

?>
