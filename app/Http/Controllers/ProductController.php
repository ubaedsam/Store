<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    // Untuk CRUD Nomor 2

    // Halaman Utama Product
    public function index()
    {
        $product = Product::orderBy('id','ASC')->get();

        return view('products', compact('product'));
    }

    // Proses tambah data
    public function addProduct(Request $request)
    {
        $product = new Product();
        $product->nama_product = $request->nama_product;
        $product->jenis_product = $request->jenis_product;
        $product->jumlah = $request->jumlah;
        $product->harga = $request->harga;
        $product->save();
        return response()->json($product);
    }

    // Mengambil data product berdasarkan id
    public function getProductById($id)
    {
        $product = Product::find($id);
        return response()->json($product);
    }

    // Proses mengubah data
    public function updateProduct(Request $request)
    {
        $product = Product::find($request->id);
        $product->nama_product = $request->nama_product;
        $product->jenis_product = $request->jenis_product;
        $product->jumlah = $request->jumlah;
        $product->harga = $request->harga;
        $product->save();
        return response()->json($product);
    }

    // Proses menghapus data
    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        return response()->json();
    }

    // Untuk API Nomor 3

    // menampilkan semua data product
    public function getallproduct()
    {
        $products = Product::paginate(10);

        return ProductResource::collection($products);
    }
}
