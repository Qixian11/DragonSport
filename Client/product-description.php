<?php 
include("dataconnection.php"); 
session_start(); 
$_SESSION["active"] = 0;
if(isset($_GET["login"]))
	$_SESSION["loginactive"] = $_GET["id"];
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

nav{display:flex;
	justify-content:space-around;
	align-items:center;
	height:7vh;
	font-family: 'Poppins', sans-serif;
	width:100%;
	background:black;
	position:sticky;
	top:0;
	z-index:1000;
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
	background-color:white;
	padding:1vh 0 1vh;
	border-top:2px solid black;
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
	color:black;
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
	color:black;
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

.background
{
	padding-top:13vh;
	background:black;
	display:grid;
	position:relative;
}

.background .content
{
	width:100vw;
	height:65vh;
	display:flex;
}

.background .product-intro
{
	width:40%;
	height:100%;
	margin-left:5vw;
	color:#fff;
	font-family:montserrat, sans-serif;
	padding-left:5vw;
	padding-top:12vh;
}

.background .product-intro p
{
	color:#929292;
	font-size:1.3vw;
	margin-bottom:3vh;
}

.background .product-intro h2
{
	font-size:3.5vw;
	word-spacing:-2px;
	margin-bottom:2vh;
}

.background .product-intro div{display:flex;}

.background .product-intro select
{
	border:2px solid #828282;
	box-sizing:border-box;
	background-color:transparent;
	color:white;
	outline:none;
	width:5vw;
	height:6vh;
	margin-right:2vw;
	cursor:pointer;
	font-size:1vw;
}

.background .product-intro .price
{
	width:5vw;
	height:6vh;
	border:2px solid #dc721f;
	box-sizing:border-box;
	background-color:transparent;
	color:#dc721f;
	outline:none;
	display:flex;
	align-items:center;
	justify-content:center;
	font-weight:bold;
	font-size:1vw;
}

.background .product-intro option
{
	color:#000000;
	text-align:center;
}

.background .product-image
{
	width:40%;
	height:100%;
	margin-left:10vw;
	display:flex;
	justify-content:center;
	align-items:center;
	border-radius:10%;
}

.background .product-image:hover > img
{
	transform:rotate(30deg);
}

.background .product-image img
{
	width:40vw;
	transition:all 0.5s ease-in-out;
}

.background .add
{
	height:7vh;
	margin-top:8vh;
	display:flex;
	justify-content:flex-end;
	position:relative;
	bottom:0;
}

.background .add input
{
	width:12vw;
	height:6.5vh;
	margin-right:2vw;
	background:none;
	border:1px solid #dc721f;
	color:#dc721f;
	font-size:1vw;
	font-weight:bold;
	outline:none;
}

.background .add input:nth-child(2){margin-right:0;}

.background .add input:hover
{
	background-color:#dc721f;
	transition:all ease 0.5s;
	color:white;
	cursor:pointer;
}

.background .previous-btn
{
	position:absolute;
	background:none;
	width:4vw;
	height:7vh;
	left:0;
	bottom:0;
	color:#dc721f;
	border:1px solid #dc721f;
	text-align:center;
	border-left:none;
	z-index:1;
	transition:all 0.5s ease-in-out;
}

.background .previous-btn i
{
	position:relative;
	top:1.5vh;
	font-size:2vw;
}

.background .previous-btn:hover
{
	background-color:#dc721f;
	color:white;
	width:7vw;
}

.background .addcart_notification
{
	font-family: 'Poppins', sans-serif;
	height:15vh;
	width:20vw;
	background:#DAF4F0;
	color:#543c20;
	position:fixed;
	right:-20vw;
	top:7vh;
	display:grid;
	grid-template-rows:30% 70%;
	grid-template-columns:50% 25% 25%;
	transition:0.75s;
}

.background .addcart_notification div
{
	display:flex;
	align-items:center;
	justify-content:center;
	height:100%;
	font-size:0.9vw;
}

.background .addcart_notification .notification-title
{
	grid-column:1/4;
	border-bottom:1px solid black;
}

.background .addcart_notification img
{
	width:85%;
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
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
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
							<span class = "wishcount" style = "display:none;"></span></a>
				<?php
						}
					}
					else
					{
				?>
						<span class = "wishcount" style = "display:none;"></span></a>
				<?php
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
					else
					{
				?>
							<span class = "cartcount" style = "display:none;"></span></a>
				<?php
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

if(isset($_GET["buy"]))
{
	$id = $_GET["id"];
	$result = mysqli_query($connect, "SELECT * FROM product WHERE Shoes_ID = $id");
	$sizer = mysqli_query($connect, "SELECT * FROM product_size INNER JOIN product_entry ON product_entry.size_id = product_size.Size_ID WHERE product_id = $id AND qty != 0");
	$row = mysqli_fetch_assoc($result);
}

?>
<div class = "background">

	<a href = "javascript:history.go(-1)" class = "previous-btn"><i class="fas fa-chevron-left"></i></a>
	<div class = "addcart_notification">
		<div class = "notification-title">You're adding this item to your cart</div>
		<div class = "notification-image"><?php echo '<img src = "data:image;base64,'.base64_encode($row['Shoes_IMG']).'" class = "product-img" >'; ?></div>
		<div class = "notification-size">&nbsp;</div>
		<div class = "notification-qty">&nbsp;</div>
	</div>
	<div class = "content">
		<div class = "product-intro">
			<h2><?php echo $row["Shoes_Name"];?></h2>
			<p><?php echo $row["Shoes_Description"];?></p>
			<div>
			<select class = "size">
				<option disabled selected value>SIZE</option>
				<?php
				while($size = mysqli_fetch_assoc($sizer))
				{
				?>
				<option value = "<?php echo $size['Size_ID']?>"><?php echo $size["Size"]?> US</option>
				<?php
				}
				?>
			</select>
			<select class = "qty">
				<option disabled selected value>QTY</option>
			</select>
			<div class = "price">
				RM <span id = "price" onclick="totalprice"><?php echo $row["Shoes_Price"]?></span>
			</div>
			</div>
		</div>
		<div class = "product-image">
			<?php echo '<img src = "data:image;base64,'.base64_encode($row['Shoes_IMG']).'" class = "product-img" >'; ?>
		</div>
	</div>
	<div class = "add">
		<?php
		if($_SESSION["loginactive"] == 1)
		{
		
			//count the wishlist items
			$countshoes = mysqli_query($connect, "SELECT * FROM wishlist WHERE user_id = $user_id AND shoes_id = $id");

			//count the shopping cart item
			$countnum = mysqli_query($connect, "SELECT * FROM shoppingcart WHERE cart_user = $user_id AND cart_product = $id");

			//To validate wishlist
			if(mysqli_num_rows($countshoes) == 0)
			{
			?>
				<input type = "button" name = "wish" value = "Add To Wishlist" class = "wishlist-btn"/>
				<script>let checkbtn = 1;</script>
			<?php
			}
			else if(mysqli_num_rows($countshoes) > 0)
			{
			?>
				<input type = "button" name = "wish" value = "Remove From Wishlist" class = "wishlist-btn"/>
				<script>let checkbtn = 0;</script>
			<?php
			}
		?>
			<input type = "button" name = "cart" value = "Add to Cart" class = "addcart-btn"/>
		<?php
		}
		else
		{
		?>
			<input type = "button" name = "wish" value = "Add To Wishlist" class = "wishlist-btn"/>
			<input type = "button" name = "cart" value = "Add to Cart" class = "addcart-btn"/>
		<?php
		}
		
		?>
		
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

	//shake the size box if size box is empty
	$(".qty").click(function()
	{
		if($(".size").val() == null)
			$(".size").effect("shake");
	});

	//to set the available size of shoes in qty box
	$(".size").change(function()
	{
		let shoes = <?php echo $id;?>;
		let size = $(".size").val();

		//change back the error border
		$(".size").css("border", "2px solid #828282");

		$(".qty").load("cart-item/available_shoes.php",{
			id:shoes, s:size
		});
	});
	
	//price calculation when the qty changed
	$(".qty").change(function()
	{
		let price = <?php echo $row["Shoes_Price"];?>;
		let qty = $(".qty").val();
		let total = price * qty;

		$(".qty").css("border", "2px solid #828282");
		$("#price").html(total);
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
	
	$(".wishlist-btn").click(function()
	{
		<?php 
		if($_SESSION["loginactive"] == 0)
		{
		?>
			alert("Please log in your accout before you add");
		<?php
		}
		else
		{
		?>
			shoes = <?php echo $id;?>;
			$(".wishcount").load("wishlist(add).php", {
				sid:shoes
			});
			if(checkbtn == 0)
			{
				$(".wishlist-btn").val("Add To Wishlist");
				checkbtn = 1;
			}
			else if(checkbtn == 1)
			{
				$(".wishlist-btn").val("Remove From Wishlist");
				checkbtn = 0;
			}
		<?php	
		}
		?>
	});
	


	$(".addcart-btn").click(function()
	{
		<?php 
		if($_SESSION["loginactive"] == 0)
		{
		?>
			alert("Please log in your accout before you add");
		<?php
		}
		else
		{
		?>
			let cart_choice = 1;
			let shoes = <?php echo $id;?>;
			let quantity=$(".qty").val();
			let size = $(".size").val();
			let size_name = $(".size option:selected").text();
			let price= parseInt($("#price").text());
			let check_quantity = 0, check_size = 0;

			if(quantity == null)
			{
				$(".qty").css("border", "2px solid red");
				$(".qty").effect("shake");
			}
			else
				check_quantity = 1;
			
			if(size == null)
			{
				$(".size").css("border", "2px solid red");
				$(".size").effect("shake");
			}
			else
				check_size = 1;

			if(check_quantity == 1&& check_size == 1)
			{
				//add function with ajax
				$(".cartcount").load("cart-item/cart(add).php", {
				sid:shoes, c:cart_choice, size:size, price:price, qty:quantity, sizename:size_name
				});
			}
		<?php	
		}
		?>
	});
	
	
});
</script>
</html>