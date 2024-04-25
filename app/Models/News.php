<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'slug',
        'author',
        'category',
        'description',
        'view_no'
    ];


    public function image(): MorphOne
    {
        return $this->morphOne(Image::class, 'image');
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }
}
