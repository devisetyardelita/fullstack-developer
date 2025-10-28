@extends('main-admin')
@section('title', 'Dashboard')
@section('content')

<div class="content">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="mb-4">Dashboard</h4>
        <div class="row d-flex align-items-stretch">
            <!-- Konten Utama -->
            <div class="col-md-8 d-flex flex-column">
                <div class="row mb-3">
                    <!-- Statistik Mutasi -->
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-header">
                                <h5 class="m-0 me-2">Mutasi Siswa</h5>
                                {{-- <small class="text-muted">Rata-rata</small> --}}
                            </div>
                            <div class="card-body text-center">
                                {{-- <h2 class="mb-2">{{ $totalMutasi ?? 0 }}</h2>
                                <span>Total Mutasi</span> --}}
                                <canvas id="donutChart"></canvas>
                                <div id="chartText" class="chart-center-text"></div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Detail Mutasi -->
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <ul class="p-0 mt-1">
                                    <h6>Detail Mutasi</h6>
                                    <li class="d-flex mb-4 pb-1">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded bg-label-success"><i class="bx bx-log-in"></i></span>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between mb-4 pb-1">
                                            <h6 class="mb-0 ">Mutasi Masuk</h6>
                                            <small class="fw-semibold">{{ $totalMasuk ?? 0 }}</small>
                                        </div>
                                    </li>
                                    <li class="d-flex mb-4 pb-1">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded bg-label-danger"><i class="bx bx-log-out"></i></span>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between mb-4 pb-1">
                                            <h6 class="mb-0">Mutasi Keluar</h6>
                                            <small class="fw-semibold">{{ $totalKeluar ?? 0 }}</small>
                                        </div>
                                    </li>
                                    <li class="d-flex mb-4 pb-1">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded bg-label-info"><i class="bx bx-building"></i></span>
                                        </div>
                                        <div class="d-flex w-100 justify-content-between mb-4 pb-1">
                                            <h6 class="mb-0">Lapor Mutasi</h6>
                                            <small class="fw-semibold">{{ $totalLapor ?? 0 }}</small>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Rincian Per Jenjang -->
                    <div class="col-md-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <ul class="p-0 mt-1">
                                    <h6>Rincian Per Jenjang</h6>
                                    @foreach(['PAUD', 'SD', 'SMP'] as $jenjang)
                                        @php
                                            $mutasiMasuk = collect($totalsbaru)->firstWhere('jenjang', $jenjang);
                                            $mutasiKeluar = collect($totalslama)->firstWhere('jenjang', $jenjang);
                                            $mutasiLapor = collect($totalmutasi)->firstWhere('jenjang', $jenjang);
                                        @endphp                                
                                        <li class="d-flex mb-2">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-building"></i></span>
                                            </div>
                                            <div class="d-flex flex-column mb-1">
                                                <h6 class="mb-0">{{ $jenjang }}</h6>
                                                <small class="text-muted">
                                                    Masuk: {{ $mutasiMasuk['total'] ?? 0 }} | Keluar: {{ $mutasiKeluar['total'] ?? 0 }} | Lapor: {{ $mutasiLapor['total'] ?? 0 }}
                                                </small>                                                
                                            </div>
                                        </li>
                                    @endforeach
                                    {{-- <pre>{{ print_r($totalsbaru, true) }}</pre> --}}

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
        
                <!-- Grafik Mutasi -->
                <div class="card mb-4">
                    <div class="row row-bordered g-0">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="m-0">Grafik Mutasi</h5>
                            <form action="{{ route('admin.export.mutasi', ['year' => request('year', now()->year)]) }}" method="GET" class="mb-0">
                                <div class="d-flex d-flex align-items-center gap-2">
                                    <select name="year" class="form-select" onchange="this.form.submit()">
                                        @foreach ($years as $y)
                                            <option value="{{ $y }}" {{ request('year', now()->year) == $y ? 'selected' : '' }}>
                                                {{ $y }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button type="submit" class="btn btn-sm btn-success d-flex align-items-center" style="white-space: nowrap;">
                                        <i class="bx bx-file"></i><span class="ms-1">Export Excel</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="px-2">
                            <canvas id="mutasiChart"></canvas>
                        </div>
                    </div>
                </div>
                

                {{-- Data Real time kuota --}}
            </div>
        
            <!-- Notifikasi -->
            <div class="col-md-4 d-flex flex-column">
                <div class="card flex-fill d-flex flex-column">
                    <div class="card-header d-flex align-items-center justify-content-between p-3">
                        <h5 class="card-title m-0 me-2"><i class="bx bx-bell me-2"></i>Notifications</h5>
                        <a href="{{ route('admin.notifications') }}" class="btn btn-sm btn-primary">Lihat Semua</a>
                    </div>
                    <div class="card-body overflow-auto">
                        <ul class="p-0 m-0">
                            @forelse ($notifications->whereNull('read_at')->sortByDesc('created_at') as $notification)
                            @php
                                $formType = $notification->data['formType'] ?? 'sbaru';
                                $bgClass = \App\Helpers\NotificationHelper::getNotificationColor($formType);
                                $icon = \App\Helpers\NotificationHelper::getNotificationIcon($formType);
                                $label = \App\Helpers\NotificationHelper::getNotificationLabel($formType);
                            @endphp
                            
                            <li class="d-flex mb-1 pb-1 notification-item {{ $bgClass }} rounded p-2">
                                <div class="avatar flex-shrink-0 ms-2">
                                    <div class="icon me-1">
                                        {!! $icon !!}
                                    </div>
                                </div>
                                <div class="d-flex flex-wrap align-items-center justify-content-between w-100">
                                    <div class="me-1">
                                        <small class="d-block mb-1">{{ $notification->data['category'] ?? 'Notification' }}</small>
                                        <p class="mb-0">{{ $notification->data['message'] }}</p>
                                    </div>
                                    <span class=" small ms-auto">{{ $notification->created_at->format('d M Y (H:i)') }}</span>
                                </div>
                            </li>                        
                            @empty
                                <p class="text-muted text-center">Tidak ada notifikasi baru.</p>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card-body {
        max-height: 600px;
        overflow-y: auto;
    }

    .c-paud { background-color: white; }
    .c-sd { background-color: white; }
    .c-smp { background-color: white; }
    .bg-lightred { background-color: #ffcccc; }
    .bg-mediumred { background-color: #ff6666; }
    .bg-darkred { background-color: #cc0000; }
    .bg-lightblue { background-color: #cce5ff; }
    .bg-mediumblue { background-color: #6699ff; }
    .bg-darkblue { background-color: #0033cc; }
    .chart-center-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 20px;
        font-weight: bold;
        color: rgba(24, 116, 152, 1); /* hijau, bisa diganti */
    }

    .notification-item {
        background-color: #f3f4fe;
        border-radius: 8px;
        margin-bottom: 5px;
        padding: 5px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #eaeaea;
    }
    .notification-item .icon {
        font-size: 20px;
        margin-right: 10px;
    }
    .notification-item.read {
        background-color: #e2e2e2; /* Warna untuk notifikasi yang sudah dibaca */
    }
</style>

<!-- Chart.js -->
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx2 = document.getElementById('mutasiChart').getContext('2d');

    var labels = @json($grafiksbaru->pluck('bulan'));
    var dataMasuk = @json($grafiksbaru->pluck('total'));
    var dataKeluar = @json($grafikslama->pluck('total'));
    var dataMutasi = @json($grafikmutasi->pluck('total'));

    var mutasiChart = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Mutasi Masuk',
                    data: dataMasuk,
                    borderColor: 'rgba(113, 221, 55, 1)',
                    backgroundColor: 'rgba(113, 221, 55, 0.15)',
                    fill: true,
                    tension: 0.4, // buat garis lebih melengkung
                    pointRadius: 5,
                    pointHoverRadius: 7
                },
                {
                    label: 'Mutasi Keluar',
                    data: dataKeluar,
                    borderColor: 'rgba(235, 83, 83, 1)',
                    backgroundColor: 'rgba(235, 83, 83, 0.15)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointHoverRadius: 7
                },
                {
                    label: 'Lapor Mutasi',
                    data: dataMutasi,
                    borderColor: 'rgba(24, 116, 152, 1)', // diperbaiki dari 'rgab'
                    backgroundColor: 'rgba(24, 116, 152, 0.15)',
                    fill: true,
                    tension: 0.4,
                    pointRadius: 5,
                    pointHoverRadius: 7
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' },
                tooltip: {
                    mode: 'index',
                    intersect: false
                }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            },
            animation: {
                duration: 1000,
                easing: 'easeOutQuart'
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: '#666'
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    },
                    ticks: {
                        stepSize: 1,
                        color: '#666'
                    }
                }
            }
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('donutChart').getContext('2d');
        const chartText = document.getElementById('chartText'); // Elemen untuk teks di tengah

        const mutasiData = @json($mutasiData);

        const labels = mutasiData.map(item => item.label);
        const data = mutasiData.map(item => item.percentage);
        const totals = mutasiData.map(item => item.total);
        
        // Warna dengan transparansi untuk soft look, sekarang merah lebih bold!
        const colors = [
            'rgba(113, 221, 55, 0.7)',   // Hijau lembut
            'rgba(255, 99, 71)',    // Merah lebih terang (Tomato)
            'rgba(3, 195, 236, 0.7)'     // Biru lembut
        ];

        const totalAll = totals.reduce((acc, curr) => acc + curr, 0);
        const percentages = totals.map(val => Math.round((val / totalAll) * 100));

        // chartText.innerText = "@json($averageMutasi)%"; // Tampilkan rata-rata di tengah

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: colors,
                    borderWidth: 0, // hilangin garis tepi antar slice
                    hoverOffset: 15
                }]
            },
            options: {
                responsive: true,
                cutout: '60%', // biar tengah lebih besar (donat-nya elegan)
                animation: {
                    animateRotate: true,
                    duration: 1500,
                    easing: 'easeOutQuart'
                },
                plugins: {
                    tooltip: {
                        backgroundColor: '#fff',
                        titleColor: '#333',
                        bodyColor: '#444',
                        borderColor: '#ccc',
                        borderWidth: 1,
                        callbacks: {
                            label: function (tooltipItem) {
                                let label = labels[tooltipItem.dataIndex];
                                let total = totals[tooltipItem.dataIndex];
                                return `${label}: ${total} mutasi`;
                            }
                        }
                    },
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#555',
                            padding: 15,
                            boxWidth: 20
                        }
                    }
                }
            }
        });
    });
