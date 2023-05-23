<?php

namespace App\Http\Controllers;

use App\Models\Fakultas;
use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{
    //
    public function index(){
        $prodi = prodi::all();
        // dd($prodi);
        return view('prodi.index')->with('prodis', $prodi);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $fakultas = Fakultas::all();
        $fakultas = Fakultas::orderBy('nama_fakultas', 'ASC')->get();
        return view('prodi.create')->with('fakultas', $fakultas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        // validasi data
        $validasi = $request->validate([
            'nama_prodi' => 'required|unique:prodi',
            'fakultas_id' => 'required'
        ]);
        // dd($validasi);

        // buat objek dari model Prodi
        $prodi = new Prodi();
        $prodi->nama_prodi = $validasi['nama_prodi'];
        $prodi->fakultas_id = $validasi['fakultas_id'];
        $prodi->save(); // simpan

        return redirect()->route('prodi.index')->with('success', "Data program studi ".$validasi['nama_prodi']." berhasil disimpan");
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
        //
    }
}
