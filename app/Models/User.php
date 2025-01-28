<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Comment;
use OwenIt\Auditing\Audit;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Models\Audit as ModelsAudit;
class User extends Authenticatable implements Auditable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $auditExclude = ['remember_token'];

    /**
     * Create an audit entry with a custom event (e.g., login, logout)
     *
     * @param string $event
     * @return void
     */

     public function auditEvent($event)
     {
        $user = $this->id;
        ModelsAudit::create([
             'auditable_type' => self::class,
             'auditable_id'   => $user,
             'user_type'      => self::class,
             'user_id'   => $user,
             'event'          => $event,
             'url'            => request()->fullUrl(),
             'ip_address'     => request()->ip(),
             'user_agent'     => request()->userAgent(),
             'created_at'     => now(),
         ]);
     }

    protected $fillable = [
        'uuid',
        'name',
        'email',
        'phone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    function getRouteKeyName()
    {
        return 'uuid';
    }

    /**
     * Get all of the posts for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }


}
