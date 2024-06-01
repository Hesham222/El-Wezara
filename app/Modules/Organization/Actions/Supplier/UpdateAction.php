<?php
namespace Organization\Actions\Supplier;
use Illuminate\Http\Request;
use Organization\Models\{Supplier};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                 = Supplier::find($id);
        $record->name           = $request->input('name');
        $record->phone          = $request->input('phone');
        $record->speciality     = $request->input('speciality');
        $record->save();
        return $record;
    }
}
