<?php

namespace Organization\Models;

class LaundrySubCategoryService extends Model
{

    public function laundrySubCategory()
    {
        return $this->belongsTo(LaundrySubCategory::class);
    }

    public function laundryService()
    {
        return $this->belongsTo(LService::class);
    }



}
