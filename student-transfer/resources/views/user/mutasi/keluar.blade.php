@if ($slama->isEmpty())
    <div class="alert alert-warning text-center">
        Anda belum mengajukan Mutasi Keluar.
    </div>
@else
    <table class="table table-hover align-middle text-center">
        <thead class="table-primary">
            <tr>
                <th>Nama Siswa</th>
                <th>Jenjang</th>
                <th>Kelas</th>
                <th>Sekolah Tujuan</th>
                <th>Status</th>
                <th>Output</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($slama as $item)
                <tr>
                    <td>{{ $item->nama_siswa }}</td>                      
                    <td><strong>{{ $item->jenjang }}</strong></td>
                    <td>{{ $item->kelas }}</td>
                    <td>{{ $item->schoolTujuan->nama_sekolah ?? '-' }}</td>
                    <td>
                        @if ($item->status == 'Diterima')
                            <span class="badge bg-success text-white">Diterima</span>
                        @elseif ($item->status == 'Sedang Diproses')
                            <span class="badge bg-info text-white">Sedang Diproses</span>
                        @elseif ($item->status == 'Ditindaklanjuti')
                            <span class="badge bg-warning text-dark">Ditindaklanjuti</span>
                        @elseif ($item->status == 'Selesai')
                            <span class="badge bg-secondary text-white">Selesai</span>
                        @endif
                    </td>                                       
                    <td>
                        @if ($item->output)
                            <a href="{{ asset($item->output) }}" target="_blank" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-arrow-down-circle"></i> Lihat
                            </a>
                        @else
                            <span class="text-muted">Belum ada balasan</span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endif
