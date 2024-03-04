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
	background-image:url("banner/sport.jpg");
	height:80vh;
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
	z-index:1000;
}

nav:hover
{
	background:black;
}

.logo{margin-left:3%;display:flex; align-items:center;}

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

.title
{
	font-family: 'Poppins', sans-serif;
	font-size:4vw;
	font-weight:900;
	letter-spacing:0.1vw;
	margin-bottom:3vh;
	color:black;
	text-align:center;
}

.content
{
	margin:0 3vw;
	display:grid;
	grid-template-rows:auto auto;
	font-family: 'Poppins', sans-serif;
}

.content .content-bar
{
	display:flex;
	justify-content:space-between;
}

.content .content-bar div button
{
	background:none;
	font-size:0.9vw;
	border:none;
	outline:none;
	cursor:pointer;
	letter-spacing:0.05vw;
}

.content .content-bar div button i
{
	margin-left:0.3vw;
	transition:all 0.3s ease-in-out;
}

.content .content-bar div ul
{
	position:relative;
}

.content .content-bar div ul li
{
	list-style:none;
}

.content .content-bar div ul li ul
{
	position:absolute;
	right:0;
	width:8vw;
	background:white;
	z-index:1000;
	display:none;
}

.content .content-bar div ul li ul li
{
	text-align:center;
	border:1px solid black;
	cursor:pointer;
}

.content .content-body
{
	display:flex;
	padding:2vh 0;
}

.content .content-body .filter
{
	width:20%;
	display:none;
	padding-right:1.5vw;
}

.content .content-body .filter .clear
{
	text-align:center;
	height:6vh;
}

.content .content-body .filter .clear input
{
	width:100%;
	height:6vh;
	font-size:3.5vh;
	font-family:"consolas";
	background-color:black;
	color:white;
	transition:all 0.5s ease-in-out;
	cursor:pointer;
	border:1px solid white;
}

.content .content-body .filter .clear input:hover
{
	filter:invert(100);
}

.content .content-body .filter .type
{
	margin:2vh 0;
}

.content .content-body .filter .type h4
{
	font-size:1.25vw;
}

.content .content-body .filter .type input
{
	display:none;
}

.content .content-body .filter .type label
{
	width:100%;
	height:6vh;
	display:flex;
	border:1px solid black;
	text-align:center;
	align-items:center;
	justify-content:center;
	cursor:pointer;
	font-size:0.9vw;
	margin:1vh 0;
}

.content .content-body .filter .type input:checked + label
{
	background:black;
	color:white;
}

.content .content-body .filter .size
{
	margin-top:2vh;
}

.content .content-body .filter .size h4{font-size:1.25vw; margin-bottom:1vh;}

.content .content-body .filter .size .size-content
{
	display:flex;
	flex-wrap:wrap;
}

.content .content-body .filter .size .size-content input
{
	display:none;
}

.content .content-body .filter .size .size-content label
{
	display:flex;
	align-items:center;
	justify-content:center;
	width:48%;
	border:1px solid black;
	height:6vh;
	margin-bottom:1vh;
	position:relative;
	cursor:pointer;
	font-size:0.9vw;
}

.content .content-body .filter .size .size-content label:nth-child(even)
{
	margin-right:2%;
}

.content .content-body .filter .size .size-content label span
{
	position:absolute;
	background:black;
	bottom:0;
	display:inline-block;
	width:100%;
	height:0.25vh;
	visibility:hidden;
}

.content .content-body .filter .size .size-content label:hover > span
{
	visibility:visible;
}

.content .content-body .filter .size .size-content input:checked + label
{
	font-weight:bold;
}

.content .content-body .filter .size .size-content input:checked + label > span
{
	visibility:visible;
	height:0.5vh;
}

.content .content-body .filter .price
{
	margin:2vh 0;
}

.content .content-body .filter .price h4{font-size:1.25vw; margin-bottom:1vh;}

.content .content-body .filter .price div
{
	display:flex;
	justify-content:space-between;
}

.content .content-body .filter .price div div
{
	width:47.5%;
	display:block;
	text-align:center;
}

.content .content-body .filter .price div div input
{
	width:100%;
	height:5vh;
	text-align:center;
	font-size:0.9vw;
	border:2px solid black;
}

.content .content-body .filter .price div div span
{
	font-size:0.9vw;
}

input[type = 'number']::-webkit-outer-spin-button,
input[type = 'number']::-webkit-inner-spin-button
{
  -webkit-appearance: none;
  margin: 0;
}

.content .content-body .product
{
	width:100%;
	height:100%;
	transition:all 0.3s ease;
	display:flex;
	flex-wrap:wrap;
}

