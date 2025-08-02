<?php

namespace App\Http\Controllers;

use App\Models\mocimodel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class mocicontroller extends Controller
{
    public function index()
    {
        return view("table.moci");
    }

    public function data()
    {
        return response()->json(['data' => mocimodel::all()]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'gambar' => 'nullable|image|max:2048',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'stok' => 'required|integer|min:0',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('moci', 'public');
        }

        $moci = mocimodel::create([
            'nama' => $request->nama,
            'gambar' => $gambar,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            'stok' => $request->stok,
        ]);

        return response()->json($moci);
    }

    public function show($id)
    {
        $produk = mocimodel::findOrFail($id);
        return response()->json($produk);
    }

    public function update(Request $request, $id)
    {
        $moci = mocimodel::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required',
            'gambar' => 'nullable|image|max:2048',
            'harga' => 'required|numeric',
            'deskripsi' => 'required',
            'stok' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('gambar')) {
            if ($moci->gambar) {
                Storage::disk('public')->delete($moci->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('moci', 'public');
        }

        $moci->update($data);

        return response()->json($moci);
    }

    public function destroy($id)
    {
        $moci = mocimodel::findOrFail($id);

        if ($moci->gambar) {
            Storage::disk('public')->delete($moci->gambar);
        }

        $moci->delete();

        return response()->json(['message' => 'Produk dihapus']);
    }
}
