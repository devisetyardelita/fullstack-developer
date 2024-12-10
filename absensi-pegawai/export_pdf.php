<?php
require('fpdf186/fpdf.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbpegawai";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Tabel Pegawai', 0, 1, 'C');
        $this->Ln(10);
        $this->Cell(20, 10, 'NIP', 1);
        $this->Cell(40, 10, 'Nama', 1);
        $this->Cell(50, 10, 'Alamat', 1);
        $this->Cell(30, 10, 'Tanggal Lahir', 1);
        $this->Cell(30, 10, 'Kode Divisi', 1);
        $this->Ln();
    }

    // Page footer
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Instantiation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 10);

$sql = "SELECT NIP, Nama, Alamat, Tanggal_lahir, Kode_divisi FROM TblPegawai";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(20, 10, $row['NIP'], 1);
        $pdf->Cell(40, 10, $row['Nama'], 1);
        $pdf->Cell(50, 10, $row['Alamat'], 1);
        $pdf->Cell(30, 10, $row['Tanggal_lahir'], 1);
        $pdf->Cell(30, 10, $row['Kode_divisi'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(0, 10, 'No records found', 1, 1, 'C');
}

$pdf->Output('D', 'Tabel_Pegawai.pdf'); // Output the PDF to download

$conn->close();
?>
