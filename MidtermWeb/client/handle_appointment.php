<?php
session_start();
// Database connection
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

// Ensure the user is logged in
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    // Get the user's account_id and name
    $userId = $_SESSION["account_id"];
    $userName = $_SESSION["name"];

    // Fetch the patient_id for the user
    $get_patient_id_sql = "SELECT patient_id FROM patient WHERE account_id = '$userId'";
    $get_patient_id_result = $conn->query($get_patient_id_sql);
    $patient_row = $get_patient_id_result->fetch_assoc();
    $patient_id = $patient_row['patient_id'];

    // Check if the user already exists in the appointment_table, if not, add them
    $check_user_sql = "SELECT * FROM appointment_table WHERE account_id = '$userId'";
    $check_user_result = $conn->query($check_user_sql);
    
    if ($check_user_result->num_rows == 0) {
        // Insert the user into the appointment_table
        $insert_user_sql = "INSERT INTO appointment_table (name, account_id) VALUES ('$userName', '$userId')";
        if (!$conn->query($insert_user_sql)) {
            echo "Error inserting user: " . $conn->error;
            exit;
        }
    }

    // Fetch the appointment_id for the user
    $get_appointment_id_sql = "SELECT appointment_id FROM appointment_table WHERE account_id = '$userId'";
    $get_appointment_id_result = $conn->query($get_appointment_id_sql);
    $appointment_row = $get_appointment_id_result->fetch_assoc();
    $appointment_id = $appointment_row['appointment_id'];

    // Check if the required POST data is set
    if (isset($_POST['doctor_name'], $_POST['service_id'], $_POST['appointmentDate1'], $_POST['appointmentTime1'], $_POST['appointmentDate2'], $_POST['appointmentTime2'], $_POST['payment'])) {
        // Get the appointment details from POST data
        $doctor_name = $_POST['doctor_name'];
        $service_id = $_POST['service_id'];
        $appointment_date1 = $_POST['appointmentDate1'];
        $appointment_time1 = $_POST['appointmentTime1'];
        $appointment_date2 = $_POST['appointmentDate2'];
        $appointment_time2 = $_POST['appointmentTime2'];
        $payment = $_POST['payment'];

        // Fetch the doctor_id from the doctor table based on the doctor_name
        $get_doctor_id_sql = "SELECT doctor_id FROM doctor WHERE doctor_name = '$doctor_name'";
        $get_doctor_id_result = $conn->query($get_doctor_id_sql);

        if ($get_doctor_id_result->num_rows > 0) {
            $doctor_row = $get_doctor_id_result->fetch_assoc();
            $doctor_id = $doctor_row['doctor_id'];

            // Check if the appointment already exists for the user
            $existing_appointment_sql = "SELECT * FROM appointments WHERE patient_id = '$patient_id' AND doctor_id = '$doctor_id' AND service_id = '$service_id' AND date1 = '$appointment_date1' AND time1 = '$appointment_time1' AND date2 = '$appointment_date2' AND time2 = '$appointment_time2' AND payment = '$payment'";
            $existing_appointment_result = $conn->query($existing_appointment_sql);

            if ($existing_appointment_result->num_rows == 0) {
                // Insert the appointment with the correct patient_id and appointment_id
                $appointments_sql = "INSERT INTO appointments (patient_id, appointment_id, doctor_id, service_id, date1, time1, date2, time2, payment) VALUES ('$patient_id', '$appointment_id', '$doctor_id', '$service_id', '$appointment_date1', '$appointment_time1', '$appointment_date2', '$appointment_time2', '$payment')";
                if ($conn->query($appointments_sql) === TRUE) {
                    echo "Appointment scheduled successfully";
                } else {
                    echo "Error scheduling appointment: " . $conn->error;
                }
            } else {
                echo "You already have an appointment scheduled";
            }
        } else {
            echo "Doctor not found";
        }
    } else {
        echo "Missing appointment details";
    }
} else {
    echo "User not logged in";
}

// Close connection
$conn->close();
?>
