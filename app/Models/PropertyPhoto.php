<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyPhoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'image_path',
        'is_cover',
        'order',
    ];

    protected $casts = [
        'is_cover' => 'boolean',
        'order' => 'integer',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }
} 