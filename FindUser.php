<?php

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
?>
