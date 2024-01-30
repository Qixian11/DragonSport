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
else
{
    $id = $_POST["id"];
    mysqli_query($connect, "DELETE FROM admin1 WHERE admin_id = $id");
?>  
    <script>
        alert('This staff has been deleted');
        $("input[type = 'search']").val("");
    </script>
<?php
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
            <th>Action</th>
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
            <td><span class = "operation">&nbsp;</span><input type="hidden" value = "<?php echo $row['admin_id']?>"></td>
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