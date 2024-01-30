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
        $sn = $_POST["shoesname"];
        $sb = $_POST["shoesbrands"];
        $st = $_POST["shoestypes"];
        $sc = $_POST["shoescolor"];
        $sp = $_POST["shoesprice"];
        $sd = $_POST["sd"];
        
        $name = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM product WHERE Shoes_ID = $id"));
        if(empty($sn))
		{
		?>	
            <script>$("#e-sn").html("This field cannot be empty");</script>
        <?php
        }
        else if($sn == $name["Shoes_Name"])
        {
            
        ?>
            <script>$("#e-sn").html("&nbsp;");</script>
        <?php
        }
        else if(mysqli_num_rows(mysqli_query($connect, "SELECT * FROM product WHERE Shoes_Name = '$sn'")) > 0)
        {
        ?>
            <script>$("#e-sn").html("This Product Name already exist");</script>
        <?php
        }
        else
        {  
        ?>
            <script>
                $("#e-sn").html("&nbsp;");
            </script>
    <?php	
        }

        $sd = str_replace("'", "''", $sd);
         if(!empty($_FILES["file"]["tmp_name"]))
         {
             $file = $_FILES["file"]["tmp_name"];
             $image = addslashes(file_get_contents($file));
             mysqli_query($connect, "UPDATE product SET Shoes_Name='$sn', brands='$sb',types='$st', Shoes_Color ='$sc',Shoes_Price='$sp', Shoes_IMG = '$image', Shoes_Description='$sd' WHERE Shoes_ID = $id");
         }
         else
         mysqli_query($connect, "UPDATE product SET Shoes_Name='$sn', brands='$sb',types='$st', Shoes_Color ='$sc',Shoes_Price='$sp', Shoes_Description='$sd' WHERE Shoes_ID = $id");
    
    ?>
        <script>$(".notification span").fadeIn().delay(2000).fadeOut();</script>

    <?php
		
    }
    $row = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM product inner join category_brands on category_brands.brands_id =  product.brands inner join category_types on category_types.types_id = product.types WHERE Shoes_ID = $id"));
  
?>
    <form action="post" id = "form">
    <div class = "paragraph">
        <p class = "attribute">Shoes Name</p>
        <p class = "input"><input type='text' value = "<?php echo $row['Shoes_Name']?>" name = "shoesname"></p>
        <p class = "error" id = "e-sn"><i>&nbsp;</i></p>
    </div>
    <div class = "paragraph">
        <p class = "attribute">Shoes Brands</p>
        <p class = "input">
			<select name = "shoesbrands">
                <option selected  value = "<?php echo $row['brands_id']?>"><?php echo $row["brands_name"]?></option>
                <option value="1">Adidas</option>   
                <option value="2">Nike</option>
                
			</select>
			
		</p>
		<p class = "error"><i>&nbsp;</i></p>		
    </div>
    <div class = "paragraph">
        <p class = "attribute">Shoes Types</p>
        <p class = "input">
			<select name = "shoestypes">
                <option selected value = "<?php echo $row['types_id']?>"><?php echo $row["types_name"]?></option>
				<option value="1">Lifestyle</option>
				<option value="2">Running</option>
				<option value="3">Football</option>
				<option value="4">Tennis</option>
				<option value="5">Training</option>
			</select>	
		</p>
		<p class = "error"><i>&nbsp;</i></p>
    </div>
    <div class = "paragraph">
        <p class = "attribute">Shoes Color</p>
        <p class = "input"><input type="text" value = "<?php echo $row['Shoes_Color']?>" name = "shoescolor"></p>
        <p class = "error" ><i>&nbsp;</i></p>
    </div>
    <div class = "paragraph">
        <p class = "attribute">Shoes Price</p>
        <p class = "input"><input type="number" value = "<?php echo $row['Shoes_Price']?>" name = "shoesprice"></p>
        <p class = "error"><i>&nbsp;</i></p>
    </div>
    <div class = "paragraph">
        <p class = "attribute">Shoes Image</p>
        <p class = "input" style="display:inline-block;"><input type="file" value= "$row['Shoes_IMG']" name = "file"> </p>
		<p style="display: inline-block;margin-left:50px;"><?php echo '<img src = "data:image;base64,'.base64_encode($row['Shoes_IMG']).'" style = "width:140px;height:70px;" >'?></p>
        <p class = "error"><i>&nbsp;</i></p>
    </div>
    <div class = "paragraph">
        <p class = "attribute">Shoes Description</p>
        <p class = "input"><textarea style="width:38vw; height:10vh;resize:none;" name="sd"  ><?php echo $row['Shoes_Description']?></textarea>
        <p class = "error"><i>&nbsp;</i></p>
    </div>
    <div>
        <p class = "notification">&nbsp;<span>Saved</span></p>
    </div>
    </form>
<?php
}
?>