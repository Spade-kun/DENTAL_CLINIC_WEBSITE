<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "k_country_dental_clinic";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["procedure_id"], $_POST["service_name"], $_POST["description"], $_POST["duration"], $_POST["cost"])) {
        $service_id = $_POST["procedure_id"];
        $service_name = $_POST["service_name"];
        $description = $_POST["description"];
        $duration = $_POST["duration"];
        $cost = $_POST["cost"];

        $update_query = "UPDATE service_table SET service_name='$service_name', description='$description', duration='$duration', cost='$cost' WHERE service_id='$service_id'";

        if ($conn->query($update_query) === TRUE) {
            echo "Service updated successfully";
        } else {
            echo "Error updating service: " . $conn->error;
        }
    } else {
        echo "All form fields are required";
    }
}

$conn->close();
?>
