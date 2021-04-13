<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category_id', 'description', 'price', 'position', 'photo'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
