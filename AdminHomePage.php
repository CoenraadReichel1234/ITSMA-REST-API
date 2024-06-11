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

/* Style the image container */
.imgCont {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 20px;
}

/* Style the image */
.imgCont .image img {
    max-width: 100%;
    height: auto;
    box-shadow: 0px 10px 18px 0px rgba(0,0,0,0.25); /* Add shadow to make the image stand out */
}
</style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home</title>
</head>
<body>
    <h1>HealthCare Med</h1>
    <?php
    include '../Frontend/AdminHeader.php';
    ?>
    <div class="imgCont">
        <div class="Container">
            <div class="image">
            <img src="../Styling/medical.jpeg">
            </div>
        </div>
    </div>
    
    
</body>
</html>