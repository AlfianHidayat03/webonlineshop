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
    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'id_kategori', 'id');
    }

    public function subcategory() : BelongsTo
    {
        return $this->belongsTo(Subcategory::class, 'id_subkategori', 'id');
    }
}
