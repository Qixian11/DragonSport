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
<title>DS Admin Sales Report</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">    
<link rel="stylesheet" type="text/css" href="sales_report/sales_report.css">
<link rel="stylesheet" type="text/css" href="navbar/navbar.css">
<link href="https://cdn.lineicons.com/2.0/LineIcons.css" rel="stylesheet">
<script src="https://kit.fontawesome.com/9dcddfad62.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset = "utf-8"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script src = "navbar/navbar.js" type="text/javascript"></script>
<script src = "sales_report/sales_report.js" type="text/javascript"></script>

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
<div class = "body">
    <div class="body-content">
        <div class="sales_report">
            <div class="top">
                <div class="chart1">
                    <div class="box">
                        <div class="fix">
                            <div class="center">
                                <i class="fas fa-user-plus" ></i>
                            </div>
                            <div >
                                <?php
                                 $user=mysqli_query($connect,"SELECT * FROM user");
                                 $countuser=mysqli_num_rows($user);
                                 $product=mysqli_query($connect,"SELECT * FROM product_entry");
                                 $countproduct=mysqli_num_rows($product);
                                 $orders=mysqli_query($connect,"SELECT * FROM orders");
                                 $countorders=mysqli_num_rows($orders);

                                ?>
                                <p class="c1"><?php echo $countuser?></p>
                                <p class="c2" >TOTAL CUSTOMER</p>
                            </div>
                        </div>
                    </div> 
                    <div class="box">
                         <div class="fix2">
                                <div class="center" style="justify-content: right;display: grid;">
                                <i class="fas fa-box-open" style="font-size:23px;"></i>
                                </div>
                                <div>
                                    <p class="c1" style="font-size:20px;font-weight:bold;"><?php echo $countproduct?></p>
                                    <p style="font-size:11px;"> TOTAL PRODUCT </p>
                                </div>
                        </div>
					</div>
					<div class="box">
                         <div class="fix">
                            <div class="center" >
                            <i class="far fa-calendar-check" style="font-size:27px;"></i>
                            </div>
                            <div>
                                <p class="c1" ><?php echo $countorders?></p>
                                <p class="c2">TOTAL ORDER</p>
                            </div>
                        </div>
                    </div>
				</div>
				
				<div  class="chart2">   
					<canvas id = "types"></canvas>
				</div>
				
				<div class="chart3">   
					<canvas id = "monthly-target" style="position: relative; height:80vh; width:80vw;" ></canvas>
				</div>
			</div>

			<div class = "second-row">
                    <div class="chartff">
                        <div class="secondreport">
                            <h3>NIKE SALES REPORT</h3>
                            <canvas id="nike-sales"></canvas>
                        </div>
                        <div class="thirdreport">
                            <h3>ADIDAS SALES REPORT</h3>
                            <canvas id="adidas-sales"></canvas>
                        </div>
                    </div>
			</div>

			<div class="third-row">
				<h3>NIKE AND ADIDAS SALES REPORT</h3>
				<canvas id="twochart" style="position: relative; height:55vh; width:80vw"></canvas>
			</div>
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



