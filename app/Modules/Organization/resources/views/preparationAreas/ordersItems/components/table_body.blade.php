@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if($record->component_type == 'Item')
    <td>{{$record->item?$record->item->name:"لا يوجد"}}</td>
    @else
        <td>{{$record->item_variant?$record->item_variant->name:"لا يوجد"}}</td>
    @endif
    <td>{{$record->quantity}}</td>
    <td>{{$record->order ? $record->order->id : "-"}}</td>
    <td>{{ ($record->order && $record->order->point_of_sale )?$record->order->point_of_sale->name:'-'}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>

            <a class="btn btn-sm btn-warning"
               href="{{route('organizations.preparationArea.orders.item.ready',$record->id)}}"
               data-id ="{{$record->id}}"
               title="تم التحضير">
                تم التحضير
            </a>

        <a class="btn btn-sm btn-primary"
           href="{{route('organizations.preparationArea.orders.item.detail',$record->id)}}"
           data-id ="{{$record->id}}"
           title="مشاهده التفاصيل"
           target="_blank"
        >
            وصف الوجبه
        </a>


    </td>
</tr>
@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
