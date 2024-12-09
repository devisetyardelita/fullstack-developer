<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\PengaduanTidakLangsung;

class PengaduanTidakLangsungController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $pengaduan_tidak_langsung = PengaduanTidakLangsung::where(function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('no_hp', 'like', '%' . $search . '%');
            })->paginate(10);
        } 
        else {
            $pengaduan_tidak_langsung = PengaduanTidakLangsung::paginate(10);
        }
        return view('pengaduan_tidak_langsung.index', compact('pengaduan_tidak_langsung', 'search'));
    }

    public function create()
    {
        return view('pengaduan_tidak_langsung.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|max:100|string',
            'no_hp' => 'required|numeric|regex:/^08[1-9][0-9]{8,9}$/',
            'email' => 'required|email',
            'bukti_pengaduan' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
            'detail_pengaduan' => 'required|max:500|string',
            'status' => 'nullable|in:Diterima,Sedang Diproses,Ditindaklanjuti,Selesai',
        ], [
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'nama.max' => 'Nama Tidak Boleh Lebih dari 100 karakter',
            'no_hp.required' => 'Nomor HP Tidak Boleh Kosong',
            'no_hp.numeric' => 'Nomor HP harus berupa Angka',
            'no_hp.regex' => 'Nomor HP tidak valid. Harus diawali dengan 08 dan diikuti dengan 11-13 digit angka.',
            'email.required' => 'E-mail Tidak Boleh Kosong',
            'email.email' => 'Format E-mail tidak valid.',
            'bukti_pengaduan.file' => 'File harus berupa file yang valid.',
            'bukti_pengaduan.mimes' => 'File harus berupa pdf, jpg, jpeg, png, doc, atau docx.',
            'bukti_pengaduan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'detail_pengaduan.required' => 'Detail pengaduan Tidak Boleh Kosong',
            'detail_pengaduan.max' => 'Detail pengaduan Tidak Boleh Lebih dari 500 karakter',
        ]);

        $filename_bukti_pengaduan = NULL;
        $path_bukti_pengaduan = NULL;
        
        if ($request->hasFile('bukti_pengaduan')) {
            $file_bukti_pengaduan = $request->file('bukti_pengaduan');
            $extension_bukti_pengaduan = $file_bukti_pengaduan->getClientOriginalExtension();
            
            $filename_bukti_pengaduan = time() . '_bukti_pengaduan.' . $extension_bukti_pengaduan;
            $path_bukti_pengaduan = 'uploads/pengaduan_tidak_langsung/bukti_pengaduan/';
            $file_bukti_pengaduan->move($path_bukti_pengaduan, $filename_bukti_pengaduan);
        }

        PengaduanTidakLangsung::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'bukti_pengaduan' => $path_bukti_pengaduan.$filename_bukti_pengaduan,
            'detail_pengaduan' => $request->input('detail_pengaduan'),
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Debug data
        //dd($validated);

        // Simpan ke database (jika model sudah dibuat)
        // Pengaduan::create($validated);

        return redirect()->route('pengaduan_tidak_langsung')->with('status', 'Data Pengaduan berhasil ditambahkan!');
    }

    public function show(int $id)
    {
        $pengaduan_tidak_langsung = PengaduanTidakLangsung::findOrFail($id);
        return view('pengaduan_tidak_langsung.show', compact('pengaduan_tidak_langsung'));
    }

    public function edit(int $id)
    {
        $pengaduan_tidak_langsung = PengaduanTidakLangsung::findOrFail($id);
        return view('pengaduan_tidak_langsung.edit', compact('pengaduan_tidak_langsung'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'nama' => 'required|max:100|string',
            'no_hp' => 'required|numeric|regex:/^08[1-9][0-9]{8,9}$/',
            'email' => 'required|email',
            'bukti_pengaduan' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
            'detail_pengaduan' => 'required|max:500|string',
            'status' => 'nullable|in:Diterima,Sedang Diproses,Ditindaklanjuti,Selesai',
        ], [
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'nama.max' => 'Nama Tidak Boleh Lebih dari 100 karakter',
            'no_hp.required' => 'Nomor HP Tidak Boleh Kosong',
            'no_hp.numeric' => 'Nomor HP harus berupa Angka',
            'no_hp.regex' => 'Nomor HP tidak valid. Harus diawali dengan 08 dan diikuti dengan 11-12 digit angka.',
            'email.required' => 'E-mail Tidak Boleh Kosong',
            'email.email' => 'Format E-mail tidak valid.',
            'bukti_pengaduan.file' => 'File harus berupa file yang valid.',
            'bukti_pengaduan.mimes' => 'File harus berupa pdf, jpg, jpeg, png, doc, atau docx.',
            'bukti_pengaduan.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'detail_pengaduan.required' => 'Detail pengaduan Tidak Boleh Kosong',
            'detail_pengaduan.max' => 'Detail pengaduan Tidak Boleh Lebih dari 500 karakter',
        ]);

        $pengaduan_tidak_langsung = PengaduanTidakLangsung::findOrFail($id);
        
        if ($request->hasFile('bukti_pengaduan	')) {
            $file_bukti_pengaduan	 = $request->file('bukti_pengaduan	');
            $extension_bukti_pengaduan	 = $file_bukti_pengaduan	->getClientOriginalExtension();
            
            $filename_bukti_pengaduan	 = time() . '_bukti_pengaduan	.' . $extension_bukti_pengaduan	;
            $path_bukti_pengaduan	 = 'uploads/pengaduan_tidak_langsung/bukti_pengaduan	/';
            $file_bukti_pengaduan	->move($path_bukti_pengaduan	, $filename_bukti_pengaduan	);

            if(File::exists($pengaduan_tidak_langsung->bukti_pengaduan	)){
                File::delete($pengaduan_tidak_langsung->bukti_pengaduan	);
            }

            $pengaduan_tidak_langsung->bukti_pengaduan	 = $path_bukti_pengaduan	 . $filename_bukti_pengaduan	;
        }

        $pengaduan_tidak_langsung->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'bukti_pengaduan	' => $pengaduan_tidak_langsung->bukti_pengaduan	 ?? $pengaduan_tidak_langsung->getOriginal('bukti_pengaduan	'),
            'detail_pengaduan' => $request->input('detail_pengaduan'),
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()->route('pengaduan_tidak_langsung')->with('status', 'Data Pengaduan berhasil diperbaharui!');
    }

    public function destroy(string $id)
    {
        $pengaduan_tidak_langsung = PengaduanTidakLangsung::findOrFail($id);
        if(File::exists($pengaduan_tidak_langsung->bukti_pengaduan)){
            File::delete($pengaduan_tidak_langsung->bukti_pengaduan);
        }

        $pengaduan_tidak_langsung -> delete();
        return redirect()->back()->with('status', 'Data Pengaduan berhasil dihapus!');
    }

    public function generatePDF()
    {
        $pengaduan_tidak_langsung = PengaduanTidakLangsung::get();
        $data = [
            'title' => 'Daftar Data Pengaduan Tidak Langsung',
            'date' => date('d/m/Y'),
            'pengaduan_tidak_langsung' => $pengaduan_tidak_langsung
        ];

        $pdf = PDF::loadView('pengaduan_tidak_langsung.pdf', $data);
        return $pdf->download('Pengaduan Tidak Langsung.pdf');
    }
    
    public function filter(Request $request)
    {
        // Get the selected statuses from the request
        $statuses = $request->input('statuses');
    
        // Query to filter by status
        $query = PengaduanTidakLangsung::query();
    
        if (!empty($statuses)) {
            $query->whereIn('status', $statuses); // Filter records based on selected statuses
        }
    
        $filteredStatuses = $query->get();
    
        // Return filtered data as JSON for the AJAX call
        return response()->json(['statuses' => $filteredStatuses]);
    }
}
