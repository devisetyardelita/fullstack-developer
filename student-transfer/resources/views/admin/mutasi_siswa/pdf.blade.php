<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            color: #000;
            margin: 30px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h2 {
            margin: 0;
            font-size: 18px;
        }

        .header small {
            font-size: 12px;
        }

        .section {
            margin-bottom: 15px;
        }

        .section-title {
            font-weight: bold;
            margin-bottom: 5px;
            font-size: 14px;
            border-bottom: 1px solid #aaa;
            padding-bottom: 3px;
        }

        .info-table {
            width: 100%;
        }

        .info-table td {
            padding: 4px 8px;
            vertical-align: top;
        }

        .label {
            width: 180px;
            font-weight: bold;
        }

        .page-break {
            page-break-after: always;
        }

        .footer {
            margin-top: 30px;
            font-size: 10px;
            text-align: right;
        }

    </style>
</head>
<body>

@foreach ($siswa as $data)
    <div class="header">
        <h2>Formulir Mutasi Masuk Siswa</h2>
        <small>Jenis Mutasi: <strong>{{ $data->tipe }}</strong></small>
    </div>

    <div class="section">
        <div class="section-title">Informasi Siswa</div>
        <table class="info-table">
            <tr>
                <td class="label">Nama Siswa</td>
                <td>: {{ $data->nama_siswa }}</td>
            </tr>
            <tr>
                <td class="label">NISN</td>
                <td>: {{ $data->nisn }}</td>
            </tr>
            <tr>
                <td class="label">Jenjang</td>
                <td>: {{ $data->jenjang }}</td>
            </tr>
            <tr>
                <td class="label">Kelas</td>
                <td>: {{ $data->kelas }}</td>
            </tr>
            <tr>
                <td class="label">Jenis Kelamin</td>
                <td>: {{ $data->kelamin }}</td>
            </tr>
            <tr>
                <td class="label">Nomor Telepon</td>
                <td>: {{ $data->no_hp }}</td>
            </tr>
            <tr>
                <td class="label">Email</td>
                <td>: {{ $data->email }}</td>
            </tr>
            <tr>
                <td class="label">Sekolah Asal</td>
                <td>: {{ $data->schoolAsal->nama_sekolah ?? $data->school_asal_name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Sekolah Tujuan</td>
                <td>: {{ $data->schoolTujuan->nama_sekolah ?? $data->school_sbaru_name ?? '-' }}</td>
            </tr>
            <tr>
                <td class="label">Status Pengajuan</td>
                <td>: {{ ucfirst($data->status) }}</td>
            </tr>
        </table>
    </div>

    <div class="footer">
        Dicetak pada: {{ $date }}
    </div>

    @if (!$loop->last)
        <div class="page-break"></div>
    @endif
@endforeach

</body>
</html>
