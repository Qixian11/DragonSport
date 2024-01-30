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

        $sqty = $_POST["sqty"];
 
        $c1=0;
               
        if($sqty==NULL)
        {
        ?>
            <script>$("#e-qty").html("This field cannot be empty");</script>
        <?php
        }
        else if($sqty>10)
        {
            ?>
                <script>$("#e-qty").html("This value more than 10");</script>
            <?php
            }
        else
        {
            
            $c1=1;

        }

        if( $c1 == 1 )
        {
            mysqli_query($connect, "UPDATE product_entry SET qty = '$sqty' where ID = '$id' ");
        ?>  
            <script>$(".notification span").fadeIn().delay(2000).fadeOut(); </script>
        <?php    
        }
    
           
    }

    $row= mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM product_entry inner join product on product.Shoes_ID= product_entry.product_id WHERE ID = $id"));

?>

    <div class = "paragraph">
        <p class = "attribute">Shoes Name</p>
        <p class = "input"><input type="hidden" READONLY value = "<?php echo $row['product_id']?>"><input type="text" READONLY value = "<?php echo $row['Shoes_Name']?>" name = "proid"></p>
        <p class = "error" ><i>&nbsp;</i></p>
    </div>
    <div class = "paragraph">
        <p class = "attribute">Size ID</p>
        <p class = "input">   
            <input type="text" READONLY value="<?php echo $row['size_id']?>" name="szid"> 
        </p>
        <p class = "error" id = "e-szid"><i>&nbsp;</i></p>
    </div>
    <div class = "paragraph">
        <p class = "attribute">Shoes Quantity</p>
        <p class = "input"><input type="number" value = "<?php echo $row['qty']?>" name="sqty" ></p>
        <p class = "error" id="e-qty"><i>&nbsp;</i></p>
    </div>
    <div>
        <p class = "notification">&nbsp;<span>Saved</span></p>
    </div>
    
<?php
}
?>