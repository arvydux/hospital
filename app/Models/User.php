<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\Permission;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class,'user_roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class,'user_permissions');
    }

    public function hasRole(...$roles)
    {
        foreach($roles as $role)
        {
            if($this->roles->contains('name',$role))
            {
                return true;
            }
        }
        return false;
    }

    public function hasPermission($permission)
    {
        return $this->hasPermissionThroughRole($permission) || (bool) $this->permissions->where('name',$permission->name)->count();
    }

    public function hasPermissionThroughRole($permission)
    {
        foreach($permission->roles as $role)
        {
            if($this->roles->contains($role))
            {
                return true;
            }
        }
        return false;
    }

    public function givePermission(...$permission)
    {
        $permissions = $this->getPermissions(array_flatten($permission));
        if($permissions === null)
        {
            return $this;
        }
        $this->permissions()->saveMany($permissions);
        return $this;
    }

    public function getPermissions(array $permissions)
    {
        return Permission::whereIn('name',$permissions)->get();
    }

    public function removePermission(...$permission)
    {
        $permissions = $this->getPermissions(array_flatten($permission));
        $this->permissions()->detach($permissions);
        return $this;
    }

    public function modifyPermission(...$permissions)
    {
        $this->permissions()->detach();
        return $this->givePermission($permissions);
    }
}
