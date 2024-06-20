<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;
use App\Models\Category;

class Shop extends Model
{
    use HasFactory;

    protected $fillable=['shop_name','detail','category','img','area_id'];

    public function area(){
        return $this->belongsTo(Area::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
