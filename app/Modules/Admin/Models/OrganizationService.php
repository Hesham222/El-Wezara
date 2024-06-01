<?php

namespace Admin\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;


class OrganizationService extends Model
{
    use HasFactory;


    public function organization()
    {
        return $this->belongsTo('Admin\Models\Organization', 'organization_id');
    }
    
    public function service()
    {
        return $this->belongsTo('Admin\Models\Service', 'service_id');
    }
}
