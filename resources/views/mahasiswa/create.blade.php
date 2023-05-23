@extends('layout.main')
@section('title', 'Tambah Mahasiswa')
@section('content')
<div class="row">
          <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Tambah Mahasiswa</h4>
                  <p class="card-description">
                    Formulir Tambah Mahasiswa
                  </p>
                  <form class="forms-sample" action="{{ route('mahasiswa.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="form-group col-lg-6">
                        <label for="npm">Nomor Pokok Mahasiswa</label>
                        <input type="text" class="form-control" name="npm" placeholder="Nomor Pokok Mahasiswa" value="{{ old('npm') }}">
                        @error('npm')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group col-lg-6">
                        <label for="nama">Nama Mahasiswa</label>
                        <input type="text" class="form-control" name="nama" placeholder="Nama Mahasiswa" value="{{ old('nama') }}">
                        @error('nama')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                        <label for="kota_lahir">Kota Lahir</label>
                        <input type="text" class="form-control" name="kota_lahir" placeholder="Nama Kota Lahir" value="{{ old('kota_lahir') }}">
                        @error('kota_lahir')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                        <div class="form-group col-lg-6">
                        <label for="tanggal">Tanggal Lahir</label>
                        <input type="date" class="form-control" name="tanggal" placeholder="" value="{{ old('tanggal') }}">
                        @error('tanggal')
                                <span class="text-danger">{{ $message }}</span>
                        @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6">
                            <label for="prodi_id">Program Studi</label>
                            <select name="prodi_id" class="form-control js-example-basic-single">
                                <option value="">Pilih Nama Program Studi</option>
                                @foreach ($prodi as $item)
                                    <option value="{{ $item['id'] }}">{{ $item->fakultas->nama_fakultas }} - {{ $item['nama_prodi'] }}</option>
                                @endforeach
                            </select>
                            @error('prodi_id')
                                    <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-lg-6">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" name="foto" placeholder="">
                            @error('foto')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Simpan</button>
                    <a href="{{ route('mahasiswa.index') }}" class="btn btn-light">Batal</a>
                  </form>
                </div>
              </div>
            </div>
</div>
@endsection
