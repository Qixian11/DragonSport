<?php
include("../../Client/dataconnection.php");
$choice = $_POST["c"];
$page = $_POST["page"] * 39 - 39;
$page1 = $_POST["page"];
$content = $_POST["content"];
$limit = 39;

if($choice == 0 && empty($content))
{   
    $query = "SELECT * from product_entry inner join product on product.Shoes_ID = product_entry.product_id";
    $count = ceil(mysqli_num_rows(mysqli_query($connect,"select * from product_entry ")) / 39);
}
else if($choice == 1 || (!empty($content) && $choice != 2))
{
    $query = "SELECT * from product_entry inner join product on product.Shoes_ID = product_entry.product_id WHERE product.Shoes_Name LIKE '%$content%'";
    $count = ceil(mysqli_num_rows(mysqli_query($connect, "SELECT * from product_entry inner join product on product.Shoes_ID = product_entry.product_id WHERE Shoes_Name LIKE '%$content%'")) / 39);
}
else
{
    $id = $_POST["id"];
	$peid_result = mysqli_query($connect, "select ID from shoppingcart, product_entry where cart_product = ID and ID  = $id");
	if(mysqli_num_rows($peid_result) > 0)
	{
		$peid_result = mysqli_fetch_assoc($peid_result);
		$pe_id=$peid_result['ID'];
		mysqli_query($connect, "DELETE FROM shoppingcart WHERE cart_product = $pe_id");
	}
	mysqli_query($connect, "DELETE FROM product_entry WHERE ID = $id");

	?>  

    <script>
        alert('This  product has been deleted');
        $("input[type = 'search']").val("");
    </script>
<?php
    $query = "SELECT * FROM product_entry INNER JOIN product ON product.Shoes_ID = product_entry.product_id";
    $count = ceil(mysqli_num_rows(mysqli_query($connect, "SELECT * from product_entry inner join product on product.Shoes_ID = product_entry.product_id")) / 39);
}

$query .= " LIMIT $page, $limit";
$result = mysqli_query($connect, $query);
?>

<div class="tablerefresh" >
					<table >
						<tr >
							<th >ID</th>
							<th >PRODUCT ID</th>
							<th >SIZE ID</th> 
							<th >SHOES NAME</th>
							<th >BRANDS </th>
							<th >TYPES </th>
							<th >SHOES COLOR </td>
							<th >SHOES PRICE </td>
							<th >QUANTITY </th>
							<th >SHOES IMG</th> 
							<th >STATUS</th> 
							<th >ACTION</th>	
						</tr>
						<?php
						while($row = mysqli_fetch_assoc($result))
						{
						?>
						<tr class ="tablecontent">
							<td ><?php echo $row["ID"];?></td>
							<td ><?php echo $row["product_id"];?></td>
							<td  id = "size_id"><?php echo $row["size_id"];?></td>
							<td ><?php echo $row["Shoes_Name"];?></td>
							<td >
							<?php
								if($row["brands"]==1)
								{
									echo 'Adidas';
								}
								else if($row["brands"]==2)
								{
									echo'Nike';
								}
								else
								{
									echo'&nbsp';
								}
								?>
							</td>
							<td >
								<?php
									if($row["types"]==1)
									{
										echo 'Lifestyle';
									}
									elseif($row["types"]==2)
									{
										echo 'Running';
									}
									elseif($row["types"]==3)
									{
										echo 'Football';
									}
									elseif($row["types"]==4)
									{
										echo 'Tennis';
									}
									elseif($row["types"]==5)
									{
										echo 'Training';
									}
									else
									{
										echo'&nbsp';
									}
								?>
							</td>

							<td	><?php echo $row["Shoes_Color"];?></td>
							<td ><?php echo $row["Shoes_Price"];?></td>
							<td ><?php echo $row["qty"];?></td>
							<td ><?php echo '<img src = "data:image;base64,'.base64_encode($row['Shoes_IMG']).'" class = "product-tbimg" >'?></td>
							<td >
								<span class="productstatus" >
								<?php 
								if($row['qty']!=0)
								{
									echo "<i class='fa fa-check-circle' style='color:#32CD32;font-size:20px;'></i>";
								}
								else
								{
									echo "<i class='fa fa-exclamation-triangle' style='color:#FF0000;font-size:20px;'></i>";
								}	
								?>

								</span><input type="hidden" value ="<?php echo $row["ID"];?>">
							</td>
							<td><span class="actionfucntion"  >&nbsp;</span><input type="hidden" value ="<?php echo $row["ID"];?>"></td>
						</tr>
						<?php 
						}
						?>
					</table>
					
					<div class = "page">
					<?php
						if($page1 > 3 && $page1 <= $count-2)
						{
							for($i = $page1-2; $i < $page1+3; $i++)
							{
					?>
								<button value = "<?php echo $i?>"><?php echo $i?></button>
					<?php
							}
						}
						else if($page1+1 >= $count)
						{
							for($i = $count - 4; $i <= $count; $i++)
							{
					?>
								<button value = "<?php echo $i?>"><?php echo $i?></button>
					<?php
							}

						}
						else
						{
							for($i = 0; $i < 5; $i++)
							{
							?>
							<button value = "<?php echo $i+1?>"><?php echo $i+1?></button>
							<?php
							}
						}
					?>	
					</div>
						
					
				</div>

<script>
//edit and delete
if(localStorage.getItem("edit_and_delete") == 0)
    $(".actionfucntion").html("<button><i class='lnr lnr-pencil' style='color:#2B60DE'></i></button>");
else if(localStorage.getItem("edit_and_delete") == 1)
    $(".actionfucntion").html("<button><i class='lnr lnr-trash' style='color:#d11a2a;'></i></button>");
else
    $(".actionfucntion").html("");
    
</script>