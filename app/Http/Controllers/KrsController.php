<?php

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class KrsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $dataKrs = Krs::orderByDesc('id')->get();
        } else {
            $npm = auth()->user()->npm;
            $dataKrs = Krs::where('npm', $npm)->orderByDesc('id')->get();
        }
        return view('krs.index', compact('dataKrs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataMahasiswa = Mahasiswa::all();
        $dataMatakuliah = Matakuliah::all();
        return view('krs.create', compact('dataMahasiswa', 'dataMatakuliah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Jika bukan admin, pastikan user punya NPM di profilnya
        if (auth()->user()->role !== 'admin' && !auth()->user()->npm) {
            return redirect()->back()->withErrors(['npm' => 'Profil Anda belum memiliki NPM. Silakan hubungi admin.'])->withInput();
        }

        $validate = $request->validate([
            'npm' => 'required|max:10',
            'kode_matakuliah' => 'required|max:8',
        ]);

        Krs::create($validate);
        return redirect()->route('krs.index')->with('success', 'data berhasil di tambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataKrs = Krs::findOrFail($id);
        $dataKrs->delete();
        return redirect()->route('krs.index')->with('success', 'data berhasil di hapus');
    }
}
