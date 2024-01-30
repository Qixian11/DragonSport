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

.background img
{
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
	height:40vh;
	text-align:center;
	position:absolute;
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
	width:100%;
	color:white;
	font-size:1.5vh;
	text-decoration:underline;
	margin-left:18vw;
	
	opacity:0.75;
}
.error{
	color:red;
}
.login
{
	font-family:sans-serif;
	width:25vw;
	text-align:center;
	position:absolute;
	background: rgba(35, 31, 31,0.75);
}

.login .error
{
	display:flex;
	align-items:center;
	justify-content:center;
	height:2.5vh;

}

.error .password-strength
{

	font-size:0.6vw;
}

#red
{
	background:red;	
	color:white;
	visibility:hidden;
}

#orange
{
	background:orange;
	color:white;
	visibility:hidden;
}

#green
{
	background:green;
	color:white;
	visibility:hidden;
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
    <img src = "banner/pexels-mnz-1598505.jpg">
<div class = "login">
	<form name = "login" method = "post">
		<h1>Forgot Password</h1>
		<p><input type = "password" name = "npassword" placeholder = "Enter New Password"/></p>
		<p class = "error" id = "error-and-strength"><span class = "pass-error">&nbsp;</span></p>
		<p><input type = "password" name = "rpassword" placeholder = "Re-Enter Password"/></p>
		<p class = "error" id = "error-and-strength1"><span class = "pass-error">&nbsp;</span></p>
		<p><input type = "submit" name = "submit" value = "Change password"></p>
		
	</form>
</div>
</div>


<?php 
if(isset($_GET["email"]))
{
	$email=$_GET["emails"];
	
	
}
if(isset($_POST["submit"]))
{
	
	$npassword = $_POST["npassword"];
	$rpassword = $_POST["rpassword"];

	$checknp = 0;
	$checkrp = 0;

	if(empty($npassword))
		{
	?>
			<script>document.getElementById("error-and-strength").innerHTML = "Password cannot be empty"; </script>
	<?php	
		}
		else if(strlen($npassword) < 8)
		{
	?>
			<script>document.getElementById("error-and-strength").innerHTML = "Password should be at least 8 characters"; </script>
	<?php	
		}
	else if(!preg_match('@[^\w]@',$npassword))
	{
		?>
		<script>document.getElementById("error-and-strength").innerHTML = "At least one  special character."; </script>
<?php	
	}
	else
		$checknp = 1;
		
		if(empty($rpassword))
		{
	?>
			<script>document.getElementById("error-and-strength1").innerHTML = "Password cannot be empty "; </script>
	<?php	
		}
		else if($rpassword != $npassword)
		{
	?>
			<script>document.getElementById("error-and-strength1").innerHTML = "Password is not match"; </script>
	<?php	
}
		else
		$checkrp= 1;

if($checknp  == 1 && $checkrp == 1)
{
	$md_password = md5($npassword);
	mysqli_query($connect, "UPDATE admin1 SET admin_password='$md_password' where admin_email='$email' ");
?>

		<script>
			alert("Your password has been changed.");
			location.href = "adminlogin.php";	
			
		</script>

<?php	
}

	
}
?>
</body>
<script>
$(document).ready(function(){
	$("input[name = 'npassword']").keyup(function()
	{
		$("#error-and-strength").html("<span class = 'password-strength' id = 'red'>Low</span><span class = 'password-strength' id = 'orange'>Medium</span><span class = 'password-strength' id = 'green'>Strong</span>");
		$("#error-and-strength").css({"display":"grid", "grid-template-columns":"33% 33% 33%", "width":"17vw", "margin":"0 auto"});

		checkstrength();
	});

	function checkstrength()
	{
		let uppercase= RegExp('[A-Z]');
		let lowercase= RegExp('[a-z]');
		let numbers = RegExp('[0-9]');
		let password = $("input[name = 'npassword']").val();
		
		if(password.length > 0)
			$("#red").css("visibility","visible");
		else
			$("#red").css("visibility","hidden");
		if(password.match(uppercase) && password.match(lowercase) || password.match(uppercase) && password.match(numbers) || password.match(lowercase) && password.match(numbers))
			$("#orange").css("visibility","visible");
		else
			$("#orange").css("visibility","hidden");
		if(password.match(uppercase) && password.match(lowercase) && password.match(numbers))
			$("#green").css("visibility","visible");
		else
			$("#green").css("visibility","hidden");
	}

});


</script>
</html>