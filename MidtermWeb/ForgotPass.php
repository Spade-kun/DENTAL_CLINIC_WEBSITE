<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ForgotPass Page</title>
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
            <a href="Login.php" class="nav-link-active">
                <button class="btn1 btn btn-primary">Reserve Now</button>
            </a>
        </div>
        <div class="forgotpass-container">
        <form class="f1" action="for_pas.php" method="post">
                <button class="btn11"><a class="link1" href="MainHome.php">x</a></button> <br>
                <img class="img4" src="images/Logo.png" alt="Logo">
                <h2>Forgot Password</h2><br>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-email"></i></span>
                    <input type="text" class="form-control" placeholder="Email" name="email" aria-label="Email" aria-describedby="basic-addon1" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-lock"></i></span>
                    <input type="password" class="form-control" placeholder="New Password" name="newpass" aria-label="Password" aria-describedby="basic-addon1" required>
                </div>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-key-variant"></i></span>
                    <input type="password" class="form-control" placeholder="Confirm Password" name="conpass" aria-label="ConfrimPassword" aria-describedby="basic-addon1" required>
                </div>
                    <button class="btn2 btn btn-primary" type="submit">Change Password</button> <br> <br>
                    <p class="a2">Already have Account Click <a class="a1" href="Login.php">here</a></p>
            </form>
        </div>
    </div>
</body>

</html>
