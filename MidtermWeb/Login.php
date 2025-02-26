<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="icon" type="image/png" href="images/Logo-circle.png">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="topnav">
        <div>
            <img class="img5" src="images/Logo.png" alt="Logo">
        </div>
        <a href="MainHome.php">Home</a>
        <a href="AboutUs.php">About Us</a>
        <a href="Services.php">Services</a>
        <a href="Login.php" class="nav1">Login/SignUp</a>
    </nav>
    
    <div>
        <img class="img2" src="images/Background.jpg" alt="Photo">
        <div class="clinic-text1">
            <h1 class="h1">K-Country Dental Clinic</h1>
        </div>
        <div class="bp2">
            <a href="Selection.html" class="nav-link-active">
                <button class="btn1 btn btn-primary">Reserve Now</button>
            </a>
        </div>
        <div class="login-container"> 
        <form class="f1" method="post">
                <button class="btn11"><a class="link1" href="MainHome.php">x</a></button> <br>
                <img class="img3" src="images/Logo.png" alt="Logo">
                <h1>Login Account</h1><br>
                <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-email"></i></span>
                        <input type="text" class="form-control" placeholder="Email" name="email" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>
                      
                 <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-lock"></i></span>
                        <input type="password" class="form-control" placeholder="Password" name="password" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>
                    <p class="p1">Forgot password? Click <a class="a1" href="ForgotPass.php">here</a></p>
                    <button class="btn2 btn btn-primary" type="submit">Login</button> <br> <br>
                    <p>Don't have account? <a class="a1" href="Signup.php">Sign up</a></p>
            </form>
        </div>
    </div>
</body>
</html>
<?php
// Start the session
session_start();

// Check if the form is submitted via POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file here
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

    // Check if email and password are set and not empty
    if (isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        // Prepare a select statement
        $sql = "SELECT account_id, email, name, password, loginType FROM account WHERE email = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);

            // Set parameters
            $param_email = $_POST['email'];

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Store result
                $stmt->store_result();

                // Check if email exists, if yes then verify password
                if ($stmt->num_rows == 1) {
                    // Bind result variables
                    $stmt->bind_result($id, $email, $name, $db_password, $role);
                    if ($stmt->fetch()) {
                        if ($_POST['password'] == $db_password) {
                            // Password is correct, so start a new session
                           
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["account_id"] = $id;
                            $_SESSION["email"] = $email;
                            $_SESSION["loginType"] = $role;
                            $_SESSION["name"] = $name;

                            // Redirect user based on role
                            switch ($role) {
                                case 'Admin':
                                    header("Location: ./admin/Dashboard.php");
                                    break;
                                case 'Doctor':
                                    header("Location: ./staff/Dashboard.php");
                                    break;
                                case 'Patient':
                                    header("Location: ./client/Dashboard.php");
                                    break;
                                default:
                                    header("Location: index.php");
                                    break;
                            }
                        } else {
                            // Password is not valid, display a generic error message
                            echo "<div class='alert alert-danger' role='alert>'Invalid email or password.</div>";
                        }
                    }
                } else {
                    // Email doesn't exist, display a generic error message
                    echo "<div class='alert alert-danger' role='alert>'Invalid email or password.</div>";
                }
            } else {
                // Display an error message if execution failed
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $conn->close();
}

?>