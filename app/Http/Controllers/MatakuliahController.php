<?php

namespace App\Http\Controllers;

use App\Models\Matakuliah;
use Illuminate\Http\Request;

class MatakuliahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataMatakuliah = Matakuliah::orderByDesc('kode_matakuliah')->get();
        return view('matakuliah.index', compact('dataMatakuliah'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('matakuliah.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'kode_matakuliah' => 'required|max:8|unique:matakuliah,kode_matakuliah',
            'nama_matakuliah' => 'required|max:50',
            'sks' => 'required|integer|min:1|max:6',
        ]);

        Matakuliah::create($validate);
        return redirect()->route('matakuliah.index')->with('success', 'Data matakuliah berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $kode_matakuliah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $kode_matakuliah)
    {
        $dataMatakuliah = Matakuliah::findOrFail($kode_matakuliah);
        return view('matakuliah.edit', compact('dataMatakuliah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $kode_matakuliah)
    {
        $validate = $request->validate([
            'kode_matakuliah' => 'required|max:8|unique:matakuliah,kode_matakuliah,' . $kode_matakuliah . ',kode_matakuliah',
            'nama_matakuliah' => 'required|max:50',
            'sks' => 'required|integer|min:1|max:6',
        ]);

        $dataMatakuliah = Matakuliah::findOrFail($kode_matakuliah);
        $dataMatakuliah->update($validate);
        return redirect()->route('matakuliah.index')->with('success', 'Data matakuliah berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $kode_matakuliah)
    {
        $dataMatakuliah = Matakuliah::findOrFail($kode_matakuliah);
        $dataMatakuliah->delete();
        return redirect()->route('matakuliah.index')->with('success', 'Data matakuliah berhasil dihapus');
    }
}