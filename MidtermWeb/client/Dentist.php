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
                      <li class="breadcrumb-item active">Home / Dentist</li>
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
                                        <h5 class="text2 card-title">Meet Our Dentists</h5>
                                        <p class="card-text">Get to know our experienced dentists who are dedicated to providing high-quality dental care. Learn about their expertise and schedule an appointment with the dentist of your choice.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text2 card-title">Our Dentists</h5> <br>
                                        <table class="table1 table">
                                            <thead>
                                                <tr>
                                                    <th class="th1">Dentist ID</th>
                                                    <th class="th2">Account ID</th>
                                                    <th class="th3">Dentist Name</th>
                                                    <th class="th2">Specialization</th>
                                                </tr>
                                                </thead>
                                                <tbody>
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

                                                    $sql = "SELECT d.doctor_id, d.doctor_name, d.account_id, GROUP_CONCAT(ds.specialty SEPARATOR ', ') AS specialties 
                                                    FROM doctor d 
                                                    LEFT JOIN doctor_specialty ds ON d.doctor_id = ds.doctor_id 
                                                    GROUP BY d.doctor_id";

                                                    $result = $conn->query($sql);

                                                    if ($result->num_rows > 0) {
                                                        while($row = $result->fetch_assoc()) {
                                                            echo "<tr>";
                                                            echo "<td>" . $row['doctor_id'] . "</td>";
                                                            echo "<td>" . $row['account_id'] . "</td>";
                                                            echo "<td>" . $row['doctor_name'] . "</td>";
                                                            echo "<td>" . $row['specialties'] . "</td>"; // Display concatenated specialties
                                                            echo "</tr>";
                                                        }
                                                    } else {
                                                        echo "<tr><td colspan='5'>No doctors found</td></tr>";
                                                    }
                                                            $conn->close();
                                                ?>
                                            </tbody>
                                        </table>
                                        <br>
                                        <a href="#overlay" class="btn6 btn btn-outline-primary">Appointment</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <!-- Overlay content -->
    <div id="overlay" class="overlay">
        <div class="container1 card">
            <div class="card-body">
                <button class="btn11"><a class="link1" href="Dentist.html">x</a></button> <br>
                <h2 class="text3">Schedule Appointment</h2> <br>
                <form action="Dentist.html">
                    <label for="selectedDoctor">Select Doctor</label>
                    <select class="form-control" id="selectedDoctor">
                        <option>Dr. John Smith</option>
                    </select>
                    <br>
                    <label for="selectedService">Select Service</label>
                    <select class="form-control" id="selectedService">
                        <option>Dental Cleanings (Prophylaxis)</option>
                        <option>Dental Exams</option>
                        <option>X-rays (Radiographs)</option>
                        <option>Fillings</option>
                        <option>Dental Crowns</option>
                        <option>Bridges</option>
                        <option>Dentures</option>
                        <option>Root Canal Therapy</option>
                        <option>Orthodontic Services</option>
                        <option>Teeth Whitening</option>
                        <option>Dental Implants</option>
                        <option>Periodontal Therapy</option>
                        <option>Extractions</option>
                        <option>Oral Surgery</option>
                        <option>TMJ (Temporomandibular Joint) Treatment</option>
                        <option>Mouthguards</option>
                        <option>Cosmetic Dentistry</option>
                    </select>
                    <br>
                    <label class="date" for="date1">Date 1</label> <br>
                    <label for="appointmentDate1">Select Date</label>
                    <input type="date" class="form-control" id="appointmentDate1">
                    <br>
                    <label for="appointmentTime1">Select Time</label>
                    <input type="time" class="form-control" id="appointmentTime1">
                    <br>
                    <label class="date" for="date2">Date 2</label> <br>
                    <label for="appointmentDate2">Select Date</label>
                    <input type="date" class="form-control" id="appointmentDate2">
                    <br>
                    <label for="appointmentTime2">Select Time</label>
                    <input type="time" class="form-control" id="appointmentTime2">
                    <br>
                    <label for="payment">Payment</label>
                    <input type="text" class="form-control" id="payment" placeholder="Enter payment amount">
                    <br><br>
                    <button type="submit" class="btn12 btn btn-outline-primary">Reserve Now</button>
                </form>
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
            $('.table1').DataTable();
        });
    </script>
</body>

</html>