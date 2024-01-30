<?php
include("../../Client/dataconnection.php");
$id = $_POST["id"];
$choice = $_POST["c"];

if(empty($id))
    exit(0);
else
{
    if($choice == 1)
    {
        $un = $_POST["un"];
        $fn = $_POST["fn"];
        $pn = $_POST["pn"];
        $add = $_POST["add"];
        $st = $_POST["st"];
        $ct = $_POST["ct"];
        $pc = $_POST["pc"];
        $ac = $_POST["ac"];
        $c1 = 0; $c2 = 0; $c3 = 0; $c4 = 0;
        $name = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM user WHERE user_id = $id"));

        if(empty($un))
        {
            echo "<script>$('#e-un').html('This field cannot be empty');</script>";
        }
        else if($un == $name["user_name"])
        {
            $c1 = 1;
            echo "<script>$('#e-un').html('&nbsp;');</script>";
        }
        else if(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM user WHERE user_name = '$un'")) > 0)
        {
            echo "<script>$('#e-un').html('This username has taken by someone');</script>";
        }
        else if(strlen($un) < 5 || strlen($un) >12)
        {
            echo "<script>$('#e-un').html('The character should be between 5 to 12');</script>";
        }
        else
        {
            $c1 = 1;
            echo "<script>$('#e-un').html('&nbsp;');</script>";
        }

        if(empty($fn))
        {
            echo "<script>$('#e-name').html('This field cannot be empty');</script>";   
        }
        else if (!preg_match("/^[a-zA-Z -]+$/",$fn))
        {
            echo "<script> $('#e-name').html('Fullname cannot contain any numbers or symbols'); </script>";
        }
        else
        {
            $c2 = 1;
        }

        if((strlen($pn) < 11 || strlen($pn) > 12) && strlen($pn) != 0)
        {
            echo "<script> $('#e-phone').html('Please key in the correct format'); </script>";
        }
        else if(!empty($pn) && $pn[0] != 0)
        {
            echo "<script> $('#e-phone').html('Please key in the correct format'); </script>";
        }
        else
        {
            $c3 = 1;
            echo "<script> $('#e-phone').html('&nbsp;'); </script>";
        }

        if(empty($ac))
        {
            echo "<script>$('#e-status').html('This field cannot be empty');</script>";
        }
        else
        {
            $c4 = 1;
            echo "<script> $('#e-status').html('&nbsp;'); </script>";
        }

        if($c1 == 1 && $c2 == 1 && $c3 == 1 && $c4 == 1)
        {
            mysqli_query($connect, "UPDATE user SET user_name = '$un', user_fullname = '$fn', phone_num = '$pn', address = '$add', state = '$st', city = '$ct', postal_code = '$pc', Status = '$ac' WHERE user_id = $id");
    ?>
            <script>$(".notification span").fadeIn().delay(2000).fadeOut();</script>
    <?php
        }
    }
    $row = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM user WHERE user_id = $id"));
?>

    <div class = "paragraph">
        <p class = "attribute">Username</p>
        <p class = "input"><input type="text" value = "<?php echo $row['user_name']?>" name = "username"></p>
        <p class = "error" id = "e-un"><i>&nbsp;</i></p>
    </div>
    <div class = "paragraph">
        <p class = "attribute">Fullname</p>
        <p class = "input"><input type="text" value = "<?php echo $row['user_fullname']?>" name = "fullname"></p>
        <p class = "error" id = "e-name"><i>&nbsp;</i></p>
    </div>
    <div class = "paragraph">
        <p class = "attribute">Email</p>
        <p class = "input"><input type="email" value = "<?php echo $row['user_email']?>" disabled><i class="lni lni-lock-alt"></i></p>
        <p class = "error"><i>&nbsp;</i></p>
    </div>
    <div class = "paragraph">
        <p class = "attribute">Phone Number</p>
        <p class = "input"><input type="tel" value = "<?php echo $row['phone_num']?>" name = "phone"></p>
        <p class = "error" id = "e-phone"><i>&nbsp;</i></p>
    </div>
    <div class = "paragraph">
        <p class = "attribute">Address</p>
        <p class = "input"><input type="text" value = "<?php echo $row['address']?>" name = "address"></p>
        <p class = "error"><i>&nbsp;</i></p>
    </div>
    <div class = "paragraph">
        <p class = "attribute">State</p>
        <p class = "input">
            <select name = "state">
                <option></option>
                <?php 
                    $state_name = array("Johor", "Malacca", "Selangor", "Negeri Sembilan", "Perak", "Penang", "Sabah", "Sarawak", "Kedah", "Pahang", "Perlis", "Kelantan", "Terengganu");
                    for($i = 0; $i < 13; $i++)
                    {
                        if($state_name[$i] == $row["state"])
                            echo "<option selected>".$state_name[$i]."</option>";
                        else
                            echo "<option>".$state_name[$i]."</option>";
                    }
                ?>
            </select>
        </p>
        <p class = "error"><i>&nbsp;</i></p>
    </div>
    <div class = "paragraph">
        <p class = "attribute">City</p>
        <p class = "input"><input type="text" value = "<?php echo $row['city']?>" name = "city"></p>
        <p class = "error"><i>&nbsp;</i></p>
    </div>
    <div class = "paragraph">
        <p class = "attribute">Postal Code</p>
        <p class = "input"><input type="text" value = "<?php echo $row['postal_code']?>" name = "postal-code"></p>
        <p class = "error"><i>&nbsp;</i></p>
    </div>
    <div class = "paragraph">
        <p class = "attribute">Status</p>
        <p class = "input">
            <select name = "status">
                    <option></option>
                    <?php 
                        $status_name = array("Active", "Banned");
                        for($i = 0; $i < 2; $i++)
                        {
                            if($status_name[$i] == $row["Status"])
                                echo "<option selected>".$status_name[$i]."</option>";
                            else
                                echo "<option>".$status_name[$i]."</option>";
                        }
                    ?>
            </select>
        </p>
        <p class = "error" id = "e-status"><i>&nbsp;</i></p>
    </div>
    <div>
        <p class = "notification">&nbsp;<span>Saved</span></p>
    </div>
<?php
}
?>

<script>
//phone mask
$("input[type = 'tel']").mask("010-00000009");
</script>