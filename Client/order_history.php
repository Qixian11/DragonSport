<?php 
include("dataconnection.php"); 
session_start(); 
if(empty($_SESSION["loginactive"]))
    echo "<script>window.location.href = 'login.php';</script>";
$_SESSION["previous_page"] = $_SERVER["PHP_SELF"];

//delete order
if(isset($_GET["delete"]))
{
	$order = $_GET["order_id"];

	//return qty
	$return_qty_result = mysqli_query($connect, "SELECT order_product, qty FROM orders_detail WHERE order_id = $order");

	while($return_qty = mysqli_fetch_assoc($return_qty_result))
	{
		$get_peid = $return_qty["order_product"];
		$get_qty = $return_qty["qty"];
		$get_current = mysqli_fetch_assoc(mysqli_query($connect, "SELECT qty FROM product_entry WHERE ID = $get_peid"));
		$updated_qty = $get_current["qty"] + $return_qty["qty"];

		mysqli_query($connect, "UPDATE product_entry SET qty = $updated_qty WHERE ID = $get_peid");
	}

	mysqli_query($connect, "DELETE FROM orders_detail WHERE order_id = $order");
	mysqli_query($connect, "DELETE FROM orders WHERE orders_id = $order");
}
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

.shop{
	width:100%;
	min-height:80vh;
	background:#DCDCDC;
	margin-bottom:2vh;
	
	
}
.shop-top{
	height:25vh;
	padding-top:3vh;
	text-align:center;
}
.fa-cart-arrow-down {
	font-size:10vh;

	text-align:center;
}
.shop-top h1{
	font-size:6vh;
    font-family: 'ZCOOL QingKe HuangYou', cursive;
}

.shop-item{
	
width:90vw;
height:19vh;
margin:0 auto;
background:#F0F0F0;
border:2px solid  black;
padding:1vw 1.75vw;
margin-bottom:2vh;
border-radius:10px;
box-shadow:0 0 10px 2px grey;

}

.name{

    font-family: 'ZCOOL QingKe HuangYou', cursive;
    padding-left:5vw;
    margin-bottom:3vh;
    font-weight:bold;
    font-size:3vh;
}
.shop-item-top{
    height:5vh;
    font-size:3vh;
    font-weight:bold;
    font-family: 'ZCOOL QingKe HuangYou', cursive;
    letter-spacing:0.2vw;
}
.shop-detail {
    display:flex;
    font-family: 'ZCOOL QingKe HuangYou', cursive;
    font-weight:bold;
    letter-spacing:0.2vw;
	justify-content:space-between;
	align-items:center;
	font-size:20px;
}


.shop-detail1{
    position:relative;
	
}
.shop-detail1 button {
	position:relative;
    border-radius: 4px;
	 height:5vh;
  background:none;
  border: none;
  color: black;
  text-align: center;
  font-size: 25px;
  width: 12vw;
  transition: all 0.5s;
  cursor: pointer;
  left:5vw;
  bottom:0;
  outline:none;
  font-family: 'ZCOOL QingKe HuangYou', cursive;
 letter-spacing:0.1vw;

}
.shop-detail1 span {
  cursor: pointer;
  display: inline-block;
  position: relative;
  transition: 0.5s;
  background:none;
  

}

.shop-detail1 span:after {
  content: '\00bb';
  position: absolute;
  opacity: 0;
  top: 0;
  right: -20px;
  transition: 0.5s;
  background:none;
}

.shop-detail1:hover span {
  padding-right: 25px;
}

.shop-detail1 :hover span:after {
  opacity: 1;
  right: 0;
}
.fa-download{
	color:black;

	cursor:pointer;
  font-size:3vh;
  
}
.halo{
	position:relative;
	width:10vw;
}
.cancel {
	position:relative;
	height:4vh;
	width:5vw;
	font-family: 'ZCOOL QingKe HuangYou', cursive;
	border:2px solid;
	cursor:pointer;
	font-size: 20px;
	margin-left:82vw;
	top:1vh;
	background:white;
	color:black;
}

.cancel:hover{
	background:black;
	color:white;
	opacity: 1;
	
	
	transition: all 0.3s ease-in-out;

}

.modal {
  visibility: hidden;
  opacity: 0;
  position: fixed;
  width: 100vw;
  height: 100vh;
  backdrop-filter: blur(10px);
  top: 0;
  left: 0;
  z-index: 1001;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: 0.3s;
  font-family:'Poppins', sans-serif;
}

.modal .delete-c {
  height: 40vh;
  display: grid;
  justify-content: center;
  grid-template-rows: 40% 35% 25%;
}

