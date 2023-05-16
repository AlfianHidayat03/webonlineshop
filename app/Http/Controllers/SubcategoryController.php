<?php

namespace App\Http\Controllers;

//import Model "Subcategory
use App\Models\Subcategory;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class SubcategoryController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get categories
        $subcategories = Subcategory::latest()->paginate(5);

        //render view with categories
        return view('subcategories.index', compact('subcategories'));
    }

     /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('subcategories.create');
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
            'id_subkategori' => 'required',
            'nama_subkategori' => 'required',
            'deskripsi' => 'required',
            'gambar'    => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //upload gambar
        $image = $request->file('gambar');
        $image->storeAs('public/subcategories', $image->hashName());

        //create Subcategory
        Subcategory::create([
            'id_subkategori'   => $request->id_subkategori,
            'nama_subkategori'     => $request->nama_subkategori,
            'deskripsi'   => $request->deskripsi,
            'gambar'     => $image->hashName()
        ]);

        //redirect to index
        return redirect()->route('subcategories.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

     /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //getSubcategory by ID
        $subcategory =Subcategory::findOrFail($id);

        //render view with Subcategory
        return view('subcategories.show', compact('subcategory'));
    }

      /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //getSubcategory by ID
        $subcategory =Subcategory::findOrFail($id);

        //render view withSubcategory
        return view('subcategories.edit', compact('subcategory'));
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
            'id_subkategori' => 'required',
            'nama_subkategori' => 'required',
            'deskripsi' => 'required',
            'gambar'    => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //getSubcategory by ID
        $subcategory =Subcategory::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('gambar')) {

            //upload new image
            $image = $request->file('gambar');
            $image->storeAs('public/subcategories', $image->hashName());

            //delete old image
            Storage::delete('public/subcategories/'.$subcategory->gambar);

            //update post with new image
            $subcategory->update([
                'id_subkategori'   => $request->id_subkategori,
                'nama_subkategori'     => $request->nama_subkategori,
                'deskripsi'   => $request->deskripsi,
                'gambar'     => $image->hashName()
            ]);

            
        } else {

            //update post without image
            $subcategory->update([
                'nama_subkategori'     => $request->nama_subkategori,
                'deskripsi'   => $request->deskripsi
            ]);
        }

        //redirect to index
        return redirect()->route('subcategories.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

      /**
     * destroy
     *
     * @param  mixed $subcategory
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //getSubcategory by ID
        $subcategory =Subcategory::findOrFail($id);

        //delete image
        Storage::delete('public/subcategories/'. $subcategory->gambar);

        //deleteSubcategory
        $subcategory->delete();

        //redirect to index
        return redirect()->route('subcategories.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}