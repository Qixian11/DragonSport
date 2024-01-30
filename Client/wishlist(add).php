<?php 
include("dataconnection.php"); 
session_start(); 
$_SESSION["active"] = 0;
$shoes = $_POST["sid"];
$name = $_SESSION["username"];
$user = mysqli_query($connect, "SELECT * FROM user WHERE user_name = '$name'");
$ruser = mysqli_fetch_assoc($user);
$user_id = $ruser["user_id"];
$checkwish = mysqli_query($connect, "SELECT * FROM wishlist WHERE shoes_id = $shoes AND user_id = $user_id");
if(mysqli_num_rows($checkwish) > 0)
{
	mysqli_query($connect, "DELETE FROM wishlist WHERE shoes_id = $shoes AND user_id = $user_id");
}
else
	mysqli_query($connect, "INSERT INTO wishlist (shoes_id, user_id) VALUES ('$shoes', '$user_id')");
$countwish = mysqli_query($connect, "SELECT * FROM wishlist WHERE user_id = $user_id");

if(mysqli_num_rows($countwish) > 0)
{
	echo mysqli_num_rows($countwish);
?>
	<script>$(".wishcount").css("display", "initial");</script>
<?php
}
else
{
?>
	<script>$(".wishcount").css("display", "none");</script>
	<script>$(".count0").css("display", "initial");</script>
<?php
}
?>