.modal .delete-c div {
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal .delete-c .delete-icon {
  font-size: 8vw;
  color: #fff3cd;
}

.modal .delete-c .delete-alert {
  display: block;
  text-align: center;
  padding-top: 3vh;
}

.modal .delete-c .delete-alert p:nth-child(1) {
  font-weight: bold;
  font-size: 1.2vw;
}

.modal .delete-c .delete-confirm {
  justify-content: space-around;
  width: 20vw;
  margin: 0 auto;
}

.modal .delete-c .delete-confirm a, button 
{
  height: 4vh;
  width: 6vw;
  cursor: pointer;
  border: none;
  font-weight: bold;
  transition: 0.3s;
  font-size:0.85vw;
}

.modal .delete-c .delete-confirm a:nth-child(1) {
  background: #cce5ff;
  display:flex;
  align-items:center;
  justify-content:center;
  color:black;
  text-decoration:none;
}

.modal .delete-c .delete-confirm a:nth-child(1):hover {
  background: #2890ff;
}

.modal .delete-c .delete-confirm button:nth-child(2) {
  background: #f8d7da;
}

.modal .delete-c .delete-confirm button:nth-child(2):hover {
  background: #df4b57;
}

.modal .modal-container {
  width: 35vw;
  background: white;
}
</style>
<head>
	<title>Dragon Sport</title>
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/9dcddfad62.js"></script>
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@700&display=swap" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset = "utf-8"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=ZCOOL+QingKe+HuangYou&display=swap" rel="stylesheet">
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
	
	<!-- order history -->
	<div class="shop">	 
		<div class="shop-top"> 
		    <i class="fa fa-cart-arrow-down" aria-hidden="true"></i> 
			<h1> ORDER HISTORY !</h1>
		</div>
        <div class="name"> MY ORDERS </div>
            <?php 
            $user_id = $_SESSION["userid"];
            $result=mysqli_query($connect,"SELECT * FROM orders ,user WHERE orders.user_id=user.user_id  AND user.user_id=$user_id ORDER BY purchase_date DESC") ;
			while($row=mysqli_fetch_assoc($result))
			{
             ?>
				<div class="shop-item">
					<div class="shop-item-top"> <?php echo $row["purchase_date"]  ?>	</div>
					<div class="shop-detail"> <span> ORDER ID :<?php echo $row["orders_id"]  ?>  </span>   <span>RM <?php echo $row["grand_total"]  ?>   </span>  <a class="shop-detail1"  href="order.php?shoes&oid=<?php echo $row['orders_id'] ?> "> <button> <span> view detail </span> </button>  </a>    <a href="emailinvoicedownload.php?odid= <?php echo $row["orders_id"]?>"> <i class="fa fa-download" aria-hidden="true"></i> </a> </div>
					
			 <!-- Cancel function -->
			 <?php
			 		// c = current, p = purchase
					date_default_timezone_set("Asia/Kuala_Lumpur");
					$pdate = new DateTime($row["purchase_date"]." ".$row["purchase_time"]);
					$cdate = new DateTime(date("Y-m-d H:i:s"));
					$gapday = $pdate->diff($cdate);

					if($gapday->days ==0)
					{
						if($gapday->h < 12)
							echo "<div class='halo'> <button class = 'cancel'>cancel</button><input type = 'hidden' value = '".$row["orders_id"]."'></div>";
					}	
			 ?>
				</div>
             <?php   
            }
            ?> 
	</div>

<!-- delete modal -->
<div class="modal" id = "delete">
    <div class = "modal-container delete-c">
        <div class="delete-icon">
            <i class="lni lni-warning"></i>
        </div>
        <div class="delete-alert">
            <p>Are you sure?</p>
            <p>You won't be able to revert this</p>
        </div>
        <div class="delete-confirm">
            <a href = "" id = "delete-btn">Cancel</a>
            <button id = "cancel-btn">Keep</button>
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

	//pop out delete modal
    $(document).on("click", ".cancel", function()
    {
        id = $(this).siblings("input[type = 'hidden']").val();
		
		$("#delete-btn").attr("href", "order_history.php?delete&order_id= "+id);
        $("body").css("overflow", "hidden");
        $("#delete").css({"visibility":"visible", "opacity":"1"});
    });

	//close view modal
    $(document).on("click", "#cancel-btn", function()
    {
        $("body").css("overflow", "visible");
        $("#delete").css({"visibility":"hidden", "opacity":"0"});
    });
});
</script>
</html>