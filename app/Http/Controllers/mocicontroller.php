<?php

namespace App\Http\Controllers;

use App\Models\mocimodel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class mocicontroller extends Controller
{
    public function index()
    {
        return view("table.moci");
    }

    public function dashboard()
    {
        $totalProduk = mocimodel::count(); // Menghitung total baris di tabel moci

        return view('admin.content', [
            'totalProduk' => $totalProduk,
            // 'totalStok' => $totalStok,
        ]);
    }

    public function data()
    {
        $moci = mocimodel::with('updatedBy')->get();
        return response()->json(['data' => $moci]);
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
            'updated_by' => Auth::id(),
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
        $data['updated_by'] = Auth::id();
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
    
    public function processCheckout(Request $request)
    {
        $cart = $request->input('cart', []);

        if (empty($cart)) {
            return response()->json(['message' => 'Keranjang kosong.'], 400);
        }

        try {
            DB::transaction(function () use ($cart) {
                foreach ($cart as $id => $item) {
                    $product = mocimodel::findOrFail($id);
                    if ($product->stok >= $item['qty']) {
                        $product->stok -= $item['qty'];
                        $product->save();
                    } else {
                        // Jika stok tidak mencukupi, batalkan transaksi
                        throw new \Exception('Stok untuk produk ' . $product->nama . ' tidak mencukupi.');
                    }
                }
            });

            return response()->json(['message' => 'Stok berhasil diperbarui.']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal memproses checkout: ' . $e->getMessage()], 500);
        }
    }
}
