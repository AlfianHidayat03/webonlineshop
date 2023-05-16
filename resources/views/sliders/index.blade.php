<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Slider</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">
<div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
            <div>
                    <h3 class="text-center my-4">Data Slider</h3>       
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('sliders.create') }}" class="btn btn-md btn-primary mb-3">Tambah Data</a>
                        <table class="table table-bordered table-hover table-striped" >
                            <thead>
                              <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Id_Slider</th>
                                <th scope="col">Nama_Slider</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($sliders as $slider)
                                <tr>    
                                    <td></td>
                                    <td>{{ $slider->id_slider}}</td>
                                    <td>{{ $slider->nama_slider }}</td>
                                    <td>{{ $slider->deskripsi }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('/storage/sliders/'.$slider->gambar) }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('sliders.destroy', $slider->id) }}" method="POST">
                                            <a href="{{ route('sliders.show', $slider->id) }}" class="btn btn-sm btn-warning">SHOW</a>
                                            <a href="{{ route('sliders.edit', $slider->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data Slider belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>  
                          {{ $sliders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        //message with toastr
        if(session()-has('success'))
        
            toastr.success(  'BERHASIL!'); 

        else if(session()-has('error'))

            toastr.error( 'GAGAL!'); 
            
        endif
    </script>
</body>
</html>
