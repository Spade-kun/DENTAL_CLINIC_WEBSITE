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

// Check if user is logged in
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    $userId = $_SESSION["account_id"];
    
    // Prepare and execute SQL statement
    $stmt = $conn->prepare("SELECT name, email, contact, address FROM account WHERE account_id = ?");
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Fetch user details
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $name = $row["name"];
        $email = $row["email"];
        $contact = $row["contact"];
        $address = $row["address"];
    }
    $stmt->close();
} else {
    // Redirect to login page or handle unauthorized access
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                      <li class="breadcrumb-item active">Home / Account</li>
                    </ol>
                  </nav>
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="text2 card-title">Staff Account Settings</h5>
                                <p class="card-text">Manage your account settings, profile information, and preferences below.</p>
                            </div>
                        </div>
                    </div>
                </div>
            
                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                    <div class="con1">
                                        <img class="img7" src="../images/Pfp.png" alt="Picture"> <br> <br>
                                        <h2 class="text1"><?php echo $row["name"]; ?></h2> <br>
                                    </div>
                                    <div>
                                <i>Email Address:</i>
                                <p class="text1"><?php echo $email; ?></p>
                                <i>Contact Number:</i>
                                <p class="text1"><?php echo $contact; ?></p>
                                <i>Address:</i>
                                <p class="text1"><?php echo $address; ?></p>
                            </div>

                                    <div>
                                        <i>Social Media</i> <p></p>
                                        <button class="btn rounded-circle btn-secondary"><i class="fab fa-facebook"></i></button>
                                        <button class="btn rounded-circle btn-secondary"><i class="far fa-envelope"></i></button>
                                        <button class="btn rounded-circle btn-secondary"><i class="fab fa-instagram"></i></button>
                                    </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <form id="updateForm">
                                    <div class="form-group">
                                        <label for="adminName">Full Name</label>
                                        <input type="text" class="form-control" id="adminName" placeholder="Full Name" value="<?php echo $name; ?>"> <br>
                                        <label for="adminEmail">Email</label>
                                        <input type="text" class="form-control" id="adminEmail" placeholder="Email" value="<?php echo $email; ?>"> <br>
                                        <label for="adminContact">Contact Number</label>
                                        <input type="text" class="form-control" id="adminContact" placeholder="Contact Number" value="<?php echo $contact; ?>"> <br>
                                        <label for="adminAddress">Address</label>
                                        <input type="text" class="form-control" id="adminAddress" placeholder="Address" value="<?php echo $address; ?>"> <br>
                                    </div>
                                    <button type="button" class="btn8 btn btn-outline-primary" id="saveChangesBtn">Save Changes</button>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>
</body>
<script>
    $(document).ready(function() {
        $("#saveChangesBtn").click(function() {
            var name = $("#adminName").val();
            var email = $("#adminEmail").val();
            var contact = $("#adminContact").val();
            var address = $("#adminAddress").val();

            $.ajax({
                type: "POST",
                url: "update_account.php",
                data: {
                    name: name,
                    email: email,
                    contact: contact,
                    address: address
                },
                success: function(response) {
                    alert(response); // Show success message
                    // Optionally, you can update the table with the new data without reloading the page
                },
                error: function(xhr, status, error) {
                    alert("Error: " + error); // Show error message
                }
            });
        });
    });
</script>
</html>
