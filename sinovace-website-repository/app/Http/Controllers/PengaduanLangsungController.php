<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use App\Models\PengaduanLangsung;
use Illuminate\Support\Facades\File;

class PengaduanLangsungController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $pengaduan_langsung = PengaduanLangsung::where(function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('no_hp', 'like', '%' . $search . '%');
            })->paginate(10);
        } 
        else {
            $pengaduan_langsung = PengaduanLangsung::paginate(10);
        }
        return view('pengaduan_langsung.index', compact('pengaduan_langsung', 'search'));
    }

    public function create()
    {
        return view('pengaduan_langsung.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100|string',
            'no_hp' => 'required|numeric|regex:/^08[1-9][0-9]{8,9}$/',
            'email' => 'required|email',
            'surat_permohonan_pengajuan' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
            'ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
            'bukti_pengaduan' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
            'status' => 'nullable|in:Diterima,Sedang Diproses,Ditindaklanjuti,Selesai',
        ], [
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'nama.max' => 'Nama Tidak Boleh Lebih dari 100 karakter',
            'no_hp.required' => 'Nomor HP Tidak Boleh Kosong',
            'no_hp.numeric' => 'Nomor HP harus berupa Angka',
            'no_hp.regex' => 'Nomor HP tidak valid. Harus diawali dengan 08 dan diikuti dengan 11-12 digit angka.',
            'email.required' => 'E-mail Tidak Boleh Kosong',
            'email.email' => 'Format E-mail tidak valid.',
            'surat_permohonan_pengajuan.file' => 'File harus berupa file yang valid.',
            'surat_permohonan_pengajuan.mimes' => 'File harus berupa pdf, jpg, jpeg, png, doc, atau docx.',
            'surat_permohonan_pengajuan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'ktp.file' => 'File harus berupa file yang valid.',
            'ktp.mimes' => 'File harus berupa pdf, jpg, jpeg, png, doc, atau docx.',
            'ktp.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'bukti_pengaduan.file' => 'File harus berupa file yang valid.',
            'bukti_pengaduan.mimes' => 'File harus berupa pdf, jpg, jpeg, png, doc, atau docx.',
            'bukti_pengaduan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'detail_pengaduan.max' => 'Detail pengaduan Tidak Boleh Lebih dari 500 karakter',
        ]);

        $filename_surat_permohonan_pengajuan = NULL;
        $path_surat_permohonan_pengajuan = NULL;

        $filename_ktp = NULL;
        $path_ktp = NULL;

        $filename_bukti_pengaduan = NULL;
        $path_bukti_pengaduan = NULL;
        
        if ($request->hasFile('surat_permohonan_pengajuan')) {
            $file_surat_permohonan_pengajuan = $request->file('surat_permohonan_pengajuan');
            $extension_surat_permohonan_pengajuan = $file_surat_permohonan_pengajuan->getClientOriginalExtension();
            
            $filename_surat_permohonan_pengajuan = time() . '_surat_permohonan_pengajuan.' . $extension_surat_permohonan_pengajuan;
            $path_surat_permohonan_pengajuan = 'uploads/pengaduan_langsung/surat_permohonan_pengajuan/';
            $file_surat_permohonan_pengajuan->move($path_surat_permohonan_pengajuan, $filename_surat_permohonan_pengajuan);
        }
        
        if ($request->hasFile('ktp')) {
            $file_ktp = $request->file('ktp');
            $extension_ktp = $file_ktp->getClientOriginalExtension();
            
            $filename_ktp = time() . '_ktp.' . $extension_ktp;
            $path_ktp = 'uploads/pengaduan_langsung/ktp/';
            $file_ktp->move($path_ktp, $filename_bukti_pengaduan);
        }
        
        if ($request->hasFile('bukti_pengaduan')) {
            $file_bukti_pengaduan = $request->file('bukti_pengaduan');
            $extension_bukti_pengaduan = $file_bukti_pengaduan->getClientOriginalExtension();
            
            $filename_bukti_pengaduan = time() . '_bukti_pengaduan.' . $extension_bukti_pengaduan;
            $path_bukti_pengaduan = 'uploads/pengaduan_langsung/bukti_pengaduan/';
            $file_bukti_pengaduan->move($path_bukti_pengaduan, $filename_bukti_pengaduan);
        }

        PengaduanLangsung::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'surat_permohonan_pengajuan' => $path_surat_permohonan_pengajuan.$filename_surat_permohonan_pengajuan,
            'ktp' => $path_ktp.$filename_ktp,
            'bukti_pengaduan' => $path_bukti_pengaduan.$filename_bukti_pengaduan,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Debug data
        // dd($validated);

        // Simpan ke database (jika model sudah dibuat)
        // Pengaduan::create($validated);

        return redirect()->route('pengaduan_langsung')->with('status', 'Data Pengaduan berhasil ditambahkan!');
    }

    public function show(int $id)
    {
        $pengaduan_langsung = PengaduanLangsung::findOrFail($id);
        return view('pengaduan_langsung.show', compact('pengaduan_langsung'));
    }

    public function edit(int $id)
    {
        $pengaduan_langsung = PengaduanLangsung::findOrFail($id);
        return view('pengaduan_langsung.edit', compact('pengaduan_langsung'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'nama' => 'required|max:100|string',
            'no_hp' => 'required|numeric|regex:/^08[1-9][0-9]{8,9}$$/',
            'email' => 'required|email',
            'surat_permohonan_pengajuan' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
            'ktp' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
            'bukti_pengaduan' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
            'status' => 'nullable|in:Diterima,Sedang Diproses,Ditindaklanjuti,Selesai',
        ], [
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'nama.max' => 'Nama Tidak Boleh Lebih dari 100 karakter',
            'no_hp.required' => 'Nomor HP Tidak Boleh Kosong',
            'no_hp.numeric' => 'Nomor HP harus berupa Angka',
            'no_hp.regex' => 'Nomor HP tidak valid. Harus diawali dengan 08 dan diikuti dengan 11-12 digit angka.',
            'email.required' => 'E-mail Tidak Boleh Kosong',
            'email.email' => 'Format E-mail tidak valid.',
            'surat_permohonan_pengajuan.file' => 'File harus berupa file yang valid.',
            'surat_permohonan_pengajuan.mimes' => 'File harus berupa pdf, jpg, jpeg, png, doc, atau docx.',
            'surat_permohonan_pengajuan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'ktp.file' => 'File harus berupa file yang valid.',
            'ktp.mimes' => 'File harus berupa pdf, jpg, jpeg, png, doc, atau docx.',
            'ktp.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'bukti_pengaduan.file' => 'File harus berupa file yang valid.',
            'bukti_pengaduan.mimes' => 'File harus berupa pdf, jpg, jpeg, png, doc, atau docx.',
            'bukti_pengaduan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'detail_pengaduan.max' => 'Detail pengaduan Tidak Boleh Lebih dari 500 karakter',
        ]);

        $pengaduan_langsung = PengaduanLangsung::findOrFail($id);
        
        if ($request->hasFile('surat_permohonan_pengajuan')) {
            $file_surat_permohonan_pengajuan = $request->file('surat_permohonan_pengajuan');
            $extension_surat_permohonan_pengajuan = $file_surat_permohonan_pengajuan->getClientOriginalExtension();
            
            $filename_surat_permohonan_pengajuan = time() . '_surat_permohonan_pengajuan.' . $extension_surat_permohonan_pengajuan;
            $path_surat_permohonan_pengajuan = 'uploads/pengaduan_langsung/surat_permohonan_pengajuan/';
            $file_surat_permohonan_pengajuan->move($path_surat_permohonan_pengajuan, $filename_surat_permohonan_pengajuan);

            if(File::exists($pengaduan_langsung->surat_permohonan_pengajuan	)){
                File::delete($pengaduan_langsung->surat_permohonan_pengajuan	);
            }

            $pengaduan_langsung->surat_permohonan_pengajuan	 = $path_surat_permohonan_pengajuan	 . $filename_surat_permohonan_pengajuan	;
        }
        
        if ($request->hasFile('ktp')) {
            $file_ktp = $request->file('ktp');
            $extension_ktp = $file_ktp->getClientOriginalExtension();
            
            $filename_ktp = time() . '_ktp.' . $extension_ktp;
            $path_ktp = 'uploads/pengaduan_langsung/ktp/';
            $file_ktp->move($path_ktp, $filename_ktp);

            if(File::exists($pengaduan_langsung->ktp)){
                File::delete($pengaduan_langsung->ktp);
            }

            $pengaduan_langsung->ktp = $path_ktp . $filename_ktp;
        }
        
        if ($request->hasFile('bukti_pengaduan')) {
            $file_bukti_pengaduan = $request->file('bukti_pengaduan');
            $extension_bukti_pengaduan = $file_bukti_pengaduan->getClientOriginalExtension();
            
            $filename_bukti_pengaduan = time() . '_bukti_pengaduan.' . $extension_bukti_pengaduan;
            $path_bukti_pengaduan = 'uploads/pengaduan_langsung/bukti_pengaduan/';
            $file_bukti_pengaduan->move($path_bukti_pengaduan, $filename_bukti_pengaduan);

            if(File::exists($pengaduan_langsung->bukti_pengaduan)){
                File::delete($pengaduan_langsung->bukti_pengaduan);
            }

            $pengaduan_langsung->bukti_pengaduan = $path_bukti_pengaduan . $filename_bukti_pengaduan;
        }

        $pengaduan_langsung->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'surat_permohonan_pengajuan' => $pengaduan_langsung->surat_permohonan_pengajuan ?? $pengaduan_langsung->getOriginal('surat_permohonan_pengajuan'),
            'ktp' => $pengaduan_langsung->ktp ?? $pengaduan_langsung->getOriginal('ktp'),
            'bukti_pengaduan' => $pengaduan_langsung->bukti_pengaduan ?? $pengaduan_langsung->getOriginal('bukti_pengaduan'),
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()->route('pengaduan_langsung')->with('status', 'Data Pengaduan berhasil diperbaharui!');
    }

    public function destroy(string $id)
    {
        $pengaduan_langsung = PengaduanLangsung::findOrFail($id);
        if(File::exists($pengaduan_langsung->surat_permohonan_pengajuan)){
            File::delete($pengaduan_langsung->surat_permohonan_pengajuan);
        }
        if(File::exists($pengaduan_langsung->ktp)){
            File::delete($pengaduan_langsung->ktp);
        }
        if(File::exists($pengaduan_langsung->bukti_pengaduan)){
            File::delete($pengaduan_langsung->bukti_pengaduan);
        }

        $pengaduan_langsung -> delete();
        return redirect()->back()->with('status', 'Data Pengaduan berhasil dihapus!');
    }

    public function generatePDF()
    {
        $pengaduan_langsung = PengaduanLangsung::get();
        $data = [
            'title' => 'Daftar Data Pengaduan Tidak Langsung',
            'date' => date('d/m/Y'),
            'pengaduan_langsung' => $pengaduan_langsung
        ];

        $pdf = PDF::loadView('pengaduan_langsung.pdf', $data);
        return $pdf->download('Pengaduan Langsung.pdf');
    }
    
    public function filter(Request $request)
    {
        // Get the selected statuses from the request
        $statuses = $request->input('statuses');
    
        // Query to filter by status
        $query = PengaduanLangsung::query();
    
        if (!empty($statuses)) {
            $query->whereIn('status', $statuses); // Filter records based on selected statuses
        }
    
        $filteredStatuses = $query->get();
    
        // Return filtered data as JSON for the AJAX call
        return response()->json(['statuses' => $filteredStatuses]);
    }
}
