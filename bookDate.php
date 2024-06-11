<?php
require '../DBConnect/dbcon.php';


$bookingInfo = json_decode(file_get_contents('php://input'), true);
$date = $bookingInfo['date'];
$timeSlots = $bookingInfo['timeSlots'];
$name = $bookingInfo['name'];
$email = $bookingInfo['email'];
$phone = $bookingInfo['phone'];

$sql = "SELECT * FROM bookings WHERE date = '$date' AND timeSlots = '$timeSlots'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    echo json_encode(array("success" => false, "message" => "The chosen date and time slot is already booked. Please choose another date or time slot."));
} else {

    $sql = "INSERT INTO bookings (date, timeSlots, name, email, phone)
    VALUES ('$date', '$timeSlots', '$name', '$email', '$phone')";

    if ($conn->query($sql) === TRUE) {
        echo json_encode(array("success" => true, "message" => "New record created successfully"));
    } else {
        echo json_encode(array("success" => false, "message" => "Error: " . $sql . "<br>" . $conn->error));
    }
}

$conn->close();
?>
