<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ObatController extends Controller
{
    public function index()
    {
        $obats = Obat::where("deleted",false)->get();
        return view('dokter.obat.index')->with([
            'obats' => $obats,
        ]);
    }

    public function create()
    {
        return view('dokter.obat.create');
    }

    public function restore()
    {
        $obats = Obat::where("deleted",true)->get();
        return view('dokter.obat.restore')->with([
            'obats' => $obats,
        ]);
    }

    public function edit($id)
    {
        $obat = Obat::find($id);
        return view('dokter.obat.edit')->with([
            'obat' => $obat,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);

        return redirect()->route('dokter.obat.index')->with('status', 'obat-created');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'kemasan' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
        ]);

        $obat = Obat::find($id);
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
        ]);

        return redirect()->route('dokter.obat.index')->with('status', 'obat-updated');
    }
    public function destroy($id)
    {
        $obat = Obat::find($id);
        $obat->delete();

        return redirect()->route('dokter.obat.restore');
    }
    
    public function softdestroy($id)
    {
        $obat = Obat::findOrFail($id);

        if (!$obat->deleted) {

            $obat->deleted = 1;
            $obat->save();

            return redirect()->route('dokter.obat.index');
        }

        $obat->deleted = 0;
        $obat->save();

        return redirect()->route('dokter.obat.restore');
    }
}