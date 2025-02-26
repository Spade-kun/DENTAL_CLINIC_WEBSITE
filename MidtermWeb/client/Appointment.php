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
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item active">Home / Appointment</li>
                    </ol>
                  </nav>
            </div>
            
            <div class="card1 card">
                <div class="card-body"> <br>
                    <div class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text2 card-title">Your Appointments</h5>
                                        <p class="card-text">View and manage your upcoming dental appointments. Stay organized and receive timely reminders for your scheduled visits.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text2 card-title">Upcoming Appointments</h5> <br>
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
                                                // Get the user's account_id
                                                $userId = $_SESSION["account_id"];

                                                // Fetch patient_id based on account_id
                                                $patientIdQuery = "SELECT patient_id FROM patient WHERE account_id = '$userId'";
                                                $patientIdResult = $conn->query($patientIdQuery);

                                                if ($patientIdResult->num_rows > 0) {
                                                    $patientRow = $patientIdResult->fetch_assoc();
                                                    $patientId = $patientRow['patient_id'];

                                                    // Fetch appointments data for the patient
                                                    $appointmentsQuery = "SELECT date1, date2, doctor_id, service_id
                                                                        FROM appointments
                                                                        WHERE patient_id = '$patientId'";
                                                    $appointmentsResult = $conn->query($appointmentsQuery);

                                                    if ($appointmentsResult->num_rows > 0) {
                                                        // Display the appointment data in a table
                                                        echo '<table class="table table-hover">';
                                                        echo '<thead>';
                                                        echo '<tr>';
                                                        echo '<th>Appointment Date 1</th>';
                                                        echo '<th>Appointment Date 2</th>';
                                                        echo '<th>Dentist</th>';
                                                        echo '<th>Service</th>';
                                                        echo '</tr>';
                                                        echo '</thead>';
                                                        echo '<tbody>';
                                                        
                                                        while ($row = $appointmentsResult->fetch_assoc()) {
                                                            // Fetch doctor_name using doctor_id
                                                            $doctorId = $row['doctor_id'];
                                                            $doctorQuery = "SELECT doctor_name FROM doctor WHERE doctor_id = '$doctorId'";
                                                            $doctorResult = $conn->query($doctorQuery);
                                                            if ($doctorResult->num_rows > 0) {
                                                                $doctorRow = $doctorResult->fetch_assoc();
                                                                $doctorName = $doctorRow['doctor_name'];
                                                            } else {
                                                                $doctorName = "Unknown Doctor";
                                                            }

                                                            // Fetch service_name using service_id
                                                            $serviceId = $row['service_id'];
                                                            $serviceQuery = "SELECT service_name FROM service_table WHERE service_id = '$serviceId'";
                                                            $serviceResult = $conn->query($serviceQuery);
                                                            if ($serviceResult->num_rows > 0) {
                                                                $serviceRow = $serviceResult->fetch_assoc();
                                                                $serviceName = $serviceRow['service_name'];
                                                            } else {
                                                                $serviceName = "Unknown Service";
                                                            }

                                                            // Display the appointment data
                                                            echo '<tr>';
                                                            echo '<td>' . $row['date1'] . '</td>';
                                                            echo '<td>' . $row['date2'] . '</td>';
                                                            echo '<td>' . $doctorName . '</td>';
                                                            echo '<td>' . $serviceName . '</td>';
                                                            echo '</tr>';
                                                        }

                                                        echo '</tbody>';
                                                        echo '</table>';
                                                    } else {
                                                        echo "No appointments found for the user.";
                                                    }
                                                } else {
                                                    echo "Patient ID not found for the user.";
                                                }
                                            } else {
                                                echo "User not logged in";
                                            }

                                            // Close connection
                                            $conn->close();
                                            ?>

                                        <br>
                                        <a href="Dental_Services.php" class="btn7 btn btn-outline-primary">Reserve Now</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css"/>
            <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
            <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0-alpha3/js/bootstrap.min.js"></script>

            <div>
                <br>
            </div>
    <script>
        $(document).ready(function () {
            // Initialize DataTables
            $('.table').DataTable();
        });
    </script>
        </main>
</body>
</html>
