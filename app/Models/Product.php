<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $fillable=[
        'name',
        'specs',
        'price',
        'quantity',
        'status',
        'manufacture_id',
        'manufactures_name',
        'categories_id',
        'category_name',
        'product_image',
        'sales_quantity',
    ];
    use HasFactory;
    public function getStatus()
    {
        return ($this->status===0)?'Còn hàng':'Hết hàng';
    }
    public function getDate()
    {
       return $this->created_at->format('d-m-Y H:i:s');
    }

    public function ProductImages() {
        return $this->hasMany(ProductImages::class, 'product_id', 'id');
    }
}
