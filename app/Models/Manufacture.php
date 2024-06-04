<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacture extends Model
{
    protected $fillable=[
        'name',
        'address',
        'phone',
        'email',
    ];
    use HasFactory;
    public function getDate()
    {
       return $this->created_at->format('d-m-Y H:i:s');
    }

}
