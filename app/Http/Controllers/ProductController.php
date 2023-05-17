<?php

namespace App\Http\Controllers;

//import Model "product
use App\Models\Product;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get products
        $products = Product::latest()->paginate(5);

        //render view with products
        return view('products.index', compact('products'));
    }

     /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('products.create');
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
             'id_kategori' => 'required',
            'id_subkategori' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'diskon' => 'required',
            'bahan' => 'required',
            'sku' => 'required',
            'tags' => 'required',
            'ukuran' => 'required',
            'warna' => 'required',
            'deskripsi' =>'required',
            'gambar'    => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //upload gambar
        $image = $request->file('gambar');
        $image->storeAs('public/products', $image->hashName());

        //create product
        Product::create([
            'id_kategori'   => $request->id_kategori,
            'id_subkategori'   => $request->id_subkategori,
            'nama_barang'     => $request->nama_barang,
            'harga'   => $request->harga,
            'diskon'   => $request->diskon,
            'bahan'   => $request->bahan,
            'sku'   => $request->sku,
            'tags' => $request->tags,
            'ukuran'   => $request->ukuran,
            'warna'   => $request->warna,
            'deskripsi' => $request->deskripsi,
            'gambar'     => $image->hashName()
            ]);

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

     /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get Product by ID
        $product = Product::findOrFail($id);

        //render view with Product
        return view('products.show', compact('product'));
    }

      /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get Product by ID
        $product = Product::findOrFail($id);

        //render view with Product
        return view('products.edit', compact('product'));
    }
    
      /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return RedirectResponse
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'id_kategori' => 'required',
            'id_subkategori' => 'required',
            'nama_barang' => 'required',
            'harga' => 'required',
            'diskon' => 'required',
            'bahan' => 'required',
            'sku' => 'required',
            'tags' => 'required',
            'ukuran' => 'required',
            'warna' => 'required',
            'deskripsi' =>'required',
            'gambar'    => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //get Product by ID
        $product = Product::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('gambar')) {

            //upload new image
            $image = $request->file('gambar');
            $image->storeAs('public/products', $image->hashName());

            //delete old image
            Storage::delete('public/products/'.$product->gambar);

            //update post with new image
            $product->update([
            'id_kategori'   => $request->id_kategori,
            'id_subkategori'   => $request->id_subkategori,
            'nama_barang'     => $request->nama_barang,
            'harga'   => $request->harga,
            'diskon'   => $request->diskon,
            'bahan'   => $request->bahan,
            'sku'   => $request->sku,
            'tags' => $request->tags,
            'ukuran'   => $request->ukuran,
            'warna'   => $request->warna,
            'deskripsi' => $request->deskripsi,
            'gambar'     => $image->hashName()
            ]);

            
        } else {

            //update post without image
            $product->update([
                'nama_barang'     => $request->nama_barang,
                'harga'   => $request->harga
            ]);
        }

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

      /**
     * destroy
     *
     * @param  mixed $product
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get Product by ID
        $product = Product::findOrFail($id);

        //delete image
        Storage::delete('public/products/'. $product->gambar);

        //delete product
        $product->delete();

        //redirect to index
        return redirect()->route('products.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}