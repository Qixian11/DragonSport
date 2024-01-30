<?php
include("../../Client/dataconnection.php");
$choice = $_POST["c"];
$page = $_POST["page"] * 8 - 8;
$content = $_POST["content"];
$limit = 8;


if($choice == 0 && empty($content))
{   
    $query = "SELECT * FROM product inner join category_brands on category_brands.brands_id =  product.brands inner join category_types on category_types.types_id = product.types order by Shoes_ID ";
    $count = ceil(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM product inner join category_brands on category_brands.brands_id =  product.brands inner join category_types on category_types.types_id = product.types order by Shoes_ID ")) / 8);
}
else if($choice == 1 || (!empty($content) && $choice != 2))
{
    $query = "SELECT * FROM product inner join category_brands on category_brands.brands_id =  product.brands inner join category_types on category_types.types_id = product.types WHERE Shoes_Name LIKE '%$content%' order by Shoes_ID ";
	$count = ceil(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM product inner join category_brands on category_brands.brands_id =  product.brands inner join category_types on category_types.types_id = product.types WHERE Shoes_ID LIKE '%$content%' order by Shoes_ID ")) / 8);
	
}
else
{
    $id = $_POST["id"];
	$peid_result = mysqli_query($connect, "select ID from shoppingcart, product_entry, product where cart_product = ID and Shoes_ID = product_id and Shoes_ID = $id");
	if(mysqli_num_rows($peid_result) > 0)
	{
		$peid_result = mysqli_fetch_assoc($peid_result);
		$pe_id=$peid_result['ID'];
		mysqli_query($connect, "DELETE FROM shoppingcart WHERE cart_product = $pe_id");
	}
	
	mysqli_query($connect, "DELETE FROM wishlist WHERE shoes_id = $id");
	mysqli_query($connect, "DELETE FROM product_entry WHERE product_id = $id");
	mysqli_query($connect, "DELETE FROM product WHERE Shoes_ID = $id ");

     echo "
	 <script>
	 	alert('This product has been deleted');
	 </script>";
    $query = "SELECT * FROM product inner join category_brands on category_brands.brands_id =  product.brands inner join category_types on category_types.types_id = product.types order by Shoes_ID";
    $count = ceil(mysqli_num_rows(mysqli_query($connect, "Select * from product, category_brands, category_types where brands = brands_id and types = types_id  order by Shoes_ID ")) / 8);
}

$query .= " LIMIT $page, $limit";
$result = mysqli_query($connect, $query);

?>

				<div class="tablerefresh" >
					<table > 
					<tr>
						<th >SHOES ID</th>
						<th >SHOES NAME</th>
						<th >SHOES BRANDS</th>
						<th >SHOES TYPES </th>
						<th >SHOES COLOR </th>
						<th >SHOES PRICE </th>
						<th >SHOES IMG   </th>
						<th >SHOES DESCRIPTION</th> 
						<th>Action</th>	
					</tr>
			
					<?php
					while($row=mysqli_fetch_assoc($result))
					{
				?>
					<tr id="data">
						<td ><?php echo $row["Shoes_ID"];?></td>
						<td ><?php echo $row["Shoes_Name"];?></td>
						<td ><?php echo $row["brands_name"];?></td>
						<td ><?php echo $row["types_name"];?> </td>
						<td ><?php echo $row["Shoes_Color"];?></td>
						<td	><?php echo $row["Shoes_Price"];?></td>
						<td ><?php echo '<img src = "data:image;base64,'.base64_encode($row['Shoes_IMG']).'" class = "product-tbimg" >'?></td>
						<td ><div  class="shdec "><?php echo $row["Shoes_Description"];?></div></td>
						<td><span class="actionfucntion" >&nbsp;</span><input type="hidden" value ="<?php echo $row["Shoes_ID"];?>" ></td>
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
			

<script>
//edit and delete
if(localStorage.getItem("edit_and_delete") == 0)
    $(".actionfucntion").html("<button><i class='lnr lnr-pencil style='color:#2B60DE'></i></button>");
else if(localStorage.getItem("edit_and_delete") == 1)
    $(".actionfucntion").html("<button><i class='lnr lnr-trash' style='color:#d11a2a;'></i></button>");
else
    $(".actionfucntion").html("");

</script>