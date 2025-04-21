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
        $karyawan = Karyawan::with('departemen')->get();
        return response()->json($karyawan);
    }

    public function create()
    { 
        $departemen = Departemen::all();
        return view('karyawan.create',['departemen'=>$departemen]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:karyawan,nip',
            'nama_karyawan' => 'required',
            'gaji_karyawan' => 'required|numeric',
            'alamat' => 'required',
            'jenis_kelamin' => 'required|in:Pria,Wanita', // Laki-laki (L) atau Perempuan (P)
            'departemen_id' => 'required|exists:departemen,id', // Pastikan departemen_id valid
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nip.required' => 'NIP wajib diisi',
            'nip.unique' => 'NIP sudah digunakan',
            'nama_karyawan.required' => 'Nama Karyawan wajib diisi',
            'gaji_karyawan.required' => 'Gaji Karyawan wajib diisi',
            'gaji_karyawan.numeric' => 'Gaji Karyawan harus berupa angka',
            'alamat.required' => 'Alamat wajib diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib dipilih',
            'foto.required' => 'Foto wajib diisi',
            'foto.image' => 'File harus berupa gambar',
        ]);

        // Simpan file foto
        $foto_file = $request->file('foto');
        $foto_ekstensi = $foto_file->extension();
        $foto_nama = date('ymdhis') . "." . $foto_ekstensi;
        $foto_file->move(public_path('foto'), $foto_nama);

        // Simpan data karyawan
        $data = [
            'nip' => $request->input('nip'),
            'nama_karyawan' => $request->input('nama_karyawan'),
            'gaji_karyawan' => $request->input('gaji_karyawan'),
            'alamat' => $request->input('alamat'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'departemen_id' => $request->input('departemen_id'),
            'foto' => $foto_nama,
        ];

        $karyawan = Karyawan::create($data);

        return response()->json([
            'message' => 'Karyawan berhasil ditambahkan',
            'data' => $karyawan,
        ], 201);
    }

    public function show($id)
    {
        //
        $karyawan = Karyawan::with('departemen')->find($id);

        if (!$karyawan) {
            return response()->json([
                'message' => 'Karyawan tidak ditemukan',
            ], 404); // HTTP Status Code 404 Not Found
        }

        return response()->json($karyawan);
    }

    public function edit($id)
    {
        $departemen = Departemen::all();
        $data = Karyawan::where('nip', $id)->first();
        
        return view('karyawan.edit',['departemen'=>$departemen, 'data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nip' => 'required|unique:karyawan,nip,' . $id,
            'nama_karyawan' => 'required',
            'gaji_karyawan' => 'required|numeric',
            'alamat' => 'required',
            'jenis_kelamin' => 'required|in:Pria,Wanita',
            'departemen_id' => 'required|exists:departemen,id',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nip.required' => 'NIP wajib diisi',
            'nip.unique' => 'NIP sudah digunakan',
            'nama_karyawan.required' => 'Nama Karyawan wajib diisi',
            'gaji_karyawan.required' => 'Gaji Karyawan wajib diisi',
            'gaji_karyawan.numeric' => 'Gaji Karyawan harus berupa angka',
            'alamat.required' => 'Alamat wajib diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib dipilih',
            'foto.image' => 'File harus berupa gambar',
        ]);

        $karyawan = Karyawan::find($id);

        if (!$karyawan) {
            return response()->json([
                'message' => 'Karyawan tidak ditemukan',
            ], 404); // HTTP Status Code 404 Not Found
        }

        $data = [
            'nip' => $request->input('nip'),
            'nama_karyawan' => $request->input('nama_karyawan'),
            'gaji_karyawan' => $request->input('gaji_karyawan'),
            'alamat' => $request->input('alamat'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'departemen_id' => $request->input('departemen_id'),
        ];

        // Jika ada file foto baru, hapus foto lama dan simpan yang baru
        if ($request->hasFile('foto')) {
            $foto_file = $request->file('foto');
            $foto_ekstensi = $foto_file->extension();
            $foto_nama = date('ymdhis') . "." . $foto_ekstensi;
            $foto_file->move(public_path('foto'), $foto_nama);

            // Hapus foto lama jika ada
            if ($karyawan->foto) {
                File::delete(public_path('foto') . '/' . $karyawan->foto);
            }

            $data['foto'] = $foto_nama;
        }

        $karyawan->update($data);

        return response()->json([
            'message' => 'Karyawan berhasil diupdate',
            'data' => $karyawan,
        ]);
    }



    public function destroy($id)
    {
        //
        $karyawan = Karyawan::find($id);

        if (!$karyawan) {
            return response()->json([
                'message' => 'Karyawan tidak ditemukan',
            ], 404); // HTTP Status Code 404 Not Found
        }

        // Hapus foto jika ada
        if ($karyawan->foto) {
            File::delete(public_path('foto') . '/' . $karyawan->foto);
        }

        $karyawan->delete();

        return response()->json([
            'message' => 'Karyawan berhasil dihapus',
        ]);
    }
}
