<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Gallery extends Model
{
    protected $fillable = ['judul' , 'deskripsi' , 'gambar' , 'kategori_id' , 'user_id'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'kategori _id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
