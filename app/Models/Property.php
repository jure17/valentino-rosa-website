<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'type',
        'disponibilita',
        'pdf_path',
    ];



    public function photos()
    {
        return $this->hasMany(PropertyPhoto::class)->orderBy('order');
    }

    public function coverPhoto()
    {
        return $this->hasOne(PropertyPhoto::class)->where('is_cover', true)->withDefault();
    }

    public function getFormattedPriceAttribute()
    {
        $formattedPrice = number_format($this->price, 0, ',', "'");
        
        if ($this->type === 'vendite') {
            return "da {$formattedPrice} CHF";
        } else {
            return "{$formattedPrice} CHF al mese";
        }
    }

    public function getPriceOnlyAttribute()
    {
        return number_format($this->price, 0, ',', "'") . ' CHF';
    }

    public function hasPdf()
    {
        return !empty($this->pdf_path) && $this->pdf_path !== null;
    }
} 