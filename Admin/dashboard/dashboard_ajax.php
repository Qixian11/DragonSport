<?php
include("../../Client/dataconnection.php");
$choice = $_POST["choice"];
$page = $_POST["page"];
$limit = 5;
$start_from = ($page-1) * 5;

if($choice == 1)
{
    $id = $_POST["id"];
    
    mysqli_query($connect, "UPDATE contact SET Status = 'Seen' WHERE ID = $id");
}
else if($choice == 2)
{
    $id = $_POST["id"];

    mysqli_query($connect, "DELETE FROM contact WHERE ID = $id");
}
else if($choice == 3)
{
    $id = $_POST["id"];
    $email = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM contact WHERE ID = $id"));
    $to = $email["user_email"];
    $subject = $email["user_subject"];
    $message = $_POST["message"];
    $header = "From: dragonsport159@gmail.com";

    if(mail($to, $subject, $message, $header))
    {
?>
        <script>alert("Message has been sent out");</script>
<?php
    }
    else
    {
?>
        <script>alert("Fail to send");</script>
<?php
    }
}

$count_unseen = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM contact WHERE Status = 'Unseen'"));
$total_page = ceil(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM contact")) / 5);
$result = mysqli_query($connect, "SELECT * FROM contact ORDER BY ID DESC LIMIT $start_from, $limit");
?>
<h3>Messages
    <?php
    if($count_unseen > 0)
        echo "<label>".$count_unseen."</label>";    
    ?>
</h3>
<hr>
<div class = "message-content">
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Date</th>
            <th>Time</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <script>let message = [], name = [], subject = [];</script>
        <?php
            while($row = mysqli_fetch_assoc($result))
            {
        ?>
            <tr>
                <td><?php echo $row["user_name"]?></td>
                <td><?php echo $row["user_email"]?></td>
                <td><?php echo $row["Date"]?></td>
                <td><?php echo $row["Time"]?></td>
                <td><?php echo $row["Status"]?></td>
                <td>
                    <button value = "<?php echo $row["ID"]?>" class = "view">Reply</button>
                    <input type="hidden" value = "<?php echo $row['ID']?>">
                    <button class = "delete">Delete</button>
                </td>
                <script>
                    message[<?php echo $row["ID"]?>] = "<?php echo $row['user_message']?>";
                    name[<?php echo $row["ID"]?>] = "<?php echo $row['user_name']?>";
                    subject[<?php echo $row["ID"]?>] = "<?php echo $row['user_subject']?>"; 
                </script>
            </tr>
        <?php
            }
        ?>
    </table>
    <div class = "pagination">
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
</div>