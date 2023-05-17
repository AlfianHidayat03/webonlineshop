<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Data Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<body style="background: lightgray">
<div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
            <div>
                    <h3 class="text-center my-4">Data Barang</h3>       
                    <hr>
                </div>
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <a href="{{ route('products.create') }}" class="btn btn-md btn-primary mb-3">Tambah Data</a>
                        <table class="table table-bordered table-hover table-striped" >
                            <thead>
                              <tr class="text-center">
                                <th scope="col">Id Kategori</th>
                                <th scope="col">Id Subkategori</th>
                                <th scope="col">Nama Barang</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Diskon</th>
                                <th scope="col">Bahan</th>
                                <th scope="col">Sku</th>
                                <th scope="col">Tags</th>
                                <th scope="col">Ukuran</th>
                                <th scope="col">Warna</th>
                                <th scope="col">Gambar</th>
                                <th scope="col">Aksi</th>
                              </tr>
                            </thead>
                            <tbody>
                              @forelse ($products as $product)
                                <tr>    
                                    <td>{{ $product->id_kategori }}</td>
                                    <td>{{ $product->id_subkategori }}</td>
                                    <td>{{ $product->nama_barang }}</td>
                                    <td>{{ $product->harga }}</td>
                                    <td>{{ $product->diskon }}</td>
                                    <td>{{ $product->bahan }}</td>
                                    <td>{{ $product->sku }}</td>
                                    <td>{{ $product->tags }}</td>
                                    <td>{{ $product->ukuran }}</td>
                                    <td>{{ $product->warna }}</td>
                                    <td class="text-center">
                                        <img src="{{ asset('/storage/products/'.$product->gambar) }}" class="rounded" style="width: 150px">
                                    </td>
                                    <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('products.destroy', $product->id) }}" method="POST">
                                            <a href="{{ route('products.show', $product->id) }}" class="btn btn-sm btn-warning">SHOW</a>
                                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-sm btn-primary">EDIT</a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                                        </form>
                                    </td>
                                </tr>
                              @empty
                                  <div class="alert alert-danger">
                                      Data Barang belum Tersedia.
                                  </div>
                              @endforelse
                            </tbody>
                          </table>  
                          {{ $products->links() }}
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
