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
    public function index(){

        $products = Product::all();

        return view('pages.admin.product.index', compact('products'));
    }

    public function create(){

        return view('pages.admin.product.create');

    }

    public function store (Request $request){

        $validator = Validator::make($request->all(), [

            'name' => 'required',
            'price' => 'numeric',
            'category' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:png,jpeg,jpg',

        ]);

        if ($validator ->fails()){
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

        if ($product){
            Alert::success('Berhasil!','Produk berhasil ditambahkan! ');
           // return redirect()->route('admin,product');
           return redirect()->route('admin.product');


        } else {
            Alert::error('Gagal!', 'Produk gagl ditambahkan!');
            return redirect()->back();
        }


    }
}
