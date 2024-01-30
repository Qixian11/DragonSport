<?php 
include("dataconnection.php"); 
session_start(); 
$_SESSION["active"] = 0;
if(isset($_GET["login"]))
	$_SESSION["loginactive"] = $_GET["id"];
if(empty($_SESSION["loginactive"]))
	$_SESSION["loginactive"] = 0;
?>
<html>
<style>

html
{
	scroll-behavior:smooth;
}

@font-face
{
	font-family:mine;
	src:url(mainpage-item/OPTICopperplate.otf);
}

*
{margin:0px;
  padding:0px;
  box-sizing:border-box;
}

.nav_background
{
	background-image:url("banner/SP15_JD_ALLSTAR_KAWHILEONARD_ACTION_PRIMARY_hd_1600.jpg");
	height:90vh;
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

.logo{margin-left:3%;display:flex; align-items:center;}

.logo img{width:3.5vw;
		  
}

.nav-link{display:flex;
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
	bottom:1.3vh;
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
	bottom:1.3vh;
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

.body
{
	margin-left:3%;
	margin-right:3%;
}

.first
{
	text-align:center;
	font-family: 'Poppins', sans-serif;
}

.first p
{
	font-weight:900;
	font-size:4vw;
}
		
.first a button
{	
	border:2px solid black;
	cursor:pointer;
	background:white;
	color:black;
	width:10vw;
	height:6vh;
	font-weight:bold;
	font-size:1vw;
	transition:all 0.3s ease-in-out;
}

.first a button i
{
	margin-left:0.75vw;
}
		 
.first a button:hover
{
	filter:invert(100);
}	

h1
{
	font-family: 'Poppins', sans-serif;
	text-transform:uppercase;
	font-size:2.5vh;
	letter-spacing:0.1vh;
	font-weight:bold;
}

.second
{
	margin-top:8vh;
	overflow-x:auto;
	height:auto;
	font-family: 'Poppins', sans-serif;
}

.second h1
{
	height:6vh;
}

.second .hotsales-body
{
	display:flex;
	float:left;
}

.second .hotsales-body .hotsales-item
{
	width:30.75vw;
	height:70vh;
	display:grid;
	grid-template-rows:85% auto;
	margin-right:0.5vw;
}

.second .hotsales-body .hotsales-item:hover > .hotsales-detail > .shoes-more
{
	visibility:visible;
}

.second .hotsales-body .hotsales-item:hover > .hotsales-image > img
{
	transform: scale(1.1);
}

.second .hotsales-body .hotsales-item:nth-last-child(1)
{
	margin-right:0;
}

.second .hotsales-body .hotsales-item .hotsales-image
{
	background:#EFEFEF;
	display:flex;
	justify-content:center;
	align-items:center;
}

.second .hotsales-body .hotsales-item .hotsales-image img
{
	width:100%;
	transition:all 0.6s ease-in-out;
}

.second .hotsales-body .hotsales-item .hotsales-detail
{
}

.second .hotsales-body .hotsales-item .hotsales-detail .shoes-name
{
	font-size:0.9vw;
}

.second .hotsales-body .hotsales-item .hotsales-detail .shoes-description
{
	text-overflow: ellipsis;
	overflow:hidden;
	height:2vh;
	color:#8F8F8F;
	font-size:0.8vw;
}

.second .hotsales-body .hotsales-item .hotsales-detail .shoes-more
{
	height:5vh;
	display:flex;
	align-items:flex-end;
	visibility:hidden;
}

.second .hotsales-body .hotsales-item .hotsales-detail .shoes-more span
{
	display:flex;
	animation:bounce 1s linear infinite;
}

.second .hotsales-body .hotsales-item .hotsales-detail .shoes-more span a
{
	text-decoration:none;
	color:black;
	font-weight:bold;
	font-size:0.9vw;
}

@keyframes bounce
{
	0%,20%,60%, 100%
	{
		transform:translateY(0);
	}
	40%
	{
		transform:translateY(-30px);
	}
	80%
	{
		transform:translateY(-20px);
	}
}

.second::-webkit-scrollbar
{
	height:0.75vh;
	top:5vh;
	position:relative;
	cursor:pointer;
}

.second::-webkit-scrollbar-track {
  background: #e6e6e6;
}

.second::-webkit-scrollbar-thumb {
  background: black;
}

.second::-webkit-scrollbar-thumb:hover {
  background: grey;
}

.decoration
{
	margin-top:8vh;
}

.decoration video
{
	width:94vw;
	height:70vh;
	object-fit: fill;
}

.third
{
	margin-top:8vh;
}

.third h1
{
	height:6vh;
}

.third .upcoming-img
{
	display:flex;
	overflow:hidden;
	position:relative;
	height:85vh;
}

.third .upcoming-img img
{
	width:94vw;
	object-fit:cover;
	transition:0.3s;
}

.third .upcoming-img .upcoming-slide
{
	position:absolute;
	bottom:7.5vh;
	width:40vw;
	margin:0 auto;
	right:0;
	left:0;
	display:flex;
	justify-content:space-around;
}

.third .upcoming-img .upcoming-slide input
{
	display:none;
}

.third .upcoming-img .upcoming-slide label
{
	display:inline-block;
	width:30%;
	background:rgba(255,255,255,0.5);
	height:0.8vh;
	cursor:pointer;
}

.third .upcoming-img .upcoming-slide input:checked + label
{
	background:black;
}

.fourth
{
	margin-top:8vh;
}

.fourth h1
{
	height:6vh;
}

.fourth .brands
{
	display:grid;
	grid-template-columns:49.9% 49.9%;
	height:70vh;
	justify-content:space-between;
}

.fourth .brands div
{
	position:relative;
	height:70vh;
}

.fourth .brands div img
{
	height:100%;
	width:100%;

}

.fourth .brands div div
{
	position:absolute;
	bottom:8.75vh;
	left:3vw;
	background:none;
	border:1px solid black;
	width:10vw;
	height:5vh;
}

.fourth .brands div .adidas-btn
{
	border:1px solid white
}

.fourth .brands div .adidas-btn a
{
	background:white;
	color:black;
}

.fourth .brands div div a
{
	position:absolute;
	left:-0.20vw;
	top:-0.20vw;
	width:100%;
	height:100%;
	background:black;
	color:white;
	display:flex;
	align-items:center;
	justify-content:center;
	text-decoration:none;
	font-family: 'Poppins', sans-serif;
	transition:0.3s;
	font-size:0.9vw;
	font-weight:bold;
}

.fourth .brands div div a i
{
	margin-left:1vw;
	font-size:0.95vw;
	text-transform:uppercase;
}

.fourth .brands div div a:hover
{
	filter:invert(100);
}

.fifth
{
	margin-top:8vh;
}

.fifth h1
{
	height:6vh;
}

.fifth .new-img
{
	display:flex;
	overflow:hidden;
	position:relative;
	height:85vh;
}

.fifth .new-img img, video
{
	width:94vw;
	object-fit:cover;
	transition:0.3s;
}

.fifth .new-img .new-slide
{
	position:absolute;
	bottom:7.5vh;
	width:40vw;
	margin:0 auto;
	right:0;
	left:0;
	display:flex;
	justify-content:space-around;
}

.fifth .new-img .new-slide input
{
	display:none;
}

.fifth .new-img .new-slide label
{
	display:inline-block;
	width:30%;
	background:rgba(255,255,255,0.5);
	height:0.8vh;
	cursor:pointer;
}

.fifth .new-img .new-slide input:checked + label
{
	background:black;
}

.fifth .new-img .new-btn
{
	position:absolute;
	bottom:5vh;
	left:3vw;
	background:none;
	border:1px solid black;
	width:10vw;
	height:5vh;
}

.fifth .new-img .new-btn a
{
	position:absolute;
	left:-0.20vw;
	top:-0.20vw;
	width:100%;
	height:100%;
	background:black;
	color:white;
	display:flex;
	align-items:center;
	justify-content:center;
	text-decoration:none;
	font-family: 'Poppins', sans-serif;
	transition:0.3s;
	font-size:0.9vw;
}

.fifth .new-img .new-btn a i
{
	margin-left:1vw;
	font-size:0.95vw;
	text-transform:uppercase;
}

.fifth .new-img .new-btn a:hover
{
	filter:invert(100);
}

.fifth .new-img .new-name
{
	position:absolute;
	right:3vw;
	top:6vh;
}

.fifth .new-img .new-name h1
{
	font-size:3vw;
}

.backtotop
{
	margin-top:8vh;
	display:flex;
	justify-content:center;
}

.backtotop a
{
	font-family: 'Poppins', sans-serif;
	text-decoration:none;
	font-size:1.1vw;
	color:black;
}

.backtotop a i
{
	margin-left:0.5vw;
}

.backtotop a:hover
{
	text-decoration:underline;
}

.navbottom
{
	background-color:black;
	margin-top:2vh;
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
	</div>
	<div class = "first">
		<p>BEAT THE GRAVITY</p>
		<a href = "product.php"><button>Shop Now<i class="fas fa-arrow-right"></i></button></a>
	</div>
	<div class = "body">

<?php
$hotsales_results = mysqli_query($connect, "SELECT Shoes_ID, Shoes_Name, Shoes_IMG, Shoes_Description, SUM(orders_detail.qty) FROM orders_detail, product_entry, product WHERE order_product = ID AND product_id = Shoes_ID GROUP BY Shoes_Name ORDER BY SUM(orders_detail.qty) DESC LIMIT 5");
?>
	<div class = "second">
		<h1>Hot Sales in this month</h1>
		<div class = "hotsales-body">
			<?php
				while($hotsales = mysqli_fetch_assoc($hotsales_results))
				{
			?>
			<div class = "hotsales-item">
				<div class = "hotsales-image">
					<?php echo '<img src = "data:image;base64,'.base64_encode($hotsales['Shoes_IMG']).'">'; ?>
				</div>
				<div class = "hotsales-detail">
					<p class = "shoes-name"><b><?php echo $hotsales['Shoes_Name']?></b></p>
					<p class = "shoes-description"><?php echo $hotsales['Shoes_Description']?></p>
					<p class = "shoes-more"><span><a href = "product-description.php?buy&id= <?php echo $hotsales['Shoes_ID']?>">More about it</a></span></p>
				</div>
			</div>
			<?php
				}
			?>
		</div>
	</div>

	<div class = "decoration">
		<video autoplay loop muted inline>
			<source src="mainpage-item/GOAT- Buy and Sell Authentic Sneakers.mp4" type="video/mp4">
		</video>
	</div>

	<div class = "third">
		<h1>Upcoming Shoes</h1>
		<div class = "upcoming-img">
			<img src="mainpage-item/dunk-high-x-ambush-cosmic-fuchsia-release-date-.png">
			<img src="mainpage-item/dunk-high-x-ambush-cosmic-fuchsia-release-date- (2).jpg">
			<img src="mainpage-item/dunk-high-x-ambush-cosmic-fuchsia-release-date- (1).jpg">
			<div class = "upcoming-slide">
				<input type="radio" value = "0" id = "up1" name = "upcoming-slide" checked><label for="up1"></label>
				<input type="radio" value = "1" id = "up2" name = "upcoming-slide"><label for="up2"></label>
				<input type="radio" value = "2" id = "up3" name = "upcoming-slide"><label for="up3"></label>
			</div>
		</div>
	</div>
	<div class = "fourth">
		<h1>Brands</h1>
		<div class = "brands">
			<div class = "adidas-brands">
				<img src="mainpage-item/02_creative_adidas_ads_illers_hidden_ii.png">
				<div class = "adidas-btn">
					<a href="only-adidas.php">Shop Now<i class="fas fa-arrow-right"></i></a>
				</div>
			</div>
			<div class = "nike-brands">
				<img src="mainpage-item/javier-ramirez-de-anton-v2basketballnike.jpg">
				<div class = "nike-btn">
					<a href="only-nike.php">Shop Now<i class="fas fa-arrow-right"></i></a>
				</div>
			</div>
		</div>	
	</div>
	<div class = "fifth">
		<h1>New Arrival</h1>
		<div class = "new-img">
			<img src="mainpage-item/NMD_R1_The_Mandalorian_Shoes_Black_GZ2737_01_standard.png">
			<img src="mainpage-item/NMD_R1_The_Mandalorian_Shoes_Black_GZ2737_04_standard.jpg">
			<video autoplay loop muted><source src = "mainpage-item/adidas Star Wars Mandalorian NMD_R1 Shoes - Black - adidas Malaysia.webm" type = "video/webm"></video>
			<div class = "new-slide">
				<input type="radio" value = "0" id = "new1" name = "new-slide" checked><label for="new1"></label>
				<input type="radio" value = "1" id = "new2" name = "new-slide"><label for="new2"></label>
				<input type="radio" value = "2" id = "new3" name = "new-slide"><label for="new3"></label>
			</div>
			<div class = "new-btn">
					<a href="product-description.php?buy&id= 63">View<i class="fas fa-arrow-right"></i></a>
			</div>
		</div>
	</div>
	<div class = "backtotop">
		<a href="#">Back to Top<i class="fas fa-arrow-up"></i></a>
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
<script type = "text/javascript">
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
		<?php
		}
		else
		{
		?>
			$(".wishcount").css("display", "initial");
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

	//slide show for upcoming and new arrival part
	let upcoming_page = 0 ,new_page = 0;

	//for upcoming
	setInterval(function()
	{
		upcoming_page++;
		
		upcoming_page = upcoming_slide(upcoming_page);
	}, 7000);

	$(".upcoming-slide input").click(function()
	{
		upcoming_page = $(this).val();

		upcoming_page = upcoming_slide(upcoming_page);
	});

	function upcoming_slide(p)
	{
		if(p > 2)
			p = 0;

		let margin = p * 94;

		$(".upcoming-img img:nth-child(1)").css("margin-left", "-"+margin+"vw");
		$("#up"+(p+1)).prop("checked", true);

		return p;
	}

	//for new arrival
	setInterval(function()
	{
		new_page++;
		
		new_page = new_slide(new_page);
	}, 10000);

	$(".new-slide input").click(function()
	{
		new_page = $(this).val();

		new_page = new_slide(new_page);
	});

	function new_slide(p)
	{
		if(p > 2)
			p = 0;

		let margin = p * 94;

		$(".new-img img:nth-child(1)").css("margin-left", "-"+margin+"vw");
		$("#new"+(p+1)).prop("checked", true);

		return p;
	}
});
</script>
</html>