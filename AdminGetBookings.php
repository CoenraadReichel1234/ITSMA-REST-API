<?php
require '../DBConnect/dbcon.php';
$sql = "SELECT * FROM bookings";
$result = $conn->query($sql);

$bookings = array();
if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $bookings[] = $row;
    }
} 

echo json_encode($bookings);

$conn->close();
?>