</body>
</html>
<script>
$(document).ready(function()
{   
    //cal month
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
    $nike_result = mysqli_query($connect, "SELECT SUM(total) as total from orders, orders_detail, product_entry, product WHERE order_id = orders_id and product_entry.ID = order_product and Shoes_ID = product_id and brands = 2 and purchase_date BETWEEN '$year_start' AND '$year_end' group by brands, month(purchase_date) ORDER BY Date (purchase_date)");
    $adidas_result = mysqli_query($connect, "SELECT SUM(total) as total from orders, orders_detail, product_entry, product WHERE order_id = orders_id and product_entry.ID = order_product and Shoes_ID = product_id and brands = 1 and purchase_date BETWEEN '$year_start' AND '$year_end' group by brands, month(purchase_date) ORDER BY Date (purchase_date)");
     $order_result = mysqli_query($connect, "SELECT SUM(grand_total) as total FROM orders WHERE purchase_date BETWEEN '$year_start' AND '$year_end' GROUP BY MONTH(purchase_date) ORDER BY Date(purchase_date)");
     $lifestyle=mysqli_query($connect,"SELECT * FROM product where types=1 ");
     $countlf=mysqli_num_rows( $lifestyle);
     $running=mysqli_query($connect,"SELECT * FROM product where types=2 ");
     $countrn=mysqli_num_rows($running);
     $football=mysqli_query($connect,"SELECT * FROM product where types=3 ");
     $countfb=mysqli_num_rows($football);
     $tennis=mysqli_query($connect,"SELECT * FROM product where types=4 ");
     $counttn=mysqli_num_rows($tennis);
     $training=mysqli_query($connect,"SELECT * FROM product where types=5 ");
     $counttr=mysqli_num_rows($training);

 ?>
    
   
     //chart1 
    var salary_bar = document.getElementById("types").getContext("2d");
    var chart = new Chart(salary_bar,
        {
            type:"bar",
            data:
             {
            labels: ["Lifestyle", "Running", "Football", "Tennis", "Training"],
            datasets:[
                {
                label:'Types',
                backgroundColor:"#F3F2F1",
                borderColor:"#8B8378",
                borderWidth:1,
                barThickness:9,
                data:[<?php echo  $countlf?>,<?php echo  $countrn?>,<?php echo  $countfb?>,<?php echo  $counttn?>,<?php echo  $counttr?>]
            }]
        },

        options:
        {
            responsive:true,
            title: {
                display: true,
                text: 'TYPES OF SHOES SALES '
              }, 
            layout:
            {
                padding:
                {
                    
                    bottom:10,
                    left:20,
                    right:30,
                }
            },
            scales: 
            {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        suggestedMax:15,
                        stepSize: 4,
                        fontSize:15
                    }
                }],
                xAxes:[{
                    ticks:
                    {
                        fontSize:12
                    }
                }]
            },
        }
    });

    //chart2
    var target_pie = document.getElementById("monthly-target").getContext("2d");
    var chart = new Chart(target_pie,
        {
            type:"pie",
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
                label:"Target",
                backgroundColor: ["#C7BEFF", "#BFEAA3","#CCF2FF","#e8c3b9","#F18C92","#F18C92"],
                borderColor:"#8B8378",
                data:[<?php 
                     $i = 0;
                     while($row_date_result = mysqli_fetch_assoc($order_result))
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
            title: {
                display: true,
                text: 'ORDER OF MONTHLY'
              }, 
         
        },  

    });

    //chart3
    var chart3 = document.getElementById("nike-sales").getContext("2d");
    var chart = new Chart(chart3,
        {
            type:"line",
            data:
             {
            labels: [ <?php 
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
                label:"Nike Sales",
                backgroundColor:"#B9DCFF",
                borderColor:"#1874CD",
                borderWidth:1,
                data:
                    [
                     <?php 
                     $i = 0;
                     while($row_date_result = mysqli_fetch_assoc($nike_result))
                     {
                        echo "'".$row_date_result["total"]."'";
                        $i++;
                        if($i != $j)
                            echo ", ";
                     }
                  ?>
                  ]
                  
            }]
        },

        options:
        {
            responsive:true,
            maintainAspectRatio:false,
            layout:
            {
                padding:
                {  
                    bottom:50,
                    left:20,
                    right:30,
                }
            },
            scales: 
            {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        suggestedMax:4000,
                        stepSize: 1000,
                        fontSize:12
                    }
                }],
                xAxes:[{
                    ticks:
                    {
                        fontSize:12
                    }
                }]
            },
            
        },
    });

    //chart4
    var chart4= document.getElementById("adidas-sales").getContext("2d");
    var chart = new Chart(chart4,
        {
            type:"line",
            data:
             {
            labels: [ <?php 
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
                label:"Adidas Sales",
                backgroundColor:"#FBE9E9",
                borderColor:"#EC8D8D",
                borderWidth:1,
                data:[<?php 
                     $i = 0;
                     while($row_date_result = mysqli_fetch_assoc($adidas_result))
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
            layout:
            {
                padding:
                {
                    
                    bottom:50,
                    left:20,
                    right:30,
                }
            },
            scales: 
            {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        suggestedMax:4000,
                        stepSize: 1000,
                        fontSize:12
                    }
                }],
                xAxes:[{
                    ticks:
                    {
                        fontSize:12
                    }
                }]
            },
        }
    });
<?php
  $nike_result1 = mysqli_query($connect, "SELECT SUM(total) as total from orders, orders_detail, product_entry, product WHERE order_id = orders_id and product_entry.ID = order_product and Shoes_ID = product_id and brands = 1 and purchase_date BETWEEN '$year_start' AND '$year_end' group by brands, month(purchase_date) ORDER BY Date (purchase_date)");
  $adidas_result1 = mysqli_query($connect, "SELECT SUM(total) as total from orders, orders_detail, product_entry, product WHERE order_id = orders_id and product_entry.ID = order_product and Shoes_ID = product_id and brands = 2 and purchase_date BETWEEN '$year_start' AND '$year_end' group by brands, month(purchase_date) ORDER BY Date (purchase_date)");
?>
    var chart5= document.getElementById("twochart").getContext("2d");
    var chart = new Chart(chart5,
        {
        type: 'bar',
        data: {
          labels: [ <?php 
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
          datasets: [{
              label: "NIKE AIR",
              type: "line",
              borderColor: "#FEA500",
              backgroundColor:"#FFF6E5",
              barThickness:18,
              data: [<?php 
                     $i = 0;
                     while($row_date_result = mysqli_fetch_assoc($adidas_result1))
                     {
                        echo "'".$row_date_result["total"]."'";
                        $i++;
                        if($i != $j)
                            echo ", ";
                     }
                  ?> ],
              fill: false
            }, {
              label: "Adidas",
              type: "bar",
              backgroundColor:"#2BF7FF",
              barThickness:25,
              data: [<?php 
                     $i = 0;
                     while($row_date_result = mysqli_fetch_assoc($nike_result1))
                     {
                        echo "'".$row_date_result["total"]."'";
                        $i++;
                        if($i != $j)
                            echo ", ";
                     }
                  ?> ],
              fill: false
            }, 
          ]
        },
        options: {
          legend: { display: false },
    
                layout:
                {
                    padding:
                    {
                        
                        bottom:0,
                        left:20,
                        right:30,
                    }
                },
             
          },
        
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