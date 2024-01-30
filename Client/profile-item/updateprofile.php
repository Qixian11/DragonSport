<span id = "save"style = "dispaly:none;">Saved</span>
<?php
include("../dataconnection.php");
session_start();
$userid = $_SESSION["userid"];
$name = $_POST["n"];
 $phone = $_POST["p"];
$address = $_POST["a"];
 $state = $_POST["s"];
 $city = $_POST["c"];
 $poscode = $_POST["pc"];

 mysqli_query($connect, "UPDATE user SET user_fullname = '$name', phone_num = '$phone', address = '$address', state = '$state', city = '$city', postal_code = '$poscode' WHERE user_id = '$userid'");

?>

<script>
$(document).ready(function(){
    $("#save").fadeIn().delay(3000).fadeOut();
});
</script>