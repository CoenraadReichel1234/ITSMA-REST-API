<?php
require '../DBConnect/dbcon.php';


function error422($message){
    $data = [
        'status' => 422,
        'message' => $message,
        'success' => false
    ];
    header("HTTP/1.0 405 Invalid Input");
    echo json_encode($data);
    exit();
}

function loginUserInfo($userInput){
    global $conn;

    $email = mysqli_real_escape_string($conn, $userInput['email']);
    $name = mysqli_real_escape_string($conn, $userInput['first_name']);
    $password = mysqli_real_escape_string($conn, $userInput['password']);
    


    #input validation
    
    if(empty(trim($email))){

        return error422('Enter Your Email');

    }
    elseif(empty(trim($name))){

        return error422('Enter Name');

    }
    elseif(empty(trim($password))){

        return error422('Enter password');

    }
    else{
        $query = "SELECT * FROM users WHERE password = '$password' AND email = '$email'";
        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result) > 0){
      
            $row = mysqli_fetch_assoc($result);
      
            if($row['isAdmin'] == '1'){
      
               $_SESSION['admin_name'] = $row['first_name'];
               $_SESSION['admin_email'] = $row['email'];
               
               $data = [
                'status'=> 201,
                'message' => 'Admin Logged in',
                'success' => true,
                'isAdmin' => true,
            ];
            header("HTTP/1.0 201 Admin Logged in");
            echo json_encode($data);
            
            exit();
            
               
      
            }elseif($row['isAdmin'] == '0'){
      
               $_SESSION['user_name'] = $row['first_name'];
               $_SESSION['user_email'] = $row['email'];
               
               $data = [
                'status'=> 201,
                'message' => 'User Logged in',
                'success' => true,
                'isAdmin' => false,
                
            ];
            
            header("HTTP/1.0 201 User Logged in");
            return json_encode($data);
            exit();
            
            

      
            }else{
                $data = [
                    'status'=> 420,
                    'message' => 'Invalid User Info',
                    'success' => false
                ];
                header("HTTP/1.0 420 Invalid User Info");
                return json_encode($data);
               
            }
            
            
      
        }else{
            $data = [
                'status'=> 420,
                'message' => 'Invalid User Info',
                'success' => false,
            ];
            header("HTTP/1.0 420 Invalid User Info");
            return json_encode($data);
        }
        

        
    }
}

?>
           


        