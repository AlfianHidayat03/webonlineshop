<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Data Barang</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body style="background: lightgray">

    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card border-0 shadow-sm rounded">
                    <div class="card-body">
                        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            
                            <div class="form-group">
                                <label class="font-weight-bold">Id Kategori</label>
                                <input type="number" class="form-control @error('id_kategori') is-invalid @enderror" name="id_kategori" value="{{ old('id_kategori') }}" placeholder="Id Kategori">
                            
                                <!-- error message untuk Id kategori -->
                                @error('id_kategori')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Id Subkategori</label>
                                <input type="text" class="form-control @error('id_subkategori') is-invalid @enderror" name="id_subkategori" value="{{ old('id_subkategori') }}" placeholder="Nama Subkategori">
                            
                                <!-- error message untuk id subkategori -->
                                @error('id_subkategori')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Nama Barang</label>
                                <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" value="{{ old('nama_barang') }}" placeholder="Nama Barang">
                            
                                <!-- error message untuk Nama Barang -->
                                @error('nama_barang')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Harga</label>
                                <input type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" value="{{ old('harga') }}" placeholder="Harga">
                            
                                <!-- error message untuk harga -->
                                @error('harga')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Diskon</label>
                                <input type="text" class="form-control @error('diskon') is-invalid @enderror" name="diskon" value="{{ old('diskon') }}" placeholder="Diskon">
                            
                                <!-- error message untuk diskon -->
                                @error('diskon')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Bahan</label>
                                <input type="text" class="form-control @error('bahan') is-invalid @enderror" name="bahan" value="{{ old('bahan') }}" placeholder="Bahan">
                            
                                <!-- error message untuk bahan -->
                                @error('bahan')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Sku</label>
                                <input type="text" class="form-control @error('sku') is-invalid @enderror" name="sku" value="{{ old('sku') }}" placeholder="Sku">
                            
                                <!-- error message untuk sku -->
                                @error('sku')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Tags</label>
                                <input type="text" class="form-control @error('tags') is-invalid @enderror" name="tags" value="{{ old('tags') }}" placeholder="Tags">
                            
                                <!-- error message untuk tags -->
                                @error('tags')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Ukuran</label>
                                <input type="text" class="form-control @error('ukuran') is-invalid @enderror" name="ukuran" value="{{ old('ukuran') }}" placeholder="Ukuran">
                            
                                <!-- error message untuk ukuran -->
                                @error('ukuran')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Warna</label>
                                <input type="text" class="form-control @error('warna') is-invalid @enderror" name="warna" value="{{ old('warna') }}" placeholder="Warna">
                            
                                <!-- error message untuk warna -->
                                @error('warna')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="5" placeholder="deskripsi"></textarea>
                            
                                <!-- error message untuk Deskripsi -->
                                @error('deskripsi')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label class="font-weight-bold">Gamnbar</label>
                                <input type="file" class="form-control @error('gambar') is-invalid @enderror" name="gambar">
                            
                                <!-- error message untuk Gambar -->
                                @error('gambar')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                            <button type="reset" class="btn btn-md btn-warning">RESET</button>

                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
    
</script>
</body>
</html>