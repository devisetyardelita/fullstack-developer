SELECT p.NIP, p.Nama, COUNT(pr.Tanggal) AS Jumlah_Presensi 
FROM TblPegawai p 
JOIN TblPresensi pr ON p.NIP = pr.NIP 
WHERE MONTH(pr.Tanggal) = 1 AND YEAR(pr.Tanggal) = 2018 
GROUP BY p.NIP, p.Nama;

SELECT d.Nama_divisi, COUNT(p.NIP) AS Jumlah_Pegawai 
FROM TblDivisi d 
LEFT JOIN TblPegawai p ON d.Kode_divisi = p.Kode_Divisi 
GROUP BY d.Nama_divisi;

SELECT NIP, Nama, Alamat 
FROM TblPegawai 
WHERE Alamat LIKE '%Bogor%';

