<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_kategori',
        'id_subkategori',
        'nama_barang',
        'harga',
        'diskon',
        'bahan',
        'sku',
        'tags',
        'ukuran',
        'warna',
        'deskripsi',
        'gambar',
    ];

}
