<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "k_country_dental_clinic";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if service ID is sent
    if (isset($_POST["service_id"])) {
        // Get and sanitize service ID
        $service_id = $_POST["service_id"];

        // Delete service from the database
        $delete_query = "DELETE FROM service_table WHERE service_id = '$service_id'";
        if ($conn->query($delete_query) === TRUE) {
            echo "Service deleted successfully";
        } else {
            echo "Error deleting service: " . $conn->error;
        }
    } else {
        echo "Service ID is required";
    }
}
?>
