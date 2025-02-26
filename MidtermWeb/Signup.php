<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Page</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font/css/materialdesignicons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="topnav">
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
        <div class="signup-container">
            <form class="f2" action="sign_up.php" method="post">
                <button class="btn11"><a class="link1" href="MainHome.php">x</a></button> <br>
                <img class="img3" src="images/Logo.png" alt="Photo">
                <h1>Sign Up</h1><p></p>
                <div class="input-group mb-3">
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-account"></i></span>
                        <input type="text" class="form-control" placeholder="Username" name="username" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>
                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-account"></i></span>
                        <input type="text" class="form-control" placeholder="Full Name" name="name" aria-label="FullName" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-email"></i></span>
                        <input type="text" class="form-control" placeholder="Email" name="email" aria-label="Email" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-lock"></i></span>
                        <input type="password" class="form-control" placeholder="Password" name="password" aria-label="Password" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-key-variant"></i></span>
                        <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" aria-label="ConfrimPassword" aria-describedby="basic-addon1" required>
                    </div><div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-counter"></i></span>
                        <input type="number" class="form-control" placeholder="Age" name="age" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-contacts"></i></span>
                        <input type="number" class="form-control" placeholder="Contact Number" name="contact" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-map-marker-radius"></i></span>
                        <input type="text" class="form-control" placeholder="Address" name="address" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-gender-male-female"></i></span>
                        <select class="form-control" name="gender" required>
                            <option value="" selected="" disabled="">Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-account-switch"></i></span>
                        <select class="form-control" name="loginType" required>
                            <option value="" selected="" disabled="">Login Type</option>
                            <option value="Admin">Admin</option>
                            <option value="Doctor">Doctor</option>
                            <option value="Patient">Patient</option>
                        </select>
                    </div>

                    <div class="form-check">
                        <input type="checkbox" class="cb1" id="myCheckbox" required>
                        <label class="l1" for="myCheckbox">I agree to the Terms & Conditions</label>
                    </div>
                    <br>
                    <button class="btn2 btn btn-primary" type="submit">Sign up</button> <p></p>
                    <p class="a1">Already have Account Click <a class="a1" href="Login.php">here</a></p> <br>
            </form>
        </div>
    </div>
</body>

</html>
