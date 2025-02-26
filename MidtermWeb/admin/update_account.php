<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "k_country_dental_clinic";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$email = $_POST['email']; // Reference email for identifying the account
$contact = $_POST['contact'];
$address = $_POST['address'];

// Update database only if the logged-in user's email matches the reference email
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true && $_SESSION["email"] === $email) {
    $sql = "UPDATE account SET name='$name', contact='$contact', address='$address' WHERE email='$email'";
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
} else {
    echo "Unauthorized access"; // Handle unauthorized access
}

$conn->close();
?>
