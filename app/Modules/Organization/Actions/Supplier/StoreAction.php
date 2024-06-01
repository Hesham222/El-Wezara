<?php
namespace Organization\Actions\Supplier;
use Illuminate\Http\Request;
use Organization\Models\{Supplier};
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  Supplier::create([
            'name'          =>  $request->input('name'),
            'phone'         =>  $request->input('phone'),
            'speciality'    =>  $request->input('speciality'),
        ]);
        return $record;
    }
}
