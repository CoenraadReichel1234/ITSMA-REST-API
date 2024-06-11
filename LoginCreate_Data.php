<?php

#error_reporting(0);

header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Method: POST');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');

include('../Backend/POST_LoginData_Function.php');


$requestMethod = $_SERVER["REQUEST_METHOD"];

if($requestMethod == "POST"){
    $inputData = json_decode(file_get_contents("php://input"), true);
    if(empty($inputData)){

        
        $loginUser = loginUserInfo($_POST);

    }
    else{
        $loginUser = loginUserInfo($inputData);
        
        
    }
    echo $loginUser;
    
    
}
else {
    $data = [
        'status' => 405,
        'message' => $requestMethod. ' Method not allowed',
    ];
    header("HTTP/1.0 405 Method not allowed");
    echo json_encode($data);

}
?>