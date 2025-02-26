<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "k_country_dental_clinic";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $doctor_id = $_POST['doctor_id'];

    // Delete the doctor based on doctor_id
    $sql = "DELETE FROM doctor WHERE doctor_id = '$doctor_id'";
    if ($conn->query($sql) === TRUE) {
       
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
