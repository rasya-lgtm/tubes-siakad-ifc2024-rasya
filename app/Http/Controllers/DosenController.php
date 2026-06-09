<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataDosen = Dosen::orderByDesc('nidn')->get();
        return view('dosen.index', compact('dataDosen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'nidn' => 'required|max:10|unique:dosen,nidn',
            'nama' => 'required|max:50',
        ]);

        Dosen::create($validate);
        return redirect()->route('dosen.index')->with('success', 'data dosen berhasil ditambah');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $nidn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $nidn)
    {
        $dataDosen = Dosen::findOrFail($nidn);
        return view('dosen.edit', compact('dataDosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nidn)
    {
        $validate = $request->validate([
        'nidn' => 'required|max:10|unique:dosen,nidn,' . $nidn . ',nidn',
        'nama' => 'required|max:50',
      ]);

      $dataDosen = Dosen::findOrfail($nidn);
      $dataDosen->update($validate);
      return redirect()->route('dosen.index')->with('success', 'data berhasil di edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nidn)
    {
        $dataDosen = Dosen::findOrFail($nidn);
        $dataDosen->delete();
        return redirect()->route('dosen.index')->with('success', 'data berhasil dihapus');
    }
}
