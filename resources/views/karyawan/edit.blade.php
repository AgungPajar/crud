@extends('layouts/app')
@section('content')
    {{-- Menampilkan error jika ada --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form edit karyawan --}}
    <form action="{{ url('karyawan/' . $data->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6>Formulir Edit Karyawan</h6>
                    </div>
                    <div class="card-body">
                        {{-- Field NIP (readonly jika tidak boleh diubah) --}}
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" name="nip" value="{{ old('nip', $data->nip) }}" readonly>
                        </div>

                        {{-- Nama Karyawan --}}
                        <div class="form-group">
                            <label for="nama_karyawan">Nama Karyawan</label>
                            <input type="text" class="form-control" name="nama_karyawan" value="{{ old('nama_karyawan', $data->nama_karyawan) }}">
                        </div>

                        {{-- Gaji Karyawan --}}
                        <div class="form-group">
                            <label for="gaji_karyawan">Gaji Karyawan</label>
                            <input type="number" class="form-control" name="gaji_karyawan" value="{{ old('gaji_karyawan', $data->gaji_karyawan) }}">
                        </div>

                        {{-- Alamat --}}
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" name="alamat">{{ old('alamat', $data->alamat) }}</textarea>
                        </div>

                        {{-- Jenis Kelamin --}}
                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" name="jenis_kelamin">
                                <option value="" disabled hidden>--Pilih Jenis Kelamin--</option>
                                <option value="Pria" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'Pria' ? 'selected' : '' }}>Pria</option>
                                <option value="Wanita" {{ old('jenis_kelamin', $data->jenis_kelamin) == 'Wanita' ? 'selected' : '' }}>Wanita</option>
                            </select>
                        </div>

                        {{-- Foto --}}
                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control" name="foto" accept="image/*">
                            @if ($data->foto)
                                <br>
                                <label>Foto Saat Ini:</label><br>
                                <img src="{{ asset('storage/' . $data->foto) }}" alt="Foto Karyawan" width="100">
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
