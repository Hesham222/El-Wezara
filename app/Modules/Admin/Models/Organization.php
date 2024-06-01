<?php

namespace Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Model
{
    protected $connection = 'mysql';

    use HasFactory;
    use SoftDeletes;

    public function deletedBy()
    {
        return $this->belongsTo('Admin\Models\Admin', 'deleted_by')->withTrashed();
    }
    
    public function services()
    {
        return $this->belongsToMany('Admin\Models\Service', 'organization_services');
    }

    public function servicesAsString()
    {
        $str = '';
        foreach($this->services as $service)
            $str.=$service->name .", ";
        return $str;
    }
}
