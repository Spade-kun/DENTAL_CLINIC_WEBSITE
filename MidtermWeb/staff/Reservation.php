<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Dental Staff Dashboard</title>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <img class="img6" src="../images/Logo.png" alt="Logo">
        <div class="logo">K-Country Dental Clinic</div>
        <i class="icon1 fa-solid fa-bell"></i>
        <div class="dropdown">
            <button class="dropbtn">Dentist</button>
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
                <li><a href="Reservation.php"><i class="fas fa-calendar-alt"></i> Reservation</a></li>
            </ul>
        </div>

        <main class="main-content">
            <div class="page-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item active">Home / Reservation</li>
                    </ol>
                  </nav>
            </div>
            
            <div class="content">
                <div class="row">
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

    // Fetch doctor_id based on account_id
    $doctorIdQuery = "SELECT doctor_id FROM doctor WHERE account_id = '$userId'";
    $doctorIdResult = $conn->query($doctorIdQuery);

    if ($doctorIdResult->num_rows > 0) {
        $doctorRow = $doctorIdResult->fetch_assoc();
        $doctorId = $doctorRow['doctor_id'];

        // Fetch appointments data for the doctor
        $appointmentsQuery = "SELECT appointments.patient_id, appointments.date1, appointments.date2, service_table.service_name AS service_name
                            FROM appointments
                            INNER JOIN service_table ON appointments.service_id = service_table.service_id
                            WHERE appointments.doctor_id = '$doctorId'";
        $appointmentsResult = $conn->query($appointmentsQuery);

        if ($appointmentsResult->num_rows > 0) {
            // Display the appointment data in a table
            echo '<table class="table1 table table-hover">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Patient\'s Name</th>';
            echo '<th>Appointment Date1</th>';
            echo '<th>Appointment Date2</th>';
            echo '<th>Service</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            while ($row = $appointmentsResult->fetch_assoc()) {
                // Fetch patient name using patient_id
                $patientId = $row['patient_id'];
                $patientNameQuery = "SELECT patient_name FROM patient WHERE patient_id = '$patientId'";
                $patientNameResult = $conn->query($patientNameQuery);
                $patientName = "Unknown Patient";

                if ($patientNameResult->num_rows > 0) {
                    $patientRow = $patientNameResult->fetch_assoc();
                    $patientName = $patientRow['patient_name'];
                }

                // Display the appointment data
                echo '<tr>';
                echo '<td>' . $patientName . '</td>';
                echo '<td>' . $row['date1'] . '</td>';
                echo '<td>' . $row['date2'] . '</td>';
                echo '<td>' . $row['service_name'] . '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
        } else {
            echo "No appointments found for the doctor.";
        }
    } else {
        echo "Doctor ID not found for the user.";
    }
} else {
    echo "User not logged in";
}

// Close connection
$conn->close();
?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function () {
            // Initialize DataTables
            $('.table1').DataTable();
        });
    </script>
        </main>
    </div>
</body>
</html>
