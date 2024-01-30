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
else
{
    $id = $_POST["id"];
    mysqli_query($connect, "DELETE FROM wishlist WHERE user_id = $id");
    mysqli_query($connect, "DELETE FROM shoppingcart WHERE cart_user = $id");
    mysqli_query($connect, "DELETE FROM user WHERE user_id = $id");
?>  
    <script>
        alert('This user has been deleted');
        $("input[type = 'search']").val("");
    </script>
<?php
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
            <th>Status</th>
            <th>Action</th>
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
            <td>
                <?php 
                if($row["Status"] == "Active")
                    echo "<i class='lni lni-checkmark-circle' style = 'color:green;font-size:1.4vw;'></i>";
                else
                    echo "<i class='lni lni-ban' style = 'color:red;font-size:1.4vw;'></i>";
                ?>
            </td>
            <td><span class = "operation">&nbsp;</span><input type="hidden" value = "<?php echo $row['user_id']?>"></td></td>
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

<script>
//edit and delete
if(localStorage.getItem("edit_and_delete") == 0)
    $(".operation").html("<button><i class='far fa-edit'></i></button>");
else if(localStorage.getItem("edit_and_delete") == 1)
    $(".operation").html("<button><i class='far fa-trash-alt'></i></button>");
else
    $(".operation").html("");
    
</script>