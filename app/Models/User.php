<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $guarded = [];

    use HasFactory;
    // public $timestamps=false;
    protected $fillable=[
        'name',
        'phone',
        'gender',
        'level',
        'email',
        'password',
        'address',
        'avatar',
    ];
    
    public function listOrder()
    {
       return $this->hasMany(Order::class,'user_id');
    }

    public function getDate()
    {
        return $this->created_at->format('d-m-Y H:i:s');
    }
}
