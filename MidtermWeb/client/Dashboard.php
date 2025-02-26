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

$sql = "SELECT * FROM account";
$result = $conn->query($sql);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Dental Client Dashboard</title>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <img class="img6" src="../images/Logo.png" alt="Logo">
        <div class="logo">K-Country Dental Clinic</div>
        <i class="icon1 fa-solid fa-bell"></i>
        <div class="dropdown">
            <button class="dropbtn">Client</button>
            <div class="dropdown-content">
              <a href="Account.php">Acount</a>
              <a href="logout.php">Logout</a>
            </div>
          </div>
    </nav>

    <div class="dashboard-container">
        <!-- Sidebar -->
        <div class="sidebar">
            <ul class="sidebar-links">
                <li><a href="Dashboard.php"><i class="fas fa-home"></i> Dashboard</a></li>
                <li><a href="Dental_Services.php"><i class="fas fa-tooth"></i> Dental Services</a></li>
                <li><a href="Dentist.php"><i class="fas fa-user-md"></i> Dentists</a></li>
                <li><a href="Appointment.php"><i class="fas fa-calendar-alt"></i> Appointments</a></li>
            </ul>
        </div>

        <main class="main-content">
            <div class="page-header">
                <h1 class="text2">Welcome, <?php 
                                // Check if user is logged in and session variables are set
                                if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
                                    // Echo out the email of the logged-in user
                                    echo $_SESSION["email"];
                                } else {
                                    // Echo out a default email or handle the case when user is not logged in
                                    echo "guest@example.com";
                                }
                            ?>!</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item active">Home</li>
                    </ol>
                  </nav>
            </div>
            <div class="card1 card">
                <div class="card-body"> <br>
                <div class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text2 card-title">Your Upcoming Appointments</h5>
                                    <p class="card-text">You have 2 appointments scheduled for this week.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text2 card-title">Latest Dental Services</h5>
                                    <p class="card-text">Explore our latest dental services and stay informed about your oral health.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="text2 card-title">Your Dental History</h5> <br>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Appointment Date</th>
                                                <th>Service</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>2024-03-01</td>
                                                <td>Dental Cleaning</td>
                                                <td>Completed</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
