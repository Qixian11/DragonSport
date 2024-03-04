<?php
session_start();
include("../Client/dataconnection.php");

if (isset($_GET["logout"])) {
    $_SESSION["admin_id"] = $_GET["log"];
}

$error = "";
if (isset($_POST["submitbtn"])) {
    if (empty($_POST["email"]) || empty($_POST["pass"])) {
        ?>
        <script>
            alert("Email or Password is empty")
        </script>
        <?php
    } else {
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $email = mysqli_real_escape_string($connect, $email);
        $pass = mysqli_real_escape_string($connect, $pass);
        $mdpass = md5($pass);
        $result = mysqli_query($connect, "SELECT * FROM admin1 where admin_email ='$email' ");

        $count = mysqli_num_rows($result);

        if ($count == 1) {
            $row = mysqli_fetch_assoc($result);

            $_SESSION["admin_id"] = $row["admin_id"];
            header("location:dashboard.php");

        } else {
            ?>
            <script>
                alert("Email or Password something went wrong!")
            </script>
            <?php
        }
    }
}
?>

<html>
<head>
    <script src="https://kit.fontawesome.com/9dcddfad62.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" type="text/css" href="adminlogin.css">
</head>
<body>
    <form action="#" method="POST">
        <div class="popup" id="popup-0">
            <div class="title">
                <p>Dragon Sport . Admin</p>
            </div>
            <div class="video-container">
                <video autoplay loop muted>
                    <source src="banner/loginbg.mp4" type="video/mp4">
                </video>
            </div>
            <div class="content">
                <div class="close-btn" onclick="togglePopup()"><i class="fa fa-window-close" aria-hidden="true"
                        style="color:white;font-size:25px;"></i></div>
                <h1>Dragon Sport</h1>
                <div class="input-container">
                    <p>Email Address</p>
                    <div class="input-field">
                        <input type="Email" class="validate" name="email" placeholder="Email">
                    </div>
                    <p>Password</p>
                    <div class="input-field">
                        <input type="password" class="validate" name="pass" placeholder="Password">
                        <i class="far fa-eye"></i>
                    </div>
                </div>
                <div class="fgtpass"><a href="adminmail.php">Forgot password</a> </div>
                <div class="almbutton">
                    <button input type="submit" class="second-button" name="submitbtn" value="Login">Login</button>
                </div>
            </div>
        </div>
    </form>
    <button onclick="togglePopup()" class="first-button">LOGIN</button>

    <script>
        function togglePopup() {
            document.getElementById("popup-0")
                .classList.toggle("active")
        }
        $(document).ready(function () {
            $(".fa-eye").mousedown(function () {
                $(this).siblings("input").attr("type", "text");
            });

            $(".fa-eye").mouseup(function () {
                $(this).siblings("input").attr("type", "password");
            });
        });
    </script>
</body>
</html>