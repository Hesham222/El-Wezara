<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class AssetProduct extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function Category(){

        return $this->belongsTo(AssetCategory::class,'assetCategory_id');
    }

    public function subAssetProducts()
    {
        return $this->hasMany(SubAssetProduct::class,'assetProduct_id');
    }

}
