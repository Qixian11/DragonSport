<?php 
session_start();
include("../Client/dataconnection.php"); 

?>

<html>
<head>
<style>
body{
background-image: linear-gradient(to top,#537895  0%, #09203f 100%);
font-family: relaway;
color:white;
margin 0;
}

.popup .content{
    position: absolute;
    top:50%;
    left:50%;
    transform: translate(-50%,-150%) scale(0);
    width:380px;
    height:450px;
    z-index: 2;
    text-align:center;
    border-radius:20px;
    background: #10181d;
    box-shadow: 5px 5px 20px #cad7e2;
    z-index: 1;
}

.popup .close-btn{

    position:absolute;
    right:20px;
    top:20px;
    width:25px;
    height:25px;
    box-shadow: 5px 5px 15px #1e1e1e,-5px -5px 15px #1e1e1e;
    cursor:pointer;
}

.popup.active .content{
    transition: all 300ms ease-in-out;
    transform: translate(-50%,-50%) scale(1);
}
h1{
    text-align:center;
    font-size:32px;
    font-weight:600;
    padding:20px;
    padding-top:20px;
    padding-bottom:10px;
}

.input-field .validate{
    padding:20px;
    font-size:16px;
    border-radius: 10px;
    border:none;
    margin-bottom:15px;
    color:#bfc0c0;
    background:#262626;
    box-shadow: inset 5px 5px 5px #232323 , inset -5px -5px 5px #292929;
    outline:none;

}
.first-button{
    color:white;
    font-size:18px;
    font-weight:500px;
    padding:30px 50px;
    border-radius: 40px;
    border:none;
    position:absolute;
    top:50%;
    left:50%;
    transform: translate(-50%,-50%);
    background:#262626;
    box-shadow:1px 1px 15px white;
    cursor:pointer;
    outline:none;
}

.first-button:active{
    background: linear-gradient(#222222,#292929);
    box-shadow:1px 1px 10px white;
    border:none;
}

.second-button{
    color:white;
    font-size:18px;
    font-weight:500;
    margin-top:20px;
    padding:20px 30px;
    border-radius:40px;
    border:none;
    background:#262626;
    box-shadow: 1px 1px 10px white;
    cursor:pointer;
    outline:none;
}

.popup a
{
    position:relative;
	width:100%;
	color:white;
	font-size:2vh;
	text-decoration:underline;
	margin-left:16vw;
	top:8vh;
	opacity:0.75;
}

.fa-eye{
	position:absolute;
	color:white;
	cursor:pointer;
	top:24vh;
	font-size:1.2vw;
	right:6vw;	
	transition:0.25s;

}



</style>
<script src="https://kit.fontawesome.com/9dcddfad62.js" crossorigin="anonymous"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset = "utf-8"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<form action="#" method="POST">
<div class="popup" id="popup-0">
    <div class="content">
	
     <div class="close-btn" onclick="togglePopup()"><i class="fa fa-window-close" aria-hidden="true" style="color:white;font-size:25px;"></i></div>

        <h1>Sign In  </h1>

     <div class="input-field">
        <input type= "Email"   class="validate" name="email" placeholder="Email">
    </div>
        <div class ="input-field">
        <input type= "password"   class="validate" name="pass" placeholder="Password"  ><i class="far fa-eye"></i>
        </div>

        <button input type="submit" class="second-button"  name="submitbtn" value="Login">
            Log In
        </button>
      <div><a href = "adminmail.php">Forgot password</a>  </div>  

    </div>
</div>
</form>
<button onclick="togglePopup()" class="first-button">Sign In</button>

<script>
function togglePopup(){
    document.getElementById("popup-0")
    .classList.toggle("active")
}
$(document).ready(function()
{	
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

</body>

<?php
if(isset($_GET["logout"]))
{
    $_SESSION["admin_id"] = $_GET["log"];
}

    $error="";
    if(isset($_POST["submitbtn"]))
    {
        if(empty($_POST["email"])||empty($_POST["pass"]))
        {
        ?>
         <script>
				alert("Email or Password is empty")
		</script>
        <?php
        }
    else 
    {
        $email=$_POST["email"];
        $pass=$_POST["pass"];
        $email=mysqli_real_escape_string($connect,$email);
        $pass=mysqli_real_escape_string($connect,$pass);
        $mdpass=md5($pass);
        $result = mysqli_query($connect, "SELECT * FROM admin1 where admin_email ='$email' ");
      
       $count= mysqli_num_rows($result);
       
        if($count==1)
        {
            $row = mysqli_fetch_assoc($result);
            
            $_SESSION["admin_id"]=$row["admin_id"];
               header("location:dashboard.php");
    
        }
    
        else 
        {
          ?>
            <script>
				alert("Email or Password something went wrong!")
			</script>
          <?php

        }
    }

    }


?>

</html>