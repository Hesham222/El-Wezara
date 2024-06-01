<?php
namespace Organization\Actions\Employee;;

use App\Http\Traits\FileTrait;
use Illuminate\Http\Request;

use Organization\Models\{
    OrganizationAdmin,Employee
};

class DestroyAction
{

    use FileTrait;
    public function execute(Request $request, $id)
    {
        $record = Employee::withTrashed()->find($id);
        if(!$record)
            return false;
        if ($record->attachment){
            $this->RemoveSingleFile($record->attachment);
        }
        $record->forceDelete();
        return $request->resource_id;
    }
}