</script>
{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx2 = document.getElementById('mutasiChart').getContext('2d');

    var labels = @json($grafiksbaru->pluck('bulan'));
    var dataMasuk = @json($grafiksbaru->pluck('total'));
    var dataKeluar = @json($grafikslama->pluck('total'));
    var dataMutasi = @json($grafikmutasi->pluck('total'));

    console.log("Labels:", labels);
    console.log("Data Masuk:", dataMasuk);
    console.log("Data Keluar:", dataKeluar);
    console.log("Data Mutasi:", dataMutasi);

    var mutasiChart = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Mutasi Masuk',
                    data: dataMasuk,
                    borderColor: 'rgba(113, 221, 55, 1)',
                    backgroundColor: 'rgba(113, 221, 55, 0.2)',
                    fill: true
                },
                {
                    label: 'Mutasi Keluar',
                    data: dataKeluar,
                    borderColor: 'rgba(235, 83, 83, 1)',
                    backgroundColor: 'rgba(235, 83, 83, 0.2)',
                    fill: true
                },
                {
                    label: 'Lapor Mutasi',
                    data: dataMutasi,
                    borderColor: 'rgab(24, 116, 152, 1)',
                    backgroundColor: 'rgba(24, 116, 152, 0.2)',
                    fill: true
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                x: { beginAtZero: true },
                y: { beginAtZero: true }
            }
        }
    });
