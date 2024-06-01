<?php
namespace Organization\Actions\HotelReservation;
use Illuminate\Http\Request;
use Organization\Models\{
    LinkedAccount
};
class AccountUpdateAction
{
    public static function storeMultiple($files, $pathFolder)
    {
        $path = array();
        if (!is_null($files))
        {
            foreach ($files as $file)
            {
                $path[]         = $file->store($pathFolder, 'public');
            }
        }
        return $path;
    }
    public function execute(Request $request,$record)
    {
        $beds = $record->num_of_extra_beds;
        $num_of_people = ($record->RoomType->num_of_persons + $beds) - 1 ;
        $file               = $this->storeMultiple($request->file('attachment'),'accounts');
        $marriage_contract  = $this->storeMultiple($request->file('marriage_contract'),'marriage_contracts');
        $oldIds = LinkedAccount::select('id')->where('hotel_reservation_id',$record->id)->pluck('id')->toArray();
        for ($i=0;$i<$num_of_people;$i++) {
            if (isset($request->name[$i])){
                $linked = new LinkedAccount();
                $linked->hotel_reservation_id     = $record->id;
                $linked->name                     = $request->name[$i];
                $linked->attachment               = (count($file) == 0) ? $linked->attachment : $file[$i];
                $linked->marriage_contract        = (count($marriage_contract) == 0) ? $linked->marriage_contract : $marriage_contract[$i];
                $linked->national_id              = $request->national_id[$i];
                $linked->note                     = $request->note[$i];
                $linked->save();
            }
        }
        LinkedAccount::whereIn('id',$oldIds)->forceDelete();
    }
}
