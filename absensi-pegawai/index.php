<?php
// db.php - Pastikan Anda memiliki koneksi database di file ini
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbPegawai";

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Pegawai</title>
</head>
<body>
    <h1>Cari Pegawai</h1>
    <form action="" method="post">
        <label for="nip">Masukkan NIP:</label>
        <input type="text" id="nip" name="nip" required>
        <button type="submit">Cari</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nip = $_POST['nip'];
        $sql = "SELECT * FROM TblPegawai WHERE NIP = '$nip'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $pegawai = $result->fetch_assoc();
            echo "<h1>Hasil Pencarian</h1>";
            echo '<label for="nip">NIP:</label>';
            echo '<input type="text" name="nip" value="' . $nip . '" readonly><br>';
            echo '<br>';
            echo '<label for="nama">Nama:</label>';
            echo '<input type="text" name="nama" value="' . $pegawai['Nama'] . '" readonly><br>';
            echo '<br>';
            echo '<label for="alamat">Alamat:</label>';
            echo '<input type="text" name="alamat" value="' . $pegawai['Alamat'] . '" readonly><br>';
            echo '<br>';
            echo '<label for="tanggal_lahir">Tanggal Lahir:</label>';
            echo '<input type="text" name="tanggal_lahir" value="' . $pegawai['Tanggal_lahir'] . '" readonly><br>';
            echo '<br>';
            echo '<label for="divisi">Divisi:</label>';
            echo '<input type="text" name="divisi" value="' . $pegawai['Kode_Divisi'] . '" readonly><br>';
            echo '<br>';
            echo '<form action="generate_excel.php" method="get" style="display:inline;">
                <input type="hidden" name="nip" value="' . $nip . '">
                <button type="submit">Cetak Excel</button>
                </form>';
            
            echo '<form action="generate_pdf.php" method="get" style="display:inline;">
                <input type="hidden" name="nip" value="' . $nip . '">
                <button type="submit">Cetak PDF</button>
                </form>';
        } else {
            echo "Data tidak ditemukan";
        }

        $conn->close();
    }
    ?>
</body>
</html>