.content .content-body .product .item
{
	width:33%;
	height:51.5vh;
	display:grid;
	grid-template-rows:85% 7.5% 7.5%;
	margin:0 0.1vw 1.5vh;
}

.content .content-body .product .item .item-pic
{
	background:#efefef;
	display:flex;
	align-items:center;
	justify-content:center;
	position:relative;
}

.content .content-body .product .item .item-pic img
{
	width:70%;
}

.content .content-body .product .item .item-pic div
{
	position:absolute;
	top:0;
	display:flex;
	justify-content:space-between;
	align-items:flex-end;
	width:100%;
	height:5vh;
}

.content .content-body .product .item .item-pic div .logo
{
	width:3vw;
	height:3vh;
}

.content .content-body .product .item .item-pic div .logo img
{
	width:100%:
}

.content .content-body .product .item .item-pic div button
{
	font-size:1vw;
	cursor:pointer;
	background:none;
	outline:none;
	border:none;
	margin-right:1vw;
	height:3vh;
}

.content .content-body .product .item .add-btnn, .item-name
{
	display:flex;
	align-items:center;
	font-size:0.85vw;
}

.content .content-body .product .item .add-btnn
{
	justify-content:space-between;
	font-size:0.85vw;
}

.content .content-body .product .item .add-btnn a
{
	height:100%;
	background:white;
	color:black;
	width:6vw;
	cursor:pointer;
	border:1px solid black;
	font-size:0.85vw;
	display:flex;
	align-items:center;
	justify-content:center;
	text-decoration:none;
	transition:all 0.3s ease-in-out;
}

.content .content-body .product .item .add-btnn a:hover
{
	background:black;
	color:white;
}

.loading
{
	height:0.5vh;
	background:grey;
	width:10%;
	animation:loading 0.5s linear infinite;
	display:none;
}

