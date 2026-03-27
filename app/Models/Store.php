<?php

namespace App\Models;

use App\Trait\TranslatableToArray;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Store extends Model
{
    use HasTranslations, TranslatableToArray , HasFactory;
    public array $translatable = ['name', 'description'];

    protected $fillable = [
        'name',
        'description',
        'image',
    ];

    public function products() {
        return $this->hasMany(Product::class);
    }


}
