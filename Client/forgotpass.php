<?php
include("../Client/dataconnection.php"); 
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

.login input[type = "text"], .login input[type = "password"]
{
	border:0;
	margin:0 auto;
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
	border-color:#2ecc71;
	width:17vw;
}

.login input[type = "submit"]
{
	border:0;
	margin:0 auto 1.5vh ;
	background:none;
	text-align:center;
	border:3px solid #2ecc71;
	outline:none;
	color:white;
	border-radius:24px;
	transition:0.25s;
	cursor:pointer;
	height:5vh;
	width:8vw;
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

.login span
{
	color:red;
}

.login span a
{
	color:lightblue;
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
.error{
	color:red;
	margin-bottom:1vh;
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
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
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
			<li><a href = "#">Contact</a></li>
			<li><a href = "#">About Us</a></li>
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
		<h1>Forgot Password</h1>
		<p><input type = "password" name = "npassword" placeholder = "Enter New Password"/></p>
		<p class = "error" id = "error-and-strength"><span class = "pass-error">&nbsp;</span></p>
		<p><input type = "password" name = "rpassword" placeholder = "Re-Enter Password"/></p>
		<p class = "error" id = "error-and-strength1"><span class = "pass-error">&nbsp;</span></p>
		<p><input type = "submit" name = "submit" value = "Change password"></p>
		
	</form>
</div>
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
	mysqli_query($connect, "UPDATE user SET user_password='$md_password' where user_email='$email' ");
?>
		<script>
			alert("Your password has been changed.");
			location.href = "login.php";	
			
		</script>

<?php	
}

	
}
?>

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