@if(count($records))
    @foreach($records as $record)
        <tr id="tableRecord-{{$record->id}}">
            @if(request()->query('view')=='trash')
                <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
                <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
            @endif
            <td>{{$record->employee->name}}</td>
            <td>{{$record->employee->id}}</td>
            <td>{{$record->date}}</td>
            <td>{{$record->amount}}</td>
            <td>{{$record->note}}</td>
            <td>{{$record->status}}</td>
            <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
{{--            <td>--}}

{{--                @if($record->status == 'Pending')--}}
{{--                    <a--}}
{{--                        href="{{route('organizations.vacationRequest.approve',$record->id)}}"--}}
{{--                        title="القبول"--}}
{{--                        class="btn btn-sm btn-primary">--}}
{{--                        <i class="fa fa-check" style="color: #fff"></i>--}}
{{--                    </a>--}}


{{--                    <a--}}
{{--                        href="{{route('organizations.vacationRequest.reject',$record->id)}}"--}}
{{--                        title="الرفض"--}}
{{--                        class="btn btn-sm btn-danger">--}}
{{--                        <i class="fa fa-crosshairs" style="color: #fff"></i>--}}
{{--                    </a>--}}
{{--                @endif--}}

{{--            </td>--}}
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="8" style="text-align:center;">
            There are no records match your inputs.
        </td>
    </tr>
@endif
