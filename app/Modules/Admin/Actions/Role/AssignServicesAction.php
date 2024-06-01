<?php
namespace Admin\Actions\Role;
use Illuminate\Http\Request;
class AssignServicesAction
{
    public function execute(Request $request, $record)
    {
        if($record->services->count())
            $record->services()->detach();
        $record->services()->attach($request->input('services'));
    }
}
