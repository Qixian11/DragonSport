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
        $gd = $_POST["gd"];
        $fn = $_POST["fn"];
        $pn = $_POST["pn"];
        $add = $_POST["add"];
        $st = $_POST["st"];
        $ct = $_POST["ct"];
        $pc = $_POST["pc"];
        $rl = $_POST["rl"];
        $c1 = 0; $c2 = 0;
        $name = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM admin1 WHERE admin_id = $id"));

        if(empty($fn))
        {
    ?>
            <script>$("#e-name").html("This field cannot be empty");</script>
    <?php       
        }
        else if (!preg_match("/^[a-zA-Z -]+$/",$fn))
        {
    ?>
            <script> $("#e-name").html("Fullname cannot contain any numbers or symbols"); </script>
    <?php	
        }
        else
        {
            $c1 = 1;
        }

        if((strlen($pn) < 11 || strlen($pn) > 12) && strlen($pn) != 0)
        {
    ?>
            <script> $("#e-phone").html("Please key in the correct format"); </script>
    <?php	
        }
        else if(!empty($pn) && $pn[0] != 0)
        {
    ?>
            <script> $("#e-phone").html("Please key in the correct format"); </script>
    <?php
        }

        else
        {
            $c2 = 1;
    ?>
            <script> $("#e-phone").html("&nbsp;"); </script>
    <?php	
        }

        if($c1 == 1 && $c2 == 1)
        {
            mysqli_query($connect, "UPDATE admin1 SET fullname = '$fn', gender = '$gd', phone_num = '$pn', street = '$add', state = '$st', city = '$ct', postal_code = '$pc', role = '$rl' WHERE admin_id = $id");
    ?>
            <script>$(".notification span").fadeIn().delay(2000).fadeOut();</script>
    <?php
        }
    }
    $row = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM admin1 WHERE admin_id = $id"));
?>

    <div class = "paragraph">
        <p class = "attribute">Fullname</p>
        <p class = "input"><input type="text" value = "<?php echo $row['fullname']?>" name = "fullname"></p>
        <p class = "error" id = "e-un"><i>&nbsp;</i></p>
    </div>
    <div class = "paragraph">
        <p class = "attribute">Gender</p>
        <p class = "input"><select name="gender">
                                <option></option>
                                <?php 
                                    $gender_name = array("Male", "Female");
                                    for($i = 0; $i < 2; $i++)
                                    {
                                        if($gender_name[$i] == $row["gender"])
                                            echo "<option selected>".$gender_name[$i]."</option>";
                                        else
                                            echo "<option>".$gender_name[$i]."</option>";
                                    }
                                ?>
                            </select>
        </p>
        <p class = "error" id = "e-name"><i>&nbsp;</i></p>
    </div>
    <div class = "paragraph">
        <p class = "attribute">Email</p>
        <p class = "input"><input type="email" value = "<?php echo $row['admin_email']?>" disabled><i class="lni lni-lock-alt"></i></p>
        <p class = "error"><i>&nbsp;</i></p>
    </div>
    <div class = "paragraph">
        <p class = "attribute">Phone Number</p>
        <p class = "input"><input type="tel" value = "<?php echo $row['phone_num']?>" name = "phone"></p>
        <p class = "error" id = "e-phone"><i>&nbsp;</i></p>
    </div>
    <div class = "paragraph">
        <p class = "attribute">Address</p>
        <p class = "input"><input type="text" value = "<?php echo $row['street']?>" name = "address"></p>
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
        <p class = "attribute">Role</p>
        <p class = "input"><select name="role">
                                <option></option>
                                <?php 
                                    $role_name = array("Super Admin", "Admin");
                                    for($i = 0; $i < 2; $i++)
                                    {
                                        if($role_name[$i] == $row["role"])
                                            echo "<option selected>".$role_name[$i]."</option>";
                                        else
                                            echo "<option>".$role_name[$i]."</option>";
                                    }
                                ?>
                            </select>
        </p>
        <p class = "error" id = "e-name"><i>&nbsp;</i></p>
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