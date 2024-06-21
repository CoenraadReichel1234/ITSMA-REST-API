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

/* Style the form */
form {
    width: 300px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color: #fff;
}

/* Style the labels */
form label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

/* Style the input fields */
form input[type="text"], form input[type="number"] {
    width: 90%;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    border: 1px solid #ccc;
}

/* Style the submit button */
form button[type="submit"] {
    width: 100%;
    padding: 10px;
    border-radius: 5px;
    border: none;
    color: white;
    background-color: #4CAF50;
    cursor: pointer;
}

form button[type="submit"]:hover {
    background-color: #45a049;
}

/* Style the table */
table {
    width: 80%;
    margin: 0 auto;
    border-collapse: collapse;
}

/* Style the table data */
table td {
    border: 1px solid #ccc;
    padding: 10px;
    text-align: center;
}
</style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
<?php
include '../Frontend/AdminHeader.php';
include '../Backend/UpdateUserData_Function.php';
include '../Backend/FindUser.php';

$userInfo = null;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['search'])){
        $email = $_POST['search_email'];
        $userInfo = getUserInfo($email);
    }else if(isset($_POST['update'])){
        $userInfo = updateUserInfo($_POST);
    }
}
?>

<form action="" method="post">
    <label for="search_email">Search Email: </lable><br>
    <input type="text" id="search_email" name="search_email" required><br>
    <button type="submit" name="search" value="search">Search</button>
</form><br><hr/>

<?php if($userInfo): ?>
<table>
<tr>
    <td>
    <form action="" method="post">
        <label for="isAdmin">Admin priviledges: </label><br>
        <input type="number" id="isAdmin" name="isAdmin" value="<?=$userInfo["isAdmin"]?>" required><br>

        <label for="first_name">Name: </lable><br>
        <input type="text" id="first_name" name="first_name" value="<?=$userInfo["first_name"]?>" required><br>

        <label for="surname">Surname: </lable><br>
        <input type="text" id="surname" name="surname" value="<?=$userInfo["surname"]?>" required><br>

        <label for="password">Password: </lable><br>
        <input type="text" id="password" name="password" value="<?=$userInfo["password"]?>" required><br>

        <label for="email">Email: </lable><br>
        <input type="text" id="email" name="email" value="<?=$userInfo["email"]?>" required><br>

        <label for="phone">Phone number: </lable><br>
        <input type="number" id="phone_number" name="phone_number" value="<?=$userInfo["phone_number"]?>" required><br><br>
        <button type="submit" name="update" value="update">Update</button>
    </form><br><hr/>
  </td></tr>
</table>
<?php endif; ?>
</body>
</html>
