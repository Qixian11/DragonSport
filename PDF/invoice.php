<?php
require('../PDF/fpdf182/fpdf.php');

//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

$pdf = new FPDF('P','mm','A4');

$pdf->AddPage();

//set font to arial, bold, 14pt
$pdf->SetFont('Arial','B',14);

//Cell(width , height , text , border , end line , [align] )

$pdf->Cell(130 ,5,'',10);
$pdf->Image('../banner/logo.png',10,10,-300);
$pdf->Cell(85 ,50,'',0,0);
$pdf->SetFont('Arial','B',18);
$pdf->Cell(100 ,5,'Invoice',0,0);
$pdf->Cell(100 ,50,'',0,1);

?>
