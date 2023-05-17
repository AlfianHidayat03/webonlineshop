<?php

namespace App\Http\Controllers;

//import Model "Slider
use App\Models\Slider;

//return type View
use Illuminate\View\View;

//return type redirectResponse
use Illuminate\Http\RedirectResponse;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * index
     *
     * @return View
     */
    public function index(): View
    {
        //get sliders
        $sliders = Slider::latest()->paginate(5);

        //render view with sliders
        return view('sliders.index', compact('sliders'));
    }

     /**
     * create
     *
     * @return View
     */
    public function create(): View
    {
        return view('sliders.create');
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
            'id_slider' => 'required',
            'nama_slider' => 'required',
            'deskripsi' => 'required',
            'gambar'    => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //upload gambar
        $image = $request->file('gambar');
        $image->storeAs('public/sliders', $image->hashName());

        //create Slider
        Slider::create([
            'id_slider'   => $request->id_slider,
            'nama_slider'     => $request->nama_slider,
            'deskripsi'   => $request->deskripsi,
            'gambar'     => $image->hashName()
        ]);

        //redirect to index
        return redirect()->route('sliders.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

     /**
     * show
     *
     * @param  mixed $id
     * @return View
     */
    public function show(string $id): View
    {
        //get Slider by ID
        $slider = Slider::findOrFail($id);

        //render view with Slider
        return view('sliders.show', compact('slider'));
    }

      /**
     * edit
     *
     * @param  mixed $id
     * @return View
     */
    public function edit(string $id): View
    {
        //get Slider by ID
        $slider = Slider::findOrFail($id);

        //render view with Slider
        return view('sliders.edit', compact('slider'));
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
            'id_slider' => 'required',
            'nama_slider' => 'required',
            'deskripsi' => 'required',
            'gambar'    => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);

        //get Slider by ID
        $slider = Slider::findOrFail($id);

        //check if image is uploaded
        if ($request->hasFile('gambar')) {

            //upload new image
            $image = $request->file('gambar');
            $image->storeAs('public/sliders', $image->hashName());

            //delete old image
            Storage::delete('public/sliders/'.$slider->gambar);

            //update post with new image
            $slider->update([
                'id_slider'   => $request->id_slider,
                'nama_slider'     => $request->nama_slider,
                'deskripsi'   => $request->deskripsi,
                'gambar'     => $image->hashName()
            ]);

            
        } else {

            //update post without image
            $slider->update([
                'nama_slider'     => $request->nama_slider,
                'deskripsi'   => $request->deskripsi
            ]);
        }

        //redirect to index
        return redirect()->route('sliders.index')->with(['success' => 'Data Berhasil Diubah!']);
    }

      /**
     * destroy
     *
     * @param  mixed $slider
     * @return void
     */
    public function destroy($id): RedirectResponse
    {
        //get Slider by ID
        $slider = Slider::findOrFail($id);

        //delete image
        Storage::delete('public/sliders/'. $slider->gambar);

        //delete Slider
        $slider->delete();

        //redirect to index
        return redirect()->route('sliders.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}