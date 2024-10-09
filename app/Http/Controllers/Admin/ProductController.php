<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{

    public function index()
    {

        $products = Product::all();

        confirmDelete('Hapus Data! ', 'Apakah anda yakin ingin menghapus data ini?');

        return view('pages.admin.product.index', compact('products'));
    }

    public function detail($id)
    {
        $product = Product::findOrFail($id); // findOrFail untuk menemukan produk berdasarkan ID

        return view('pages.admin.product.detail', compact('product')); // compact('product'), bukan 'products'
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id); // findOrFail untuk menemukan produk berdasarkan ID

        return view('pages.admin.product.edit', compact('product')); // compact('product'), bukan 'products'
    }




    public function create()
    {

        return view('pages.admin.product.create');

    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'price' => 'numeric',
            'category' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpeg,jpg',

        ]);

        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back();
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image'); // Menggunakan method file(), bukan files()
            $imageName = time() . '.' . $image->getClientOriginalExtension(); // Membuat nama file unik
            $image->move(public_path('images'), $imageName); // Pindahkan file ke folder public/images/
        }

        /* if ($request ->hasFile('image')){
             $image = $request->files('image');
             $imageName = time() . '.' . $image ->getClientOriginalExtension();
             $image -> move ('images/', $imageName);
         }
             */

        $product = Product::create([

            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'description' => $request->description,
            'image' => $imageName,

        ]);

        if ($product) {
            Alert::success('Berhasil!', 'Produk berhasil ditambahkan! ');
            // return redirect()->route('admin,product');
            return redirect()->route('admin.product');


        } else {
            Alert::error('Gagal!', 'Produk gagl ditambahkan!');
            return redirect()->back();
        }


    }

    public function update(Request $request, $id)
    {
        // Validasi input
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'price' => 'required|numeric',
            'category' => 'required',
            'description' => 'required',
            'image' => 'nullable|mimes:png,jpeg,jpg',
        ]);

        // Jika validasi gagal
        if ($validator->fails()) {
            Alert::error('Gagal!', 'Pastikan semua terisi dengan benar!');
            return redirect()->back();

        }

        // Cari produk berdasarkan ID
        $product = Product::findOrFail($id);

        // Handle penggantian gambar
        if ($request->hasFile('image')) {
            $oldImagePath = public_path('images/' . $product->image);
            if (File::exists($oldImagePath)) {
                File::delete($oldImagePath);
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move('images/', $imageName);
        } else {
            $imageName = $product->image; // Gunakan gambar lama jika tidak ada yang baru
        }

        // Update data produk
        $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'category' => $request->category,
            'description' => $request->description,
            'image' => $imageName,
        ]);

        // Redirect dengan pesan sukses atau gagal
        if ($product) {
            return redirect()->route('admin.product')
                ->with('success', 'Produk berhasil diperbarui!');
        } else {
            return redirect()->back()
                ->with('error', 'Produk gagal diperbarui!');
        }
    }

    public function delete($id)
    {
        $product = Product::findOrFail($id);

        $oldPath = public_path('images/' . $product->image);
        if (File::exists($oldPath)) {
            File::delete($oldPath);
        }

        $product->delete();

        if ($product) {
            Alert::success('Berhasil!', 'Produk berhasil dihapus!');
            return redirect()->back();
        } else {
            Alert::error('Gagal!', 'Produk gagal dihapus!');
            return redirect()->back();
        }
    }


}
