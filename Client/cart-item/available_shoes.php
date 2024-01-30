<?php
include("../dataconnection.php");
$id = $_POST["id"];
$size = $_POST["s"];

$result = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM product_entry WHERE product_id = $id AND size_id = $size"));
$qty = $result["qty"];
?>

<option disabled selected value>QTY</option>
<?php
    for($i = 1; $i <= $qty; $i++)
    {
?>
        <option value = "<?php echo $i?>"><?php echo $i?></option>
<?php
    }
?>