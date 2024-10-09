<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class UserController extends Controller
{

    public function index()
    {
        $products = Product::all(); // Mengambil semua produk dari database
        return view('pages.user.index', compact('products')); // Mengirim produk ke view
    }

    public function show($id)
    {
        $product = Product::findOrFail($id); // Mengambil detail produk berdasarkan ID

        return view('pages.user.product.detail', compact('product')); // Mengirim produk ke view detail
    }
 
    /*
    public function show($id)
{
    $product = Product::findOrFail($id);

    return view('pages.user.product.detail', compact('products'));
}

   public function index(){

        $products = Product::all();

        return view('pages.user.index', compact('products'));
    }
        */
}
