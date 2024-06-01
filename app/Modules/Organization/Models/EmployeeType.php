<?php

namespace Organization\Models;


use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;


class EmployeeType extends Model
{
    use SoftDeletes ;
    use HasTranslations;

    public $translatable = ['name','description'];
    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }



}
