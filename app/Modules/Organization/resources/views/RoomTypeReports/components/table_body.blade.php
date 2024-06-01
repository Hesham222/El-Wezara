@if(count($records))
    @foreach($records as $record)
        @if(count($record->hotelReservations) > 0)
            <tr id="tableRecord-{{$record->id}}">
                <td>{{$record->name?$record->name:"لا يوجد"}}</td>
                <td>{{$record->hotelReservations->count('room_id')}}</td>
                <td>{{$record->hotelReservations->sum('num_of_nights') - $record->hotelReservations->sum('num_of_children')}}</td>
                <td>{{$record->hotelReservations->sum('num_of_children')}}</td>
                <td>{{$record->hotelReservations->sum('num_of_extra_beds')}}</td>
                <td>{{$record->hotelReservations->sum('final_price')}}</td>
                <td>{{$record->hotelReservations->sum('paidAmount')}}</td>
                <td>{{$record->hotelReservations->sum('remainingAmount')}}</td>
            </tr>

        @endif
    @endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
