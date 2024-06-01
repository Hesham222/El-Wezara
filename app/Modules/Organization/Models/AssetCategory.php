<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class AssetCategory extends Model
{
    use SoftDeletes ;

    protected $appends = ['currentValueAmount','startValueAmount'];

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function assetProducts()
    {
        return $this->hasMany(AssetProduct::class,'assetCategory_id');
    }

    public function CurrentValue()
    {
        return $this->hasManyThrough('Organization\Models\SubAssetProduct','Organization\Models\AssetProduct' , 'assetCategory_id', 'assetProduct_id');
    }

    public function getCurrentValueAmountAttribute()
    {
        return $this->CurrentValue()->get();
    }

    public function StartValue()
    {
        return $this->hasManyThrough('Organization\Models\SubAssetProduct','Organization\Models\AssetProduct' , 'assetCategory_id', 'assetProduct_id');
    }

    public function getStartValueAmountAttribute()
    {
        return $this->StartValue()->get();
    }

}
