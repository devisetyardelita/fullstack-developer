<?php
require 'vendor/vendor/autoload.php'; // Adjust the path if you installed PhpSpreadsheet without Composer

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

include 'db.php';

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Tabel Pegawai');

// Set the header row
$sheet->setCellValue('A1', 'NIP');
$sheet->setCellValue('B1', 'Nama');
$sheet->setCellValue('C1', 'Alamat');
$sheet->setCellValue('D1', 'Tanggal Lahir');
$sheet->setCellValue('E1', 'Kode Divisi');

// Menangkap parameter NIP dari URL
$nip = isset($_GET['nip']) ? $_GET['nip'] : '';
    

// Fetch data from the database
$sql = "SELECT NIP, Nama, Alamat, Tanggal_lahir, Kode_Divisi FROM tblpegawai WHERE NIP = '$nip'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $rowNumber = 2; // Starting row for data
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A' .$rowNumber,  $row['NIP']);
        $sheet->setCellValue('B' .$rowNumber, $row['Nama']);
        $sheet->setCellValue('C' .$rowNumber, $row['Alamat']);
        $sheet->setCellValue('D' .$rowNumber, $row['Tanggal_lahir']);
        $sheet->setCellValue('E' .$rowNumber, $row['Kode_Divisi']);
        $rowNumber++;
    }
} else {
    $sheet->setCellValue('A2', 'No records found');
}

ob_end_clean();

$filename ='Tabel_Pegawai.xlsx';
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

// Save the spreadsheet
$writer = new Xlsx($spreadsheet);




$writer->save('php://output');
$conn->close();
?>
