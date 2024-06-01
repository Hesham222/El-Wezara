<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Item extends Model
{
    use SoftDeletes;
    use HasTranslations;

    public $translatable = ['name','description'];

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function components()
    {
        return $this->hasMany(ItemDetail::class);
    }


    public function variants()
    {
        return $this->hasMany(ItemVariant::class);
    }

}
