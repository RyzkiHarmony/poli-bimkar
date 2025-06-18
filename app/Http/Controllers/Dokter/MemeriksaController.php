<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\DetailPeriksa;
use App\Models\JanjiPeriksa;
use App\Models\Obat;
use App\Models\Periksa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemeriksaController extends Controller
{
    public function index()
    {
        $dokter = Auth::user();
        
        // Ambil janji periksa yang belum diperiksa untuk dokter yang sedang login
        $janjiPeriksas = JanjiPeriksa::with(['pasien', 'jadwalPeriksa'])
            ->whereHas('jadwalPeriksa', function($query) use ($dokter) {
                $query->where('id_dokter', $dokter->id);
            })
            ->whereDoesntHave('periksa')
            ->orderBy('no_antrian', 'asc')
            ->get();
        
        return view('dokter.memeriksa.index', compact('janjiPeriksas'));
    }

    public function create($id)
    {
        $janjiPeriksa = JanjiPeriksa::with(['pasien', 'jadwalPeriksa'])->findOrFail($id);
        $obats = Obat::where('deleted', 0)->get();
        
        return view('dokter.memeriksa.create', compact('janjiPeriksa', 'obats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_janji_periksa' => 'required|exists:janji_periksas,id',
            'tgl_periksa' => 'required|date',
            'catatan' => 'required|string|max:1000',
            'biaya_periksa' => 'required|numeric|min:0',
            'obat_ids' => 'array',
            'obat_ids.*' => 'exists:obats,id'
        ]);

        // Buat record periksa
        $periksa = Periksa::create([
            'id_janji_periksa' => $request->id_janji_periksa,
            'tgl_periksa' => $request->tgl_periksa,
            'catatan' => $request->catatan,
            'biaya_periksa' => $request->biaya_periksa,
        ]);

        // Simpan detail obat jika ada
        if ($request->has('obat_ids') && is_array($request->obat_ids)) {
            foreach ($request->obat_ids as $obat_id) {
                DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat' => $obat_id,
                ]);
            }
        }

        return redirect()->route('dokter.memeriksa.index')
                        ->with('success', 'Pemeriksaan berhasil disimpan.');
    }

    public function history()
    {
        $dokter = Auth::user();
        
        // Ambil janji periksa yang sudah diperiksa untuk dokter yang sedang login
        $janjiPeriksas = JanjiPeriksa::with(['pasien', 'jadwalPeriksa', 'periksa'])
            ->whereHas('jadwalPeriksa', function($query) use ($dokter) {
                $query->where('id_dokter', $dokter->id);
            })
            ->whereHas('periksa')
            ->get();
        
        return view('dokter.memeriksa.history', compact('janjiPeriksas'));
    }

    public function detail($id)
    {
        $dokter = Auth::user();
        
        // Ambil janji periksa dengan detail pemeriksaan
        $janjiPeriksa = JanjiPeriksa::with([
            'pasien', 
            'jadwalPeriksa.dokter.poli', 
            'periksa.detailPeriksas.obat'
        ])
        ->whereHas('jadwalPeriksa', function($query) use ($dokter) {
            $query->where('id_dokter', $dokter->id);
        })
        ->whereHas('periksa')
        ->findOrFail($id);
        
        return view('dokter.memeriksa.detail', compact('janjiPeriksa'));
    }
}