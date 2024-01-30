<?php 
include("dataconnection.php"); 
session_start(); 
$_SESSION["active"] = 0;
if(empty($_SESSION["loginactive"]))
	$_SESSION["loginactive"] = 0;
$_SESSION["previous_page"] = $_SERVER["PHP_SELF"];
?>
<!DOCTYPE html>
<html>
<style>
@font-face
{
	font-family:sec;
	src:url(product-item/HarmoniaSansProCyr-Cond.ttf);
}

*
{margin:0px;
  padding:0px;
  box-sizing:border-box;
}

nav{display:flex;
	justify-content:space-around;
	align-items:center;
	height:7vh;
	font-family: 'Poppins', sans-serif;
	width:100%;
	background:black;
	position:sticky;
	top:0;
	box-shadow: 5px 5px 18px #525050;
	z-index:100;
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
}

.wishandcart .shoppingcart
{
	font-size:2.7vh;
	color:#dfd9d3;
	transition:0.5s;
}

.wishandcart .cartcount
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
	left:5.5vw;
	top:0.05vw;
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
	top:7vh;;
	z-index:1000;
	background-color:white;
	border:1px solid black;
	border-bottom:none;
	width:11vw;
	display:none;
}

.account .profile-list li
{
	list-style:none;
	padding:2vh 0;
	text-align:center;
	border-bottom:1px solid black;
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

.profile-body
{
	background:	#f0f4f7;
	width:99.1vw;
	font-family: 'Poppins', sans-serif;
	color:white;
}

.profile-content
{
	width:89.75vw;
	margin:0 auto;
	padding:0 1vw;
}

.profile-body .profile-header
{
	height:18.75vh;
	display:flex;
	align-items:center;
}

.profile-body .profile-header .profile-name
{
	height:10vh;
	width:40vw;
	color:black;
}

.profile-body .profile-header .profile-name p
{
	font-size:2.5vw;
	text-transform:uppercase;
}

.profile-body .profile-header .profile-name .register-date
{
	font-size:0.9vw;
	color:#cccccc;
	text-transform:initial;
	color:	#696969;
}

.profile-body .profile-header .digital-clock
{
	width:20vw;
	display:flex;
	justify-content:space-around;
	margin-left:27.75vw;
}

.profile-body .profile-header .digital-clock div
{
	width:6.45vw;
}

.profile-body .profile-header .digital-clock div span
{
	background:#2196f3;
	position:relative;
	display:block;
	color:white;
	display:flex;
	justify-content:center;
	align-items:center;
	z-index:10;
	height:8.5vh;
	box-shadow:0 0 0 2px rgba(0, 0, 0, .2);
	font-size:1.5vw;
}

.profile-body .profile-header .digital-clock div span:nth-child(2)
{
	height:3.5vh;
	font-size:0.7vw;
	letter-spacing:0.05vw;
	text-transform:uppercase;
	font-weight:500;
	background:#127fd6;
	box-shadow:0;
	z-index:9;
}
.profile-body .profile-header .digital-clock div:last-child span
{
	background:#ff006a;
}

.profile-body .profile-header .digital-clock div:last-child span:nth-child(2)
{
	background:#ec0062;
}

.profile-body .profile-detail
{
	margin:4vh 0 0;
	padding-bottom:4vh;
	width:50vw;
	color:black;
}

.profile-body .profile-detail h3
{
	color:black;
	font-size:1.5vw;
	margin-bottom:3vh;
}

.profile-body .profile-detail .notifysaved
{
	color:#7CF87C;
	font-size:0.8vw;
}

.profile-body .profile-detail .basic-information
{
	background:white;
	border-radius:0.5vw;
	width:87.5vw;
}

.profile-body .profile-detail .basic-information .bi-header
{
	border-bottom:1px solid rgba(0, 0, 0 , 0.3);
	padding:1.5vh 1.25vw;
	font-size:1vw;
	display:flex;
	justify-content:space-between;
}

.profile-body .profile-detail .basic-information .bi-content
{
	padding:0 1.25vw 0 1.25vw;
}

.profile-body .profile-detail .basic-information .bi-content .bi-attribute
{
	width:7vw;
	display:inline-block;
	font-size:1vw;
}

.profile-body .profile-detail .basic-information .bi-content p
{
	border-top:1px solid rgba(0, 0, 0 , 0.3);
	position:relative;
	height:9vh;
	display:flex;
	align-items:center;
}

.profile-body .profile-detail .basic-information .bi-content p:nth-child(1)
{
	border:none;
}

.profile-body .profile-detail .basic-information .bi-content p i 
{
	margin-left:1vw;
	font-size:1vw;
}

.profile-body .profile-detail .basic-information .bi-content .hint
{
	position:absolute;
	height:4.75vh;
	width:15vw;
	background:#3899ec;
	bottom:80%;
	right:0;
	color:white;
	visibility:hidden;
	opacity:0;
	display:flex;
	align-items:center;
	justify-content:center;
	font-size:0.8vw;
	transition:all 0.3s ease;
}

.profile-body .profile-detail .basic-information .bi-content .hint::after
{
	content:"";
	background:#3899ec;
	border:2px solid #3899ec;
	border-top:none;
	border:right:none;
	position:absolute;
	top:75%;
	width:0.8vw;
	height:1.30vh;
	transform:rotate(45deg);
	right:12.5%;
}

.profile-body .profile-detail .basic-information .bi-content p .fa-exclamation-circle:hover + #ph
{
	visibility:visible;
	opacity:1;
}

.profile-body .profile-detail .basic-information .bi-content p .fa-lock:hover + #eh
{
	visibility:visible;
	opacity:1;
}

.profile-body .profile-detail .basic-information .bi-content p input, select
{
	margin-left:2vw;
	width:72.5vw;
	height:5vh;
	border:2px solid lightblue;
	font-size:0.9vw;
	padding:0.5vh 0.5vw;;
}

.profile-body .profile-detail .basic-information .bi-content p input:focus, select:focus
{
	outline:none;
	box-shadow:0 0 15px lightblue;
}

.profile-body .profile-detail .login-information
{
	background:white;
	border-radius:0.5vw;
	width:87.5vw;
	margin-top:5vh;
}

.profile-body .profile-detail .login-information .li-header
{
	border-bottom:1px solid rgba(0, 0, 0 , 0.3);
	padding:1.5vh 1.25vw;
	font-size:1vw;
}

.profile-body .profile-detail .login-information .li-content
{
	padding:0 1.25vw 0 1.25vw;
}

.profile-body .profile-detail .login-information .li-content .li-attribute
{
	width:7vw;
	display:inline-block;
	font-size:1vw;
}

.profile-body .profile-detail .login-information .li-content p
{
	border-top:1px solid rgba(0, 0, 0 , 0.3);
	position:relative;
	height:9vh;
	display:flex;
	align-items:center;
}

.profile-body .profile-detail .login-information .li-content p:nth-child(1)
{
	border:none;
}

.profile-body .profile-detail .login-information .li-content p input
{
	margin-left:2vw;
	width:72.5vw;
	height:5vh;
	border:2px solid lightblue;
	font-size:0.9vw;
	padding:0.5vh 0.5vw;;
}

.profile-body .profile-detail .login-information .li-content p button
{
	margin-left:1vw;
	background:white;
	width:3vw;
	border-radius:1vh;
	border:2px solid #127fd6;
	color:#127fd6;
	font-size:0.9vw;
	transition:all 0.3s ease-in-out;
	cursor:pointer;
	outline:none;
}

.profile-body .profile-detail .login-information .li-content p button:hover
{
	background:#127fd6;
	color:white;
}

.profile-body .profile-detail .login-information .li-content p input:focus
{
	outline:none;
	box-shadow:0 0 15px lightblue;
}

.modal-bg
{
	position:fixed;
	background:rgba(0, 0, 0, 0.5);
	width:100%;
	height:100%;
	top:0;
	left:0;
	z-index:10000;
	display:flex;
	justify-content:center;
	align-items:center;
	visibility:hidden;
	opacity:0;
	transition:all 0.3s ease-in-out;
}

.modal-bg .modal-box
{
	background:	white;
	width:30vw;
	border-radius:1vh;
}

.modal-bg .modal-box .modal-header
{
	background:	#3899ec;
	border-radius: 1vh 1vh 0 0;
	height:6.5vh;
	display:flex;
	justify-content:space-between;
	align-items:center;
	padding: 0 1vw;
}

.modal-bg .modal-box .modal-header h4
{
	font-size:1vw;
}

.modal-bg .modal-box .modal-header button 
{
	background:none;
	width:1.5vw;
	border-radius:50%;
	outline:none;
	color:white;
	border:none;
	cursor:pointer;
}

.modal-bg .modal-box .modal-header button i
{
	font-size:0.9vw;
}

.modal-bg .modal-box .modal-content
{
	padding:1.5vh 1vw;
}

.modal-bg .modal-box .modal-content p
{
	color:	#8498a6;
	font-size:0.8vw;
	position:relative;
}

.modal-bg .modal-box .modal-content p input::placeholder
{
	color:#d4dce2;
}

.modal-bg .modal-box .modal-content p input
{
	border:2px solid lightblue;
	font-size:0.8vw;
	width:100%;
	height:4vh;
	padding:0.5vh 0.5vw;
}

.modal-bg .modal-box .modal-content p i
{
	position:absolute;
	right:0.5vw;
    top: 50%;
    transform: translate(0,-50%);
	cursor:pointer;
}

.modal-bg .modal-box .modal-content .errorr
{
	margin-bottom:1vh;
	display:flex;
	justify-content:space-between;
	color:red;
	font-size:0.8vw;
	height:2vh;
}

.modal-bg .modal-box .modal-content .errorr .strength-bar
{
	width:9.25vw;
	height:2vh;
	text-align:center;
	font-size:0.7vw;
	font-weight:bold;
}

#red{background:red;color:white;visibility:hidden;}
#orange{background:orange;color:white;visibility:hidden;}
#green{background:green;color:white;visibility:hidden;}

.modal-bg .modal-box .modal-content .save-btn
{
	display:flex;
	justify-content:flex-end;
}

.modal-bg .modal-box .modal-content p input[type = "submit"]
{
	cursor:pointer;
	background:	#127fd6;
	border-radius:1vw;
	font-size:0.8vw;
	width:3.5vw;
	height:3.5vh;
	color:white;
	margin-bottom:0;
	outline:none;
}

.modal-bg .modal-box .modal-content p input[type = "submit"]:hover
{
	background:lightblue;
}

.navbottom
{
	background-color:black;
	height:37vh;
	padding:1vh 2vw;
	display:grid;
	grid-template-columns:21.5% 25% 27%;
	font-family: 'Poppins', sans-serif;
	position:relative;
	justify-content:space-around;
}

.navbottom .navbottom-content
{
	display:flex;
	align-items:center;
	justify-content:space-between;
}

.navbottom .navbottom-content ul
{
	height:30vh;
	display:flex;
	flex-direction:column;
	justify-content:space-around;
}

.navbottom .navbottom-content ul li
{
	display:flex;
	list-style:none;
	align-items:center;
}

.navbottom .navbottom-content ul li div
{
	width:2.75vw;
	height:4.5vh;
	border-radius:50%;
	background:rgb(73,72,72);
	display:flex;
	align-items:center;
	justify-content:center;
	font-size:1vw;
	color:white;
}

.navbottom .navbottom-content ul li span
{
	color:white;
	margin-left:1.5vw;
	font-size:0.85vw;
}

.navbottom .about-us
{
	color:white;
	font-size:0.85vw;
	padding-top:7.5vh;
}

.navbottom .about-us span
{
	letter-spacing:0.01vw;
	word-spacing:0.2vw;
	line-height: 2;
}

.navbottom .navbottom-map
{
	display:flex;
	align-items:center;
}

.navbottom .navbottom-menu ul li
{
	list-style:none;
	font-size:0.85vw;
	margin-bottom:2vh;
}

.navbottom .navbottom-menu ul li a
{
	text-decoration:none;
	color:#EBEDF2;
}

.navbottom .copyright
{
	position:absolute;
	bottom:0;
	color:white;
	text-align:center;
	width:100%;
	background:#35363A;
	font-size:0.8vw;
}

hr{border-color:grey;}



</style>
<head>
	<title>Dragon Sport</title>
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/9dcddfad62.js" crossorigin="anonymous"></script>
	<script src = "product-item/vanilla-tilt.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="profile-item/jquery.mask.js"></script>

</head>
<body>
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
				<a href = "#" class = "shoppingcart"><i class="fas fa-shopping-cart"></i>
		<?php
				if($_SESSION["loginactive"] == 1)
				{
					$countcart = mysqli_query($connect, "SELECT * FROM shoppingcart WHERE cart_user = $user_id");
					if(mysqli_num_rows($countcart) > 0)
					{
		?>
						<span class = "cartcount"><?php echo mysqli_num_rows($countcart);?></span>
		<?php
					}
					else
					{
		?>
						<span class = "cartcount"></span>
		<?php
					}
				}
		?>
				</a>
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
						<li><a href = "order_history.php">Billing History</a></li>
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
	<?php
		$user = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM user WHERE user_id = $user_id"));
	?>
	<div class = "profile-body">
		<div class = "profile-content">
			<div class = "profile-header">
				<div class="profile-name">
					<p><?php echo $user["user_fullname"];?></p>
					<p class = "register-date">Dragon Sport Member Since <?php echo $user["registered_date"]?></p>
				</div>
				<div class = "digital-clock">
					<div>
						<span id = "hour">00</span><span>Hours</span>
					</div>
					<div>
						<span id = "minute">00</span><span>Minutes</span>
					</div>
					<div>
						<span id = "second">00</span><span>Seconds</span>
					</div>
				</div>
			</div>
			<div class = "profile-detail">
			<h3>Account Settings</h3>
				<div class = "basic-information">
					<div class = "bi-header">
						<h4>Basic Info<h4>
						<div class = "notifysaved"></div>
					</div>
					<div class = "bi-content">
						<p><span class = "bi-attribute">Full Name</span><input type = "text" name = "fullname" value = "<?php echo $user["user_fullname"]?>"/></p>
						<p><span class = "bi-attribute">Email</span><input type = "email" name = "Email" value = "<?php echo $user["user_email"]?>" disabled/><i class="fas fa-lock"></i>
						<label class = "hint" id = "eh">This field cannot be modified</label>
						</p>
						<p><span class = "bi-attribute">Phone</span><input type = "tel" name = "telphone" value = "<?php echo $user["phone_num"]?>"/><i class="fas fa-exclamation-circle"></i>
						<label class = "hint" id = "ph">Follow this format : 01x-xxxxxxxxxx</label>
						</p>
						<p><span class = "bi-attribute">Address</span><input type = "text" name = "address" value = "<?php echo $user["address"]?>"/></p>
						<p><span class = "bi-attribute">State</span><select name = "state" class = "state">
																		<option></option>
																	<?php 
																		$state_name = array("Johor", "Malacca", "Selangor", "Negeri Sembilan", "Perak", "Penang", "Sabah", "Sarawak", "Kedah", "Pahang", "Perlis", "Kelantan", "Terengganu");
																		for($i = 0; $i < 13; $i++)
																		{
																			if($state_name[$i] == $user["state"])
																				echo "<option selected>".$state_name[$i]."</option>";
																			else
																				echo "<option>".$state_name[$i]."</option>";
																		}
																	?>
															   		</select></p>
						<p><span class = "bi-attribute">City</span><input type = "text" name = "city" value = "<?php echo $user["city"]?>"/></p>
						<p><span class = "bi-attribute">Postal Code</span><input type = "text" name = "postal-code" value = "<?php echo $user["postal_code"]?>"/></p>
					</div>
				</div>
				<div class = "login-information">
					<div class = "li-header">
						<h4>Login Info<h4>
					</div>
					<div class = "li-content">
						<p><span class = "li-attribute">Username</span><input type = "text" name = "username" value = "<?php echo $user["user_name"]?>" disabled/><button class = "uedit">Edit</button></p>
						<p><span class = "li-attribute">Password</span><input type = "password" name = "password" value = "<?php echo $user["user_password"]?>" disabled/><button class = "pedit">Edit</button></p>
					</div>
				</div>
			</div>
			<div class = "modal-bg" id = "umodal">
				<div class = "modal-box">
					<div class="modal-header">
						<h4>Change User Name</h4>
						<button class = "close-modal"><i class="fas fa-times"></i></button>
					</div>
					<div class="modal-content">
						<form method = "post">
						<p>Enter your new user name</p>
						<p><input type = "text" name = "cuusername" placeholder = "Username"/></p>
						<div class = "errorr" id = "error-username">&nbsp;</div>
						<p>Enter your password</p>
						<p><input type = "password" name = "cupassword" placeholder = "Password"/><i class="far fa-eye"></i></p>
						<div class = "errorr" id = "error-password">&nbsp;</div>
						<p class = "save-btn"><input type = "submit" name = "usave" value = "Save" /></p>
						</form>
					</div>
				</div>
			</div>
			<div class = "modal-bg" id = "pmodal">
				<div class = "modal-box">
					<div class="modal-header">
						<h4>Change Password</h4>
						<button class = "close-modal"><i class="fas fa-times"></i></button>
					</div>
					<div class="modal-content">
						<form method = "post">
						<p>Enter your current password</p>
						<p><input type = "password" name = "cpassword" placeholder = "Current Password"/><i class="far fa-eye"></i></p>
						<div class = "errorr" id = "error-cpassword">&nbsp;</div>
						<p>Enter your new password</p>
						<p><input type = "password" name = "npassword" placeholder = "New Password"/><i class="far fa-eye"></i></p>
						<div class = "errorr" id = "error-npassword">&nbsp;</div>
						<p>Re-enter your new password</p>
						<p><input type = "password" name = "rpassword" placeholder = "Re-enter Password"/><i class="far fa-eye"></i></p>
						<div class = "errorr" id = "error-rpassword">&nbsp;</div>
						<p class = "save-btn"><input type = "submit" name = "psave" value = "Save" /></p>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class = "navbottom">
		<div class = "navbottom-content">
			<ul>
				<li><div><i class="fas fa-map-marker-alt"></i></div><span>Jalan PJS 11/20, Bandar Sunway,<br>47500, Subang Jaya, Selangor</span></li>
				<li><div><i class="fas fa-phone-alt"></i></div><span>+6075325648</span></li>
				<li><div><i class="fas fa-envelope"></i></div><span>dragonsport@gmail.com</span></li>
			</ul>
		</div>
		<div class = "about-us">
			<h4>About Us</h4>
			<br>
			<span>Dragon Sport was established in 2021 and as a local business in Malaysia. Sell a lot of renowned brands of sneaker such as Adidas and Nike. Provides a good platform for customers to purchase their fovourite sneakers.</span>
		</div>
		<div class = "navbottom-map">
			<iframe width="100%" height="80%" frameborder="0" allowfullscreen src="//umap.openstreetmap.fr/en/map/untitled-map_552500?scaleControl=false&miniMap=false&scrollWheelZoom=false&zoomControl=true&allowEdit=false&moreControl=true&searchControl=null&tilelayersControl=null&embedControl=null&datalayersControl=true&onLoadPanel=undefined&captionBar=false"></iframe>
		</div>
		<div class = "copyright">
			Copyright &copy; 2021 Dragon Sport || All Rights Reserval
		</div>
	</div>
</body>
<?php
if(isset($_POST["usave"]))
{
	$nusername = $_POST["cuusername"];
	$password = md5($_POST["cupassword"]);
	$checkusername = mysqli_query($connect, "SELECT * FROM user WHERE user_name = '$nusername'");
	$valid_username = 0;
	$valid_password = 0;

	if(empty($nusername))
	{
?>
	<script>
		$("#error-username").html("Username cannot be empty");
	</script>
<?php
	}
	else if(strlen($nusername) > 11)
	{
?>
	<script>
		$("#error-username").html("Username should less than 12 characters");
	</script>
<?php
	}
	else if(mysqli_num_rows($checkusername) > 0)
	{
?>
	<script>
		$("#error-username").html("Username has been taken");
	</script>
<?php
	}
	else
	{
?>
	<script>
		$("#error-username").html("");
	</script>
<?php
		$valid_username = 1;
	}

	if($password != $user["user_password"])
	{
?>
		<script>
			$("#error-password").html("Incorrect password");
		</script>
<?php
	}
	else
	{
?>
		<script>
			$("#error-password").html("");
		</script>
<?php	
		$valid_password = 1;
	}

	if($valid_username == 1 && $valid_password == 1)
	{
		mysqli_query($connect, "UPDATE user SET user_name = '$nusername' WHERE user_id = $user_id");
		$_SESSION["username"] = $nusername;
?>
		<script>
			alert("Your user name has been changed.");
			$(".errorr").html("");
			localStorage.setItem("modal", 0);
		</script>
<?php		
		echo "<meta http-equiv='refresh' content='0'>";
	}
}

if(isset($_POST["psave"]))
{
	$password = md5($_POST["cpassword"]);
	$npassword = $_POST["npassword"];
	$rpassword = $_POST["rpassword"];
	$checkcp = 0;
	$checknp = 0;
	$checkrp = 0;

	if($password != $user["user_password"])	
	{
?>
		<script>
			$("#error-cpassword").html("Incorrect password");
		</script>
<?php
	}
	else
		$checkcp = 1;

	if(empty($npassword))
	{
?>
		<script>
			$("#error-npassword").html("Password cannot be empty");
		</script>
<?php
	}
	else if(strlen($npassword) < 8)
	{
?>
		<script>
			$("#error-npassword").html("Password is too short");
		</script>
<?php
	}
	else
		$checknp = 1;
	
	if($rpassword != $npassword)
	{
?>
		<script>
			$("#error-rpassword").html("Password is not match");
		</script>
<?php
	}
	else if(empty($rpassword))
	{
?>
		<script>
			$("#error-rpassword").html("Password cannot be empty");
		</script>	
<?php
	}
	else
		$checkrp = 1;
	
	if($checkcp == 1 && $checknp  == 1 && $checkrp == 1)
	{
		$md_password = md5($npassword);
		mysqli_query($connect, "UPDATE user SET user_password = '$md_password' WHERE user_id = $user_id");
?>
		<script>
			alert("Your password has been changed.");
			localStorage.setItem("pmodal", 0);
		</script>
<?php
	}
}
?>
<script>
let modal = localStorage.getItem("modal");
let pmodal = localStorage.getItem("pmodal");
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
	
	//decide whether to display wishcount and cartcount
	<?php
	if($_SESSION["loginactive"] == 1)
	{
		if(mysqli_num_rows($countwish) == 0 || $_SESSION["loginactive"] == 0)
		{
		?>
			$(".wishcount").css("display", "none");
			$(".count0").css("display", "initial");
		<?php
		}
		else
		{
		?>
			$(".wishcount").css("display", "initial");
			$(".count0").css("display", "none");
		<?php
		}

		if(mysqli_num_rows($countcart) == 0 || $_SESSION["loginactive"] == 0)
		{
		?>
			$(".cartcount").css("display", "none");
		<?php
		}
		else
		{
		?>
			$(".cartcount").css("display", "initial");
		<?php
		}
	}
	?>
	
	$(".wishandcart .wishlist").click(function(){
		<?php
		if($_SESSION["loginactive"] == 0)
		{
		?>
			alert("You can't see your wishlist before you log in");
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

	//Display Time
	function currenttime()
	{
		let date = new Date();
		$("#hour").html(date.getHours());
		$("#minute").html(date.getMinutes());
		$("#second").html(date.getSeconds());
	}

	var triggertime = setInterval(currenttime, 1000);

	//Saved Basic Info to Database
	$(".profile-detail .basic-information .bi-content input, select").change(function()
	{
		let name = $("input[name = 'fullname']").val();
		let phone = $("input[name = 'telphone']").val();
		let address = $("input[name = 'address']").val();
		let state = $(".state").val();
		let city = $("input[name = 'city']").val();
		let poscode = $("input[name = 'postal-code']").val();

		if(phone.length > 0 && phone.length < 11 || phone.length > 12)
			$("input[type = 'tel']").css("border-color", "red");
		else
		{
			$("input[type = 'tel']").css("border-color", "lightblue");
			$(".notifysaved").load("profile-item/updateprofile.php", {
				n:name, p:phone, a:address, s:state, c:city, pc:poscode
			});
		}
	});

	//Define Modal Visibility
	if(modal == 0)
		$("#umodal").css({"visibility":"hidden", "opacity":"0"});
	else
		$("#umodal").css({"visibility":"visible", "opacity":"1"});

	if(pmodal == 0)
		$("#pmodal").css({"visibility":"hidden", "opacity":"0"});
	else
		$("#pmodal").css({"visibility":"visible", "opacity":"1"});

	//Change User Name
	$(".uedit").click(function()
	{
		$("#umodal").css({"visibility":"visible", "opacity":"1"});
		localStorage.setItem("modal", 1);
	});

	$(".close-modal").click(function(){
		$("#umodal").css({"visibility":"hidden", "opacity":"0"});
		$("#umodal").css("opacity", "0");
		localStorage.setItem("modal", 0);
		$(".errorr").html("");
	});

	//Change Password
	$(".pedit").click(function()
	{
		$("#pmodal").css({"visibility":"visible", "opacity":"1"});
		$("#pmodal").css("opacity", "1");
		localStorage.setItem("pmodal", 1);
	});

	$(".close-modal").click(function(){
		$("#pmodal").css({"visibility":"hidden", "opacity":"0"});;
		$("#pmodal").css("opacity", "0");
		localStorage.setItem("pmodal", 0);
	});

	//Password Strength
	$("input[name = 'npassword']").keyup(function()
	{
		$("#error-npassword").html("<span class = 'strength-bar' id = 'red'>Weak</span><span class = 'strength-bar' id = 'orange'>Medium</span><span class = 'strength-bar' id = 'green'>Strong</span>");
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

	$("input[type = 'tel']").mask("010-00000000");

	$(".fa-eye").mousedown(function()
	{
		$(this).siblings("input").attr("type", "text");
	});

	$(".fa-eye").mouseup(function()
	{
		$(this).siblings("input").attr("type", "password");
	});
});   
</script>
</html>