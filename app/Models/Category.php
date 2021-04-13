<?php

namespace App\Models;

use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name', 'position'];

    public function menus()
    {
        return $this->hasMany(Menu::class)->orderBy('position', 'ASC');
    }
}
