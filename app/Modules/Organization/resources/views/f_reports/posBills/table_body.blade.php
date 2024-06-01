@if(count($records))
    @foreach($records as $record)
        <tr id="tableRecord-{{$record->id}}">
            <td>{{$record->id}}</td>
            <td>{{$record->order_id}}</td>
            <td>{{$record->order->point_of_sale->name}}</td>
            <td>{{$record->type}}</td>
            <td>{{$record->amount}}</td>
            <td>{{$record->created_at}}</td>
            <td>
                @if($record->approved == 1)
                <input type="checkbox" name="invoices[]" value="{{$record->id}}" />
                @endif
            </td>
            <td>
                @if($record->approved == 0)
                  <a href="{{route('organizations.report.posBillsApprove', $record->id)}}" class="btn btn-primary">قبول</a>               
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

