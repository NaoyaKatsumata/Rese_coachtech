<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;

class Shop extends Model
{
    use HasFactory;

    protected $fillable=['shop_name','detail','category','img','area_id'];

    public function area(){
        return $this->hasMany('App\Models\categories');
    }
}
