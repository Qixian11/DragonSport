<?php
include("dataconnection.php");
session_start();
if(empty($_SESSION["loginactive"]))
	$_SESSION["loginactive"] = 0;
?>
<!DOCTYPE html>
<html>
<style>
*
{margin:0px;
  padding:0px;
  box-sizing:border-box;
}

.nav_background
{
	background-image:url("banner/FY16_INNO_RN_AEROSWIFT_BASKETBALL_KDURANT_DYNAMIC_hd_1600.jpg");
	height:100vh;
	background-size:cover;
}

nav{display:flex;
	justify-content:space-around;
	align-items:center;
	height:7vh;
	font-family: 'Poppins', sans-serif;
	width:100%;
	background:linear-gradient(to bottom, rgba(41, 38, 38, 0.7), rgba(222, 222, 222, 0));
	position:sticky;
	top:0;
}

nav:hover
{
	background:black;
}

.logo{margin-left:3%;}

.logo img{width:3.5vw;
		  
}

.nav-link{display:inline-flex;
		  margin-left:2%;
		  justify-content:space-around;
		  align-items:center;
		  width:50%;
		  height:4vh;
		  padding-top:0.5vh;
}

.nav-link a
{
	margin:0 0.2vw;
	color:#dfd9d3;
	text-decoration:none;
	letter-spacing:0.3vh;
	font-weight:bold;
	font-size:1.2vw;
}
  
.nav-link a:hover
{
	color:white;	
}
  
.nav-link ul
{
	top:4vh;
	position:absolute;
	opacity:1;
	visibility:hidden;
}

.nav-link ul li
{
	background-color:black;
	padding:1vh 0 1vh;
	border-top:2px solid white;
	position:relative;
	top:3vh;
	display:list-item;
	width:8vw;
	text-align:center;
}

.nav-link ul li .fas
{	
	float:right;
	position:relative;
	font-size:2vh;
	right:1vw;
	top:0.6vh;
}

.nav-link ul li a
{
	color:#dfd9d3;
}

.nav-link li{list-style:none;
			 width:8vw;
			 text-align:center;
}

.nav-link li .fa-caret-down
{
	display:block;
	text-align:center;
	display:none;
	color:white;
}

.nav-link li:hover > .fa-caret-down
{
	display:block;
}

.nav-link li:hover > ul
{
	opacity:1;
	visibility:visible;
}

.search-bar
{
	width:20vw;
	height:4vh;
	display:flex;
	border-radius:3vh;
	margin-left:1.9vw;
	border:0.15vw solid #dfd9d3;
	position:relative;
}

.search-bar input
{	
	background:none;
	width:18vw;
	height:100%;
	border:none;
	border-radius:3vh 0 0 3vh;
	outline:none;
	padding:0 1vw;
	color:white;
	font-size:0.9vw;
	position:absolute;
}

::placeholder
{
	color:white;
}

.search-bar .icon
{
	position:absolute;
	height:3.5vh;
	width:2vw;
	right:0;
	top:0;
	display:flex;
	justify-content:center;
	align-items:center;
}

.search-bar .icon i
{
	color:#dedede;
	font-size:1vw;
}

.wishandcart .wishlist
{
	color:#dfd9d3;
	font-size:2.7vh;
	transition:0.5s;
}

.wishandcart .wishcount
{
	position:absolute;
	font-size:0.7vw;
	color:black;
	border:1px solid black;
	border-radius:100%;
	background-color:white;
	height:2vh;
	width:1vw;
	text-align:center;
	left:1.9vw;
	bottom:1.3vh;
}

.wishandcart .shoppingcart
{
	font-size:2.7vh;
	color:#dfd9d3;
	transition:0.5s;
}

.wishandcart .shoppingcart:hover{font-size:3vh;}
.wishandcart .wishlist:hover{font-size:3vh; color:red;}

.wishandcart
{
	display:flex;
	align-items:center;
	position:relative;
	width:7%;
	margin-left:1vh;
	justify-content:space-around;
}

.account
{
	width:11%;
	display:flex;
	justify-content:center;
	align-items:center;
}

.account .profile
{
	width:2.5vw;
	height:4.5vh;
	background:none;
	outline:none;
	border:none;
	color:white;
}

.account .profile i{font-size:1.3vw;}

.account .profile-name
{
	width:8vw;
	text-align:center;
	font-size:0.85vw;
	color:white;
}

