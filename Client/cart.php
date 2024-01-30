<?php 
include("dataconnection.php"); 
session_start(); 
if(empty($_SESSION["loginactive"]))
    echo "<script>window.location.href = 'login.php';</script>";

$_SESSION["active"] = 0;
if(empty($_SESSION["loginactive"]))
	$_SESSION["loginactive"] = 0;
$_SESSION["previous_page"] = $_SERVER["PHP_SELF"];
?>
<!DOCTYPE html>
<html>

<style>
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

.wishlist-side
{
	margin-top:3%;
	margin-left:3%;
	margin-right:3%;
	font-family: 'Poppins', sans-serif;
	font-size:2vw;
	text-align:center;
	font-weight:500;
}

.wishlist-side .wish-container
{
	display:flex;
	flex-wrap:wrap;
	justify-content:flex-start;
}

.wishlist-side .wish-container .wish-grid
{
	display:grid;
	width:30vw;
	height:60vh;
	grid-template-rows: 50vh 4vh 6vh;
	margin-left:0.75vw;
	margin-bottom:1.5vh;
}

.wishlist-side .wish-container .wish-grid .product-img
{
	background-color:#efefef;
	justify-content:center;
	align-items:center;
	display:flex;
	position:relative;
}

.wishlist-side .wish-container .wish-grid .product-img img
{
	width:25vw;
}

.wishlist-side .wish-container .wish-grid .product-img .remove-btn
{
	position:absolute;
	right:1vw;
	top:1.5vh;
	border:none;
	outline:none;
	font-size:1.2vw;
	cursor:pointer;
	opacity:0.50;
}

.wishlist-side .wish-container .wish-grid .product-img .remove-btn:hover
{
	opacity:1;
}

.wishlist-side .wish-container .wish-grid .name
{
	font-size:1vw;
	padding-top:1vh;
}

.wishlist-side .wish-container .wish-grid .name #name{float:left;}

.wishlist-side .wish-container .wish-grid .name #price{float:right}

.wishlist-side .wish-container .wish-grid .view-btn
{
}

.wishlist-side .wish-container .wish-grid .view-btn a
{
	float:left;
	text-decoration:none;
	border:1px solid black;
	color:black;
	border-radius:15%;
	font-size:1vw;
	padding:0.5vh;
	margin-top:0.8vh;
}

.wishlist-side .wish-container .wish-grid .view-btn a:hover
{
	opacity:0.5;
	cursor:pointer;
}

.count0
{
	font-size:1.3vw;
	font-weight:lighter;
	margin-top:3vh;
	color:#808080;
}

.recommend
{
	height:60vh;
	margin-left:3%;
	margin-right:3%;
	margin-top:12vh;
}

.recommend p
{
	text-align:center;
	font-size:1.5vw;
	padding:3vh;
	font-size:100;
	font-family: 'Poppins', sans-serif;
}

.recommend .recommend-item
{
	display:flex;
	justify-content:space-between;
	height:49.5vh;
}

.recommend .recommend-item img
{
	width:20vw;
}

.navbottom
{
	background-color:black;
	margin-top:2vh;
	padding:6vh 0 0.5vh;
}

.navbottom .content
{
	width:70%;
	margin:auto;
	display:flex;
	justify-content:space-around
}

.navbottom .content .shoes,.service,.term
{
	width:20%;
	height:100%;
}

.navbottom .content p
{
	font-family: mine;
	letter-spacing:0.1vh;
	font-size:0.9vw;
	color: #CFD3D6;
	text-transform:uppercase;
	font-weight:lighter;
}

.navbottom .content ul{margin-top:1.2vh;}

.navbottom .content li
{
	padding:0.7vh 0 0.7vh;
	list-style:none;
}

.navbottom .content a:hover{color:gold;}

.navbottom .content a
{
	text-decoration:none;
	color:white;
	transition: all 0.2s ease-in;
	font-size:0.85vw;
}

.navbottom .social
{
	width:18%;
	height:4vh;
	display:flex;
	margin:3vh auto 0;
	align-items:center;
}

.navbottom .social p
{
	font-family: mine;
	letter-spacing:0.1vh;
	font-size:0.8vw;
	color: #CFD3D6;
	text-transform:uppercase;
	font-weight:lighter;
}

.navbottom .social .fab
{
	color:white;
	font-size:3vh;
	margin-left:2vw;
	transition:all 0.2s ease-in-out;
}

.navbottom .social .fab:hover
{
	font-size:3.5vh;
	cursor:pointer;
	color: lightblue;
}

hr{border-color:grey;}

</style>
<head>
	<title>Dragon Sport</title>
	<link rel="stylesheet" type="text/css" href="cart-item/cart.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@700&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Oswald:wght@600&display=swap" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script src="https://kit.fontawesome.com/9dcddfad62.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset = "utf-8"></script>

