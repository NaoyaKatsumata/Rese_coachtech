<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','shop_id'];

    public $incrementing = false;
    protected $primaryKey = ['user_id', 'shop_id'];
    
}
