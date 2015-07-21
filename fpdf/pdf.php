<?php
 
require('fpdf.php');

class PDF extends FPDF
{
   private $gettitle; 
    
  
    
// Load data
function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}
function mytitle($titles)
{
    $this->gettilte=$titles;
}
function Header()
{
    global $title;
    	
	$title = $this->gettilte;//'Master List';
	$this->SetTitle($title);
    $this->Image(SITE_CSSURL.'newadmin/img/Island-Peeps_Logo.png',10,8,30);  // change
    // Arial bold 15
    $this->SetFont('Arial','B',11);
    // Calculate width of title and position
    $w = $this->GetStringWidth($title)+8;  // change
    $this->SetX((200-$w)/2);
    // Colors of frame, background and text
    $this->SetDrawColor(0,80,180);
    $this->SetFillColor(230,230,0);
    $this->SetTextColor(220,50,50);
    // Thickness of frame (1 mm)
    $this->SetLineWidth(1);
    // Title
    $this->Cell($w,8,$title,1,1,'C',true);  // change
    // Line break
    $this->Ln(10);
 	
}

function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Text color in gray
    $this->SetTextColor(128);
    // Page number
    $this->Cell(0,8,'Page '.$this->PageNo(),0,0,'C');
}

 

// Colored table
function FancyTable($header, $data)
{
    // Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B',8);
    // Header
    $w = array(10, 30,20,20,25, 40,25,20);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],8,$header[$i],1,0,'C',true);
    $this->Ln();

    // Data
    $fill = false;
    foreach($data as $row)
    {
 
	if(floor($this->GetY()) == 274){
	   // Colors, line width and bold font
	    $this->SetFillColor(255,0,0);
	    $this->SetTextColor(255);
	    $this->SetDrawColor(128,0,0);
	    $this->SetLineWidth(.3);
	    $this->SetFont('','B',8);
	    // Header
	    $w = array(10, 30,20,20,25, 40,25,20);
	    for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],8,$header[$i],1,0,'C',true);
	    $this->Ln();
	}
	else{

	    // Color and font restoration
    	$this->SetFillColor(224,235,255);
    	$this->SetTextColor(0);
    	$this->SetFont('Arial','',8);

        $this->Cell($w[0],7,$row[0],'LR',0,'L',$fill);
        $this->Cell($w[1],7,$row[1],'LR',0,'L',$fill);
        $this->Cell($w[2],7,$row[2],'LR',0,'L',$fill);
        $this->Cell($w[3],7,$row[3],'LR',0,'L',$fill);
        $this->Cell($w[4],7,$row[4],'LR',0,'L',$fill);
        $this->Cell($w[5],7,$row[5],'LR',0,'L',$fill);
        $this->Cell($w[6],7,$row[6],'LR',0,'L',$fill);
        $this->Cell($w[7],7,$row[7],'LR',0,'L',$fill);
        $this->Ln();
        $fill = !$fill;
	}
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}
 function SuggestprofileTable($header, $data)
{
    // Colors, line width and bold font
    $this->SetFillColor(255,0,0);
    $this->SetTextColor(255);
    $this->SetDrawColor(128,0,0);
    $this->SetLineWidth(.3);
    $this->SetFont('','B',8);
    // Header
    $w = array(40, 60);
    for($i=0;$i<count($header);$i++)
        $this->Cell($w[$i],6,$header[$i],1,0,'C',true);
    $this->Ln();

    // Data
    $fill = false;
    foreach($data as $row)
    {
 
	if(floor($this->GetY()) == 274){
	   // Colors, line width and bold font
	    $this->SetFillColor(255,0,0);
	    $this->SetTextColor(255);
	    $this->SetDrawColor(128,0,0);
	    $this->SetLineWidth(.3);
	    $this->SetFont('','B',8);
	    // Header
	    $w = array(40, 60);
	    for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],6,$header[$i],1,0,'C',true);
	    $this->Ln();
	}
	else{

	    // Color and font restoration
    	$this->SetFillColor(224,235,255);
    	$this->SetTextColor(0);
    	$this->SetFont('Arial','',8);

        $this->Cell($w[0],7,$row[0],'LR',0,'C',$fill);
        $this->Cell($w[1],7,$row[1],'LR',0,'L',$fill);
       
       
        $this->Ln();
        $fill = !$fill;
	}
    }
    // Closing line
    $this->Cell(array_sum($w),0,'','T');
}
}
 
?>
