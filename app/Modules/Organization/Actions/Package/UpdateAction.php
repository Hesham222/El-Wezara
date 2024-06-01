<?php
namespace Organization\Actions\Package;
use Illuminate\Http\Request;
use Organization\Models\{EventHall,
    EventType,
    Package,
    PackageItem,
    PackageProdcut,
    PackageSupplierService,
    SubscribersType};
class UpdateAction
{
    public function execute(Request $request,$id)
    {
        $record                 =   Package::find($id);
        $record->name           =   $request->input('name');
        $record->hall_id        =   $request->input('hall');
        $record->capacity       =   $request->input('capacity');
        $record->actual_price   =   $request->input('actual_price');
        $record->final_price    =   $request->input('final_price');
        $record->description    =   $request->input('description');
        $record->save();


//        if ($request->input('items'))
//        {
//            $record->packageItems()->delete();
//            $i  =   0 ;
//            foreach ($request->input('items') as $item)
//            {
//                PackageItem::create([
//                    'quantity' =>$request->input('quantity')[$i],
//                    'description' =>$request->input('description_item')[$i],
//                    'price'=>$request->input('price')[$i++],
//                    'package_id' => $record->id,
//                    'item_id' => $item,
//                ]);
//            }
//            $i  =   0 ;
//        }





        if($request->input('services'))
        {
            $record->packageSupplierServices()->delete();
            $i  =   0 ;

            foreach ($request->input('services') as $service)
            {
                PackageSupplierService::create([
                    'quantity' =>$request->input('service_quantity')[$i],
                    'description' =>$request->input('description_service')[$i],
                    'price'=>$request->input('service_price')[$i++],
                    'package_id' => $record->id,
                    'supplier_service_id' => $service,
                ]);
            }


        }

        return $record;
    }
}
