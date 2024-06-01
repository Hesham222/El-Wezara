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
    <td>{{$record->Reservation->id}}</td>
    <td>{{$record->Reservation->package->hall?$record->Reservation->package->hall->name:'-'}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>

            <a class="btn btn-sm btn-warning"
               href="{{route('organizations.preparationArea.orders.item.ready',$record->id)}}"
               data-id ="{{$record->id}}"
               title="تم التحضير">
                <i class="m-menu__link-bullet m-menu__link-icon fa fa-check" style="color: #fff"></i>
            </a>

        <a class="btn btn-sm btn-primary"
           href="{{route('organizations.preparationArea.orders.item.detail',$record->id)}}"
           data-id ="{{$record->id}}"
           title="مشاهده التفاصيل"
           target="_blank"
        >
            <i class="m-menu__link-bullet m-menu__link-icon fa fa-eye" style="color: #fff"></i>
        </a>

    @if(!$record->prep_area->checkItem($record->item,$record->quantity))

        <a class="btn btn-sm btn-success"
           href="{{route('organizations.preparationArea.orders.item.shortcomings',$record->id)}}"
           data-id ="{{$record->id}}"
           title="طلب النواقص"
        >
            <i class="m-menu__link-bullet m-menu__link-icon fa fa-bell" style="color: #fff"></i>
        </a>

@endif
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
