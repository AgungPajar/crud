@extends('layouts/app')
@section('content')
<form action="{{route('karyawan.store')}}" method="POST">
  @csrf
  <div class="row">
    <div class="col-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6>Formulir Tambah Karyawan</h6>
        </div>

        <div class="card-body">

          <div class="form-group">
            <label for="">Nip</label>
            <input type="number" class="form-control" name="nip"  >
          </div>
          <div class="form-group">
            <label for="">Nama Karyawan</label>
            <input type="text" class="form-control" name="nama_karyawan">
          </div>
          <div class="form-group">
            <label for="">Gaji Karyawan</label>
            <input type="number" class="form-control" name="gaji_Karyawan">
          </div>
          <div class="form-group">
            <label for="">Alamat</label>
            <textarea class="form-control" name="alamat" ></textarea>
          </div>
          <div class="form-group">
            <label for="">Jenis Kelamin</label>
            <select name="jenis_kelamin">
              <option value="" selected disabled hidden>--pilih  jenis kelamin--</option>
              <option value="Pria">Pria</option>
              <option value="Wanita">Wanita</option>
            </select>
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