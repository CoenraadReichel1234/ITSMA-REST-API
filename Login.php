<?php
require '../DBConnect/dbcon.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="../Styling/LoginStyling.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
</head>
<body align="center">
    <h1>MedCare</h1>
    <img class="medIMG" src="../Styling/medical.jpeg">
    <form id="loginForm" class="loginForm">
    <label for="Email"><b>Enter Email</b></label><br>
	<input type="text" placeholder="Enter email here" name="email" id="email" required><br><br>
	
	<label for="Name"><b>Enter Firstname</b></label><br>
	<input type="text" placeholder="Enter Firstname" name="first_name" id="first_name" required><br><br>
	
	<label for="PassWord"><b>Password</b></label><br>
    <input type="password" placeholder="Enter Password" name="password" id="password" required><br><br>

	
	<button type="submit">Submit</button>
    </form>

    <div class="noAcc">Don't have an account, consult your medical centre.</div>

    <script>
    document.getElementById('loginForm').addEventListener('submit', function(e) {
        e.preventDefault();
        var email = document.getElementById('email').value;
        var first_name = document.getElementById('first_name').value;
        var password = document.getElementById('password').value;
        var data = {email: email, first_name: first_name, password: password};
        postData(data);
    });

    function postData(data) {
        fetch('../Backend/LoginCreate_Data.php', {
            method: 'POST', 
            body: JSON.stringify(data), 
            headers:{
            'Content-Type': 'application/json',
            }
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response not OK');
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            if (data.success) {
                if (data.isAdmin) {
                    alert('Successfully logged in as Admin');
                window.location.href = '../Frontend/AdminHomePage.php';
            } else {
                alert('Successfully logged in as User');
                window.location.href = '../Frontend/UserHomePage.php';
            }
            }
        });
    }
</script>
</body>
</html>