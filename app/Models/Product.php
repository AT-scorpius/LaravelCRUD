<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_name',
        'mf_id',
        'price',
        'quatity',
        'image',
        'description',
    ];
    public function manufacturer()
    {
      return  $this->belongsTo('App\Models\Manufacturer',"mf_id",'id');
    }
}
