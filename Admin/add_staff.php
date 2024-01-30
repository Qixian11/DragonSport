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
<title>DS Admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">    
<link rel="stylesheet" type="text/css" href="navbar/navbar.css">
<link rel="stylesheet" type="text/css" href="add_staff/add_staff.css">
<link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset = "utf-8"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script src = "navbar/navbar.js" type="text/javascript"></script>
<script src = "add_staff/add_staff.js" type="text/javascript"></script>
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
            <li>  <a href ="adminlogin.php?logout&log=0"> Log out </a> </li> 
            </ul>
        </div>
    </div>
</div>
<div class="body">
    <div class = "body-content">
        <div class="staff-table">
            <div class="table-head">
                <h3>Staff</h3>
            </div>
            <div class = "table-header">
                <div class = "search-bar">
                    <span><i class="lni lni-search-alt"></i></span>
                    <input type="search" name = "search" placeholder = "Search">
                </div>
                <div class = "add-btn">
                    <button>Add New</button>
                </div>
            </div>
            <div class = "table-content">
                <div class = "table">
                    <table>
                        <tr>
                            <th>Staff ID</th>
                            <th>Fullname</th>
                            <th>Gender</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Address</th>
                            <th>City</th>
                            <th>State</th>
                            <th>Postal Code</th>
                            <th>Role</th>
                        </tr>
                    <?php
                        $count = ceil(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM admin1")) / 8);
                        $result = mysqli_query($connect, "SELECT * FROM admin1 LIMIT 8");
                        while($row = mysqli_fetch_assoc($result))
                        {
                    ?>
                        <tr>
                            <td><?php echo $row["admin_id"]?></td>
                            <td><?php echo $row["fullname"]?></td>
                            <td><?php echo $row["gender"]?></td>
                            <td><?php echo $row["admin_email"]?></td>
                            <td><?php echo $row["phone_num"]?></td>
                            <td><?php echo $row["street"]?></td>
                            <td><?php echo $row["city"]?></td>
                            <td><?php echo $row["state"]?></td>
                            <td><?php echo $row["postal_code"]?></td>
                            <td><?php echo $row["role"]?></td>
                        </tr>
                    <?php
                        }
                    ?>
                    </table>
                </div>
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
<div class = "modal">
    <div class = "modal-container">
        <div class = "modal-head">
            <h3>Add Staff</h3>
            <button><i class="lni lni-close"></i></button>
        </div>
        <div class = "modal-body">
            <p class = "input"><span>Fullname :</span><input type="text" name = "fullname"></p>
            <p id = "e-name" class = "error"></p>
            <p class = "input"><span>Gender :</span>
                <select name = "gender">
                    <option selected></option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </p>
            <p id = "e-gender" class = "error"></p>
            <p class = "input"><span>Email :</span><input type="email" name = "email"></p>
            <p id = "e-email" class = "error"></p>
            <p class = "input"><span>Role :</span>
                <select name = "role">
                    <option selected></option>
                    <option>Super Admin</option>
                    <option>Admin</option>
                </select>
            </p>
            <p id = "e-role" class = "error"></p>
            <p class = "input"><span>Password :</span><input type="password" name = "password"><i class="lni lni-eye"></i></p>
            <p id = "e-password" class = "error"></p>
            <p class = "input"><span>Confirm Password :</span><input type="password" name = "repassword"><i class="lni lni-eye"></i></p>
            <p id = "e-repassword" class = "error"></p> 
            <p><button>Add</button></p>     
        </div>
    </div>
</div>

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
    $npassword =$_POST["npassword"];
    $rpassword = $_POST["rpassword"];

    $check=0;
    $check1=0;
    $check2=0;
    $ch=[];
    $k=0;
   

    if($password !=$admin['admin_password'])
    {
     $ch[$k++]="This is not your current password!";
    }
    else{
        $check=1;
    }

   
     if(empty($npassword))
    {
    
        $ch[$k++]="password cant be empty!";
    
   
    }
    else if(strlen($npassword) < 8)
    {
   
        $ch[$k++]="Password should be at least 8 characters in length!";
    
    }
    else
    {

            $check1=1;
        
    }
    if($npassword !=$rpassword)
    {
        
        $ch[$k++]="New password must be the same as password reentered!";
      
    }

   else if((md5($npassword)) ==$admin['admin_password'])
   {
    $ch[$k++]="New password cannot be the same as old password";
   } 
   else
   {

        $check2=1;
   }
 
   if($check == 0 || $check1 == 0 || $check2 == 0)
   {
    $b =implode('\r\n',$ch);
   
    echo "<script> alert('".$b."') </script>";
   }
 
   else if($check == 1 && $check1 == 1 && $check2 == 1)
    {
     $mdpassword=md5($npassword);  
    mysqli_query($connect, "UPDATE admin1 SET admin_password = '$mdpassword' WHERE admin_id='$id'");
    ?>
    <script>
    alert("Password already changed!");
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