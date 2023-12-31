<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OAuthProvider extends Model
{
    use HasUlids, HasFactory;

    protected $table = 'oauth_providers';

    protected $fillable = ['name', 'provider_user_id', 'user_id', 'avatar'];
    protected $hidden = ['created_at', 'updated_at'];
}
