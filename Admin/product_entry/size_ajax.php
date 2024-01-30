<?php
include("../../Client/dataconnection.php");

$c=$_POST["c"];

if($c==0)
{
	$id=$_POST['id'];
	$size=$_POST["size"];
    if(empty($size))
    {
    ?>    
        <script>alert("This cannot be empty")</script>
    <?php    
    }
    else if(!is_numeric($size))
    {
    ?>    
     <script>alert("This cannot be charater")</script>
    <?php 
    }
	else if(mysqli_num_rows(mysqli_query($connect,"Select * FROM product_size where Size = '$size'"))>=1)
    {
    ?>    
     <script>alert("This size already exits")</script>
    <?php 
    }
    else
    {
        mysqli_query($connect,"UPDATE product_size SET Size='$size' where Size_ID='$id'");  
		?>    
		<script>alert("This update sucessfully !")</script>
	   <?php   
    }
}
else if($c==1)
{
	$size=$_POST["size"];

	if(empty($size))
    {
    ?>    
        <script>alert("This cannot be empty")</script>
    <?php    
	}
	else if(!is_numeric($size))
    {
    ?>    
        <script>alert("This cannot be charater")</script>
    <?php 
    }

    else
    {
        mysqli_query($connect,"INSERT INTO product_size (Size) VALUES ('$size')");   
		echo "<script>alert('This size had been added');</script>"; 
    }
}
else if($c=2)
{
	$id=$_POST['id'];
	echo "<script>alert('This size had been deleted');</script>";

	mysqli_query($connect,"DELETE FROM product_size where Size_ID=$id");
}

?>

<div class="sizetable" >
			
				<table>
					<tr class="sione" >
						<th class="sicone" >SIZE ID</th>
						<?php
						$dissize=mysqli_query($connect,"SELECT * FROM  product_size");
						while($row=mysqli_fetch_assoc($dissize))
						{
						?>
						<td  class="sictwo" contenteditable='true'><?php echo $row['Size_ID']?></td>
						<?php
						}
						?>	
					</tr>	
					<tr class="sitwo">
						<th>SIZE</th>
						<?php
						$dissize=mysqli_query($connect,"SELECT * FROM  product_size");
						while($row=mysqli_fetch_assoc($dissize))
						{
						?>
						<td class = "testtt" contenteditable='true' ><?php echo $row['Size']?><input type="hidden" value="<?php echo $row['Size_ID']?>"></td>
						<?php
						}
						?>	
					</tr> 
					<tr>
						<th>ACTION</th>
						<?php
						$dissize=mysqli_query($connect,"SELECT * FROM  product_size");
						while($row=mysqli_fetch_assoc($dissize))
						{
						?>
						<td ><span class="actsifunction" >&nbsp</span><input type="hidden" value ="<?php echo $row["Size_ID"];?>"></td>
						<?php
						}
						?>
				</table>
		
		</div>