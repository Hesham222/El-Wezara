<?php
namespace Organization\Actions\Subscription;;
use Illuminate\Http\Request;

use Organization\Models\{
    Subscription
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Subscription::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
