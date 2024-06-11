<?php
require '../DBConnect/dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the booking ID from the POST request
    $bookingId = $_POST["bookingId"];

    // Delete the booking
    $sql = "DELETE FROM bookings WHERE id = $bookingId";

    if ($conn->query($sql) === TRUE) {
        echo "Booking deleted successfully";
    } else {
        echo "Error deleting booking: " . $conn->error;
    }
}

$conn->close();
?>
