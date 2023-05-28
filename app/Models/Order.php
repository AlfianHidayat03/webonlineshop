<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_kategori',
        'nama_kategori',
        'deskripsi',
        'gambar',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member', 'id');
    } 
}
