<?php
include("../../Client/dataconnection.php");
$choice = $_POST["c"];
$page = $_POST["page"] * 8 - 8;
$content = $_POST["content"];
$limit = 8;

if($choice == 0 && empty($content))
{   
    $query = "SELECT * FROM admin1";
    $count = ceil(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM admin1")) / 8);
}
else if($choice == 1 || (!empty($content) && $choice != 2))
{
    $query = "SELECT * FROM admin1 WHERE fullname LIKE '%$content%'";
    $count = ceil(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM admin1 WHERE fullname LIKE '%$content%'")) / 8);
}
else if($choice == 2 && (empty($content) || !empty($content)))
{
    $name = $_POST["n"];
    $gender = $_POST["g"];
    $email = $_POST["e"];
    $role = $_POST["r"];
    $password = $_POST["p"];
    $rpassword = $_POST["rp"];
    $c1 = 0; $c2 = 0; $c3 = 0; $c4 = 0; $c5 = 0; $c6 = 0;

    if(empty($name))
    {
?>
        <script>$("#e-name").html("This field cannot be empty");</script>
<?php       
    }
    else if (!preg_match("/^[a-zA-Z -]+$/",$name))
    {
?>
        <script> $("#e-name").html("Fullname cannot contain any numbers or symbols"); </script>
<?php	
    }
    else
    {
        $c1 = 1;
        echo "<script>$('#e-name').html('')</script>";
    }

    if(empty($gender))
    {
?>
        <script>$("#e-gender").html("This field cannot be empty");</script>
<?php       
    }
    else
    {
        $c2 = 1;
        echo "<script>$('#e-gender').html('')</script>";
    }

    if(empty($email))
    {
?>
        <script>$("#e-email").html("This field cannot be empty");</script>
<?php       
    }
    else if(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM admin1 WHERE admin_email = '$email'")) > 0)
    {
?>
        <script>$("#e-email").html("This email has taken by someone");</script>
<?php  
    }
    else
    {
        $c3 = 1;
        echo "<script>$('#e-email').html('')</script>";
    }

    if(empty($role))
    {
?>
        <script>$("#e-role").html("This field cannot be empty");</script>
<?php       
    }
    else
    {
        $c6 = 1;
        echo "<script>$('#e-role').html('')</script>";
    }

    if(empty($password))
    {
?>
        <script>$("#e-password").html("This field cannot be empty");</script>
<?php       
    }
    else if(strlen($password) <=5)
    {
?>
        <script>$("#e-password").html("Password is too short");</script>
<?php  
    }
    else
    {
        $c4 = 1;
        echo "<script>$('#e-password').html('')</script>";
    }

    if($rpassword != $password)
    {
?>
        <script>$("#e-repassword").html("Password is not match");</script>
<?php       
    }
    else if(empty($rpassword))
    {
?>
        <script>$("#e-repassword").html("This field cannot be empty");</script>
<?php       
    }
    else
    {
        $c5 = 1;
        echo "<script>$('#e-repassword').html('')</script>";
    }

    if($c1 == 1 && $c2 == 1 && $c3 == 1 && $c4 == 1 && $c5 == 1 && $c6 == 1)
    {
        $date = date("F Y");
        $md5paswword = md5($password);
        if(mysqli_query($connect, "INSERT INTO admin1 (fullname, gender, admin_email, role, admin_password, joined_date) VALUES ('$name', '$gender', '$email', '$role', '$md5paswword', '$date')"))
        {
            $subject = "Create Admin Account";
            $message = "Congratulation, you have became an admin of Dragon Sport. please log in your account with your Email and Password(".$password."). Click the below link to access the login page.\nhttp://localhost/FYP/Admin/adminlogin.php";
            $header = "From: dragonsport159@gmail.com";

            mail($email, $subject, $message, $header);
?>
            <script>
                alert("Account has added successfully");
                $(".input input, input[type = 'search'], select").val("");
                $(".error").html("");
                $(".modal").css({"visibility":"hidden", "opacity":"0"});
                localStorage.setItem("openandclose", 0);
            </script>
<?php
        }
    }
    $query = "SELECT * FROM admin1";
    $count = ceil(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM admin1")) / 8);
}

$query .= " LIMIT $page, $limit";
$result = mysqli_query($connect, $query);
?>

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