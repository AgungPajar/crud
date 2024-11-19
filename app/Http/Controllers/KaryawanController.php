<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\file;

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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nip.required' => 'NIP wajib diisi',
            'nama_karyawan.required' => 'Nama Karyawan wajib diisi',
            'gaji_karyawan.required' => 'Gaji Karyawan wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib dipilih',
            'foto.image' => 'File harus berupa gambar',
        ]);

        $filePath = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Memberikan nama file unik
            $filePath = $file->storeAs('public/uploads', $fileName); // Menyimpan foto di folder public/uploads
        }


        $data = [
            'nip' => $request->input('nip'),
            'nama_karyawan' => $request->input('nama_karyawan'),
            'gaji_karyawan' => $request->input('gaji_karyawan'),
            'alamat' => $request->input('alamat'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'foto' => $filePath,
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
        // Ambil data karyawan berdasarkan nip
        $data = Karyawan::where('nip', $id)->first();

        // Jika data tidak ditemukan, kembalikan dengan pesan error
        if (!$data) {
            return redirect('karyawan')->with('error', 'Data tidak ditemukan.');
        }

        // Kirim data ke view edit
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
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'nip.required' => 'NIP wajib diisi',
            'nama_karyawan.required' => 'Nama Karyawan wajib diisi',
            'gaji_karyawan.required' => 'Gaji Karyawan wajib diisi',
            'alamat.required' => 'Alamat wajib diisi',
            'jenis_kelamin.required' => 'Jenis Kelamin wajib dipilih',
            'foto.image' => 'File yang diunggah harus berupa gambar.',
            'foto.mimes' => 'Hanya file bertipe JPEG, PNG, atau JPG yang diizinkan.',
            'foto.max' => 'Ukuran foto maksimal adalah 2MB.',
        ]);

        // Ambil data karyawan lama
        $karyawan = Karyawan::find($id); // Cek apakah karyawan ada dengan find($id)

        if (!$karyawan) {
            return redirect('karyawan')->with('error', 'Karyawan tidak ditemukan');
        }

        // Cek apakah foto baru diupload
        $filePath = $karyawan->foto; // Gunakan foto lama jika tidak ada foto baru

        if ($request->hasFile('foto')) {
            if ($karyawan->foto) {
                Storage::delete('public/' . $karyawan->foto); 
            }

            // Simpan foto baru
            $filePath = $request->file('foto')->store('public/uploads');
        }

        $data = [
            'nip' => $request->nip,
            'nama_karyawan' => $request->nama_karyawan,
            'gaji_karyawan' => $request->gaji_karyawan,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'foto' => $filePath,
        ];

        // Update data karyawan
        $karyawan->update($data);

        return redirect('karyawan')->with('success', 'Karyawan berhasil diubah');
    }


    public function destroy($id)
    {
        Karyawan::where('nip', $id)->delete();
        return redirect('karyawan')->with('success', 'Karyawan berhasil dihapus');
    }
}
