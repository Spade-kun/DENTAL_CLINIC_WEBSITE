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
    $doctorId = $_POST['doctor_id'];
    $serviceId = $_POST['service_id'];

    // Fetch service name based on service_id
    function getServiceDetails($conn, $service_id) {
        $sql = "SELECT service_name FROM service_table WHERE service_id = '$service_id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['service_name']; // Return only service name
        } else {
            return null;
        }
    }

    $service_name = getServiceDetails($conn, $serviceId);

    if ($service_name) {
        $sql = "UPDATE doctor SET service_id = '$serviceId', specialty = '$service_name' WHERE doctor_id = '$doctorId'";

        if ($conn->query($sql) === TRUE) {
            echo "Doctor updated successfully";
        } else {
            echo "Error updating doctor: " . $conn->error;
        }
    } else {
        echo "Service details not found";
    }
}

$conn->close();
?>
