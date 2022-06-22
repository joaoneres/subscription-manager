<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasEvents;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes, HasEvents;

    protected $fillable = [
        'name', 'description', 'price', 'recurrent',
        'period',
    ];

    public function cover()
    {
        return $this->morphOne('App\Models\Image', 'imageable');
    }

    public function formatedPrice()
    {
        return number_format($this->price / 100, 2, '.', ',');
    }
}
