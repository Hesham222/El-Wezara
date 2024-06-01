@if(count($records))
@foreach($records as $record)
    @if(count($record->components) > 0)
        <h2>{{$record->name}}</h2>
        @foreach($record->components as $component)
            <tr id="tableRecord-{{$component->id}}">
                @if($component->component_type == 'Ingredient')
                    <td>{{$component->id}}</td>
                    <td>{{$component->ingredent?$component->ingredent->name:"لا يوجد"}}</td>
                    <td>{{$component->ingredent->unit_of_measurement?$component->ingredent->unit_of_measurement->name:"لا يوجد"}}</td>
                    <td>{{$component->quantity?$component->quantity:"لا يوجد"}}</td>
                    <td>{{$component->ingredent?$component->ingredent->final_cost:"لا يوجد"}}</td>
                    <td>{{$component->ingredent->final_cost * $component->quantity}}</td>
                    <td>{{1}}</td>
                    <td>{{$component->item?$component->item->price:"لا يوجد"}}</td>
                    <td>{{$component->item?$component->item->mortal:"لا يوجد"}}</td>
                    <td>{{date('d M Y', strtotime($component->created_at)) ." - ". date('h:i a', strtotime($component->created_at))}}</td>
                @else
                    <td>{{$component->id}}</td>
                    <td>{{$component->item?$component->item->name:"لا يوجد"}}</td>
                    <td>{{$component->ingredent->unit_of_measurement?$component->ingredent->unit_of_measurement->name:"لا يوجد"}}</td>
                    <td>{{$component->item?$component->item->quantity:"لا يوجد"}}</td>
                    <td>{{$component->item?$component->item->final_cost:"لا يوجد"}}</td>
                    <td>{{$component->item->final_cost * $component->quantity}}</td>
                    <td>{{1}}</td>
                    <td>{{$component->item?$component->item->price:"لا يوجد"}}</td>
                    <td>{{$component->item?$component->item->mortal:"لا يوجد"}}</td>
                    <td>{{date('d M Y', strtotime($component->created_at)) ." - ". date('h:i a', strtotime($component->created_at))}}</td>
                @endif

            </tr>
        @endforeach
    @endif
@endforeach

@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
