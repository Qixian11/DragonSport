<?php
include("../Client/dataconnection.php");
session_start();
if(empty($_SESSION["admin_id"]))
    echo "<script>window.location.href = 'adminlogin.php';</script>";

//GET ADMIN INFORMATION
$id= $_SESSION["admin_id"];
$admin = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM admin1 where admin_id= $id "));
?>
<!DOCTYPE html>
<html>
<head>
<title>DS Admin Order Report</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">    
<link rel="stylesheet" type="text/css" href="order_report/order_report.css">
<link rel="stylesheet" type="text/css" href="navbar/navbar.css">
<link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset = "utf-8"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script src = "order_report/order_report.js" type="text/javascript"></script>
<script src = "navbar/navbar.js" type="text/javascript"></script>
</head>

<body>
<nav>
    <div class = "logo">
        <p><img src= "navbar/logo.png"><span>Dragon Sport</span></p>
    </div>
    <div class = "navbar-content">
        <div class="navbar-list">
            <ul>
                <?php
                if($admin["role"] == "Super Admin")
                {
                ?>
                    <li><a href= "dashboard.php"><i class="lni lni-dashboard"></i><span>Dashboard</span></a></li>
                    <p>Manage</p>
                    <li id = "user"><a><i class="lni lni-user"></i><span>User</span><i class="lni lni-chevron-left"></i></a></li>
                    <div class = "user-drop-section">
                        <li class = "user-dropdown"><a href = "add_user.php"><i class = "lni"></i><span>Add User</span></a></li>
                        <li class = "user-dropdown"><a href = "edit_user.php"><i class = "lni"></i><span>Edit User</span></a></li>
                    </div>
                    <li id = "staff"><a><img src = "navbar/admin.png" class = "lni"><span>Staff</span><i class="lni lni-chevron-left"></i></a></li>
                    <div class = "staff-drop-section">
                        <li class = "staff-dropdown"><a href = "add_staff.php"><i class = "lni"></i><span>Add Staff</span></a></li>
                        <li class = "staff-dropdown"><a href = "edit_staff.php"><i class = "lni"></i><span>Edit Staff</span></a></li>
                    </div>
                    <li id = "product"><a><img src = "navbar/product.png" class = "lni"><span>Product</span><i class="lni lni-chevron-left"></i></a></li>
                    <div class = "product-drop-section">
                        <li class = "product-dropdown"><a href = "product.php"><i class = "lni"></i><span>Shoes</span></a></li>
                        <li class = "product-dropdown"><a href = "product_entry.php"><i class = "lni"></i><span>Product Entry</span></a></li>
                    </div>
                    <li><a href= "category.php"><img src = "navbar/category.png" class = "lni"><span>Category</span></a></li>
                    <li><a href= "order.php"><img src = "navbar/Untitled-1.png" class = "lni"><span>Order</span></a></li>
                    <li><a href= "sales_report.php"><img src = "navbar/salesreport.png" class = "lni"><span>Sales Report</span></a></li>
                <?php
                }
                else
                {
                ?>
                    <li><a href= "dashboard.php"><i class="lni lni-dashboard"></i><span>Dashboard</span></a></li>
                    <p>Manage</p>
                    <li id = "user"><a><i class="lni lni-user"></i><span>User</span><i class="lni lni-chevron-left"></i></a></li>
                    <div class = "user-drop-section">
                        <li class = "user-dropdown"><a href = "add_user.php"><i class = "lni"></i><span>Add User</span></a></li>
                        <li class = "user-dropdown"><a href = "edit_user.php"><i class = "lni"></i><span>Edit User</span></a></li>
                    </div>
                    <li><a href= "order.php"><img src = "navbar/Untitled-1.png" class = "lni"><span>Order</span></a></li>
                    <li><a href= "sales_report.php"><img src = "navbar/salesreport.png" class = "lni"><span>Sales Report</span></a></li>
                <?php
                }
                ?>
            </ul>
        </div>
    </div>
</nav>
<div class= "body-head">
    <button><i class="lni lni-menu"></i></button>
    <div class = "digital-clock">
        <span id = "hour">00</span>:<span id = "minute">00</span>:<span id = "second">00</span>
    </div>
    <div class="admin-profile">
        <i class="lni lni-user"></i>
        <div>
            <ul>
			<li id="view-profile"><a href = "#">View Profile</a></li>
                <li> <a href ="adminlogin.php"> Log out </a> </li>
            </ul>
        </div>
    </div>
