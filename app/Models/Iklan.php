<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Iklan extends Model
{
    use HasFactory;

    // protected $connection = 'oracle'; // uncomment this line if you want to use oracle database

    public $timestamps = true;

    protected $table = 'iklan';

    protected $primaryKey = 'iklan_id';

    public $incrementing = true;

    protected $guarded = ['iklan_id'];

    function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * Get the user that owns the Iklan
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
