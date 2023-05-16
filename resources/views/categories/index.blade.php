<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Kategori</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">
<div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
            <div>
                    <h3 class="text-center my-4">Data Kategori</h3>       
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('categories.create') }}" class="btn btn-md btn-success mb-3">Tambah Data</a>
                        <table class="table table-bordered table-hover table-striped" >
                            <thead>
                              <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">Id Kategori</th>
                                <th scope="col">Nama Kategori</th>
                                <th scope="col">Deskripsi</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($categories as $category)
                                <tr>    
                                    <td></td>
                                    <td>{{ $category->id_kategori}}</td>
                                    <td>{{ $category->nama_kategori }}</td>
                                    <td>{{ $category->deskripsi }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('/storage/categories/'.$category->gambar) }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('categories.destroy', $category->id) }}" method="POST">
                                            <a href="{{ route('categories.show', $category->id) }}" class="btn btn-sm btn-dark">SHOW</a>
                                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data kategori belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>  
                          {{ $categories->links() }}
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
