@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
        <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
        <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>{{$record->admin?$record->admin->employee?$record->admin->employee->name:'-':'-'}}</td>
    <td>{{$record->point_of_sale->name}}</td>
    <td>{{$record->total_amount}}</td>
    <td>{{$record->table_number?$record->table_number:'-'}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
            @if($record->status == 'sentToPrepration' || $record->status == 'pending' )
            <a
                class="btn btn-sm btn-primary"
                title="انهاء الطلب "
                href="{{route('organizations.pointOfSale.close.order.view',$record->id)}}"
            >
                <i class="fa fa-check" style="color: #fff"></i>
            </a>

            <a
                class="btn btn-sm btn-warning"
                title="تعديل الطلب "
                href="{{route('organizations.pointOfSale.edit.order.view',$record->id)}}"
            >
                <i class="fa fa-edit" style="color: #fff"></i>
            </a>
        @elseif($record->status == 'closed')
                منتهى
        @else
                قيض العمل
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
