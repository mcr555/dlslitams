<?php
require('fpdf.php');
require('../conn.php');
date_default_timezone_set("Asia/Manila");

class PDF extends FPDF
{

	//Page header
	function Header()
	{

	}

	//Page footer
	function Footer()
	{

	}
}
	
	//Instanciation of inherited class
	//Instanciation of inherited class
	$pdf=new PDF('P','mm','A4');
	$pdf->AliasNbPages();
	$pdf->AddPage();
	// Adds image to beginning of d

		$db = mysql_connect('localhost', 'root','');
		mysql_select_db('dbstudent');
		$query=mysql_query("select * from tbl1 where fld_sn='".$_GET['id']."' order by fld_sn");
		while($row=mysql_fetch_array($query))
		{
		$pdf->SetFont('arial','b',20);
		$pdf->Ln(10);$pdf->Cell(0,0,'Student Information',0,0,'L');
		$pdf->SetFont('arial','b',10);
		$pdf->Ln(10);
		//$pdf->Image($row['picture'],9.5,8,13);
		$pdf->Ln(10);$pdf->Cell(0,0,'Student number: '.str_pad($row['fld_sn'],5,"0",STR_PAD_LEFT),0,0,'L');
		$pdf->Ln(10);$pdf->Cell(0,0,'Last name: '.$row['fld_ln'],0,0,'L');
		$pdf->Ln(10);$pdf->Cell(0,0,'First name: '.$row['fld_fn'],0,0,'L');
		}

	$pdf->Output();
?>