</script> --}}

{{-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const ctx = document.getElementById('donutChart').getContext('2d');
        const chartText = document.getElementById('chartText'); // Elemen untuk teks di tengah

        const mutasiData = @json($mutasiData);

        const labels = mutasiData.map(item => item.label);
        const data = mutasiData.map(item => item.percentage);
        const totals = mutasiData.map(item => item.total);
        const colors = ['#71dd37', '#ff3e1d', '#03c3ec']; // Warna chart

        const totalAll = totals.reduce((acc, curr) => acc + curr, 0);
        const percentages = totals.map(val => Math.round((val / totalAll) * 100));

        chartText.innerText = "@json($averageMutasi)%"; // Tampilkan rata-rata di tengah

        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: colors,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (tooltipItem) {
                                let label = labels[tooltipItem.dataIndex];
                                let total = totals[tooltipItem.dataIndex];
                                return `${label}: ${total} mutasi`;
                            }
                        }
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    });
</script> --}}

<script src="https://cdnjs.cloudflare.com/ajax/libs/laravel-echo/1.11.2/echo.iife.js"></script>
<script src="https://js.pusher.com/7.2/pusher.min.js"></script>
<script>
document.getElementById("updateStatusButton").addEventListener("click", function () {
    let mutasiId = this.dataset.mutasiId;

    fetch("admin/dashboard/update-kuota", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
        },
        body: JSON.stringify({
            mutasi_id: mutasiId,
            status: "Selesai",
        }),
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert("Kuota berhasil diperbarui!");
        } else {
            alert("Gagal memperbarui kuota: " + data.error);
        }
    })
    .catch(error => console.error("Error:", error));
});
</script>
@endsection
