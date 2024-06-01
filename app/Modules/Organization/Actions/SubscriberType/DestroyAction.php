<?php
namespace Organization\Actions\SubscriberType;;
use Illuminate\Http\Request;

use Organization\Models\{
    SubscribersType
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = SubscribersType::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
