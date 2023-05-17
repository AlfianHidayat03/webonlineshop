<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_kategori',
        'nama_kategori',
        'deskripsi',
        'gambar',
    ];

    public function Subcategory() : HasMany
    {
        return $this->hasMany(Subcategory::class);
    }

    public function Product() : HasMany
    {
        return $this->hasMany(Product::class);
    }
}
