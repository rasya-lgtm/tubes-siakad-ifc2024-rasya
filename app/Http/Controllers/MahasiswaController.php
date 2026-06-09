<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataMahasiswa = Mahasiswa::orderByDesc('npm')->get();
        return view('mahasiswa.index', compact('dataMahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataDosen = Dosen::all();
        return view('mahasiswa.create', compact('dataDosen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'npm' => 'required|max:10|unique:mahasiswa,npm',
            'nidn' => 'required|max:10',
            'nama' => 'required|max:50',
        ]);

        Mahasiswa::create($validate);
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $npm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $npm)
    {
        $dataMahasiswa = Mahasiswa::findOrFail($npm);
        $dataDosen = Dosen::all();
        return view('mahasiswa.edit', compact('dataMahasiswa', 'dataDosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $npm)
    {
        $validate = $request->validate([
            'npm' => 'required|max:10|unique:mahasiswa,npm,' . $npm . ',npm',
            'nidn' => 'required|max:10',
            'nama' => 'required|max:50',
        ]);

        $dataMahasiswa = Mahasiswa::findOrFail($npm);
        $dataMahasiswa->update($validate);
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $npm)
    {
        $dataMahasiswa = Mahasiswa::findOrFail($npm);
        $dataMahasiswa->delete();
        return redirect()->route('mahasiswa.index')->with('success', 'Data mahasiswa berhasil dihapus');
    }
}