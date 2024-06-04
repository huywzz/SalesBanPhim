<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $fillable=[
        'name',
        'image'
    ];
    
    use HasFactory;
    
    public function getDate()
    {
       return $this->created_at->format('d-m-Y H:i:s');
    }
    public function listProduct()
    {
        return $this->hasMany(product::class, 'categories_id');
    }
}
