<!DOCTYPE html>
<html>
<head>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f2f2f2;
}

/* Style the main heading */
h1 {
    text-align: center;
    padding: 20px;
    background-color: #4CAF50;
    color: white;
}

/* Style the secondary heading */
h2 {
    text-align: center;
    color: #4CAF50;
}

/* Style the form */
#bookingForm {
    width: 300px;
    margin: 0 auto;
    padding: 20px;
}

/* Style the labels */
#bookingForm label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}

/* Style the input fields */
#bookingForm input[type="text"], #bookingForm input[type="email"], #bookingForm input[type="tel"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border-radius: 5px;
    border: 1px solid #ccc;
}
#calendar {
    width: 70%;
    margin: 0 auto;
    border-collapse: collapse;

}
#calendar th {
    background-color: #4CAF50;
    color: white;
    padding: 10px;
}

#calendar td {
    border: 1px solid #ccc;
    height: 1px;
    vertical-align: top; 
    padding: 1px;
}

#calendar td button {
    font-size: 18px;
    width: 100%;
    height: 100%;
    border: none;
    background-color: #f2f2f2;
    cursor: pointer;
    padding-top: 20px;
    padding-bottom: 20px;
    transition: background-color 0.3s ease;
    
}

#calendar td button:hover {
    background-color: lightgreen;
}


#bookings {
    width: 70%;
    margin: 0 auto;
    padding: 20px;
}
</style>
    <title>Booking Calendar</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
    <h1>HealthCare Med</h1>
    <?php 
    include "../Frontend/UserHeader.php";
    ?>
    

    <h2>Booking Calendar</h2>
    <form id="bookingForm">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        <label for="phone">Phone:</label><br>
        <input type="tel" id="phone" name="phone" required><br><br>
    </form><br><br>

    <table id="calendar">
        <tr>
            <th>Sun</th>
            <th>Mon</th>
            <th>Tue</th>
            <th>Wed</th>
            <th>Thu</th>
            <th>Fri</th>
            <th>Sat</th>
        </tr>
    </table>

    <script>
        var date = new Date();
        var month = date.getMonth();
        var year = date.getFullYear();
        var firstDay = new Date(year, month, 1);
        var lastDay = new Date(year, month + 1, 0);
        var calendar = document.getElementById('calendar');

        for (var i = firstDay.getDay(); i > 0; i--) {
            var cell = calendar.insertRow(-1).insertCell(-1);
            cell.colSpan = i;
            cell.style.border = 'none';
        }

        for (var i = 1; i <= lastDay.getDate(); i++) {
            var cell = calendar.rows[calendar.rows.length - 1].insertCell(-1);
            cell.innerHTML = '<button onclick="bookDate(' + i + ')">' + i + '</button>';
            if (calendar.rows[calendar.rows.length - 1].cells.length === 7) {
                calendar.insertRow(-1);
            }
        }

        var bookings = [];
        window.onload = function() {
        fetch('../Backend/getBookings.php')
        .then(response => response.json())
        .then(data => {
            bookings = data;
            
            displayBookings();
        })
        .catch((error) => {
            console.error('Error:', error);
        });
    };

        function displayBookings() {
            var bookingsDiv = document.getElementById('bookings');
            bookingsDiv.innerHTML = '<h2>Booked Dates and Times</h2>';
            for (var i = 0; i < bookings.length; i++) {
                var booking = bookings[i];
                bookingsDiv.innerHTML += '<p>Date: ' + booking.date + ', Time: ' + booking.timeSlots + '</p>';
            }
        }

        function bookDate(i) {
            var startTime = prompt('Please enter a start time between 8:00 AM and 5:00 PM (e.g., 9:00 AM):');
            if (startTime) {
                var date = new Date(year, month, i); // Set the date to the selected day
                var formattedDate = date.getFullYear() + '-' + (date.getMonth() + 1) + '-' + date.getDate();
                var formattedStartTime = convertTo24Hour(startTime);

                var name = document.getElementById('name').value;
                var email = document.getElementById('email').value;
                var phone = document.getElementById('phone').value;
                var bookingInfo = {
                    date: formattedDate,
                    timeSlots: formattedStartTime,
                    name: name,
                    email: email,
                    phone: phone
                };



                // Send bookingInfo to the server
                fetch('../Backend/bookDate.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(bookingInfo),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Booking successful: ' + data.message);
                    } else {
                        alert('Booking failed: ' + data.message);
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                });
            }
    }
    function convertTo24Hour(time) {
    var hours = parseInt(time.substr(0, 2));
    time = time.toUpperCase();
    if(time.indexOf('AM') != -1 && hours == 12) {
        time = time.replace('12', '0');
    }
    if(time.indexOf('PM')  != -1 && hours < 12) {
        time = time.replace(hours, (hours + 12));
    }
    return time.replace(/(AM|PM)/, '');
}

    </script>
    
    <div id="bookings"></div>
</body>
</html>
