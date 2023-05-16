<?php

namespace App\Http\Controllers;

//import Model "Category
use App\Models\Category;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get categories
        $categories = Category::latest()->paginate(5);

        //render view with categories
        return view('categories.index', compact('categories'));
    }

     /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('categories.create');
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
            'nama_kategori' => 'required',
            'deskripsi' => 'required',
            'gambar'    => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //upload gambar
        $image = $request->file('gambar');
        $image->storeAs('public/categories', $image->hashName());

        //create category
        Category::create([
            'id_kategori'   => $request->id_kategori,
            'nama_kategori'     => $request->nama_kategori,
            'deskripsi'   => $request->deskripsi,
            'gambar'     => $image->hashName()
        ]);

        //redirect to index
        return redirect()->route('categories.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

     /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get category by ID
        $category = Category::findOrFail($id);

        //render view with category
        return view('categories.show', compact('category'));
    }

      /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get category by ID
        $category = Category::findOrFail($id);

        //render view with category
        return view('categories.edit', compact('category'));
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
            'nama_kategori' => 'required',
            'deskripsi' => 'required',
            'gambar'    => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //get category by ID
        $category = Category::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('gambar')) {

            //upload new image
            $image = $request->file('gambar');
            $image->storeAs('public/categories', $image->hashName());

            //delete old image
            Storage::delete('public/categories/'.$category->gambar);

            //update post with new image
            $category->update([
                'id_kategori'   => $request->id_kategori,
                'nama_kategori'     => $request->nama_kategori,
                'deskripsi'   => $request->deskripsi,
                'gambar'     => $image->hashName()
            ]);

            
        } else {

            //update post without image
            $category->update([
                'nama_kategori'     => $request->nama_kategori,
                'deskripsi'   => $request->deskripsi
            ]);
        }

        //redirect to index
        return redirect()->route('categories.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

      /**
     * destroy
     *
     * @param  mixed $category
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get category by ID
        $category = Category::findOrFail($id);

        //delete image
        Storage::delete('public/categories/'. $category->gambar);

        //delete category
        $category->delete();

        //redirect to index
        return redirect()->route('categories.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}