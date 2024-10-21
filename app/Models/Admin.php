<?php

namespace App\Models;

use App\Traits\DeleteImage;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use OwenIt\Auditing\Auditable as AuditableTrait;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable implements Auditable
{
    use HasApiTokens, Notifiable, HasRoles, SoftDeletes, DeleteImage, AuditableTrait;

    protected $guarded = [];

    protected $table = 'admins';

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['email_verified_at' => 'datetime'];
}
