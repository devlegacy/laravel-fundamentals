<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use App\Entities\Message;
use App\Entities\Note;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Undocumented function
     *
     * @return void
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user');
    }

    /**
     * Validate user role
     *
     * @param String $role
     * @return boolean
     */
    public function hasRoles(array $roles = ['administrador']) : bool
    {
        return $this->roles->pluck('name')->intersect($roles)->count();
        // foreach ($roles as $key => $role) {
        //     foreach ($this->roles as $key => $userRole) {
        //         if ($userRole->name === $role) {
        //             return true;
        //         }
        //     }
        // }
        // return false;
    }

    public function isAdmin()
    {
        return $this->hasRoles(['administrador']);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function note()
    {
        return $this->morphOne(Note::class, 'notable');
    }

    public function setPasswordAttribute($password)
    {
        return $this->attributes['password'] = bcrypt($password);
    }
}
