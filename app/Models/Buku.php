<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Buku extends Model
{
    protected $table = 'bukus'; 

    protected $fillable = [
        'isbn', 
        'judul', 
        'pengarang', 
        'penerbit', 
        'tahun_terbit', 
        'stok', 
        'lokasi_rak',
        'status', 
        'kategori_id'
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
