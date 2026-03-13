<?php

namespace App\Models;

use App\Trait\TranslatableToArray;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Product extends Model
{
    use HasTranslations , TranslatableToArray;
    public array $translatable = ['name', 'description'];

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'quantity',
        'store_id'
    ];

    public function stores()
    {
        return $this->belongsTo(Store::class);
    }



}
