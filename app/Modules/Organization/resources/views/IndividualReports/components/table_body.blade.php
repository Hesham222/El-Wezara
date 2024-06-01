@if(count($records))
@foreach($records as $record)
        @if(count($record->hotelReservations) > 0)
            @if($record->checkSupplier() == "true")
                <tr id="tableRecord-{{$record->id}}">
                <td>{{$record->id?$record->id:"لا يوجد"}}</td>
                <td>{{$record->name?$record->name:"لا يوجد"}}</td>
                <td>{{$record->hotelReservations->sum('num_of_nights')}}</td>
                <td>{{$record->hotelReservations->sum('num_of_nights') - $record->hotelReservations->sum('num_of_children')}}</td>
                <td>{{$record->hotelReservations->sum('final_price')}}</td>
                <td>{{$record->hotelReservations->sum('paidAmount')}}</td>
            </tr>
            @else
                @continue($record)
        @endif

    @endif
@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
