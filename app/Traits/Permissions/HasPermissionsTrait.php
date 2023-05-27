<?php

namespace App\Traits\Permissions;

use App\Models\User\Role;
use PhpParser\Builder\Trait_;
use App\Models\User\Permission;

trait HasPermissionsTrait
{


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class);
    }


    protected function hasPermission($permission)
    {
        return (bool) $this->permissions->where('name', $permission->name)->count();
    }

    public function hasPermissionTo($permission)
    {
        return $this->HasPermission($permission) || $this->hasPermissionThroughRole($permission);
    }

    public function hasRole(...$roles)
    {

        foreach ($roles as $role) {
            if ($this->roles->contains('name', $role)) {
                return true;
            }
            return false;
        }
    }

    public function hasPermissionThroughRole($permission)
    {
        foreach($permission->roles as $role)
        {
            if($this->roles->contains($role)){
                return true;
            }
        }
        return false;
    }


}
