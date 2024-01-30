<?php
include("../Client/dataconnection.php"); 
session_start();

?>
<!DOCTYPE html>
<html>
<style>

*
{margin:0px;
  padding:0px;
  box-sizing:border-box;
}

.background 
{
	background-image:url("banner/pexels-mnz-1598505.jpg");
    width:100vw;
    height:100vh;
    background-size:cover;
}
::placeholder{
    color:white;
}

.login
{
	font-family:sans-serif;
	width:25vw;
	height:27vh;
	text-align:center;
	position:relative;
	background: rgba(35, 31, 31,.7);
    border-radius:10px;
    
}

.login input[type = "text"], .login input[type = "password"]
{
	border:0;
	margin:1.8vh auto;
	background:none;
	text-align:center;
	border:3px solid #3498db;
	padding:14px 10px;
	outline:none;
	color:white;
	border-radius:24px;
	transition:0.25s;
	width:12vw;
	height:5vh;
	font-size:0.7vw;
}

.login input[type = "text"]:focus, .login input[type = "password"]:focus
{
	border-color:#4169E1;
	width:17vw;
}

.login input[type = "submit"]
{
	border:0;
	margin:1.5vh auto;
	background:none;
	text-align:center;
	border:3px solid #2ecc71;
	outline:none;
	color:white;
	border-radius:24px;
	transition:0.25s;
	cursor:pointer;
	height:5vh;
	width:7.5vw;
	font-size:0.8vw;
}

.login input[type = "submit"]:hover
{
	background:#2ecc71;
	
}

.login h1
{
	margin:2vh auto;
	color:white;
	text-transform:uppercase;
	font-weight:500;
	font-size:1.75vw;
}

.login .back 
{
	width:100%;
	color:white;
    padding-left:50%;

}

.login span a
{
	color:lightblue;
}

.background
{
	
	display:flex;
	align-items:center;
    justify-content:center;
   
}

.login a
{
	position:absolute;
	color:white;
	font-size:1.5vh;
	text-decoration:underline;
	bottom:1vh;
	right:1vw;
	opacity:0.75;
}

</style>
<head>
	<title>ADMIN FORGOT</title>
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600&display=swap" rel="stylesheet">
	<link href="mainpage.css" rel="styleshet">
	<script src="https://kit.fontawesome.com/9dcddfad62.js" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@700&display=swap" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset = "utf-8"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>

<div class = "background">
    
<div class = "login">
	<form name = "login" method = "post">
		<h1>Forgot Password</h1>
		<p><input type = "text" name = "email" placeholder = "E-mail"/></p>
		
		<p><input type = "submit" name = "submit" value = "SEND"></p>
	
	</form>
	<a href = "adminlogin.php">Back to login</a>
  
</div>
</div>
</div>	
<?php 
if(isset($_POST["submit"]))
{
	$email=$_POST["email"];
	$query=mysqli_query($connect,"SELECT * FROM admin1 where admin_email='$email'");

	
	if(mysqli_num_rows($query)==1)
	{
		$subject = "FORGOT PASSWORD Verification link";
			
			$message ="Your activation link is: http://localhost/fyp/admin/adminforgot.php?email&emails=$email";
			$header = "FROM: dragonsport159@gmail.com";

			mail($email, $subject, $message, $header);
	?>
		<script>
			alert("Your activation link has been sending to your email");
			location.href ="adminlogin.php";
			
		</script>
<?php	
	}
	else
	{
	?>
		<script>
			alert("Could not find your email please enter again");
			location.href = "adminmail.php";
			
		</script>
	<?php
	}

}
	
?>
</body>
<script>


</script>
</html>