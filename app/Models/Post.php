<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// by default, model ini mewakil table 'posts'
// Laravel prefer "convention over configuration"
class Post extends Model
{
    use HasFactory;
    public $table = 'post'; // config
}
