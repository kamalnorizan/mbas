<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends \Spatie\Permission\Models\Role
{
    use HasFactory;

    function getRouteKeyName()
    {
        return 'uuid';
    }

    protected $fillable = ['uuid', 'name', 'description'];
}
