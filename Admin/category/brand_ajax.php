<?php
include("../../Client/dataconnection.php");
$choice = $_POST["c"];
$page = $_POST["p"];
$limit = 8;
$start_from = ($page-1) * 8;

if($choice == 0)
{
    $brand = $_POST["b"];

    if(!empty($brand))
    {
            mysqli_query($connect, "INSERT INTO category_brands (brands_name) VALUES ('$brand')");
?>
        <script>
            $("#brand-modal").css({"visibility":"hidden", "opacity":"0"});
            $("#brand-modal input[type = 'text']").val("");
        </script>
<?php
    }
    else
    {
?>
    <script>$("#b-error").html("This field cannot be empty");</script>
<?php
    }
}
else if($choice == 1)
{
    $id = $_POST["id"];
    $brand = $_POST["b"];

    mysqli_query($connect, "UPDATE category_brands SET brands_name = '$brand' WHERE brands_id = $id");
?>
    <button class = "edit"><i class="far fa-edit"></i></button>
    <button class = "delete"><i class="far fa-trash-alt"></i></button>
<?php
    exit();
}
else if($choice == 2)
{
    $id = $_POST["id"];

    mysqli_query($connect, "DELETE FROM category_brands WHERE brands_id = $id");
}

$brands_result = mysqli_query($connect, "SELECT * FROM category_brands LIMIT $start_from, $limit"); //query for display shoes
$total_page = ceil(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM category_brands")) / 8);//for page
?>

<!--HTML PART-->
<table>
    <tr>
        <th>ID</th>
        <th>Brands Name</th>
        <th>Action</th>
    </tr>
    <?php
    while($brands_rows = mysqli_fetch_assoc($brands_result))
    {
    ?>
    <tr>
        <td class = "id"><?php echo $brands_rows["brands_id"]?></td>
        <td class = "brands_name"><?php echo $brands_rows["brands_name"]?></td>
        <td class = "action">
            <button class = "edit"><i class="far fa-edit"></i></button>
            <button class = "delete"><i class="far fa-trash-alt"></i></button>
        </td>
    </tr>
    <?php
    }
    ?>
</table>
<div class = "page">
    <?php
    if($total_page > 5)
    {
        if($page+2 >= $total_page)
        {
            for($i = $total_page - 4; $i <= $total_page; $i++)
            {
            ?>
                <div><button value = "<?php echo $i?>"><?php echo $i?></button></div>
            <?php
            }
        }
        else if($page > 3)
        {
            for($i = $page-2; $i <= $page + 2; $i++)
            {
            ?>
                <div><button value = "<?php echo $i?>"><?php echo $i?></button></div>
            <?php
            }
        }
        else
        {
            for($i = 1; $i <= 5; $i++)
            {
            ?>
                <div><button value = "<?php echo $i?>"><?php echo $i?></button></div>
            <?php
            }
        }
    }
    else
    {
        for($i = 1; $i <= $total_page; $i++)
        {
        ?>
            <div><button value = "<?php echo $i?>"><?php echo $i?></button></div>
        <?php
        }
    }
    ?>
</div>