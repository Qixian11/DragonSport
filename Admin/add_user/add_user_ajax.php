<?php
include("../../Client/dataconnection.php");
$choice = $_POST["c"];
$page = $_POST["page"] * 8 - 8;
$content = $_POST["content"];
$limit = 8;

if($choice == 0 && empty($content))
{   
    $query = "SELECT * FROM user";
    $count = ceil(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM user")) / 8);
}
else if($choice == 1 || (!empty($content) && $choice != 2))
{
    $query = "SELECT * FROM user WHERE user_name LIKE '%$content%'";
    $count = ceil(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM user WHERE user_name LIKE '%$content%'")) / 8);
}
else if($choice == 2 && (empty($content) || !empty($content)))
{
    $username = $_POST["u"];
    $name = $_POST["n"];
    $email = $_POST["e"];
    $password = $_POST["p"];
    $rpassword = $_POST["rp"];
    $c1 = 0; $c2 = 0; $c3 = 0; $c4 = 0; $c5 = 0;

    if(empty($username))
    {
?>
        <script>$("#e-uname").html("This field cannot be empty");</script>
<?php
    }
    else if(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM user WHERE user_name = '$username'")) > 0)
    {
?>
        <script>$("#e-uname").html("This username has taken by someone");</script>
<?php
    }
    else if(strlen($username) < 5 || strlen($username) >12)
    {
?>
        <script>$("#e-uname").html("The character should be between 5 to 12");</script>
<?php
    }
    else
    {
        $c1 = 1;
?>
        <script>
            $("#e-uname").html("");
        </script>
<?php
    }

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
        $c2 = 1;
        echo "<script>$('#e-name').html('')</script>";
    }

    if(empty($email))
    {
?>
        <script>$("#e-email").html("This field cannot be empty");</script>
<?php       
    }
    else if(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM user WHERE user_name = '$email'")) > 0)
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

    if($c1 == 1 && $c2 == 1 && $c3 == 1 && $c4 == 1 && $c5 == 1)
    {
        $date = date("F Y");
        $vcode = rand(100000, 999999);
        $md5paswword = md5($password);
        if(mysqli_query($connect, "INSERT INTO user (user_name, user_fullname, user_email, user_password, Verification_code, Verified, registered_date, Status) VALUES ('$username', '$name', '$email', '$md5paswword', '$vcode', 0, '$date', 'Active')"))
        {
            $subject = "Create User Account";
            $message = "Dear user, please log in your account with this ID(".$username.") and Password(".$password."). And please change your password immediately once you signed in. And also verify your account with this Token(".$vcode."). Click below link to verify\nhttp://localhost/FYP/Client/verify.php?verify&useremail=".$username;
            $header = "From: dragonsport159@gmail.com";

            mail($email, $subject, $message, $header);
?>
            <script>
                alert("Account has added successfully");
                $(".input input, input[type = 'search']").val("");
                $(".error").html("");
                $(".modal").css({"visibility":"hidden", "opacity":"0"});
                localStorage.setItem("openandclose", 0);
            </script>
<?php
        }
    }
    $query = "SELECT * FROM user";
    $count = ceil(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM user")) / 8);
}

$query .= " LIMIT $page, $limit";
$result = mysqli_query($connect, $query);
?>

<div class = "table">
    <table>
        <tr>
            <th>User ID</th>
            <th>Username</th>
            <th>Fullname</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Address</th>
            <th>City</th>
            <th>State</th>
            <th>Postal Code</th>
            <th>Registered Date</th>
        </tr>
    <?php
        while($row = mysqli_fetch_assoc($result))
        {
    ?>
        <tr>
            <td><?php echo $row["user_id"]?></td>
            <td><?php echo $row["user_name"]?></td>
            <td><?php echo $row["user_fullname"]?></td>
            <td><?php echo $row["user_email"]?></td>
            <td><?php echo $row["phone_num"]?></td>
            <td><?php echo $row["address"]?></td>
            <td><?php echo $row["city"]?></td>
            <td><?php echo $row["state"]?></td>
            <td><?php echo $row["postal_code"]?></td>
            <td><?php echo $row["registered_date"]?></td>
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