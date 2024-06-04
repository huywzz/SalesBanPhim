<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    protected $fillable = [
        'code',
        'discount',
        'status',
    ];

    use HasFactory;
    public function getStatus()
    {
        return ($this->status === 0) ? 'Còn hạn sử dụng' : 'Hết hạn sử dụng';
    }

    public function getDate()
    {
        return $this->created_at->format('Y-m-d H:i:s');
    }
}