</div>
<div class = "body">
    <div class="body-content">
        <div class="order">
            <div class="top">
            <div class="order-title">
                    <p>ORDER DETAIL</p>
                </div>
                <div class="search">
                    <div class = "search-bar">
                        <span><i class="lni lni-search-alt"></i></span>
                        <input type="search" name = "search" placeholder = "Search">	
                    </div>
                </div>
            </div>
            <div class="content">
                <div class="table">
                    <table >
							<tr id="head">
								<th>ORDER ID</th>
								<th>USER ID</th>
								<th>USER NAME</th>
								<th>PURCHASE DATE</th>
								<th>GRAND TOTAL</th>
								<th>ACTION</th>
							</tr>
							<?php
                            	$count = ceil(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM orders"))/12);
								$result=(mysqli_query($connect,"SELECT * FROM orders INNER JOIN user ON user.user_id=orders.user_id  LIMIT 12"));
                                

							while($row=mysqli_fetch_assoc($result))
							{
							?> 
								<tr id="content">
									<td><?php echo $row["orders_id"]?></td>
									<td><?php echo $row["user_id"]?></td>
									<td><?php echo $row["user_name"]?></td>
									<td><?php echo $row["purchase_date"]?></td>
									<td><?php echo $row["grand_total"]?></td>
									<td> <a href="emailinvoice.php?odid= <?php echo $row["orders_id"]?>" target="_blank"><i class="fa fa-download" aria-hidden="true" style="font-size:15px;color:rgb(231, 28, 69);"></i> </a></td>
								</tr>
							<?php 
							}
							?>
					</table>
                    <div class = "page">
					<?php
						for($i = 0; $i < $count; $i++)
						{
					?>
							<button value = "<?php echo $i+1?>"><?php echo $i+1?></button>
					<?php
						}
					?>
					</div>
                </div>
            </div>
        </div>
    </div>
<div>
<!--pop out admin profile-->

<div class = "profile-content" id="profile-content">
   
    <div class="profile">
    
        <div class="profile-top">
            <h2>Admin Profile </h2>
         <button id="btn123">x</button>  
        </div>
        <div class="profile-body">
            <form method="post">
           <p class=profile-body-1> Full name</p > 
                <p class=profile-body-2><input type="text" name="fullname" value="<?php echo $admin["fullname"]?>"></p>
            

            <p class=profile-body-1>Gender</p >
                <p class=profile-body-2><input type="text" name="gender"value= "<?php echo $admin["gender"]?>"></p>
            
            <p class=profile-body-1>Phone_num</p >
                <p class=profile-body-2><input type="tel"name="phone" value= "<?php echo $admin["phone_num"]?>"></p>
            
           <p class=profile-body-1>Street</p >
             <p class=profile-body-2><input type="text" name="street"value="<?php echo $admin["street"]?>"></p>
            
             <p class=profile-body-1>City</p >
                <p class=profile-body-2><input type="text"name="city" value="<?php echo $admin["city"]?>"></p>
            
            
             <p class=profile-body-1>State</p >
                <p class=profile-body-2><input type="text"name="state" value="<?php echo $admin["state"]?>"></p>
            
            
             <p class=profile-body-1>Postal code</p >
                 <p class=profile-body-2><input type="text" name="postal"value="<?php echo $admin["postal_code"]?>"></p>

               <p class=profile-body-1  >Joined date</p >
             <p class=profile-body-2><input class=halo type="text"name="joined" value="<?php echo $admin["joined_date"]?>"disabled/></p>
               
            <p class=profile-body-1>Admin_email</p >
                <p class=profile-body-2><input type="email" name="adminemail"value="<?php echo $admin["admin_email"]?>"disabled/></p>
            
            <p class=profile-body-1>Admin_password</p>
                <p class=profile-body-2><input type="password"name="adminpass" value="<?php echo $admin["admin_password"]?>"disabled/><span id="edit_btn"> <button id="btn1" type = "button">Edit</button></span></p>
                
              <span id="submit_123">  <input type="submit" name="save-admin" value="Save" >   </span>  
               
         </form>

         <div class = "chgadmin" id="chgadmin">
				<div class = "chg-box">
					<div class="chg-top">
						<h4>Change Password</h4>
						<button class = "close-btn">X</button>
                    </div>
                    
					<div class="chg-body">
						<form method ="post">
						<p>Enter your current password</p>
						<p><input type = "password" name = "cpassword" placeholder = "Current Password" required/></p>
						<div class = "errorr" id = "error-cpassword">&nbsp;</div>
						<p>Enter your new password</p>
						<p><input type = "password" name = "npassword" placeholder = "New Password"/></p>
						<div class = "errorr" id = "error-npassword">&nbsp;</div>
						<p>Re-enter your new password</p>
						<p><input type = "password" name = "rpassword" placeholder = "Re-enter Password"/></p>
						<div class = "errorr" id = "error-rpassword">&nbsp;</div>
						<p class = "save-btn"><input type = "submit" name = "ssave" value = "Save" /></p>
						</form>
					</div>
				</div>
		</div>
        </div>  
    
    </div>
        
</div>

<?php 
if(isset($_POST["save-admin"]))
{
    $fullname=$_POST["fullname"];
    $gender=$_POST["gender"];
    $phone=$_POST["phone"];
    $street=$_POST["street"];
    $city=$_POST["city"];
    $state=$_POST["state"];
    $postcode=$_POST["postal"];

 
   if(mysqli_query($connect ,"UPDATE admin1 SET fullname='$fullname',state='$state' ,gender='$gender',phone_num='$phone',street='$street',city='$city',postal_code='$postcode' WHERE admin_id ='$id' "))
   {

    ?>
    <script>
    alert("update completed");
    window.location.href = "dashboard.php";
    </script>

    <?php
   }
}


if(isset($_POST["ssave"]))
{
    $password=md5($_POST["cpassword"]);
    $npassword =md5($_POST["npassword"]);
    $rpassword =md5( $_POST["rpassword"]);

    $check=0;

    
    if($password !=$admin['admin_password'])
    {
    ?>
      <script>
     alert("This is not your current password");
     
    </script>
    <?php
    }
    else if($npassword ==$admin['admin_password'] )
    {
        ?>
        <script>
       alert("New password cannot be the same as old password");
       
      </script>
      <?php  
    }
     else if(empty($npassword))
    {
     ?>
      <script>
        alert("password cant be empty");
    
    </script>
    <?php
    }
    else if(strlen($npassword) < 8)
    {
     ?>
      <script>
        alert("password too short");
    
    </script>
    <?php
    }
   else if (empty($rpassword))
    {
     ?>
        <script>
      alert("password cant be empty");
     
      </script>
      <?php
    }
    else if(strlen($rpassword) < 8)
    {
     ?>
      <script>
        alert("password too short");
    
    </script>
    <?php
    }

    else if($npassword !=$rpassword)
    {
    ?>
    <script>
      alert("New password must be the same as password reentered");
  
    </script>
     <?php
    }
     else
     $check=1;


    if($check ==1 )
    {
       
    mysqli_query($connect, "UPDATE admin1 SET admin_password = '$npassword' WHERE admin_id='$id'");
    ?>
    <script>
    alert(" password already changed");
    window.location.href = "dashboard.php";
 
  </script>
  <?php
    }

    ?>
    
 <?php
}
?>	
	
</body>
</html>
<script>

 $(document).ready(function() 
{
        //search item
        $(document).on("keyup", ".search-bar input", function()
        {
        
            page = 1;
            search_content = $(this).val();
            choice = 1;
            $(".order-table").load("order_report/order_report_ajax.php", {
                page:page, content:search_content
            });

        });

    // profile pop out 
    $(".profile-content").hide();
    $(document).on("click","#view-profile", function()
    {
        $(".profile-content").show();
        $("body").css("overflow","hidden");
    
    });
    $(document).on("click","#btn123", function()
    {
        $(".profile-content").hide();
        $("body").css("overflow","visible");
    
    });
    
    $(".chgadmin").hide();  

    $("#btn1").click(function()
    {
        $(".chgadmin").show();
    });
    
    $(document).on("click",".close-btn", function(){
        $(".chgadmin").hide(); 
    });
    
    $(function () {
        //禁用“确认重新提交表单”
        window.history.replaceState(null, null, window.location.href);
        });

});
</script>