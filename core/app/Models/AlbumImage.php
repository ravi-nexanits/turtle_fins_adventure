<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlbumImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'album_id',
        'image_path',
        'caption',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Each image belongs to an album.
     */
    public function album()
    {
        return $this->belongsTo(Album::class);
    }

    /**
     * Accessor for full image URL.
     */
    public function getImageUrlAttribute()
    {
        return $this->image_path
            ? asset('storage/' . $this->image_path)
            : null;
    }
}
