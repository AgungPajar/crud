@extends('layouts/app')
@section('content')

<form action="{{ url('karyawan/'.$data->nip) }}" method="POST">
  @csrf
  @method('PUT')
  <div class="row">
    <div class="col-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6>Formulir Edit karyawan</h6>
        </div>
        <div class="card-body">
          <div class="form-group">
            <label for="">Nama karyawan</label>
            <input type="text" class="form-control" name="nama_karyawan" value="{{ $data->nama_karyawan }}">
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
