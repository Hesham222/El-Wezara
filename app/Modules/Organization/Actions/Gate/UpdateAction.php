<?php
namespace Organization\Actions\Gate;
use Illuminate\Http\Request;
use Organization\Models\{
    Gate
};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record             = Gate::find($id);
        $record->name       = $request->input('name');
        $record->save();
        return $record;
    }
}
