<?php
namespace Organization\Models;


class AddOrder extends Model
{


    public function admin()
    {
        return $this->belongsTo(OrganizationAdmin::class,'created_by','id');

    }
}