<?php

namespace App\Models;

use App\Traits\GetModelByUuid;
use App\Traits\UuidGenerator;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;
    use GetModelByUuid;
    use UuidGenerator;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'nom',
        'prenom',
        'telephone',
        'email',
        'password',
        'clear_password',
        'active',
        'super_admin',
        'email_verified_at',
    ];

    public $guard_name = 'admin';

    /**
     * The attributes that should be hidden for serialization.
     *
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'active' => 'boolean',
    ];

    protected function fullName(): Attribute
    {
        return new Attribute(
            fn () => $this->nom.' '.$this->prenom,
        );
    }
}
