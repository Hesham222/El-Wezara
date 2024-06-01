<?php


namespace Organization\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerComplain extends Model
{
    use SoftDeletes ;

    protected $table = 'customer_complain';

    public function Customer(){
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function deletedBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'deleted_by')->withTrashed();
    }



    public function createdBy()
    {
        return $this->belongsTo('Organization\Models\OrganizationAdmin', 'created_by');
    }
}