.account .profile-list
{
	position:absolute;
	right:0;
	margin-top:20.5vh;
	z-index:1000;
	background-color:white;
	border:1px solid black;
	width:11vw;
	display:none;
}

.account .profile-list li
{
	list-style:none;
	padding:2vh 0;
	text-align:center;
}

.account .profile-list li a
{
	color:black;
	text-decoration:none;
	font-size:1vw;
}

.account .profile-list li input
{
	background-color:white;
	border:none;
	font-family: 'Poppins', sans-serif;
	font-size:1vw;
}

.account .profile-list li input:hover{cursor:pointer;}

.account .profile-list li:nth-child(1){border-bottom:1px solid black;}

.account a button
{
	width:5vw;
	height:3.5vh;
	height:3.5vh;
	font-family: 'Poppins', sans-serif;
	background:none;
	border:none;
	font-weight:bold;
	font-size:0.85vw;
	color:#dfd9d3;
}

.account button:hover
{
	background-color:white;
	color:black;
	cursor:pointer;
}

.account a:nth-child(1){border-right:1px solid white;}
.account .profile-list a:nth-child(1){border:none;}

.login
{
	font-family:sans-serif;
	width:25vw;
	transorm:translate(-50%, -50%);
	text-align:center;
	position:absolute;
	background: rgba(35, 31, 31,0.75);
}

.login input[type = "text"], .login input[type = "password"], .login input[type = "email"]
{
	border:0;
	margin:1.8vh auto;
	background:none;
	text-align:center;
	border:3px solid #3498db;
	padding:1.5vh 10px;
	outline:none;
	color:white;
	border-radius:24px;
	transition:0.25s;
	width:12vw;
	height:5vh;
	font-size:0.7vw;
}

.login input[type = "text"]:focus, .login input[type = "password"]:focus, .login input[type = "email"]:focus
{
	border-color:#2ecc71;
	width:17vw;
}

