<?php
include("dataconnection.php");
session_start();
$checkb = $_POST["c3"];
$limit = $_POST["limit"];
$checksearch = $_POST["checksearch"];

if($checksearch == 1)
{
	$content = $_SESSION["content"];
	$query = "SELECT * FROM product where Shoes_Name LIKE '%$content%'";
	if(mysqli_num_rows(mysqli_query($connect, $query)) < 1)
	{
		echo "<p class = 'no-result'>Sorry. No Result Found</p>";
		exit();
	}
}
else
{
	if($checkb == 0)
		$query = "SELECT * FROM product";
	else if($checkb == 1)
		$query = "SELECT * FROM product WHERE brands = 1";
	else if($checkb == 2)
		$query = "SELECT * FROM product WHERE brands = 2";
}
$query .= " LIMIT $limit";
$result = mysqli_query($connect, $query);
if($limit > mysqli_num_rows($result))
{
?>
	<script>$(".viewmore").css("display","none")</script>
<?php
}
//wishlist color
if($_SESSION["loginactive"] == 1)	
{
	$name = $_SESSION['username'];
	$wish = mysqli_query($connect, "SELECT * FROM wishlist INNER JOIN user ON user.user_id = wishlist.user_id where user_name = '$name'");
	$x = 0;
	while($rwish = mysqli_fetch_assoc($wish))
	{
		$shoes_id[$x] = $rwish["shoes_id"];
		$x++;
	}
}
while($row = mysqli_fetch_assoc($result))
{
?>
	<div class = "item">
		<div class = "item-pic">
			<?php echo '<img src = "data:image;base64,'.base64_encode($row['Shoes_IMG']).'" class = "product-img" >'; ?>
			<div class = logo-and-wish>
<?php
				if($row['brands'] == "1")
				{
?>
				<span class = "logo"><img src = "product-item/Adidas.png"></span>
<?php
				}
				else
				{
?>
				<span class = "logo"><img src = "product-item/nike.png"></span>
<?php
				}
?>
<?php
				if($_SESSION["loginactive"] == 1 && !empty($shoes_id))
				{
					$check = 0;
					for($i = 0; $i < count($shoes_id); $i++)
					{
						if($shoes_id[$i] == $row["Shoes_ID"])
						{
						?>
							<button value = "<?php echo $row["Shoes_ID"]?>" class = "wishlist-btn"><i class="fas fa-heart" style = "color:red;"></i></button>
						<?php
							$check = 1;
						}
					}
					if($check == 0)
					{
					?>
						<button value = "<?php echo $row["Shoes_ID"]?>" class = "wishlist-btn"><i class="fas fa-heart" style = "color:black;"></i></button>
					<?php
					}
				}
				else
				{
				?>
					<button value = "<?php echo $row["Shoes_ID"]?>" class = "wishlist-btn"><i class="fas fa-heart" style = "color:black;"></i></button>
				<?php
				}
?>
			</div>
		</div>
		<div class = "item-name">
			<?php echo $row["Shoes_Name"]?>
		</div>
		<div class = "add-btnn">
			<span>RM <?php echo $row["Shoes_Price"]?></span>
			<a href = "product-description.php?buy&id= <?php echo $row['Shoes_ID']?>">VIEW</a>
		</div>
	</div>
<?php
}
?>
<script>
//add wishlist
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
			shoes = $(this).val();
			$(".wishcount").load("wishlist(add).php", {
				sid:shoes
			});
			let color = $(".fa-heart", this).css("color");
			if(color == "rgb(0, 0, 0)")
				$(".fa-heart", this).css("color", "red");
			else if(color = "rgb(255, 0, 0)")
				$(".fa-heart", this).css("color", "black");
		<?php
		}
		?>
	});
</script>