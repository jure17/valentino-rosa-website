<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'image_path',
        'description',
        'order',
    ];

    protected $casts = [
        'order' => 'integer',
    ];

    // Category constants
    const CATEGORY_SOPRASTRUTTURE = 'soprastrutture';
    const CATEGORY_SOTTOSTRUTTURE = 'sottostrutture';
    const CATEGORY_MURI = 'muri';
    const CATEGORY_MEZZI = 'mezzi';

    public static function getCategories()
    {
        return [
            self::CATEGORY_SOPRASTRUTTURE => 'Soprastrutture',
            self::CATEGORY_SOTTOSTRUTTURE => 'Sottostrutture',
            self::CATEGORY_MURI => 'Muri a secco',
            self::CATEGORY_MEZZI => 'I nostri Mezzi',
        ];
    }

    public function getCategoryLabelAttribute()
    {
        return self::getCategories()[$this->category] ?? $this->category;
    }
} 