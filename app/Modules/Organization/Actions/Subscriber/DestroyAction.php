<?php
namespace Organization\Actions\Subscriber;;
use Illuminate\Http\Request;

use Organization\Models\{
    Subscriber
};

class DestroyAction
{
    public function execute(Request $request, $id)
    {
        $record = Subscriber::withTrashed()->find($id);
        if(!$record)
            return false;
        $record->forceDelete();
        return $request->resource_id;
    }
}
