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
<title>DS Admin Product</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">    
<link rel="stylesheet" type="text/css" href="product/products.css">
<link rel="stylesheet" type="text/css" href="navbar/navbar.css">
<link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset = "utf-8"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script src = "navbar/navbar.js" type="text/javascript"></script>
<script src = "product/product.js" type="text/javascript"></script>
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
	
	<?php
	$top= mysqli_query($connect,"SELECT * FROM product");
	$nike= mysqli_query($connect,"SELECT * FROM product where brands='1'");
	$adidas= mysqli_query($connect,"SELECT * FROM product where brands='2'");
	$countproduct= mysqli_num_rows($top);
	$countnike= mysqli_num_rows($nike);
	$countadidas= mysqli_num_rows($adidas);?>
	

	<div class = "body-content">
		<div class="body-first">
		
			<div class = "box">
				<div>
					<p id = "user-count" class = "count"><?php echo $countproduct?></p>
					<p>Total Prouduct</p>
				</div>
		        <div class ="shoes">
				   <img  style="width:80px;height:45px;margin-top:5px;" src="product/shoes.png">
			    </div>
			</div>
				 
			<div class = "box">
				<div class ="nike">
					<img  style="width:70px;height:40px; margin-top:4px;" src="product/nike.png">
				</div>
				<div>
					<p id = "items-count" class = "count"><?php echo $countnike?></p>
					<p>Total Nike</p>
				</div>
			</div>
			
			<div class = "box">
				<div class ="adidas">
					<img  style="width:60px; height:50px;" src="product/adidas.png">
				</div>
				<div>
				<p id = "sales-count" class = "count"><?php echo $countadidas?></p>
				<p>Total Adidas</p>
				</div>
			</div>
			
		</div>
		
		<div class="bodysecond" >
			<div  class ="top" >
					<div class="part1">
						<div class="tbtitle"> <strong>PRODUCT</strong></div>
					</div>
					<div class="part2">
				
							<div class = "search-bar">
								<span><i class="lni lni-search-alt"></i></span>
								<input type="search" name = "search" placeholder = "Search">	
							</div>
						
					</div>
					<div class="part3">
						<div class="gear" >
						
								<button ><i class="fa fa-gear fa-spin" ></i></button>
					
						</div>
						<div class="setting">
							<div class="setright">
								<div  class="setdetail">
									<button id ="add" class="detailbtn"><i>Add</i></button>
									<button id ="edit" class="detailbtn"><i>Edit</i></button>
									<button id ="delete" class="detailbtn"><i>Delete</i></button>
									<button id ="clear" class="detailbtn"><i>Clear</i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
		 
			<div class="addproduct_form" >
				<div class="form">
					<form  name="shoesform"  method="post" action="" enctype="multipart/form-data"  >
						<div class="block">
							<p>Add New Shoes</p>
						</div>
						<div class="block" >
							<div class="row">
								<label >Shoes Name  :</label>
								<input type="text" required  name="shoesname" pattern="[a-zA-Z0-9\s]{1,}">
							</div>		
						</div>
						<div class="block" >
							<div class="row">
								<label >Shoes Brands:</label>
								<select name="shoesbrands" required>
									<option value="">Choice Brand</option>
									<option value="1">Adidas</option>
									<option value="2">Nike</option>
								</select>
							</div >		
						</div>
						<div class="block" >
							<div class="row">
								<label >Shoes Types :</label>
								<select  name="shoestypes" required>
									<option value="">Choice Types</option>
									<option value="1">Lifestyle</option>
									<option value="2">Running</option>
									<option value="3">Football</option>
									<option value="4">Tennis</option>
									<option value="5">Training</option>
									</select>	
							</div >
						</div>
						<div class="block" >
							<div class="row">
								<label >Shoes Color : </label>
								<input type="text" name="shoescolor" required pattern="[a-zA-Z\s]{1,}">
							</div>
						</div>
						<div class="block"  >
							<div class="row">
								<label >Shoes Price :</label>
								<input type="number" name="shoesprice"  required min="1" max="9999">
							</div>
						</div>
						<div class="block" >
							<div class="row">
								<label >Shoes IMG :</label>
								<input type="file" name="file" id="file" style="width:200px;" required>
							</div >
						</div>
						<div class="block" >
							<div class="row">
								<label >Shoes Description :</label>
								<textarea name="shoesdescription" cols="27" rows="6" required></textarea>
							</div>
						</div>
						<div class="block">
							<div class="ad"><button type="submit"  name="submit">ADD SHOES</button></div>
						</div>
					</form>	
				</div>
			</div>
		
			<div class="tablelist" >
				<div class="tablerefresh" >
					<table >
					<tr >
						<th >SHOES ID</th>
						<th >SHOES NAME</th>
						<th >SHOES BRANDS</th>
						<th >SHOES TYPES </th>
						<th >SHOES COLOR </th>
						<th >SHOES PRICE </th>
						<th >SHOES IMG   </th>
						<th >SHOES DESCRIPTION</th> 
						<th>Action</th>	
					</tr>
			
					<?php
					$count = ceil(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM product")) / 8);
					$result=mysqli_query($connect,"select * from product, category_brands, category_types where brands = brands_id and types = types_id order by Shoes_ID limit 8 " );
					
                    while($row = mysqli_fetch_assoc($result))
                    {
					?>
					<tr id="data">
						<td ><?php echo $row["Shoes_ID"];?></td>
						<td ><?php echo $row["Shoes_Name"];?></td>
						<td ><?php echo $row["brands_name"];?></td>
						<td ><?php echo $row["types_name"];?> </td>
						<td ><?php echo $row["Shoes_Color"];?></td>
						<td	><?php echo $row["Shoes_Price"];?></td>
						<td ><?php echo '<img src = "data:image;base64,'.base64_encode($row['Shoes_IMG']).'" class = "product-tbimg" >'?></td>
						<td ><div  class="shdec "><?php echo $row["Shoes_Description"];?></div></td>
						<td><span class="actionfucntion" >&nbsp;</span><input type="hidden" value ="<?php echo $row["Shoes_ID"];?>" ></td>
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

<div class = "modal" id = "edit-modal">
    <div class = "modal-container">
        <div class = "modal-head">
            <h3>Edit Shoes Information</h3>
            <button><i class="lni lni-close"></i></button>
        </div>
        <div class = "modal-body">
            
        </div>
    </div>
</div>

<div class="modal" id = "delete-modal">
    <div class = "modal-container delete-c">
        <div class="delete-icon">
            <i class="lni lni-warning"></i>
        </div>
        <div class="delete-alert">
            <p>Are you sure?</p>
            <p>You won't be able to revert this</p>
        </div>
        <div class="delete-confirm">
			<button id = "delete-btn">Delete</button>
            <button id = "cancel-btn">Cancel</button>
        </div>
    </div>
</div>

<?php
if(isset($_POST["submit"]))
{

	$snm=$_POST["shoesname"];
	$sbr=$_POST["shoesbrands"];
	$sty=$_POST["shoestypes"];
	$sco=$_POST["shoescolor"];
	$spr=$_POST["shoesprice"];
	$sdes=$_POST["shoesdescription"];
    $image_data = $_FILES["file"]["tmp_name"];
    $image_type = $_FILES["file"]["type"];
    $image = addslashes(file_get_contents($image_data));

    if(mysqli_num_rows(mysqli_query($connect,"SELECT * FROM product where Shoes_Name='$snm' AND brands='$sbr' AND types='$sty' "))>=1)
    {
    ?>    
        <script>
            alert("<?php echo $snm?> already exits !")
        </script>
    <?php
    }
    else
    {	
	    mysqli_query($connect,"INSERT INTO product(Shoes_Name, brands, types, Shoes_Color, Shoes_Price, Shoes_IMG, Shoes_Description) VALUES( '$snm', '$sbr', '$sty', '$sco', '$spr','$image', '$sdes' ) ");
	?>
        <script>
            alert(" <?php echo $snm?> added  sucussfully !");
        </script>
    <?php	    
    }   
}
?>


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
