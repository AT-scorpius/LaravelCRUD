<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacturer extends Model
{
    use HasFactory;
    protected $fillable=['mf_name'];
    public function products(){
        return $this->hasMany('App\Models\Product','mf_id','id');
    }
}
