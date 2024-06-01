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
class StoreAction
{
    public function execute(Request $request)
    {
        $record =  Package::create([
            'name'              => $request->input('name'),
            'capacity'          => $request->input('capacity'),
            'description'       => $request->input('description'),
            'hall_id'           => $request->input('hall'),
            'actual_price'      => $request->input('actual_price'),
            'final_price'       => $request->input('final_price'),
        ]);
//
//        $i  =   0 ;
//        foreach ($request->input('items') as $item)
//        {
//            PackageItem::create([
//                'quantity' =>$request->input('quantity')[$i],
//                'description' =>$request->input('description_item')[$i],
//                'price'=>$request->input('price')[$i++],
//                'package_id' => $record->id,
//                'item_id' => $item,
//            ]);
//        }


//        for ($i=0;$i<count($request->input('products'));$i++)
//        {
//            $new_prdocut = new PackageProdcut();
//            $new_prdocut->package_id = $record->id;
//            $new_prdocut->quantity = $request->input('capacity');
//
//            $id = strtok($request->input('products')[$i], ',');
//            $type = substr($request->input('products')[$i], strpos($request->input('products')[$i], ",") + 1);
//
//            $new_prdocut->price = $request->input('product_price')[$i];
//
//
//            $new_prdocut->component_type = $type;
//            $new_prdocut->component_id = $id;
//            $new_prdocut->save();
//
//        }


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

        return $record;
    }

}
