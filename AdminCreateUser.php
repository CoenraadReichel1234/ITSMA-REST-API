<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
}

/* Style the h1 element */
h1 {
    text-align: center;
    color: #4CAF50;
    font-size: 2em;
    padding: 20px;
    background-color: #d8f2e0; /* Light green background */
}

/* Style the form */
#createUser {
    width: 300px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color: #fff;
}

/* Style the labels */
#createUser label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

/* Style the input fields */
#createUser input[type="text"], #createUser input[type="password"], #createUser input[type="number"] {
    width: 90%;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

/* Style the radio buttons */
#createUser input[type="radio"] {
    margin: 0 5px 0 0;
}

/* Style the submit button */
#createUser button[type="submit"] {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: none;
    color: white;
    background-color: #4CAF50;
    cursor: pointer;
}

#createUser button[type="submit"]:hover {
    background-color: #45a049;
}
    </style>        
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create User</title>
</head>
<body>
<?php
    include '../Frontend/AdminHeader.php';
    ?>

<h1>Create User</h1>
<script>
function validateForm() {
    var radios = document.getElementsByName('isAdmin');
    var formValid = false;

    var i = 0;
    while (!formValid && i < radios.length) {
        if (radios[i].checked) formValid = true;
        i++;        
    }

    if (!formValid) alert("Must check some option for Admin Priviledges");
    return formValid;
}
</script>
    
<form id="createUser" onsubmit="return validateForm()">

    <label for="isAdmin">Is user admin:</label><br>
    <input type="radio" id="toggle-on" name="isAdmin" value="1">
    <label for="toggle-on">Yes</label>

    <input type="radio" id="toggle-off" name="isAdmin" value="0">
    <label for="toggle-off">No</label>
    <br>

    <label for="name">First Name:</label><br>
    <input type="text" name="first_name" id="first_name" required><br>

    <label for="surname">Surname:</label><br>
    <input type="text" name="surname" id="surname" required><br>

    <label for="password">Password:</label><br>
    <input type="password" name="password" id="password" required><br>


    <label for="email">Email:</label><br>
    <input type="text" name="email" id="email" required><br>

    <label for="number">Phone number:</label><br>
    <input type="number" name="phone" id="phone" required><br>


    <button type="submit">Submit</button>
</form>

<script>
    document.getElementById('createUser').addEventListener('submit', function(e) {
        e.preventDefault();
        var isAdmin = document.querySelector('input[name="isAdmin"]:checked').value;
        var email = document.getElementById('email').value;
        var first_name = document.getElementById('first_name').value;
        var surname = document.getElementById('surname').value;
        var password = document.getElementById('password').value;
        var phone = document.getElementById('phone').value;
        var data = {isAdmin: isAdmin, email: email, first_name: first_name, surname: surname, password: password, phone: phone};
        postData(data);
    });

    function postData(data) {
    fetch('../Backend/CreateUser.php', {
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
        return response.text();  // change this to text
    })
    .then(text => {
        try {
            const data = JSON.parse(text);  // try to parse the text
            console.log(data);
            if (data.success) { 
                alert('User Created Successfully');
                window.location.href = '../Frontend/AdminHomePage.php'; 
            }
        } catch (error) {
            console.error('Invalid JSON:', text);
            throw error;
        }
    })
    .catch(error => console.error('Error:', error));
}

</script>

</body>
</html>
