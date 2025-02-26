<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                      <li class="breadcrumb-item active">Home / Dental Services</li>
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
                                        <h5 class="text2 card-title">Explore Dental Services</h5>
                                        <p class="card-text">Discover a range of dental services to cater to your oral health needs. Learn more about each service and schedule an appointment for personalized care.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text2 card-title">Available Dental Services</h5> <br>
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
                                            $sql = "SELECT * FROM service_table";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                // Output data of each row
                                                echo '<table class="table1 table table-hover">
                                                        <thead>
                                                            <tr>
                                                                <th class="th3">Service ID</th>
                                                                <th class="th1">Service Name</th>
                                                                <th class="th2">Description</th>
                                                                <th class="th1">Duration</th>
                                                                <th class="th1">Costs</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>';
                                                while ($row = $result->fetch_assoc()) {
                                                    echo "<tr>
                                                            <td class='td1'>" . $row["service_id"] . "</td>
                                                            <td class='td1'>" . $row["service_name"] . "</td>
                                                            <td>" . $row["description"] . "</td>
                                                            <td>" . $row["duration"] . "</td>
                                                            <td>" . $row["cost"] . "</td>
                                                        </tr>";
                                                }
                                                echo '</tbody></table>';
                                            } else {
                                                echo "0 results";
                                            }
                                            $conn->close();
                                        ?>
                                            </tbody>
                                        </table>
                                        <br>
                                        <a href="#overlay" class="btn10 btn btn-outline-primary" title="Schedule Appointment">Appoint Now</a>
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
            $('.table1').DataTable();
        });
    </script>
        </main>
    </div>
    <!-- Overlay content -->
    <div id="overlay" class="overlay">
        <div class="container1 card">
            <div class="card-body">
                <button class="btn11"><a class="link1" href="Dental_Services.php">x</a></button> <br>
                <h2 class="text3">Schedule Appointment</h2> <br>
                <form id="appointmentForm" action="Dental_Services.php">
                    <label for="selectedDoctor">Select Doctor</label>
                    <input type="text" class="form-control" name="doctor_name" placeholder="Enter Doctor Name">
                    <br>
                    <label for="selectedService">Select Service</label>
                    <input type="number" class="form-control" name="service_id" placeholder="Enter Service ID">
                    <br>
                    <label class="date" style="margin-left: 150px" for="date1">Preffered Date and Time Schedule</label> <br>
                    <label for="appointmentDate1">Select Date</label>
                    <input type="date" class="form-control" name="appointmentDate1">
                    <br>
                    <label for="appointmentTime1">Select Time</label>
                    <input type="time" class="form-control" name="appointmentTime1">
                    <br>
                    <label class="date" style="margin-left: 75px" for="date2">Preffered Date and Time Schedule(incase not available)</label> <br>
                    <label for="appointmentDate2">Select Date</label>
                    <input type="date" class="form-control" name="appointmentDate2">
                    <br>
                    <label for="appointmentTime2">Select Time</label>
                    <input type="time" class="form-control" name="appointmentTime2">
                    <br>
                    <label for="payment">Payment</label>
                    <input type="text" class="form-control" name="payment" placeholder="Enter payment amount">
                    <br><br>
                    <button type="submit" class="btn12 btn btn-outline-primary">Reserve Now</button>
                </form>

            </div>
        </div>
    </div>

    <script>
$(document).ready(function() {
    // Submit form using AJAX
    $('#appointmentForm').submit(function(event) {
        // Prevent default form submission
        event.preventDefault();

        // Serialize form data
        var formData = $(this).serialize();

        // Submit form using AJAX
        $.ajax({
            type: 'POST',
            url: 'handle_appointment.php',
            data: formData,
            success: function(response) {
                // Display success message or handle other actions
                alert(response);
            },
            error: function(xhr, status, error) {
                // Handle error
                console.log(xhr.responseText);
            }
        });
    });
});
</script>

</body>


</html>

