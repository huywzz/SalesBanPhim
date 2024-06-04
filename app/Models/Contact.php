<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact';
    protected $primaryKey = 'id';
    protected $guarded = [];

    protected $fillable = [
        'name',
        'email',
        'phone',
        'content',
    ];
    use HasFactory;

    public function getDate()
    {
        return $this->created_at->format('d-m-Y H:i:s');
    }
}
