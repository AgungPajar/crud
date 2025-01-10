<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Departemen;


class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::all();
        return view('karyawan.index', ['karyawan' => $karyawan]);
    }

    public function create()
    { 
        $departemen = Departemen::all();
        return view('karyawan.create',['departemen'=>$departemen]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'nama_karyawan' => 'required',
            'gaji_karyawan' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nip.required' => 'NIP wajib diisi',
            'nama_karyawan.required' => 'Nama Karyawan wajib diisi',
            'gaji_karyawan.required' => 'Gaji Karyawan wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib dipilih',
            'foto.required' => 'Foto Wajib Diisi!',
            'foto.image' => 'File harus berupa gambar',
        ]);

        $foto_file = $request->file('foto');
        $foto_ekstensi = $foto_file->extension();
        $foto_nama = date('ymdhis') . "." . $foto_ekstensi;
        $foto_file->move(public_path('foto'), $foto_nama);


        $data = [
            'nip' => $request->input('nip'),
            'nama_karyawan' => $request->input('nama_karyawan'),
            'gaji_karyawan' => $request->input('gaji_karyawan'),
            'alamat' => $request->input('alamat'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'departemen_id' => $request->input('departemen_id'),
            'foto' => $foto_nama,
        ];

        Karyawan::create($data);
        return redirect('karyawan')->with('success', 'Karyawan berhasil ditambahkan');
    }

    public function show(Karyawan $karyawan)
    {
        //
    }

    public function edit($id)
    {
        $data = Karyawan::where('nip', $id)->first();
        return view('karyawan.edit')->with('data', $data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nip' => 'required',
            'nama_karyawan' => 'required',
            'gaji_karyawan' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
        ], [
            'nip.required' => 'NIP Wajib Diisi!',
            'nama_karyawan.required' => 'Nama Karyawan Wajib Diisi!',
            'gaji_karyawan.required' => 'Gaji Karyawan Wajib Diisi!',
            'alamat.required' => 'Alamat Karyawan Wajib Diisi!',
            'jenis_kelamin.required' => 'Data Jenis Kelamin Wajib Diisi!',
        ]);

        $data = [
            'nip' => $request->nip,
            'nama_karyawan' => $request->nama_karyawan,
            'gaji_karyawan' => $request->gaji_karyawan,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
        ];

        if ($request->hasFile('foto')) {
            $request->validate([
                'foto' => 'mimes:jpeg,jpg,png,gif'
            ], [
                'foto.mimes' => 'Foto yang diperbolehkan berekstensi jpeg, jpg, png, gif'
            ]);

            $foto_file = $request->file('foto');
            $foto_ekstensi = $foto_file->extension();
            $foto_nama = date('ymdhis') . "." . $foto_ekstensi;
            $foto_file->move(public_path('foto'), $foto_nama);

            $data_foto = Karyawan::where('nip', $id)->first();
            if ($data_foto && $data_foto->foto) {
                File::delete(public_path('foto') . '/' . $data_foto->foto);
            }

            $data['foto'] = $foto_nama;
        }

        Karyawan::where('nip', $id)->update($data);
        return redirect('karyawan')->with('success', 'Data Berhasil Diubah!');
    }



    public function destroy($id)
    {
        //

        $data = Karyawan::where('nip', $id)->first();
        File::delete(public_path('foto') . '/' . $data->foto);

        Karyawan::where('nip', $id)->delete();
        return redirect('karyawan')->with('success', 'Data Berhasil Dihapus!');
    }
}
