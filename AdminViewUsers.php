<!DOCTYPE html>
<html lang="en">
<head>
<style>
/* Style the body */
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

/* Style the table */
#userTable {
    width: 80%;
    margin: 0 auto;
    border-collapse: collapse;
}

/* Style the table headers */
#userTable th {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
}

/* Style the table data */
#userTable td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: center;
}
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Users</title>
</head>
<body>
<h1>HealthCare Med</h1>
<?php
    include '../Frontend/AdminHeader.php';
    ?><br><br>
    <table id="userTable">
        <tr>
            <th>isAdmin</th>
            <th>Name</th>
            <th>Surname</th>
            <th>Password</th>
            <th>Email</th>
            <th>Phone Number</th>
        </tr>
    </table>

    <script>
        fetch('../Backend/GETUserData.php')
            .then(response => response.json())
            .then(data => {
                let table = document.getElementById('userTable');
                data.data.forEach(item => { // Note the change here
                    let row = `<tr>
                        <td>${item.isAdmin}</td>
                        <td>${item.first_name}</td>
                        <td>${item.surname}</td>
                        <td>${item.password}</td>
                        <td>${item.email}</td>
                        <td>${item.phone_number}</td>
                    </tr>`;
                    table.innerHTML += row;
                });
            })
            .catch(error => console.error('Error:', error));
    </script>
</body>
</html>
