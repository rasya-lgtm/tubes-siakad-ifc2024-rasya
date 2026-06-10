<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Jadwal;
use App\Models\Matakuliah;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role == 'admin') {
            $dataJadwal = Jadwal::orderByDesc('id')->get();
        } else {
            $npm = auth()->user()->npm;
            $dataJadwal = Jadwal::whereHas('matakuliah.krs', function($q) use ($npm) {
                $q->where('npm', $npm);
            })->orderByDesc('id')->get();
        }
        return view('jadwal.index', compact('dataJadwal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dataDosen = Dosen::all();
        $dataMatakuliah = Matakuliah::all();

        return view('jadwal.create', compact('dataDosen','dataMatakuliah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'kode_matakuliah' => 'required|max:10',
            'nidn' => 'required|max:10',
            'kelas' => 'required',
            'hari' => 'required',
            'jam' => 'required',
        ]);

        Jadwal::create($validate);
        return redirect()->route('jadwal.index')->with('success', 'data berhasil ditambah');

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
        $dataJadwal = Jadwal::findOrFail($id);
        $dataDosen = Dosen::all();
        $dataMatakuliah = Matakuliah::all();
        return view('jadwal.edit', compact('dataJadwal', 'dataDosen', 'dataMatakuliah'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
        'kode_matakuliah' => 'required|max:10',
        'nidn' => 'required|max:10',
        'kelas' => 'required',
        'hari' => 'required',
        'jam' => 'required',
      ]);

        $dataJadwal = Jadwal::findOrFail($id);
        $dataJadwal->update($validate);
        return redirect()->route('jadwal.index')->with('success', 'data berhasil di edit');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dataJadwal = Jadwal::findOrFail($id);
        $dataJadwal->delete();
        return redirect()->route('jadwal.index')->with('success', 'data berhasil di hapus');
    }
}
