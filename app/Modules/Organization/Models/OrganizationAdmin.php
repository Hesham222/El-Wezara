<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class OrganizationAdmin extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name', 'email', 'phone', 'password', 'role_id','organization_id','employee_id','deleted_at','created_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function createdBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'created_by')->withTrashed();
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
