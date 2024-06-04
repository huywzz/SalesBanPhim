<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $table = 'news';
    protected $primaryKey = 'id';
    protected $guarded = [];
    
    protected $fillable = [
        'title',
        'content',
        'image',
    ];
    use HasFactory;

    public function getDate()
    {
        return $this->created_at->format('d-m-Y H:i:s');
    }

    
}
