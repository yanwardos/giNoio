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
    static $DEFAULT_PASSWORD = "PASSWORD";
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

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    // role
    public function hasRole($role)
    {
        // if(!$this->roles) return null;
        return $this->role->name === $role;
    }
    
    public function getPasien() { 
        return  Pasien::where('user_id', $this->id)->first();
    }
    
    public function getMedis() {
        return  Medis::where('user_id', $this->id)->first();
    }

    public function getAdmin() {
        return  Admin::where('user_id', $this->id)->first();
    }

    public function getAvatar(){
        if(!isset($this->avatar)) return "https://via.placeholder.com/350x450";
        if(!is_null($this->avatar)) return "https://via.placeholder.com/350x450";
        return $this->avatar;
    }
}