</head>
<body>
<nav>
		<div class = "logo">
		<a href="mainpage.php">	<img src = "mainpage-item/logo.png"></a>
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
    <div class="basket">
		<div class = "baskettitle">
			<div><i class="fas fa-shopping-cart"></i></div>
			<div class="cart">SHOPPING CART</div>
		</div>	
	
		<div class="basket_item">
			<table class = "display-item">
				<tr >
					<th>IMG</th>
					<th>ITEM NAME</th>
					<th>SIZE</th>
					<th>COLOUR</th>
					<th>QUANTITY</th>
					<th>PRICE</th>
					<th>TOTAL</th>
					<th></th>

				</tr>
				<?php
			//	$_SESSION["admin_id"]=$row["admin_id"];
				$user_id = $_SESSION["userid"];
				$cart=mysqli_query($connect,"SELECT * FROM shoppingcart, product, product_entry, product_size WHERE cart_product = ID and cart_user = $user_id and product_id = Shoes_ID and product_entry.size_id = product_size.Size_ID");
				
					
				?>
				<?php
				while($row=mysqli_fetch_assoc($cart))
				{
				?>
				<tr class="content">
					
					<td><?php echo '<img src = "data:image;base64,'.base64_encode($row['Shoes_IMG']).'" class = "img" >'?></td>
					<td><?php echo $row["Shoes_Name"]?></td>
					<td><?php echo $row["Size"]?></td>
					<td><?php echo $row["Shoes_Color"]?></td>
					<td><input type="hidden" value = "<?php echo $row["cart_product"]?>"><input type="number" onKeyDown="return false" value=<?php echo $row["quantity"]?> min="1" max="<?php echo $row["qty"]?>" class = "quantity"></td>
					<td class = "price"><?php echo $row["Shoes_Price"]?></td>
					<td class = "total" ><?php echo $row["total_price"]?></td>
					<td><input type="hidden" value = "<?php echo $row["cart_id"]?>"><button class = "delbtn"><i class="fas fa-times"></i></button></td>
				
				</tr>
				<?php	
				}
				?>		
			</table>	
		</div>
		<div class="right"> 
			<div class="cal">
				<div class="sumhe">
					<h3>Summary</h3>
				</div>
				<div class="content">
					<div class="sumcen">
						<p>Subtotal:</p>
						<p>Services Tax(6%):</p>
						<p>Delivery Fee:</p>
					</div>
					<div class="sumcennum">		
						<div >RM <span class = "subtotal">&nbsp;</span></div>
						<div >RM <span class = "gst">&nbsp;</span></div>
						<div >RM <span class = "shipping">5</span></div>
					</div>
				</div>

				<div class="sumtot">
					<div >Total</div>
					<div style="color:red">RM</div>
					<div class = "total_g_s" style="color:red" >0</div>
				</div>
				
				<div class="chkoutbtn">
					<button id="myBtn" onclick="modal()"><span>CHECK OUT</span></button>
				</div>
			</div>
		</div>
	</div>

		<div  class="modal" id="myModal">
			<div class="modal-content">
				<div class="close">&times;</div>
				<div class="pay-title" >
					<div>CONFIRM PURCHASE</div>
				</div>
				<div class="payment" >
					<form method = "post" >
						<div class="box"  >
							<div class="p1">
							<div  class="name">CARD HOLDER :</div>
							<input type="text" required  pattern="[a-zA-Z]{1,}"  placeholder="EXP: Diamond Zhang Bi Chen" >
						</div>
						</div>
						
							<div class="box" >
								<div class="p2">
									<div >
										<div class="name">CARD NUMBER :</div>
										<input type="text"  class="creditCardText" required  placeholder="0000-0000-0000-0000" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{4}" maxlength="19">
									</div>
									<div>
										<div  class="name">CVV :</div>
										<input type="text" placeholder="000" pattern="[0-9]{3}" maxlength="3" required >
									</div>
								</div>
							</div>
						
							<div class="box">
								<div  class="name">EXPIRED  DATE :</div>
								<div class="p3">
									<select type="select"  >
										<option>JAN</option>
										<option>FEB</option>
										<option>MAR</option>
										<option>APR</option>
										<option>MAY</option>
										<option>JUN</option>
										<option>JULY</option>
										<option>AUG</option>
										<option>SEP</option>
										<option>OCT</option>
										<option>NOV</option>
										<option>DEC</option>
									</select>	

									<select type="select"  >
										<option>2021</option>
										<option>2022</option>
										<option>2023</option>
										<option>2024</option>
									</select>						
							
									<div class="image" ><img src="cart-item/visa.png"></div>
								</div>
							
								
							</div>
						<div class="box">	
							<div class="button" >
								<input type="submit" name = "hi"   value = "PAY NOW" >	
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
</body>		
<?php
if(isset($_POST["hi"]))
{
	date_default_timezone_set("Asia/Kuala_Lumpur");
	$grand_total = 0;$total = 0;
	$countTotal_result = mysqli_query($connect, "SELECT * FROM shoppingcart WHERE cart_user = $user_id");
	
	//caculation for inserting grand total orders table
	while($total_rows = mysqli_fetch_assoc($countTotal_result))
	{
		$total += $total_rows["total_price"];
	}
	$grand_total = $total + ($total*0.06) + 5;

	//insert into orders
	$order_id = date("ynd").rand(1000,9999);
	$purchase_date = date("Y/m/d");
	$purchase_time = date("H:i:s");
	$sql=mysqli_query($connect, "INSERT INTO orders (orders_id, purchase_date, purchase_time, user_id, grand_total) VALUES ('$order_id', '$purchase_date', '$purchase_time', '$user_id', '$grand_total')");
	
	// send pdf  invoice 
	$order_details = mysqli_query($connect,"SELECT * FROM orders where user_id = '$user_id '");
	
	// send pdf invoice
	if($sql)
	{
		//insert into orders_details
		$insert_result = mysqli_query($connect, "SELECT * FROM shoppingcart WHERE cart_user = $user_id");
		while($total_rows = mysqli_fetch_assoc($insert_result))
		{
			$pe_id = $total_rows["cart_product"];
			$qty = $total_rows["quantity"];
			$totall = $total_rows["total_price"];
			
			mysqli_query($connect, "INSERT INTO orders_detail (order_id, order_product, qty, total) VALUES ('$order_id', '$pe_id', '$qty', '$totall')");
			mysqli_query($connect, "DELETE FROM shoppingcart WHERE cart_user = $user_id AND cart_product = $pe_id");
			$minus_stock = mysqli_fetch_assoc(mysqli_query($connect, "SELECT qty FROM product_entry WHERE ID = $pe_id"));
			$new_qty = $minus_stock["qty"] - $qty;
			mysqli_query($connect, "UPDATE product_entry SET qty = $new_qty WHERE ID = $pe_id");
		}
		echo "<script> location.replace('emailinvoice.php?odid=$order_id')</script>";
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

    $('.creditCardText').keyup(function() {
	var foo = $(this).val().split("-").join(""); // remove hyphens
	if (foo.length > 0 ) {
		foo = foo.match(new RegExp('.{1,4}', 'g')).join("-");
	}
	$(this).val(foo);
	});

    //to calculat once page is loaded
        starting_calulate();

        $(".quantity").change(function()
        {
            let pe_id = $(this).siblings("input[type = 'hidden']").val();
            let choice = 2;
            let qty = $(this).val();
            let total = getTotal(qty, this);
            $(this).parent().siblings(".total").html(total);
            
            starting_calulate();

            $(".cartcount").load("cart-item/cart(add).php",
            {
                c:choice, qty:qty, total:total, pe_id:pe_id
            });
        });

        //calculation 
        function starting_calulate()
        {
            let subtotal = getSubTotal();
            $(".subtotal").html(subtotal);

            //set shipping price
            if(subtotal == 0)
                $(".shipping").html("0");
            else
                $(".shipping").html("5");

            let gst = getServiceTax(subtotal);
            $(".gst").html(gst.toFixed(2));
            
            let total_g_s = getTotal_g_s(subtotal, gst);
            $(".total_g_s").html(total_g_s);
        }

        function getTotal(q, t)
        {
            let total = 0;
            let price = parseInt($(t).parent().siblings(".price").text());
            total = price * q;

            return total;
        }

        function getSubTotal()
        {
            let subtotal = 0;

            $(".total").each(function(){
                subtotal += parseInt($(this).text());
            });

            return subtotal;
        }

        function getServiceTax(stotal)
        {
            let gst = stotal * 0.06;

            return gst;
        }

        function getTotal_g_s(stotal, gst)
        {
            let shipping = parseInt($(".shipping").text());
            let total_g_s = stotal + shipping + gst;

            return total_g_s;
        }

        //ajax
	$(".delbtn").click(function()
	{
		let choice = 0;
		let cartid = $(this).siblings("input[type = 'hidden']").val();

		$(this).parent().siblings(".total").html("0");
		$(this).parent().parent().fadeOut();
		$(".cartcount").load("cart-item/cart(add).php",
		{
			c:choice, cartid:cartid
		});
		starting_calulate();
	});

 	//payment modal

    var modal = document.getElementById("myModal");
	var btn = document.getElementById("myBtn");
	var span = document.getElementsByClassName("close")[0];
	
		btn.onclick = function()
		{
			var total=parseInt(document.getElementsByClassName("subtotal").innerHTM=getSubTotal());
			if(total==0)
			{
				alert("Please add the item before make payment!")
			}
			else
			{	
				modal.style.display = "block";
					
			}
		}
	
		span.onclick = function() 
		{
			modal.style.display = "none";
		}

		window.onclick = function(event) 
		{
		  if (event.target == modal)
		 {
			modal.style.display = "none";
			}
		}
});
</script>
</html>