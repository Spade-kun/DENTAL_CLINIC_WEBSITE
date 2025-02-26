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

// Define function to get account details based on account id
function getAccountDetails($conn, $account_id) {
    $sql = "SELECT name FROM account WHERE account_id = '$account_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row;
    } else {
        return null;
    }
}
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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $account_id = $_POST['account_id'];
    $service_id = $_POST['service_id'];

    // Fetch account details based on account_id
    $account_details = getAccountDetails($conn, $account_id);

    // Fetch service name based on service_id
    $service_name = getServiceDetails($conn, $service_id);
    
    if ($account_details && isset($account_details['name']) && $service_name) {
        $name = $account_details['name'];

        // Check if the doctor already exists
        $existing_doctor_sql = "SELECT * FROM doctor WHERE account_id = '$account_id'";
        $existing_doctor_result = $conn->query($existing_doctor_sql);

        if ($existing_doctor_result->num_rows > 0) {
            // Doctor already exists, insert new specialty record
            $doctor_id = $existing_doctor_result->fetch_assoc()['doctor_id'];
            $insert_specialty_sql = "INSERT INTO doctor_specialty (doctor_id, specialty, service_id) VALUES ('$doctor_id', '$service_name', '$service_id')";
            if ($conn->query($insert_specialty_sql) === TRUE) {
                echo "Specialty added successfully";
            } else {
                echo "Error adding specialty: " . $conn->error;
            }
        } else {
            // Doctor does not exist, insert new row
            $insert_doctor_sql = "INSERT INTO doctor (doctor_name, account_id) VALUES ('$name', '$account_id')";
            if ($conn->query($insert_doctor_sql) === TRUE) {
                $doctor_id = $conn->insert_id; // Get the inserted doctor_id
                // Insert specialty for the new doctor
                $insert_specialty_sql = "INSERT INTO doctor_specialty (doctor_id, specialty, service_id) VALUES ('$doctor_id', '$service_name', '$service_id')";
                if ($conn->query($insert_specialty_sql) === TRUE) {
                    echo "New doctor and specialty added successfully";
                } else {
                    echo "Error adding specialty: " . $conn->error;
                }
            } else {
                echo "Error adding new doctor: " . $conn->error;
            }
        }

        // Redirect to Dentist.php
        header("Location: Dentist.php");
        exit();
    } else {
        echo "Account not found or missing details";
    }
}

$conn->close();
?>
