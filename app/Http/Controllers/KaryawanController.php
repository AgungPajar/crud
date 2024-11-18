<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class KaryawanController extends Controller
{
    public function index()
    {
        $karyawan = Karyawan::all();
        return view('karyawan.index', ['karyawan' => $karyawan]);
    }

    public function create()
    {
        return view('karyawan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required',
            'nama_karyawan' => 'required',
            'gaji_karyawan' => 'required',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
        ],[
            'nip.required' => 'NIP wajib diisi',
            'nama_karyawan.required' => 'Nama Karyawan wajib diisi',
            'gaji_karyawan.required' => 'Gaji Karyawan wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib dipilih',
        ]);

        $data = [
            'nip' => $request->input('nip'),
            'nama_karyawan' => $request->input('nama_karyawan'),
            'gaji_karyawan' => $request->input('gaji_karyawan'),
            'alamat' => $request->input('alamat'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
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
            'nama_karyawan' => 'required',
        ]);

        $data = [
            'nama_karyawan' => $request->nama_karyawan,
        ];

        Karyawan::where('nip', $id)->update($data);
        return redirect('karyawan')->with('success', 'Karyawan berhasil diubah');
    }

    public function destroy($id)
    {
        Karyawan::where('nip', $id)->delete();
        return redirect('karyawan')->with('success', 'Karyawan berhasil dihapus');
    }
}
