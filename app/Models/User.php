<?php

namespace App\Models;

use App\Enum\RoleEnum;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id', 
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'role_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime', 
    ];

    public function id(){
        return $this->id;
    }

    public function roles()
    {
        return $this->hasOne(Role::class, 'id');
    }

    public function hasRole($role)
    {
        return $this->roles->name === $role;
    }

    public function getAvatar(){
        if(!isset($this->avatar)) return "https://via.placeholder.com/350x450";
        if(!is_null($this->avatar)) return "https://via.placeholder.com/350x450";
        return $this->avatar;
    }
}
