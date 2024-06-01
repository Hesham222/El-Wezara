@if(count($records))
@foreach($records as $record)
    @if(count($record->hotelReservations) > 0)
        <tr>
            <td>{{'اسم الشركه -'}} {{$record->name}}  </td>
        </tr>
        @foreach($record->hotelReservations as $hotelReservation)
            <tr id="tableRecord-{{$hotelReservation->id}}">
                <td>{{$hotelReservation->Room?$hotelReservation->Room->room_num:"لا يوجد"}}</td>
                <td>{{$hotelReservation->Customer?$hotelReservation->Customer->name:"لا يوجد"}}</td>
                <td>{{$hotelReservation->checkIn == 1? "IN":"EXP"}}</td>
                <td>{{$hotelReservation->arrival_date?$hotelReservation->arrival_date:"لا يوجد"}}</td>
                <td>{{$hotelReservation->departure_date?$hotelReservation->departure_date:"لا يوجد"}}</td>
                <td>{{$hotelReservation->num_of_nights?$hotelReservation->num_of_nights - $hotelReservation->num_of_children:"0"}}</td>
                <td>{{$hotelReservation->num_of_children?$hotelReservation->num_of_children:"0"}}</td>
                <td>{{$hotelReservation->RoomType?$hotelReservation->RoomType->name:"لا يوجد"}}</td>
                <td>{{$hotelReservation->supplier?$hotelReservation->supplier->name:"لا يوجد"}}</td>
                <td>{{$hotelReservation->final_price?$hotelReservation->final_price:"0"}}</td>
                <td>{{$hotelReservation->paidAmount?$hotelReservation->paidAmount:"0"}}</td>

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
