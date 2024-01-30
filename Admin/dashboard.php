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
<link rel="stylesheet" type="text/css" href="dashboard/dashboard.css">
<link rel="stylesheet" type="text/css" href="navbar/navbar.css">
<link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset = "utf-8"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script src = "navbar/navbar.js" type="text/javascript"></script>
<script src = "dashboard/dashboard.js" type="text/javascript"></script>
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
               <li>  <a href ="adminlogin.php?logout&log=0 " onclick="myFunction()" > Log out </a> </li> 

               <script>  function myFunction(){
                   confirm("Are you sure want to log out??");
                   
               }
            
            </script>
              
            </ul>
        </div>
    </div>
</div>
<div class = "body">
    <div class = "body-content">
        <div class="body-first">
            <!-- GET DATA -->
            <?php  
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $daily_date = date("Y/m/d");
            //total user
            $all_user = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM user"));

            //total items
            $all_item = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM product"));

            //monthly item sold
            $get_month = date("m");
            $item_sales = mysqli_fetch_assoc(mysqli_query($connect, "SELECT SUM(qty) as total_sales FROM orders INNER JOIN orders_detail ON orders_detail.order_id = orders.orders_id WHERE MONTH(purchase_date) = $get_month"));
            $item_result = $item_sales["total_sales"];
            if(empty($item_result))
                $item_result = 0;

            //daily income
            $daily_income_query = mysqli_fetch_assoc(mysqli_query($connect, "SELECT SUM(grand_total) as daily_income FROM orders WHERE purchase_date = '$daily_date'"));
            $daily_income = $daily_income_query["daily_income"];
            if(empty($daily_income))
                $daily_income = 0;

            //total business hour
            $first_day = new DateTime("2020-09-01");
            $last_day = new DateTime($daily_date);
            $total_business_day = $first_day->diff($last_day);
            $convert_to_hours = ($total_business_day->days * 24) + date("H");

            //top buyer
            $top_buyer = mysqli_fetch_assoc(mysqli_query($connect, "SELECT user_fullname, SUM(grand_total) as total FROM orders, orders_detail, user WHERE order_id = orders_id AND user.user_id = orders.user_id GROUP BY orders.user_id ORDER BY SUM(grand_total) DESC LIMIT 1"));
            
            //total products sold
            $total_products_sold = mysqli_fetch_assoc(mysqli_query($connect, "SELECT SUM(qty) as total_qty FROM orders_detail"));
            ?>
            <!--END GET DATA -->
            <div class = "container">
                <div>
                    <p id = "user-count" class = "count"><?php echo $all_user?></p>
                    <p>Total User</p>
                </div>
                <div>
                    <i class="lni lni-user"></i>
                </div>
            </div>
            <div class = "container">
                <div>
                    <i class="lni lni-dropbox"></i>
                </div>
                <div>
                    <p id = "items-count" class = "count"><?php echo $all_item?></p>
                    <p>Total Items</p>
                </div>
            </div>
            <div class = "container">
                <div>
                    <p id = "sales-count" class = "count"><?php echo $item_result?></p>
                    <p>Monthly Sales</p>
                </div>
                <div>
                    <i class="lni lni-cart"></i>
                </div>
            </div>
            <div class = "container">
                <div>
                    <i class="lni lni-wallet"></i>
                </div>
                <div>
                    <p id = "earn-count" class = "count"><?php echo $daily_income?></p>
                    <p>Earning</p>
                </div>
            </div> 
        </div>
        <div class = "body-second">
            <canvas id = "monthly-income" ></canvas>
        </div>
        <div class = "body-third">
            <div class="social-content">
                <div class = "social-content-icon">
                    <i class="lni lni-hourglass"></i>
                </div>
                <div class = "social-content-data">
                    <p><?php echo $convert_to_hours?></p>
                    <p>Total Business Hours</p>
                    <div>
                        <div></div>
                    </div>
                </div>
            </div>
            <div class="social-content">
                <div class = "social-content-icon">
                    <i class="lni lni-cup"></i>
                </div>
                <div class = "social-content-data">
                    <p><?php echo $top_buyer["user_fullname"]?></p>
                    <p>Top Buyer</p>
                    <div>
                        <div></div>
                    </div>
                </div>
            </div>
            <div class="social-content">
                <div class = "social-content-icon">
                    <i class="lni lni-shopping-basket"></i>
                </div>
                <div class = "social-content-data">
                    <p><?php echo $total_products_sold["total_qty"]?></p>
                    <p>Total Products Sold</p>
                    <div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            $count_unseen = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM contact WHERE Status = 'Unseen'"));
            $total_page = ceil(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM contact")) / 5);
            $result = mysqli_query($connect, "SELECT * FROM contact ORDER BY ID DESC LIMIT 5");
        ?>
        <div class = "body-forth">
            <h3>Messages
                <?php
                if($count_unseen > 0)
                    echo "<label>".$count_unseen."</label>";    
                ?>
            </h3>
            <hr>
            <div class = "message-content">
               <table>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                    <script>let message = [], name = [], subject = [];</script>
                    <?php
                        while($row = mysqli_fetch_assoc($result))
                        {
                    ?>
                        <tr>
                            <td><?php echo $row["user_name"]?></td>
                            <td><?php echo $row["user_email"]?></td>
                            <td><?php echo $row["Date"]?></td>
                            <td><?php echo $row["Time"]?></td>
                            <td><?php echo $row["Status"]?></td>
                            <td>
                                <button value = "<?php echo $row["ID"]?>" class = "view">Reply</button>
                                <input type="hidden" value = "<?php echo $row['ID']?>">
                                <button class = "delete">Delete</button>
                            </td>
                            <script>
                                message[<?php echo $row["ID"]?>] = "<?php echo $row['user_message']?>";
                                name[<?php echo $row["ID"]?>] = "<?php echo $row['user_name']?>";
                                subject[<?php echo $row["ID"]?>] = "<?php echo $row['user_subject']?>"; 
                            </script>
                        </tr>
                    <?php
                        }
                    ?>
               </table>
               <div class = "pagination">
                    <?php
                    if($total_page > 5)
                    {
                        for($i = 0; $i < 5; $i++)
                        {
                        ?>
                            <div><button value = "<?php echo $i+1?>"><?php echo $i+1?></button></div>
                        <?php
                        }
                    }
                    else
                    {
                        for($i = 0; $i < $total_page; $i++)
                        {
                        ?>
                            <div><button value = "<?php echo $i+1?>"><?php echo $i+1?></button></div>
                        <?php
                        }
                    }
                    ?>
               </div>
            </div>
        </div>
    </div>
</div>

<!--view modal-->

<div class="modal" id = "view">
    <div class = "modal-container">
        <div class="view-modal-head">
            <h3>Reply Message</h3>
            <button><i class="lni lni-close"></i></button>
        </div>
        <div class="view-modal-content">
            <div class = "message-reply">
                <p><span class = "attribute">Name :</span><span class = "detail" id = "name"></span></p>
                <p><span class = "attribute">Subject :</span><span class = "detail" id = "subject"></span></p>
                <p><span class = "attribute">Message :</span><p class = "detail" id = "message"></p></p>
                <p><span class = "attribute">Reply :</span></p>
                <p><textarea name = "reply" cols="30" rows="4"></textarea></p>
            </div>
            <div class = "reply-submit">
                <button>Reply</button>
            </div>
        </div>
    </div>
</div>

<!--delete modal-->

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
            <button id = "delete-btn">Delete</button>
            <button id = "cancel-btn">Cancel</button>
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
<script>
//monthly income chart
<?php 
   $month_name = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
   $month_start = 0;
   $month_end = date("n");

   $year_start = date("Y");
   $year_end = $year_start;

   if($month_end - 4 <= 0)
   {
        $month_start = ($month_end + 12) - 5;
        $year_start -= 1;
   }
       
   else
   {
        $month_start = $month_end - 5;
   }

   //select data
    $year_start .= "-".($month_start+1)."-1";
    $year_end .= "-".$month_end."-31";
    $date_result = mysqli_query($connect, "SELECT SUM(grand_total) as total FROM orders WHERE purchase_date BETWEEN '$year_start' AND '$year_end' GROUP BY MONTH(purchase_date) ORDER BY Date(purchase_date)");
?>
let income_bar = $("#monthly-income")[0].getContext("2d");
Chart.defaults.global.defaultFontSize = 15;
let chart = new Chart(income_bar,
{
    type:"line",
    data:
    {
        labels: [<?php 
                    $i = $month_start;
                    $j = 0;
                    while($i != $month_end)
                    {
                        echo "'".$month_name[$i]."'";
                        $i++;
                        if($i > 11)
                            $i = 0;
                        if($i != $month_end)
                            echo ", ";
                        $j++;
                    }
                  ?>],
        datasets:
        [{
            label:"Income",
            backgroundColor:"#d8dbe0",
            borderWidth:3,
            borderColor:"black",
            data:[<?php 
                     $i = 0;
                     while($row_date_result = mysqli_fetch_assoc($date_result))
                     {
                        echo "'".$row_date_result["total"]."'";
                        $i++;
                        if($i != $j)
                            echo ", ";
                     }
                  ?>]
        }]
    },

    options:
    {
        responsive:true,
        maintainAspectRatio:false,
        title:
        {
            display:true,
            text:"Monthly Income",
            fontSize:20,
            fontColor:"black"
        },
        layout:
        {
            padding:
            {
                top:30,
                bottom:30,
                left:25,
                right:25
            }
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true,
                    stepSize: 3000,
                    fontSize:12
                }
            }],
            xAxes:[{
                ticks:
                {
                    fontSize:12
                }
            }]
        }
    }
});
//end income chart
</script>
</html>