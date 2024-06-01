<?php
    
namespace App\Imports;
    
use Organization\Models\Ingredient;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Organization\Models\UnitMeasurement;
     
class IngImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $unit = UnitMeasurement::where('id', $row['unit_id'])->first();

        if(!$unit){
            abort(401);
        }

        return new Ingredient([
            'name->en'     => $row['name_en'],
            'name->ar'     => $row['name_ar'],
            'quantity'    => $row['quantity'], 
            'unit_measurement_id'    => $row['unit_id'],
            'cost' =>$row['cost'],
        ]);
    }
}