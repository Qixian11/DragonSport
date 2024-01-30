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



.nav_background
{
	background-image:url("banner/pexels-lucas-pezeta-2119223.jpg");
	height:95vh;

	background-size:cover;
	position:relative;
	background-color:black;
	
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
.search-bar input::placeholder
{
	color:white;
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
::placeholder
{
	color:black;
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
	top:0.05vw
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
	top:7vh;
	
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



.contactus{

	width:600px;
	
	padding:10px 10px ;
	margin:0 auto;
	text-decoration:none;
	

}
.contactus h1{
	text-align:center;
	font-family:'Poppins' ,sans-serif;
	padding-top:20%;
	text-transform: uppercase;
	text-align:center;
	letter-spacing:1px;
	color:white;
	text-decoration:underline ;
	text-underline-position:under;
	
}
.btn {
	margin-top:30px;
}

.btn input{
	display:block;
	text-decoration:none;
	border:1.5px solid #fff;
	width:200px;
	text-align:center;
	height: 45px;
	line-height:45px;
	text-transform:uppercase;
	color:#fff;
	letter-spacing:5px;
	transition:all 0.5s linear;
	background:none;
	cursor:pointer;
	
}
.btn input:hover{
	background:#fff;
	color:#000;
}
.item{
	margin-bottom:15px;
	
}

.item input[type="text"]
{
	width:100%;
	background:none;
	border:0;
	border-bottom:2px solid #fff;
	color:#fff;
	padding:10px 10px;
	resize:none;
	font-size:15px;
	margin-top:15px;
	outline:none;


}
.item1 textarea{
    width:100%;
	background:none;
	border:0;
	border-bottom:2px solid #fff;
	color:#fff;
	
	resize:none;
	font-size:15px;
	outline:none;
    height:180px;
	

}
.item.name_email{
 display:flex;
 justify-content:space-between;
}
.item.name_email input{
	width:48%;
}
.item textarea{
	height:150px;
	resize:none;

}

::-webkit-input-placeholder{
	color:#fff;
}
 .img img {
	display:flex;
	height:50px;
	weight:50px;
}
.container{
	display:flex;
	position:relative;
	background:#f7fcff;
	justify-content:center;
	width: 100%;
	flex-direction:row;
	
	margin:0 auto ;
}
.container .box{
	position:relative;
	width: 300px;
	height:300px;
	margin:50px;
	box-shadow:0px 30px 50px rgba(0,0,0,0.05);
	background:#fff;
	
}

body .container{
	display:flex;
	justify-content:center;
	align-items:center;
	min-height: 10vh;
	background:#f7fcff;
	
}
.container .box .imgBx{
	position:absolute;
	top: 0;
	left: 0;
	width: 100%;
	height:100%;

	display:flex;
	justify-content:center;
	align-items:center;
	transition:0.5s;
	transition-delay:0.5s;
	
}

.container .box:hover .imgBx{
	transform :scale(0);
	transition-delay:0s;
}
.container .box .imgBx img{
	max-width:100px;
}
.container .box .content{
	position:relative;
	top 0;
	left 0;
	width: 100%;
	height:100%;
	padding:20px;
	display:flex;
	justify-content:center;
	align-items:center;
	flex-direction:column;
	transition:0.5s;
	background:#ff3579;
	transform:scale(0);
	transition-delay:0s;
}
.container .box:hover .content{
	transform:scale(1);
	transition-delay:0.5s;
}

.container .box:nth-child(2) .content{
	background:#2ba1ff;
}
.container .box:nth-child(3) .content{
	background:#c630e0;
}

.container .box .content .icon img{
	max-width:88px;
	filter:invert(1);
	
}
.container .box .content h3{
	color:#fff;
	text-transform:uppercase;
	font-size:16px;
	letter-spacing:2px;
	margin-top:20px;
}
.container .box .content h4{
	color:#fff;

}


</style>
<head>
	<title>Dragon Sport</title>
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600&display=swap" rel="stylesheet">
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
	
<form name="contact_us" method="GET">
	<div class = "contact">
		
			<div class ="contactus">
				<h1>Contact US</h1>
				<div class="item name_email">
				<input type="text" name="username" placeholder="Your name">
				<input type="text" name="useremail"placeholder="Email">
				</div>
				
			<div class = "item">
				<input type="text" name="subject" placeholder="Subject">
			</div>
			<div class = "item1">
			<textarea placeholder="message" name="message"></textarea> 
			</div>
			<div class = "btn">
			<input type="submit" value="send" name="submit1">		
			</div>
		</div>		
		</div>
	</form>

</div>

<?php
if(isset($_GET["submit1"]))
{
	date_default_timezone_set('Asia/Kuala_Lumpur');
	$name2=$_GET["username"];
	$email1=$_GET["useremail"];
	$message1=$_GET["message"];
	$subject1=$_GET["subject"];
	$date = date("d F");
	$time = date("H:i");
	mysqli_query($connect,"insert into contact(user_name,user_email,user_subject,user_message, Date, Time, Status)VALUES('$name2','$email1','$subject1','$message1', '$date', '$time', 'Unseen')");
?>
	<script>
	alert("Record save");
	location.href = "mainpage.php";
</script>
<?php
}
?>

<div class="container">
	<div class="box">
		<div class="imgBx">
		<img src="banner/call3.png">
		</div>
		<div class="content">
		<div class="icon">
		<img src="banner/call3.png">
		</div>
		 <h3>Phone NO.</h3>
		 <h4>+60-10883-3962</h4>
		 <h4>+60-111516-5367</h4>
		 <h4>+60-10510-1108</h4>
		</div>
	</div>
	<div class="box">
		<div class="imgBx">
		<img src="banner/message1.png">
		</div>
		<div class="content">
		<div class="icon">
		<img src="banner/message1.png">
		</div>
		 <h3>Email.</h3>
		 <h4>dragonsport159gmail.com</h4>
	
		</div>
	</div>
	<div class="box">
		<div class="imgBx">
		<img src="banner/map1.png">
		</div>
		<div class="content">
		<div class="icon">
		<img src="banner/map1.png">
		</div>
		 <h3>Address.</h3>
		 <h4>Jalan PJS 11/20,</h4>
		 <h4>Bandar Sunway, 47500,</h4>
		 <h4> Subang Jaya, Selangor</h4>


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
});
</script>
</html>