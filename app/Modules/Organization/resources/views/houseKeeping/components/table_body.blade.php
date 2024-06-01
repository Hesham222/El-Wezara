@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    <td>{{$record->room->ParentRoom->hotel->name}}</td>
    <td>{{$record->room->room_num}}</td>
    <td>{{$record->occupied_date}}</td>
    <td>{{$record->status}}</td>
    <td>
        @if(count($record->room->reservations) > 0 && ( count($record->room->reservations->where('arrival_date',date('Y-m-d'))) > 0 && $record->occupied_date == date('Y-m-d') ) )
            Expected Check In
        @elseif(count($record->room->reservations) > 0 && ( count($record->room->reservations->where('departure_date',date('Y-m-d'))) > 0 && $record->occupied_date == date('Y-m-d')) )
            Expected Check out
        @else
            --
        @endif
    </td>
    <td>
        <a
            href="{{route('organizations.housekeeping.edit',$record->id)}}"
            title="تعديل"
            class="btn btn-sm btn-primary">
            <i class="fa fa-edit" style="color: #fff"></i>
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