.login input[type = "submit"]
{
	border:0;
	margin:1.75vh auto;
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

.background
{
	height:93vh;
	display:flex;
	align-items:center;
	justify-content:center;
}

.login .forgot{margin-top:1vh; display:flex; justify-content:space-between}

.login .forgot a
{
	color:white;
	font-size:1.5vh;
	text-decoration:underline;
	margin:0 2vh 1vh;
	opacity:0.75;
}

.login span
{
	color:red;
	display:block;
	font-size:0.8vw;
}

.login .password_section
{
	relative;
}

.login .password-strength
{
	background:none;
	position:absolute;
	margin:0 auto;
	left: 0;
	right: 0;
	width:13vw;
	height:1vh;
	display:none;
	grid-template-columns:32% 32% 32%;
	justify-content:space-between;
	font-weight:bold;
}

.login .password-strength .strength-red
{
	background:red;
	color:white;
	font-size:0.625vw;
	visibility:hidden;
}

.login .password-strength .strength-orange
{
	background:orange;
	color:white;
	font-size:0.625vw;
	visibility:hidden;
}

.login .password-strength .strength-green
{
	background:green;
	color:white;
	font-size:0.625vw;
	visibility:hidden;
}
</style>
<head>
	<title>Dragon Sport</title>
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600&display=swap" rel="stylesheet">
	<link href="mainpage.css" rel="styleshet">
	<script src="https://kit.fontawesome.com/9dcddfad62.js" crossorigin="anonymous"></script>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@700&display=swap" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset = "utf-8"></script>
</head>
<body>
<div class = "nav_background">
<nav>
		<div class = "logo">
		<a href = "mainpage.php"><img src = "mainpage-item/logo.png"> </a>
		</div>
		<ul class = "nav-link">
			<li><a href = "mainpage.php">Home</a></li>
			<li><a href = "product.php">Shop All</a></li>
			<li><a>Brands</a><i class="fas fa-caret-down"></i>
				<ul>
					<li><a href = "only-adidas.php">Adidas</a></li>
					<li><a href = "only-nike.php">Nike</a></li>
				</ul>
			</li>
			<li><a href = "contactus.php">Contact</a></li>
			<li><a href = "aboutus.php">About Us</a></li>
		</ul>
		<div class = "search-bar">
			<form name = "search-item" action = "product.php" method = "post">
				<input  type = "search" placeholder = "Search" name = "search-content">
				<label class = "icon">
					<i class="fas fa-search"></i>
				</label>
			</form>
		</div>
		<?php
			if(isset($_POST["search-content"]) || isset($_POST["search-btn"]))
			{
				$_SESSION["active"] = 1;
				$_SESSION["content"] = $_POST["search-content"];
			}
		?>
		<div class = "wishandcart">
				<a href = "#" class = "wishlist"><i class="far fa-heart"></i>
		<?php
			if($_SESSION["loginactive"] == 1)
			{	
				$user_id = $_SESSION["userid"];
				$countwish = mysqli_query($connect, "SELECT * FROM wishlist WHERE user_id = $user_id");
				if(mysqli_num_rows($countwish) > 0)
				{
		?>
					<span class = "wishcount"><?php echo mysqli_num_rows($countwish);?></span></a>
		<?php
				}
				else
				{
		?>
					<span class = "wishcount"></span></a>
		<?php
				}
			}
		?>
				<a href = "#" class = "shoppingcart"><i class="fas fa-shopping-cart"></i></a>
		</div>
		<div class = "account">
		<?php
			if($_SESSION["loginactive"] == 0)
			{	
		?>
				<a href = "register.php" id = "register"><button>Sign up</button></a>
				<a href = "login.php" id = "login"><button>Log in</button></a>
		<?php
			}
			else if($_SESSION["loginactive"] == 1)
			{
				echo "<div class = 'profile-name'>Hello, ".$_SESSION["username"]."</div>";
				echo "<button class = 'profile'><i class='fas fa-bars'></i></button>";
		?>
				<div class = "profile-list">
					<form method = "post">
					<ul>
						<li><a href = "user_profile.php">View Profile</a></li>
						<li><input type = "submit" name = "logout-btn" value = "Log out"/></li>
					</ul>
					</form>
				</div>
		<?php
			}
			if(isset($_POST["logout-btn"]))
			{
				$_SESSION["loginactive"] = 0;
		?>
				<script>location.href = "mainpage.php"</script>
		<?php	
			}
		?>
		</div>
	</nav>
<div class = "background">
<div class = "login">
	<form name = "login" method = "post">
		<h1>Register</h1>
		<p><input type = "text" name = "username" placeholder = "Enter Username"/><span id = "username"></span></p>
		<p><input type = "text" name = "fullname" placeholder = "Enter Full Name"/><span id = "name"></span></p>
		<p><input type = "email" name = "email" placeholder = "Enter Email"/><span id = "email"></span></p>
		<p><input type = "password" name = "password" placeholder = "Enter Password"/>
		<div class = "password_section">		
			<div class = "password-strength">
				<span class = "strength-red">Weak</span>
				<span class = "strength-orange">Medium</span>
				<span class = "strength-green">Strong</span>
			</div>
			<span id = "password"></span>
		</div>
		</p>
		<p><input type = "password" name = "repassword" placeholder = "Re-enter Password"/><span id = "re-enter"></span></p>
		<p><input type = "submit" name = "submit" value = "Register"></p>
		<p class = "forgot">
			<a href = "login.php">Had an existing account</a>
		</p>
	</form>
	<?php
	if(isset($_POST["submit"]))
	{
		$username = $_POST["username"];
		$fullname = $_POST["fullname"];
		$email = $_POST["email"];
		$password = $_POST["password"];
		$repassword = $_POST["repassword"];
		$checkr = 0; $checku = 0; $checkf = 0; $checke = 0; $checkp = 0;
		$checkn = mysqli_query($connect, "SELECT user_name from user where user_name = '$username'");
		$checkem = mysqli_query($connect, "SELECT user_email from user where user_email = '$email'");
		if(empty($username))
		{
	?>
			<script>document.getElementById("username").innerHTML = "Username cannot be empty"; </script>
	<?php	
		}
		else if(mysqli_num_rows($checkn) == 1)
		{
	?>
			<script>document.getElementById("username").innerHTML = "Username has been used"; </script>
	<?php	
		}
		else if(strlen($username) > 11)
		{
	?>
			<script>document.getElementById("username").innerHTML = "Your username is too long"; </script>
	<?php	
		}
		else
			$checku = 1;
		
		if(empty($fullname))
		{
	?>
			<script>document.getElementById("name").innerHTML = "Fullname cannot be empty"; </script>
	<?php	
		}
		else if (!preg_match("/^[a-zA-Z -]+$/",$fullname))
		{
	?>
			<script> document.getElementById("name").innerHTML = "Username cannot contain any numbers or symbols"; </script>
	<?php	
		}
		else
			$checkf = 1;
		
		if(empty($email))
		{
	?>
			<script>document.getElementById("email").innerHTML = "Email cannot be empty"; </script>
	<?php	
		}
		else if(mysqli_num_rows($checkem) == 1)
		{
	?>
			<script> document.getElementById("email").innerHTML = "Email has been registered"; </script>
	<?php	
		}
		else
			$checke = 1;
			
		if(empty($password))
		{
	?>
			<script>document.getElementById("password").innerHTML = "Password cannot be empty"; </script>
	<?php	
		}
		else if(strlen($password) < 8)
		{
	?>
			<script>document.getElementById("password").innerHTML = "Password should be at least 8 characters"; </script>
	<?php	
		}
	else if(!preg_match('@[^\w]@',$password))
	{
		?>
		<script>document.getElementById("password").innerHTML = "At least one  special character."; </script>
<?php	
	}
		else
			$checkp = 1;
		
		if(empty($repassword))
		{
	?>
			<script>document.getElementById("re-enter").innerHTML = "Password cannot be empty "; </script>
	<?php	
		}
		else if($repassword != $password)
		{
	?>
			<script>document.getElementById("re-enter").innerHTML = "Password is not match"; </script>
	<?php	
		}
		else
			$checkr = 1;
		
		if($checku == 1 && $checkf == 1 && $checke == 1 && $checkp == 1 && $checkr == 1)
		{	
			$registered_date = date("F Y");
			$hash_password = md5($password);
			$subject = "Verification Code";
			$veri_code = rand(100000, 999999);
			$message = "Congratulation ".$username.", Your account has been registered successfully. Please verify your account before log in. Your verification code is ".$veri_code;
			$header = "FROM: dragonsport159@gmail.com";
			
			mail($email, $subject, $message, $header);
			
			mysqli_query($connect, "INSERT INTO user (user_name, user_fullname, user_email, user_password, Verification_Code, Verified, registered_date, Status) VALUES ('$username', '$fullname', '$email', '$hash_password', '$veri_code', '0', '$registered_date', 'Active')");
	?>	
			<script>
				alert("Register Successfully");
				location.href = "verify.php?verify&useremail=<?php echo $username;?>";
			</script>
	<?php	
		}
		else
	?>
			<script>alert("Register Unsuccessfully"); </script>
	<?php
	}
	?>
</div>
</div>
</div>
</body>
<script>
$(document).ready(function()
{	
	$(".account .profile-list input[type = 'submit']").on("click", function()
	{
		return confirm("Are you sure you want to log out??");
	});
	
	$(".account .profile").click(function()
	{
		$(".account .profile-list").fadeToggle();
	});
	
	$(".wishandcart .wishlist").click(function(){
		<?php
		if($_SESSION["loginactive"] == 0)
		{
		?>
			alert("You can't see you wishlist before you log in");
		<?php
		}
		else
		{
		?>
			location.href = "wishlist.php";
		<?php
		}
		?>
	});

	$(".wishandcart .shoppingcart").click(function(){
		<?php
		if($_SESSION["loginactive"] == 0)
		{
		?>
			alert("You can't see your shopping cart before you log in");
		<?php
		}
		else
		{
		?>
			location.href = "cart.php";
		<?php
		}
		?>
	});
	
	//password strength section
	$(".login input[name = 'password']").focus(function(){
		$(".login .password-strength").css("display", "grid");
		$("#password").css("display", "none");
		$(".login input[name = 'password']").keyup(function()
		{
			strength_check();
		});
	});
	

	function strength_check()
	{
		let uppercase= RegExp('[A-Z]');
		let lowercase= RegExp('[a-z]');
		let numbers = RegExp('[0-9]');
		let password = $(".login input[name = 'password']").val();
		
		if(password.length > 0)
			$(".login .strength-red").css("visibility","visible");
		else
			$(".login .strength-red").css("visibility","hidden");
		if(password.match(uppercase) && password.match(lowercase) || password.match(uppercase) && password.match(numbers) || password.match(lowercase) && password.match(numbers))
			$(".login .strength-orange").css("visibility","visible");
		else
			$(".login .strength-orange").css("visibility","hidden");
		if(password.match(uppercase) && password.match(lowercase) && password.match(numbers))
			$(".login .strength-green").css("visibility","visible");
		else
			$(".login .strength-green").css("visibility","hidden");
}
	//password-strength section end
});
</script>
</html>