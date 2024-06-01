<?php

namespace Organization\Models;


use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\SoftDeletes;


class EmployeeVacationType extends Model
{
    use SoftDeletes ;
   // use HasTranslations;

  //  public $translatable = ['type','description'];
    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }



}
