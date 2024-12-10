<?php
require('fpdf.php');

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        global $title, $subtitle;
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Calculate width of title and position
        $w = $this->GetStringWidth($title)+6;
        $this->SetX((210-$w)/2);
        // Colors of frame, background and text
        $this->SetDrawColor(103, 132, 65);
        $this->SetFillColor(103, 133, 64);
        $this->SetTextColor(245, 247, 241);
        // Thickness of frame (1 mm)
        $this->SetLineWidth(1);
        // Title
        $this->Cell($w,9,$title,1,1,'C',true);
        // Subtitle
        $this->SetFont('Arial', 'I', 10); // Italic, size 10
        $this->SetTextColor(0); // Reset text color
        $this->Cell(0, 6, $subtitle, 0, 1, 'C');
        // Line break
        $this->Ln(5);    
        //buat garis horisontal
        $this->SetDrawColor(103, 132, 65);
        $this->SetLineWidth(0.8);
        $this->Line(10, $this->GetY(), $this->GetPageWidth() - 10, $this->GetY());
        // Line break
        $this->Ln(5);  
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        //buat garis horizontal
        $this->Line(10,$this->GetY(),200,$this->GetY());
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    // Load data
    function LoadDataFromDatabase()
    {
        include 'db.php';
    
        // Check the connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
    
        $data = array();

        // Menangkap parameter NIP dari URL
        $nip = isset($_GET['nip']) ? $_GET['nip'] : '';
    
        // Fetch data from the database
        $result = $conn->query("SELECT NIP, Nama, Alamat, Tanggal_lahir, Kode_Divisi FROM tblpegawai WHERE NIP = '$nip'");
    
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    
        // Close the database connection
        $conn->close();
    
        return $data;
    }
    function Content($header, $data)
    {
        // Text before the table
        $this->SetFont('Times','B', '14');
        $this->SetTextColor(103, 133, 64);
        $this->Cell(0, 10, 'Hasil Pencarian Pegawai ABC', 0, 1, 'C');
        $this->Ln(5);

        // Table
        $this->FancyTable($header, $data);
    }

    // Colored table
    function FancyTable($header, $data)
    {
        // Colors, line width and bold font
        $this->SetFillColor(103, 132, 65);
        $this->SetTextColor(255);
        $this->SetDrawColor(77, 75, 52);
        $this->SetLineWidth(.3);
        $this->SetFont('','B');
        // Calculate total page width
        $totalWidth = $this->GetPageWidth() - $this->lMargin - $this->rMargin;
        // Calculate column widths as a percentage of the total width
        $percentages = array(10, 20, 37, 18, 15); 
        $w = array();
        foreach ($percentages as $percentage) {
            $w[] = $totalWidth * $percentage / 100;
        }
        // Header
        for($i=0;$i<count($header);$i++)
            $this->Cell($w[$i],7,$header[$i],1,0,'C',true);
        $this->Ln();
        // Color and font restoration
        $this->SetFillColor(245, 247, 241);
        $this->SetTextColor(0);
        $this->SetFont('');
        // Data
        $fill = false;
        foreach($data as $row)
        {
            $this->Cell($w[0],6,$row['NIP'],'LR',0,'L',$fill);
            $this->Cell($w[1],6,$row['Nama'],'LR',0,'L',$fill);
            $this->Cell($w[2],6,$row['Alamat'],'LR',0,'L',$fill);
            $this->Cell($w[3],6,$row['Tanggal_lahir'],'LR',0,'L',$fill);
            $this->Cell($w[4],6,$row['Kode_Divisi'],'LR',0,'L',$fill);
            $this->Ln();
            $fill = !$fill;
        }
        // Closing line
        $this->Cell(array_sum($w),0,'','T');
    }
}

// Start output buffering
ob_start();

// Instanciation of inherited class
$pdf = new PDF();
$title = 'Pegawai PT ABC';
$subtitle = 'PDF';
$header = array('NIP', 'Nama Pegawai', 'Alamat', 'Tanggal Lahir', 'Divisi');
// Data loading
$data = $pdf->LoadDataFromDatabase();
$pdf->AliasNbPages();
$pdf->SetTitle($title);
$pdf->AddPage();
$pdf->SetFont('Times','',12);
$pdf->Content($header, $data);

// End output buffering and clean output
ob_end_clean();

$pdf->Output();

?>