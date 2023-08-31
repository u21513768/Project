<?php
/*Quintin d'Hotman de Villiers u21513768*/
// See all errors and warnings
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);

$mysqli = mysqli_connect("localhost:3306", "u21513768", "yobsxklz", "u21513768");

$submit = isset($_POST['submit']);
if ($submit) {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pass = $_POST["pass"];
    if ($name != null && $name != "" && $email != null && $email != "" && $pass != null && $pass != "") {
        $query = "INSERT INTO tbusers (name, email, password) VALUES ('$name', '$email', '$pass');";

        $res = mysqli_query($mysqli, $query) == TRUE;
        if ($res) {
            $alertMessage = "Your account has been created successfully.";
            session_start();

            $_SESSION["email"] = $email;
            $_SESSION["pass"] = $pass;
            header("Location: login.php");
            exit; // Make sure to exit after redirecting
        }
        else {
            $alertMessage = "Failed to create account.";
        }
    }
    else {
        $alertMessage = "Please fill in all details";
    }
} 
?>

<!DOCTYPE html>
<html>

<head>
    <title>Smooth Scroll Effect</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway:700,900|Open+Sans">
    <script>
        // JavaScript function to display an alert
        function showAlert(message) {
            alert(message);
        }

        function showPassword(targetId) {
			var x = document.getElementById(targetId);
			if (x.type === "password") {
				x.type = "text";
			} else {
				x.type = "password";
			}
		}
    </script>
</head>

<body>
    <section class="section top-section" id="top-section">
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark px-3">
            <a class="navbar-brand h1 active" href="#splash.html"><i class="lni lni-connectdevelop"></i></a>
            <a class="navbar-brand" href="splash.html">Informed Insights</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <a class="nav-item nav-link" href="#">Login</a>
                    <a class="nav-item nav-link" href="#sign-up">Sign Up</a>
                </div>
            </div>
        </nav>
        <div class="content-container content-theme-dark">
            <div class="content-inner">
                <div class="content-center">
                    <h1>Informed Insights</h1>
                    <p>Discover, Engage, Enlighten: Your Gateway to Knowledge</p>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                </div>
            </div>
        </div>
        <div class="login-container col-md-6 offset-md-3 h-100 d-flex align-items-center justify-content-center">
            <div class="row-container">
                <div class="row px-0 py-0">
                    <div class="col-6 px-0">
                        <div class="overlay-left px-3 py-3 ">
                            <form action="login.php" method="POST">
                                <h1 class="text-center">Login</h1>
                                <div class="form-group">
                                    <label for="InputEmail1">Email address</label>
                                    <input type="email" class="form-control" id="InputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                                </div>
                                <br />
                                <div class="form-group">
                                    <label for="InputPassword1">Password</label>
                                    <input type="password" class="form-control" id="InputPassword1" placeholder="Password" name="pass">
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="Check1" onclick="showPassword('InputPassword1')">
                                    <label class="form-check-label" for="Check1">Show Password</label>
                                </div>
                                <br />
                                <div class="text-center">
                                    <input type="submit" class="btn btn-primary" value="Submit"/>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-6 px-0 d-flex flex-column ">
                        <div class="overlay-right px-3 py-3 text-center align-self-center">
                            <div class="my-auto">
                                <h1>Create Account!</h1>
                                <p>Sign up if you still don't have an account... </p>
                                <a href="#sign-up" class="btn btn-primary" id="sign-in-button">Sign up</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="scroll">
            <p>Scroll down <i class="lni lni-arrow-down arrow-icon"></i></p>
        </div>
    </section>

    <section class="section bottom-section">
        <div id="text" class="h-100 d-flex align-items-center justify-content-center col-md-4 offset-md-4">
            <!--<div class="transparent-to-white" id="bottom-text">--><!--class="col-md-6 offset-md-3"-->
            <!--<div class="px-4 py-4">
                <h1>Our Mission</h1>
                <p>
                    We invite you to join our
                    community of writers. We have created a space where you can
                    freely express yourself, share your stories, and connect with
                    others who share a passion for writing. Our goal is to create
                    a supportive space where everyone's voice is valued, fostering a sense of camaraderie and
                    friendship among our members. Be a part of our vibrant community and let your creativity shine!
                </p>
                <footer style="text-align: left; font-size: 12px;">Quintin d'Hotman de Villiers u21513768 Informed Insights™</footer>
                </div>
            </div>-->
            <div class="sign-up-container">
                <form action="index.php" id="sign-up" method="POST">
                    <h1>Sign Up</h1>
                    <div class="form-group">
                        <label for="inputName">Name</label>
                        <input type="text" class="form-control" id="inputName" aria-describedby="nameHelp"
                            placeholder="Enter name" name="name">
                    </div>
                    <br />
                    <div class="form-group">
                        <label for="InputEmail2">Email address</label>
                        <input type="email" class="form-control" id="InputEmail2" aria-describedby="emailHelp" placeholder="Enter email" name="email">
                        <small id="emailHelp" class="form-text text-danger ">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="InputPassword2">Password</label>
                        <input type="password" class="form-control" id="InputPassword2" placeholder="Password" name="pass">
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="Check2" onclick="showPassword('InputPassword2')">
                        <label class="form-check-label" for="Check2">Show Password</label>
                    </div>
                    <br />
                    <input type="submit" class="btn btn-primary" name="submit" value="Sign Up"/>
                </form>
            </div>
        </div>
        <div class="content-container content-theme-light">
            <div class="content-inner">
                <div class="content-center bottom-text">
                    <h1>Informed Insights</h1>
                    <p>Discover, Engage, Enlighten: Your Gateway to Knowledge</p>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                    <div class="bubble"></div>
                </div>
            </div>
        </div>
    </section>
    <?php
    if (isset($alertMessage)) {
        // Output JavaScript to display an alert
        echo "<script>showAlert('$alertMessage');</script>";
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>