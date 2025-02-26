<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Dental Admin Dashboard</title>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <img class="img6" src="../images/Logo.png" alt="Logo">
        <div class="logo">K-Country Dental Clinic</div>
        <i class="icon1 fa-solid fa-bell"></i>
        <div class="dropdown">
            <button class="dropbtn">Admin</button>
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
                <li><a href="Patients.php"><i class="fas fa-user"></i> Patients</a></li>
            </ul>
        </div>

        <main class="main-content">
            <div class="page-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item active">Home / Patients</li>
                    </ol>
                  </nav>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text2 card-title">Patients History</h5> <br>
                                <?php
                            // Database connection
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname = "k_country_dental_clinic";

                            $conn = new mysqli($servername, $username, $password, $dbname);

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Fetch data from database
                            $sql = "SELECT * FROM patient";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                // Output data of each row
                                echo '<table class="table1 table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="th1">Patient ID</th>
                                                <th class="th1">Account ID</th>
                                                <th class="th1">Patient Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>';
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>
                                            <td class='td1'>" . $row["patient_id"] . "</td>
                                            <td class='td1'>" . $row["account_id"] . "</td>
                                            <td>" . $row["patient_name"] . "</td>
                                        </tr>";
                                }
                                echo '</tbody></table>';
                            } else {
                                echo "0 results";
                            }
                            $conn->close();
                        ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </main>
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
</body>
</html>
