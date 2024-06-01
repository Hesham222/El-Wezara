<?php

namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;


class SubAssetProduct extends Model
{
    use SoftDeletes ;

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }

    public function ParentProduct(){

        return $this->belongsTo(AssetProduct::class,'assetProduct_id');
    }

}
