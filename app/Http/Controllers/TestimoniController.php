<?php

namespace App\Http\Controllers;

//import Model testimoni
use App\Models\Testimoni;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class TestimoniController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get Testimonis
        $testimonis = Testimoni::latest()->paginate(5);

        //render view with testimonis
        return view('testimonis.index', compact('testimonis'));
    }

     /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('testimonis.create');
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
            'nama_testimoni' => 'required',
            'deskripsi' => 'required',
            'gambar'    => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //upload gambar
        $image = $request->file('gambar');
        $image->storeAs('public/testimonis', $image->hashName());

        //create testimoni
       Testimoni::create([
            'nama_testimoni'     => $request->nama_testimoni,
            'deskripsi'   => $request->deskripsi,
            'gambar'     => $image->hashName()
        ]);

        //redirect to index
        return redirect()->route('testimonis.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

     /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get testimoni by ID
        $testimoni =Testimoni::findOrFail($id);

        //render view with testimoni
        return view('testimonis.show', compact('testimoni'));
    }

      /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get testimoni by ID
        $testimoni =Testimoni::findOrFail($id);

        //render view with testimoni
        return view('testimonis.edit', compact('testimoni'));
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
            'nama_testimoni' => 'required',
            'deskripsi' => 'required',
            'gambar'    => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //get testimoni by ID
        $testimoni =Testimoni::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('gambar')) {

            //upload new image
            $image = $request->file('gambar');
            $image->storeAs('public/testimonis', $image->hashName());

            //delete old image
            Storage::delete('public/testimonis/'.$testimoni->gambar);

            //update post with new image
            $testimoni->update([
                'nama_testimoni'     => $request->nama_testimoni,
                'deskripsi'   => $request->deskripsi,
                'gambar'     => $image->hashName()
            ]);

            
        } else {

            //update post without image
            $testimoni->update([
                'nama_testimoni'     => $request->nama_testimoni,
                'deskripsi'   => $request->deskripsi
            ]);
        }

        //redirect to index
        return redirect()->route('testimonis.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

      /**
     * destroy
     *
     * @param  mixed $testimoni
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get testimoni by ID
        $testimoni =Testimoni::findOrFail($id);

        //delete image
        Storage::delete('public/testimonis/'. $testimoni->gambar);

        //delete testimoni
        $testimoni->delete();

        //redirect to index
        return redirect()->route('testimonis.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}