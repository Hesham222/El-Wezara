<?php

namespace Organization\Models;


use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;


class Department extends Model
{
    use SoftDeletes ;
    use HasTranslations;

    public $translatable = ['name','description'];

    protected $appends = ['number_of_employees'];

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function head_of_department()
    {
        return $this->belongsTo('Organization\Models\Employee', 'employee_id');
    }

    public function employees()
    {
        return $this->hasMany(Employee::class,'department_id');
    }

 public function headDepartment()
    {
        return $this->belongsTo('Organization\Models\Department', 'parent_id');
    }

    public function getNumberOfEmployeesAttribute()
    {
        return $this->employees->count();
    }
}
