<?php
// Establish database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "k_country_dental_clinic";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$age = $_POST['age'];
$contact = $_POST['contact'];
$address = $_POST['address'];
$gender = $_POST['gender'];
$loginType = $_POST['loginType'];

// Check if username or email already exists
$sql_check = "SELECT * FROM account WHERE username='$username' OR email='$email'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    // Username or email already exists
    echo "Username or email already exists.";
} else {
    // Insert into account table
    $sql = "INSERT INTO account (name, username, password, email, age, contact, address, gender, loginType)
    VALUES ('$name', '$username', '$password', '$email', '$age', '$contact', '$address', '$gender', '$loginType')";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;
        
        // Check loginType and insert into appropriate table
        switch($loginType) {
            case "Patient":
                $sql_patient = "INSERT INTO patient (account_id, patient_name) VALUES ('$last_id', '$name')";
                if ($conn->query($sql_patient) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql_patient . "<br>" . $conn->error;
                }
                break;
            case "Doctor":
                $sql_doctor = "INSERT INTO doctor (account_id, doctor_name) VALUES ('$last_id', '$name')";
                if ($conn->query($sql_doctor) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql_doctor . "<br>" . $conn->error;
                }
                break;
        }
        header("Location: Login.php");
            exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
