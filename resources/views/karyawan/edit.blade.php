@extends('layouts/app')
@section('content')
    @if ($errors->any())
        @foreach ($errors->all() as $err)
            <p class="alert alert-danger">{{ $err }}</p>
        @endforeach
    @endif
    <form action="{{ url('karyawan/' . $data->nip) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6>Formulir Edit Karyawan</h6>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">Nip</label>
                            <input type="number" class="form-control" name="nip" value="{{ $data->nip }}">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Karyawan</label>
                            <input type="text" class="form-control" name="nama_karyawan"
                                value="{{ $data->nama_karyawan }}">
                        </div>
                        <div class="form-group">
                            <label for="">Gaji Karyawan</label>
                            <input type="number" class="form-control" name="gaji_karyawan"
                                value="{{ $data->gaji_karyawan }}">
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <textarea class="form-control" name="alamat">{{ $data->alamat }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin">
                                <option value="" selected disabled hidden>--pilih jenis kelamin--</option>
                                <option value="Pria" {{ $data->jenis_kelamin == 'Pria' ? 'selected' : '' }}>Pria</option>
                                <option value="Wanita" {{ $data->jenis_kelamin == 'Wanita' ? 'selected' : '' }}>Wanita
                                </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" id="foto" class="form-control" name="foto" accept="image/*">
                            @if ($data->foto)
                                <br>
                                <label>Foto Saat Ini:</label><br>
                                <img src="{{ Storage::url($data->foto) }}" alt="Foto Karyawan" width="100">
                            @endif
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
