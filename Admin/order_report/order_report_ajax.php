<?php
include("../../Client/dataconnection.php");
$page = $_POST["page"] * 12 - 12;
$content = $_POST["content"];
$limit = 12;


if(empty($content))
{   
    $query = "SELECT * FROM orders INNER JOIN user ON user.user_id=orders.user_id ";
    $count = ceil(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM orders INNER JOIN user ON user.user_id=orders.user_id ")) / 12);
}
else
{
    $query = "SELECT * FROM orders  INNER JOIN user ON user.user_id=orders.user_id  WHERE user.user_name LIKE '%$content%'";
	$count = ceil(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM orders INNER JOIN user ON user.user_id=orders.user_id  WHERE user.user_name LIKE '%$content%'")) / 12);
	
}
$query .= " LIMIT $page, $limit";
$result = mysqli_query($connect, $query);

?>

                <div class="table">
                    <table >
							<tr id="head">
								<th>ORDER ID</th>
								<th>USER ID</th>
								<th>USER NAME</th>
								<th>PURCHASE DATE</th>
								<th>GRAND TOTAL</th>
								<th>ACTION</th>
							</tr>
							<?php
								
							while($row=mysqli_fetch_assoc($result))
							{
							?> 
								<tr id="content">
									<td><?php echo $row["orders_id"]?></td>
									<td><?php echo $row["user_id"]?></td>
									<td><?php echo $row["user_name"]?></td>
									<td><?php echo $row["purchase_date"]?></td>
									<td><?php echo $row["grand_total"]?></td>
									<td> <a href="emailinvoice.php?odid= <?php echo $row["orders_id"]?>"><i class="fa fa-download" aria-hidden="true" style="font-size:15px;color:rgb(231, 28, 69);"></i> </a></td>
								</tr>
							<?php 
							}
							?>
					</table>
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
				</div>	
                </div>
			