@keyframes loading
{
	25%
	{
		margin-left:25%;
	}
	50%
	{
		margin-left:50%;
	}
	75%
	{
		margin-left:75%;
	}
	100%
	{
		margin-left:85%;
	}
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

.no-result
{
	font-family:"sec";
	font-size:5vh;
}
</style>
<head>
	<title>Dragon Sport</title>
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
	<script src="https://kit.fontawesome.com/9dcddfad62.js" crossorigin="anonymous"></script>
	<script src = "product-item/vanilla-tilt.min.js"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
	<div class = "title">
		<p>ALL PRODUCT</p>
	</div>

	<div class = "content">
		<div class = "content-bar">
			<div>
				<button class = "show-filter-btn"><span class = "filter-text">Show Filter</span><i class="fas fa-angle-right"></i></button>
			</div>
			<div>
				<ul>
					<li>
						<button class = "sort">Sort By<i class="fas fa-sort"></i></button>
						<ul>
							<li class = "asc-btn"><button>A-Z</button></li>
							<li class = "desc-btn"><button>Z-A</button></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>

		<?php
		$types_result = mysqli_query($connect, "SELECT * FROM category_types");
		$size_result = mysqli_query($connect, "SELECT * FROM product_size");
		?>

		<div class = content-body>
			<div class = "filter">
				<div class = "clear">
					<input type = "submit"  name = "submit-btn" value = "CLEAR ALL" class = "clear-btn"/>
				</div>
				<div class = "type">
					<h4>Types</h4>
				<?php
				$j = 1;
				while($types_row = mysqli_fetch_assoc($types_result))
				{
				?>
					<p><input type = "checkbox" name = "type[]" value = "<?php echo $types_row['types_id']?>" id = "type<?php echo $j?>"/>
					<label for = "type<?php echo $j?>"><?php echo $types_row['types_name']?></label></p>
				<?php
					$j++;
				}
				?>
				</div>
				<div class = "size">
					<h4>Size</h4>
					<div class = "size-content">
					<?php
					while($size_row = mysqli_fetch_assoc($size_result))
					{
					?>
						<input type = "checkbox" name = "size[]" value = "<?php echo $size_row['Size_ID']?>" id = "size_num<?php echo $size_row['Size_ID']?>"/>
						<label for = "size_num<?php echo $size_row['Size_ID']?>"><?php echo $size_row["Size"]?> US <span></span></label>
					<?php
					}
					?>	
					</div>	
				</div>
				<div class = "price">
					<h4>Price</h4>
					<div>
						<div>
							<input type = "number" name = "price-min" value = "130" min = "130" max = "1000" id = "price-min"/>
							<span class = "min">MIN</span>
						</div>
						<div>
							<input type = "number" name = "price-max" value = "1000" min = "130" max = "1000" id = "price-max"/>
							<span class = "max">MAX</span>
						</div>
					</div>
				</div>
			</div>
			<div class = "product">
					
			</div>
		</div>
	</div>

	<div class = "loading">
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
	let price_min = 130, price_max = 1000, checkb = 0, limit = 9;
	let checkt = 0, checks = 0, size = [], type = [], sort = 0;
	let cdf = 0, flimit = 9, checksearch = 0;

//to define whether it is load search page or default page
<?php
if($_SESSION["active"] == 1)
{
?>
	checksearch = 1;
<?php
}
?>
	$(".product").load("item.php",{
			c3:checkb, limit:limit, checksearch:checksearch
	});

	$(".filter input[type = 'checkbox']").click(function()
	{
		//reset the loading height
		scrollheight = $(window).height() * 2;

		type = [];
		size = [];

		cdf = 1;flimit = 9;
		$('.type input[type="checkbox"]:checked').each(function()
		{
            type.push($(this).val());
			checkt = 1;
        });
		
		if (!$(".type input[type = 'checkbox']").is(":checked"))
			checkt = 0;

		$('.size input[type="checkbox"]:checked').each(function()
		{
             size.push($(this).val());
			 checks = 1;
        });

		if (!$(".size input[type = 'checkbox']").is(":checked"))
			checks = 0;

		$(".product").load("filter.php", {
			type:type, size:size, price_min:price_min, price_max:price_max, c1:checkt, c2:checks, sort:sort, c3:checkb , flimit:flimit
		});
	});
	$(".price input[type = 'number']").keyup(function()
	{
		//reset the loading height
		scrollheight = $(window).height() * 2;

		cdf = 1;flimit = 9;
		price_min = $(".price input[name = 'price-min']").val();
		price_max = $(".price input[name = 'price-max']").val();
		$(".product").load("filter.php", {
			type:type, size:size, price_min:price_min, price_max:price_max, c1:checkt, c2:checks, sort:sort, c3:checkb, flimit:flimit
		});
	});
		
	$(".show-filter-btn").click(function()
	{
		if($(".filter").css("display") === "none")
		{
			$(".filter").slideDown(200);
			$(".product").css("width","80%");
			$(".fa-angle-right").css("transform","rotate(90deg)");
			$(".filter-text").html("Hide Filter");
		}
		else
		{
			$(".filter").slideUp(200);
			$(".product").css("width","100%");
			$(".fa-angle-right").css("transform","rotate(0deg)");
			$(".filter-text").html("Show Filter");
		}
	});

	$(".clear input").click(function()
	{
		location.reload();
	});

	$(".asc-btn").click(function()
	{
		//reset the loading height
		scrollheight = $(window).height() * 2;

		sort = 1;cdf = 1;flimit = 9;
		$(".product").load("filter.php", {
			type:type, size:size, price_min:price_min, price_max:price_max, c1:checkt, c2:checks, sort:sort, c3:checkb, flimit:flimit
		});
	});
	
	$(".desc-btn").click(function()
	{
		//reset the loading height
		scrollheight = $(window).height() * 2;

		sort = 2;cdf = 1;flimit = 9;
		$(".product").load("filter.php", {
			type:type, size:size, price_min:price_min, price_max:price_max, c1:checkt, c2:checks, sort:sort, c3:checkb, flimit:flimit
		});
	});
	
	$(".sort").click(function()
	{
		if($(".content .content-bar div ul li ul").css("display") === "none")
			$(".content .content-bar div ul li ul").slideDown();
		else
			$(".content .content-bar div ul li ul").slideUp();
	});
	
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
	
	//loading new content
	let timeout, scrollheight = $(window).height() * 2, k = 0;
	$(window).scroll(function()
	{
		if($(window).scrollTop() > scrollheight)
		{
			scrollheight += $(".item").height()*3;
			clearTimeout(timeout);
			timeout = setTimeout(function()
			{
				$(".loading").fadeIn().delay(2000).fadeOut();

				setTimeout(function()
				{
					if(cdf == 0)
					{
						limit = limit + 9;
						$(".product").delay(20000).load("item.php",{
							c3:checkb, limit:limit, checksearch:checksearch
						});
					}
					else
					{
						flimit = flimit + 9;
						$(".product").load("filter.php",{
							type:type, size:size, price_min:price_min, price_max:price_max, c1:checkt, c2:checks, sort:sort, c3:checkb, flimit:flimit
						});
					}
				},2000);
			}, 300);
			
		}
	});
});
</script>
</html>