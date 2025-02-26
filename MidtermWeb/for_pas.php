<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "k_country_dental_clinic";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve form data
    $email = $conn->real_escape_string($_POST['email']);
    $newPassword = $_POST['newpass'];
    $confirmPassword = $_POST['conpass'];

    // Check if new password matches the confirmation password
    if ($newPassword !== $confirmPassword) {
        echo "Error: New password and confirmation password do not match";
        exit();
    }

    // Update password in the database
    $sql = "UPDATE account SET password ='$newPassword' WHERE email ='$email'";

    if ($conn->query($sql) === TRUE) {
        echo "Password changed successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header("Location: Login.php");
    exit();

    $conn->close();
}
?>

