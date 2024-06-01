<?php
namespace Organization\Actions\HotelReservation;
use Illuminate\Http\Request;
use Organization\Models\LinkedAccount;
use Organization\Models\{
    RoomPricing
};
class AccountStoreAction
{
    public static function storeMultiple($files, $pathFolder)
    {
        $path = array();
        foreach ($files as $file)
        {

            $originalName   = $file->getClientOriginalName();
            $size           = $file->getSize();
            $path[]         = $file->store($pathFolder, 'public');

        }
        return $path;
    }
    public function execute(Request $request,$record)
    {
        if($record->roomType_id == '3'){
            $people = 1;
        }elseif ($record->roomType_id == '2'){
            $people = 2;
        }else{
            $people = 3;
        }
        $beds = $record->num_of_extra_beds;

        $num_of_people = ($people + $beds) - 1 ;
       // dd($num_of_people);

        $file               = $this->storeMultiple($request->file('attachment'),'accounts');
        $marriage_contract  = $this->storeMultiple($request->file('marriage_contract'),'marriage_contracts');
        $data = $request->all();

        for ($i=0;$i<$num_of_people;$i++) {
            if (isset($request->name[$i])){
                $linked = new LinkedAccount();
                $linked->hotel_reservation_id     = $record->id;
                $linked->name                     = $request->name[$i];
                $linked->attachment               = $file[$i];
                $linked->marriage_contract        = $marriage_contract[$i];
                $linked->national_id              = $request->national_id[$i];
                $linked->note                     = $request->note[$i];
                $linked->save();
            }else{
                return redirect()->route('organizations.hotelReservation.index')->with('error','يجب أن تسجل عدد بيانات الاشخاص الآخرين بشكل صحيح مراعيا نوع الغرفه وعدد السراير المضافه .');

            }
        }
    }
}
