<?php

namespace Admin\Models;

class AdminRole extends Model
{
    public function permissions()
    {
        return $this->hasMany(RolePermission::class);
    }
}
