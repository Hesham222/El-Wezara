@if(count($records))
@foreach($records as $record)


<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    <td>{{$record->Vendor?$record->Vendor->name:"لا يوجد"}}</td>
    <td>{{$record->Ingredient?$record->Ingredient->name:"لا يوجد"}}</td>
    <td>{{$record->Ingredient->unit_of_measurement?$record->Ingredient->unit_of_measurement->name:"لا يوجد"}}</td>
    <td>{{$record->price?$record->price:"لا يوجد"}}</td>
    <td>{{$record->Ingredient->unit_of_measurement?$record->Ingredient->final_cost:"لا يوجد"}}</td>
    <td>{{date('d M Y', strtotime($record->created_at)) ." - ". date('h:i a', strtotime($record->created_at))}}</td>
</tr>
@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
