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
              <a href="../MainHome.php">Logout</a>
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
                      <li class="breadcrumb-item active">Home / Dentist</li>
                    </ol>
                  </nav>
            </div>
            <div class="dashboard-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text2 card-title">Dentists History</h5>
                                <a href="#overlay" class="btn13 btn btn-outline-success">Add Doctor</a>
                                <table class="table1 table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="th1 ">Doctor's ID</th>
                                            <th class="th1 ">Doctor's Name</th>
                                            <th class="th2">Specialty</th>
                                            <th class="th1">Action</th>
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
                                        echo "<td>" . $row['doctor_name'] . "</td>";
                                        echo "<td>" . $row['specialties'] . "</td>"; // Display concatenated specialties
                                        echo "<td>
                                                <button class='btn btn-sm btn-primary' title='Edit Doctor' onclick='showUpdateForm(" . $row['doctor_id'] . ")'><i class='fas fa-user-md'></i></button>
                                                <button class='btn btn-sm btn-danger' title='Delete' onclick='deleteDoctor(" . $row['doctor_id'] . ")'><i class='fas fa-trash'></i></button>
                                            </td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No doctors found</td></tr>";
                                }
                                        $conn->close();
                                    ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </main>
        <div id="overlay" class="overlay">
        <div class="container3 card">
            <div class="card-body">
                <button class="btn11"><a class="link1" href="Dentist.php">x</a></button> <br>
                <h2 class="text3">Add New Doctor</h2>
                <form method="post" action="add_doctor.php">
                    <div class="div2">
                        <label><b>Account ID</b></label><br>
                        <input type="number" name="account_id" placeholder="Account ID" required> <br> <br>
                        <label><b>Service ID</b></label><br>
                        <input type="number" name="service_id" placeholder="Service ID" required> <br> <br>
                        <button type="submit" class="btn btn-outline-primary">Add</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
     <!-- Update form -->
     <div id="updateForm" class="overlay" style="display: none;">
        <div class="container4 card" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 80%; max-width: 400px; padding: 20px; background-color: white; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);">
        <div class="card-body">
            <button class="btn11" onclick="hideUpdateForm()"><a class="link1">x</a></button> <br>
            <h2 class="text3">Update Doctor</h2> <br>
            <form action="Dentist.php" method="post" onsubmit="return updateDoctor()">
            <input type="hidden" id="update_doctor_id" name="doctor_id">
            <label><b>Service ID</b></label><br>
            <input type="number" id="update_service_id" name="service_id" placeholder="Update Service ID" required><br><br>
                <button type="submit" onlclick="updateDoctor()" id="updateBtn" class="btn btn-outline-primary" style="display: block; margin: 0 auto;">Update Service</button>
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
            $('.table').DataTable();
        });
    </script>
    <script>
    function showUpdateForm(doctorId, serviceId) {
    document.getElementById("update_doctor_id").value = doctorId;
    document.getElementById("update_service_id").value = serviceId;
    document.getElementById("updateForm").style.display = "block";
}

    function hideUpdateForm() {
        document.getElementById("updateForm").style.display = "none";
    }

    function updateDoctor() {
    var doctorId = document.getElementById("update_doctor_id").value;
    var serviceId = document.getElementById("update_service_id").value;

    $.ajax({
        type: "POST",
        url: "update_doctor.php",
        data: {
            doctor_id: doctorId,
            service_id: serviceId
        },
        success: function(response) {
            alert(response); // Show success message
            hideUpdateForm(); // Hide the update form after successful update
            // You might want to refresh the doctor listing here
        },
        error: function(xhr, status, error) {
            alert("Error: " + error); // Show error message
        }
    });

    return false; // Prevent form submission
}

    function deleteDoctor(doctorId) {
        if (confirm("Are you sure you want to delete this doctor?")) {
            $.ajax({
                type: "POST",
                url: "delete_doctor.php",
                data: { doctor_id: doctorId },
                success: function(response) {
                    
                },
                error: function(xhr, status, error) {
                    alert("Error: " + error); // Show error message
                }
            });
        }
        // Prevent default action
        event.preventDefault();
    }
</script>

</body>

</html>
