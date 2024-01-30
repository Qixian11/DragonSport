
<?php
include("dataconnection.php");

session_start();
//Invoice
require('../PDF/fpdf.php');
$odid=$_GET['odid'];
$result=mysqli_query($connect,"SELECT * FROM orders,user WHERE orders.user_id = user.user_id AND orders.orders_id = $odid" );
$row=mysqli_fetch_assoc($result);
//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Image('banner/logoblack.png',10,10,-300);
$pdf->Cell(85 ,50,'',0,0);
$pdf->SetFont('Arial','B',18);
$pdf->Cell(100 ,5,'Invoice',0,0);
$pdf->Cell(100 ,50,'',0,1);

//set font to arial, regular, 12pt
$pdf->SetFont('Arial','',12);

$pdf->Cell(130	,5,'Jalan PJS 11/20,',0,0);
$pdf->SetFont('Arial','B',18);
$pdf->Cell(35	,5,'Details',0,0);
$pdf->Cell(59	,5,'',0,1);//end of line


$pdf->SetFont('Arial','',12);
$pdf->Cell(130	,5,'Bandar Sunway,',0,0);
$today = date("Y-m-d");
$pdf->Cell(35	,5,'Date:',0,0);
$pdf->Cell(34	,5,$today,0,1);//end of line

$pdf->Cell(130	,5,'47500, Subang Jaya, Selangor',0,0);
$pdf->Cell(35	,5,'Order Id : ',0,0);
$pdf->Cell(34	,5,$row['orders_id'],0,1);//end of line

$pdf->Cell(130	,5,'+6075325648',0,0);
$pdf->Cell(35	,5,'Customer Name : ',0,0);
$cid=mysqli_query($connect,"SELECT * FROM orders,user WHERE orders.user_id = user.user_id AND orders.orders_id = $odid" );
$cust_id=mysqli_fetch_assoc($cid);
$cusid=$cust_id['user_id'];
$cusemail=$cust_id['user_email'];

$pdf->Cell(34	,5,$cust_id['user_name'],0,1);//end of line

$pdf->Cell(130	,5,'dragonsport159@gmail.com',0,0);
//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//display booking time and date
$pdf->Cell(35	,5,'Purchase Date : ',0,0);
$pdf->Cell(34	,5,$row['purchase_date'],0,1);//end of line

//make a dummy empty cell as a vertical spacer
$pdf->Cell(189	,10,'',0,1);//end of line

//invoice contents
$pdf->SetFont('Arial','B',12);

$pdf->Cell(111 ,6,'Items',1,0,'C');
$pdf->Cell(23 ,6,'Quantity',1,0,'C');
$pdf->Cell(35 ,6,'Items Price(RM)',1,0,'C');
$pdf->Cell(25 ,6,'Total(RM)',1,1,'C');/*end of line*/
$pdf->SetFont('Arial','',12);

$total=0;
$subtotal=0;
$result2=mysqli_query($connect,"SELECT orders_detail.qty as os_qty, Shoes_price, total, grand_total, Shoes_Name, Shoes_Price FROM orders, orders_detail, product, product_entry WHERE orders_id = order_id AND orders_id = $odid AND user_id =$cusid  AND order_product = ID AND product_id = Shoes_ID");

while($row2=mysqli_fetch_assoc($result2))
{
        $quantity=$row2['os_qty'];
        $price=$row2['Shoes_Price'];
        $total=$row2['total'];
        $subtotal +=$total;
        
        $gtotal=$row2["grand_total"];
      
        $pdf->Cell(111	,5,$row2['Shoes_Name'],1,0);
        $pdf->Cell(23	,5,$quantity,1,0);
        $pdf->Cell(35	,5,$row2['Shoes_Price'],1,0);
        $pdf->Cell(25	,5,number_format($total,2),1,1,'R');//end of line
}

$pdf->SetFont('Arial','B',12);
$pdf->Cell(169	,5,'Subtotal',1,0);
$pdf->Cell(25	,5,number_format($subtotal,2),1,1,'R');//end of line
$pdf->Cell(169	,5,'Tax',1,0);
$pdf->Cell(25	,5,'6%',1,1,'R');//end of line
$pdf->Cell(169	,5,'Shipping fee',1,0);
$pdf->Cell(25	,5,' 5.00',1,1,'R');//end of line
$pdf->Cell(169	,5,'Grand Total',1,0);
$pdf->Cell(25	,5,$row['grand_total'],1,1,'R');//end of line
$pdf->Cell(136  ,7,'***  This is computer generate INVOICE and requires no signature.  ***',0,0,'C');
//Numbers are right-aligned so we give 'R' after new line parameter


//Start Email
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

$customer=mysqli_query($connect,"SELECT * FROM orders,user WHERE orders.user_id = user.user_id AND orders.orders_id = $odid" );
$cust=mysqli_fetch_assoc($customer);
$cname=$cust["user_name"];


$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";

$mail->SMTPDebug  = 0;  
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = 587;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "dragonsport159@gmail.com";
$mail->Password   = "abcd123~";

$mail->IsHTML(true);
$mail->AddAddress($cust['user_email'],$cust['user_name']);
$mail->SetFrom("dragonsport159@gmail.com", "DRAGONSPORT SDN BHD");
$mail->AddReplyTo("dragonsport159@gmail.com", "DRAGONSPORT SDN BHD");
$mail->Subject = "Order Received | DRAGONSPORT SDN BHD";
$attachment= $pdf->Output('attachment.pdf', 'S');
$mail->AddStringAttachment($attachment, 'invoice.pdf');


$content = "Dear ".$cname.", We've received your orders. Attached is your invoice. <br> <b>Thank You.</b> <br> <small>DRAGONSPORT,Simplicity is the ultimate sophistication. </small>";
$headers='MINE-Version: 1.0'."\r\n".
         'Content-Type: text/html; charset=utf-8';

$mail->MsgHTML($content); 


if(!$mail->Send())
{

}
else
{
    $odid=$_GET['odid'];
}
?>
<script>
alert("Invoice already send to your email please Check!");
</script>
<?php
echo "<script>location.href = 'payment_successful.php'</script>";

?>