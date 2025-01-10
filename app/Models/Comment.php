<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Contracts\Auditable;
class Comment extends Model implements Auditable
{
    use HasFactory;
    use \OwenIt\Auditing\Auditable;
    public $timestamps = true;

    protected $table = 'comments';

    protected $primaryKey = 'id';

    public $incrementing = true;

    protected $guarded = ['id'];

    /**
     * Get the user that owns the Comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Get the post that owns the Comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function post(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }
}
