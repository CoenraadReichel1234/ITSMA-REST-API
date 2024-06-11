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
h1 {
    text-align: center;
    color: #4CAF50;
    font-size: 2em;
    padding: 20px;
    background-color: #d8f2e0; /* Light green background */
}
/* Style the h2 element */
h2 {
    text-align: center;
    color: #4CAF50;
    font-size: 1.5em;
    padding: 20px;
}

/* Style the bookings div */
#bookings {
    width: 80%;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 10px;
    background-color: #fff;
}

/* Style the p elements inside the bookings div */
#bookings p {
    border-bottom: 1px solid #ccc;
    padding: 10px;
}

/* Style the delete button */
#bookings button {
    float: right;
    padding: 5px 10px;
    border: none;
    color: white;
    background-color: #f44336;
    cursor: pointer;
}

#bookings button:hover {
    background-color: #da190b;
}
</style>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h1>HealthCare Med</h1>
    <?php
    include '../Frontend/AdminHeader.php';
    ?>
    <h2>Existing Bookings</h2>
    <div id="bookings"></div>

    <script>
        // Fetch bookings from the server when the page loads
        fetch('../Backend/AdminGetBookings.php')
        .then(response => response.json())
        .then(data => {
            var bookingsDiv = document.getElementById('bookings');
            data.forEach(booking => {
                bookingsDiv.innerHTML += '<p>Date: ' + booking.date + ', Time: ' + booking.timeSlots + ', Name: ' + booking.name + ', Email: ' + booking.email + ', Phone: ' + booking.phone + ' <button onclick="deleteBooking(' + booking.id + ')">Delete</button></p>';
            });
        })
        .catch((error) => {
            console.error('Error:', error);
        });

        function deleteBooking(bookingId) {
    if (confirm('Are you sure you want to delete this booking?')) {
        fetch('../Backend/DeleteBooking.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: 'bookingId=' + encodeURIComponent(bookingId),
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
            location.reload();
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    }
}

    </script>
</body>
</html>
