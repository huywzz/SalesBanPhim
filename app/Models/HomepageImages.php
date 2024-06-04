<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomepageImages extends Model
{
    protected $table = 'homepage_images';
    protected $primaryKey = 'id';
    protected $guarded = [];

    use HasFactory;
}
