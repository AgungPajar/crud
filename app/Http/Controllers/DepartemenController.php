<?php

namespace App\Http\Controllers;

use App\Models\Departemen;
use Illuminate\Http\Request;
use App\Models\Karyawan;

class DepartemenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $departemen = Departemen::all();
        return response()->json($departemen);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view ('departemen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'nama_departemen' => 'required|string|max:255',
        ]);

        $departemen = Departemen::create([
            'nama_departemen' => $request->nama_departemen,
        ]);

        return response()->json([
            'message' => 'Departemen berhasil ditambahkan',
            'data' => $departemen,
        ], 201); // HTTP Status Code 201 Created
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $departemen = Departemen::find($id);

        if (!$departemen) {
            return response()->json([
                'message' => 'Departemen tidak ditemukan',
            ], 404); // HTTP Status Code 404 Not Found
        }

        return response()->json($departemen);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $data = Departemen::where('id',$id)->first();
        return view('departemen.edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'nama_departemen' => 'required|string|max:255',
        ]);

        $departemen = Departemen::find($id);

        if (!$departemen) {
            return response()->json([
                'message' => 'Departemen tidak ditemukan',
            ], 404); // HTTP Status Code 404 Not Found
        }

        $departemen->update([
            'nama_departemen' => $request->nama_departemen,
        ]);

        return response()->json([
            'message' => 'Departemen berhasil diupdate',
            'data' => $departemen,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        $departemen = Departemen::find($id);

        if (!$departemen) {
            return response()->json([
                'message' => 'Departemen tidak ditemukan',
            ], 404); // HTTP Status Code 404 Not Found
        }

        $departemen->delete();

        return response()->json([
            'message' => 'Departemen berhasil dihapus',
        ]);
    }
}
