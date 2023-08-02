<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasUlids, HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
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
        'id' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Populates user's OAuth providers
     *
     * @return HasMany
     */
    public function oauth_providers()
    {
        return $this->hasMany(OAuthProvider::class, 'user_id', 'id');
    }

    /**
     * Populates user events
     *
     * @return HasMany
     */
    public function events(): HasMany
    {
        return $this->hasMany(Event::class, 'user_id', 'id');
    }

    /**
     * Populates user followers
     *
     * @return HasMany
     */
    public function followers(): HasMany
    {
        return $this->hasMany(Follower::class, 'user_id', 'id');
    }

    /**
     * Populates user subscribers
     *
     * @return HasMany
     */
    public function subscribers(): HasMany
    {
        return $this->hasMany(Subscriber::class, 'user_id', 'id');
    }

    /**
     * Populates user sales
     *
     * @return HasMany
     */
    public function sales(): HasMany
    {
        return $this->hasMany(MerchSale::class, 'user_id', 'id');
    }
}
