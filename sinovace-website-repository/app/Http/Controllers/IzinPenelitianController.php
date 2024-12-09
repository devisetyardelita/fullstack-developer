<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use App\Models\IzinPenelitian;
use Illuminate\Support\Facades\File;

class IzinPenelitianController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        if ($search) {
            $izin_penelitian = IzinPenelitian::where(function($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')
                    ->orWhere('email', 'like', '%' . $search . '%')
                    ->orWhere('no_hp', 'like', '%' . $search . '%');
            })->paginate(10);
        } 
        else {
            $izin_penelitian = IzinPenelitian::paginate(10);
        }
        return view('izin_penelitian.index', compact('izin_penelitian', 'search'));
    }

    public function create()
    {
        return view('izin_penelitian.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100|string',
            'no_hp' => 'required|numeric|regex:/^08[1-9][0-9]{8,9}$/',
            'email' => 'required|email',
            'sr_kesbangpol' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
            'sip_kampus_lembaga' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
            'status' => 'nullable|in:Diterima,Sedang Diproses,Ditindaklanjuti,Selesai',
        ], [
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'nama.max' => 'Nama Tidak Boleh Lebih dari 100 karakter',
            'no_hp.required' => 'Nomor HP Tidak Boleh Kosong',
            'no_hp.numeric' => 'Nomor HP harus berupa Angka',
            'no_hp.regex' => 'Nomor HP tidak valid. Harus diawali dengan 08 dan diikuti dengan 11-12 digit angka.',
            'email.required' => 'E-mail Tidak Boleh Kosong',
            'email.email' => 'Format E-mail tidak valid.',
            'sr_kesbangpol.file' => 'File harus berupa file yang valid.',
            'sr_kesbangpol.mimes' => 'File harus berupa pdf, jpg, jpeg, png, doc, atau docx.',
            'sr_kesbangpol.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'sip_kampus_lembaga.file' => 'File harus berupa file yang valid.',
            'sip_kampus_lembaga.mimes' => 'File harus berupa pdf, jpg, jpeg, png, doc, atau docx.',
            'sip_kampus_lembaga.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
        ]);

        $filename_sr_kesbangpol = NULL;
        $path_sr_kesbangpol = NULL;

        $filename_sip_kampus_lembaga = NULL;
        $path_sip_kampus_lembaga = NULL;
        
        if ($request->hasFile('sr_kesbangpol')) {
            $file_sr_kesbangpol = $request->file('sr_kesbangpol');
            $extension_sr_kesbangpol = $file_sr_kesbangpol->getClientOriginalExtension();
            
            $filename_sr_kesbangpol = time() . '_sr_kesbangpol.' . $extension_sr_kesbangpol;
            $path_sr_kesbangpol = 'uploads/izin_penelitian/sr_kesbangpol/';
            $file_sr_kesbangpol->move($path_sr_kesbangpol, $filename_sr_kesbangpol);
        }
        
        if ($request->hasFile('sip_kampus_lembaga')) {
            $file_sip_kampus_lembaga = $request->file('sip_kampus_lembaga');
            $extension_sip_kampus_lembaga = $file_sip_kampus_lembaga->getClientOriginalExtension();
            
            $filename_sip_kampus_lembaga = time() . '_sip_kampus_lembaga.' . $extension_sip_kampus_lembaga;
            $path_sip_kampus_lembaga = 'uploads/izin_penelitian/sip_kampus_lembaga/';
            $file_sip_kampus_lembaga->move($path_sip_kampus_lembaga, $filename_sip_kampus_lembaga);
        }

        IzinPenelitian::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'email' => $request->email,
            'sr_kesbangpol' => $path_sr_kesbangpol.$filename_sr_kesbangpol,
            'sip_kampus_lembaga' => $path_sip_kampus_lembaga.$filename_sip_kampus_lembaga,
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Debug data
        // dd($validated);

        // Simpan ke database (jika model sudah dibuat)
        // Pengaduan::create($validated);

        return redirect()->route('izin_penelitian')->with('status', 'Data Pengaduan berhasil ditambahkan!');
    }

    public function show(int $id)
    {
        $izin_penelitian = IzinPenelitian::findOrFail($id);
        return view('izin_penelitian.show', compact('izin_penelitian'));
    }

    public function edit(int $id)
    {
        $izin_penelitian = IzinPenelitian::findOrFail($id);
        return view('izin_penelitian.edit', compact('izin_penelitian'));
    }

    public function update(Request $request, int $id)
    {
        $request->validate([
            'nama' => 'required|max:100|string',
            'no_hp' => 'required|numeric|regex:/^08[1-9][0-9]{8,9}$$/',
            'email' => 'required|email',
            'sr_kesbangpol' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
            'sip_kampus_lembaga' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120',
            'status' => 'nullable|in:Diterima,Sedang Diproses,Ditindaklanjuti,Selesai',
        ], [
            'nama.required' => 'Nama Tidak Boleh Kosong',
            'nama.max' => 'Nama Tidak Boleh Lebih dari 100 karakter',
            'no_hp.required' => 'Nomor HP Tidak Boleh Kosong',
            'no_hp.numeric' => 'Nomor HP harus berupa Angka',
            'no_hp.regex' => 'Nomor HP tidak valid. Harus diawali dengan 08 dan diikuti dengan 11-12 digit angka.',
            'email.required' => 'E-mail Tidak Boleh Kosong',
            'email.email' => 'Format E-mail tidak valid.',
            'sr_kesbangpol.file' => 'File harus berupa file yang valid.',
            'sr_kesbangpol.mimes' => 'File harus berupa pdf, jpg, jpeg, png, doc, atau docx.',
            'sr_kesbangpol.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
            'sip_kampus_lembaga.file' => 'File harus berupa file yang valid.',
            'sip_kampus_lembaga.mimes' => 'File harus berupa pdf, jpg, jpeg, png, doc, atau docx.',
            'sip_kampus_lembaga.max' => 'Ukuran file tidak boleh lebih dari 10 MB.',
        ]);

        $izin_penelitian = IzinPenelitian::findOrFail($id);
        
        if ($request->hasFile('sr_kesbangpol')) {
            $file_sr_kesbangpol = $request->file('sr_kesbangpol');
            $extension_sr_kesbangpol = $file_sr_kesbangpol->getClientOriginalExtension();
            
            $filename_sr_kesbangpol = time() . '_sr_kesbangpol.' . $extension_sr_kesbangpol;
            $path_sr_kesbangpol = 'uploads/izin_penelitian/sr_kesbangpol/';
            $file_sr_kesbangpol->move($path_sr_kesbangpol, $filename_sr_kesbangpol);

            if(File::exists($izin_penelitian->sr_kesbangpol	)){
                File::delete($izin_penelitian->sr_kesbangpol	);
            }

            $izin_penelitian->sr_kesbangpol	 = $path_sr_kesbangpol	 . $filename_sr_kesbangpol	;
        }
        
        if ($request->hasFile('sip_kampus_lembaga')) {
            $file_sip_kampus_lembaga = $request->file('sip_kampus_lembaga');
            $extension_sip_kampus_lembaga = $file_sip_kampus_lembaga->getClientOriginalExtension();
            
            $filename_sip_kampus_lembaga = time() . '_sip_kampus_lembaga.' . $extension_sip_kampus_lembaga;
            $path_sip_kampus_lembaga = 'uploads/izin_penelitian/sip_kampus_lembaga/';
            $file_sip_kampus_lembaga->move($path_sip_kampus_lembaga, $filename_sip_kampus_lembaga);

            if(File::exists($izin_penelitian->sip_kampus_lembaga)){
                File::delete($izin_penelitian->sip_kampus_lembaga);
            }

            $izin_penelitian->sip_kampus_lembaga = $path_sip_kampus_lembaga . $filename_sip_kampus_lembaga;
        }

        $izin_penelitian->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'sr_kesbangpol' => $izin_penelitian->sr_kesbangpol ?? $izin_penelitian->getOriginal('sr_kesbangpol'),
            'sip_kampus_lembaga' => $izin_penelitian->sip_kampus_lembaga ?? $izin_penelitian->getOriginal('sip_kampus_lembaga'),
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()->route('izin_penelitian')->with('status', 'Data Pengaduan berhasil diperbaharui!');
    }

    public function destroy(string $id)
    {
        $izin_penelitian = IzinPenelitian::findOrFail($id);
        if(File::exists($izin_penelitian->sr_kesbangpol)){
            File::delete($izin_penelitian->sr_kesbangpol);
        }
        if(File::exists($izin_penelitian->sip_kampus_lembaga)){
            File::delete($izin_penelitian->sip_kampus_lembaga);
        }

        $izin_penelitian -> delete();
        return redirect()->back()->with('status', 'Data Pengaduan berhasil dihapus!');
    }

    public function generatePDF()
    {
        $izin_penelitian = IzinPenelitian::get();
        $data = [
            'title' => 'Daftar Data Pengaduan Tidak Langsung',
            'date' => date('d/m/Y'),
            'izin_penelitian' => $izin_penelitian
        ];

        $pdf = PDF::loadView('izin_penelitian.pdf', $data);
        return $pdf->download('Izin Penelitian.pdf');
    }
    
    public function filter(Request $request)
    {
        // Get the selected statuses from the request
        $statuses = $request->input('statuses');
    
        // Query to filter by status
        $query = IzinPenelitian::query();
    
        if (!empty($statuses)) {
            $query->whereIn('status', $statuses); // Filter records based on selected statuses
        }
    
        $filteredStatuses = $query->get();
    
        // Return filtered data as JSON for the AJAX call
        return response()->json(['statuses' => $filteredStatuses]);
    }
}
