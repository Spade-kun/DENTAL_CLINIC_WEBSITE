<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
              <a href="Settings.php">Settings</a>
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

        <!-- Main Content -->
        <main class="main-content">
            <div class="page-header">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                      <li class="breadcrumb-item active">Home / Dental Services</li>
                    </ol>
                  </nav>
            </div>
            
            <!-- Dental Services Overview -->
            <div class="card">
                <div class="card-body">
                    <div class="content">
                        <h2 class="text2">Dental Services Overview</h2>
                        <p>Manage and view information about the dental services provided by K-Country Dental Clinic. You can add, edit, or remove services as needed.</p>
                        <a href="#overlay" class="btn4 btn btn-outline-success">Add New</a><br>
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
                                                <th>Service ID</th>
                                                <th class="th1">Service Name</th>
                                                <th class="th5">Description</th>
                                                <th>Duration</th>
                                                <th>Costs</th>
                                                <th>Actions</th>
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
                                            <td>
                                                <button class='btn btn-sm btn-primary' title='Edit' onclick='showUpdateForm(" . $row["service_id"] . ", \"" . $row["service_name"] . "\", \"" . $row["description"] . "\", \"" . $row["duration"] . "\", \"" . $row["cost"] . "\")'><i class='fas fa-edit'></i></button>
                                                <button class='btn btn-sm btn-danger' title='Delete' onclick='deleteService(" . $row["service_id"] . ")'><i class='fas fa-trash'></i></button>

                                            </td>
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
        </main>
    </div>
    <!-- Overlay content -->
    <div id="overlay" class="overlay">
        <div class="container1 card">
            <div class="card-body">
                <button class="btn11"><a class="link1" href="Dental_Services.php">x</a></button> <br>
                <h2 class="text3">Add Services</h2> <br>
                <form action="dental_services.php" method="post">
                    <label><b>Service Name</b></label><br>
                    <input type="text" name="service_name" placeholder="Service Name"><br><br>
                    <label><b>Description</b></label><br>
                    <textarea name="description" class="form-control"></textarea><br>
                    <label><b>Duration</b></label><br>
                    <input type="text" name="duration" placeholder="Duration"><br><br>
                    <label><b>Cost</b></label><br>
                    <input type="text" name="cost" placeholder="Cost"><br><br><br>
                    <button type="submit" class="btn12 btn btn-outline-primary">Add Service</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Update form -->
    <div id="updateForm" class="overlay" style="display: none;">
        <div class="container4 card" style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%); width: 80%; max-width: 400px; padding: 20px; background-color: white; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);">
            <div class="card-body">
                <button class="btn11" onclick="hideUpdateForm()"><a class="link1">x</a></button> <br>
                <h2 class="text3">Update Service</h2> <br>
                <form action="Dental_Services.php" method="post" onsubmit="return updateService()">
                    <label><b>Service ID</b></label><br>
                    <input type="text" id="update_procedure_id" name="procedure_id" placeholder="Service ID" readonly><br>
                    <label><b>Service Name</b></label><br>
                    <input type="text" id="update_service_name" name="service_name" placeholder="Service Name"><br>
                    <label><b>Description</b></label><br>
                    <textarea id="update_description" name="description" class="form-control"></textarea><br>
                    <label><b>Duration</b></label><br>
                    <input type="text" id="update_duration" name="duration" placeholder="Duration"><br>
                    <label><b>Cost</b></label><br>
                    <input type="text" id="update_cost" name="cost" placeholder="Cost"><br><br> <br>
                    <button type="submit" onlclick="updateService()" id="updateBtn" class="btn btn-outline-primary" style="display: block; margin: 0 auto;">Update Service</button>
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
    function showUpdateForm(serviceId, serviceName, description, duration, cost) {
        document.getElementById("update_procedure_id").value = serviceId;
        document.getElementById("update_service_name").value = serviceName;
        document.getElementById("update_description").value = description;
        document.getElementById("update_duration").value = duration;
        document.getElementById("update_cost").value = cost;
        document.getElementById("updateForm").style.display = "block";
    }

    function hideUpdateForm() {
        document.getElementById("updateForm").style.display = "none";
    }

    function updateService() {
        var serviceId = document.getElementById("update_procedure_id").value;
        var serviceName = document.getElementById("update_service_name").value;
        var description = document.getElementById("update_description").value;
        var duration = document.getElementById("update_duration").value;
        var cost = document.getElementById("update_cost").value;

        $.ajax({
            type: "POST",
            url: "update_service.php",
            data: {
                procedure_id: serviceId,
                service_name: serviceName,
                description: description,
                duration: duration,
                cost: cost
            },
            success: function(response) {
                alert(response); // Show success message
                // Optionally, you can update the table with the new data without reloading the page
            },
            error: function(xhr, status, error) {
                alert("Error: " + error); // Show error message
            }
        });

        return false; // Prevent form submission
    }
    function deleteService(serviceId) {
        if (confirm("Are you sure you want to delete this service?")) {
            $.ajax({
                type: "POST",
                url: "delete_service.php", // Create this file to handle delete operation
                data: { service_id: serviceId }, // Ensure correct parameter name
                success: function(response) {
                    alert(response); // Show success message
                    // You may also remove the row from the table without reloading the page
                },
                error: function(xhr, status, error) {
                    alert("Error: " + error); // Show error message
                }
            });
        }
    }
</script>
        
</body>
<?php
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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all form fields are set
    if (isset($_POST["service_name"], $_POST["description"], $_POST["duration"], $_POST["cost"])) {
        // Get form data
        $service_name = $_POST["service_name"];
        $description = $_POST["description"];
        $duration = $_POST["duration"];
        $cost = $_POST["cost"];

        // Check if service name already exists
        $check_query = "SELECT * FROM service_table WHERE service_name = '$service_name'";
        $result = $conn->query($check_query);

        if ($result->num_rows == 0) {
            // Insert data into database
            $insert_query = "INSERT INTO service_table (service_name, description, duration, cost) 
                             VALUES ('$service_name', '$description', '$duration', '$cost')";

            if ($conn->query($insert_query) === TRUE) {
          //      echo "New record created successfully";
            } else {
                echo "Error: " . $insert_query . "<br>" . $conn->error;
            }
        } else {
     //       echo "Service with the same name already exists";
        }
    } else {
        echo "All form fields are required";
    }
}

// Close connection
$conn->close();
?>


</html>
