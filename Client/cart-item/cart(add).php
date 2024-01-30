<?php
include("../dataconnection.php");
session_start();
$user_id = $_SESSION["userid"];
$choice = $_POST["c"];
$valid_notificaiton = 0;

if($choice == 0)
{
    $cart_id = $_POST["cartid"];

    mysqli_query($connect, "DELETE FROM shoppingcart WHERE cart_id = $cart_id");
}
else if($choice == 1)
{
    $id = $_POST["sid"];
    $size = $_POST["size"];
    $price = $_POST["price"];
    $qty = $_POST["qty"];
    $sizename = $_POST["sizename"];
    
    //find product entry ID
    $pe_id_result = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM product_entry WHERE product_id = $id AND size_id = $size"));
    $pe_id = $pe_id_result['ID'];

    //check the same product
    $check_same_product_result = mysqli_query($connect, "SELECT * FROM shoppingcart WHERE cart_user = $user_id AND cart_product = $pe_id");

    if(mysqli_num_rows($check_same_product_result) > 0)
    {
        $check_same_product = mysqli_fetch_assoc($check_same_product_result);

        $new_qty = $check_same_product["quantity"] + $qty;
        $new_price = ($price / $qty) * $new_qty;

        if($new_qty > $pe_id_result["qty"])
            echo "<script>alert('Sorry, your quantity is exceeded our stock')</script>";  
        else
        {
            mysqli_query($connect, "UPDATE shoppingcart SET quantity = $new_qty, total_price = $new_price WHERE cart_product = $pe_id");
            $valid_notificaiton = 1;
        }
    }
    else
    {
        mysqli_query($connect, "INSERT INTO shoppingcart (cart_product, cart_user, quantity, total_price) VALUES ('$pe_id', '$user_id', '$qty', '$price')");
        $valid_notificaiton = 1;
    }

    //to display notidication if update or insert successfully
    if($valid_notificaiton == 1)
    {
       echo "<script>
            $('.addcart_notification').css('right', '0');
            $('.notification-size').html('Size : $sizename');
            $('.notification-qty').html('x$qty');
            setTimeout(function()
            {
                $('.addcart_notification').css('right', '-20vw');
            },5000);
        </script>";
    }
}

else if($choice == 2)
{
    $pe_id = $_POST["pe_id"];
    $qty = $_POST["qty"];
    $total = $_POST["total"];

    mysqli_query($connect, "UPDATE shoppingcart SET quantity = $qty, total_price = $total WHERE cart_user = $user_id AND cart_product = $pe_id");
}

$countcart =mysqli_num_rows(mysqli_query($connect, "SELECT * FROM shoppingcart WHERE cart_user = $user_id"));
if($countcart == 0)
{
?>
    <script>$(".cartcount").css("display","none");</script>
<?php
}
else
{
?>
    <script>
        $(".cartcount").css("display","initial");
    </script>
<?php
    echo $countcart;
}
?>