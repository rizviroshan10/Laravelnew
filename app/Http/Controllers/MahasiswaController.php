<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $keyword = $request->query('search');

        if ($keyword){

            $mahasiswa = Mahasiswa::where
            ('nama','LIKE',"%{$keyword}%") -> paginate(10);
        }
        else{
            $mahasiswa = Mahasiswa::paginate(10);

        }

        return view('mahasiswa.index')->with('mahasiswas', $mahasiswa);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prodi = Prodi::orderBy('nama_prodi', 'ASC')->get();
        return view('mahasiswa.create')->with('prodi', $prodi);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validasi = $request->validate([
            'npm' => 'required|unique:mahasiswas',
            'nama' => 'required',
            'kota_lahir' => 'required',
            'tanggal' => 'required',
            'prodi_id' => 'required',
            'foto' => 'required|file|image'
        ]);
        $mahasiswa = new Mahasiswa();
        $mahasiswa->npm = $validasi['npm'];
        $mahasiswa->nama = $validasi['nama'];
        $mahasiswa->kota_lahir = $validasi['kota_lahir'];
        $mahasiswa->tanggal = $validasi['tanggal'];
        $mahasiswa->prodi_id = $validasi['prodi_id'];

        // upload foto
        $ext = $request->foto->getClientOriginalExtension();
        $new_filename = $validasi['npm'].".".$ext;
        $request->foto->storeAs('public', $new_filename);

        $mahasiswa->foto = $new_filename;
        $mahasiswa->save(); // simpan

        return redirect()->route('mahasiswa.index')->with('success', "Data mahasiswa " . $validasi['nama'] . " berhasil disimpan");

    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        $prodi = Prodi::orderBy('nama_prodi', 'ASC')->get();
        return view('mahasiswa.edit')->with('mahasiswa', $mahasiswa)->with('prodi', $prodi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validasi = $request->validate([
            'nama' => 'required',
            'kota_lahir' => 'required',
            'tanggal' => 'required',
            'prodi_id' => 'required',
            'foto' => 'required|file|image'
        ]);
        //masih pake npm yang lama
        $mahasiswa->npm = $mahasiswa->npm;
        $mahasiswa->nama = $validasi['nama'];
        $mahasiswa->kota_lahir = $validasi['kota_lahir'];
        $mahasiswa->tanggal = $validasi['tanggal'];
        $mahasiswa->prodi_id = $validasi['prodi_id'];

        // upload foto
        $ext = $request->foto->getClientOriginalExtension();
        $new_filename = $mahasiswa->npm.".".$ext;
        $request->foto->storeAs('public', $new_filename);

        $mahasiswa->foto = $new_filename;
        $mahasiswa->save(); // simpan

        return redirect()->route('mahasiswa.index')->with('success', "Data mahasiswa " . $validasi['nama'] . " berhasil disimpan");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        // dd($mahasiswa);
        $mahasiswa->delete();
        //return redirect()->route('mahasiswa.index')->with('success', 'Data berhasil dihapus');
        return response("Selected mahasiswa (s) deleted successfully.",200);
    }

    public function multiDelete(Request $request)
    {
        Mahasiswa::whereIn('id', $request->get('selected'))->delete();

        return response("Selected mahasiswa(s) deleted successfully.", 200);
    }
}
