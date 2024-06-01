@if(count($records))
    @foreach($records as $record)
        <tr id="tableRecord-{{$record->id}}">
            @if(request()->query('view')=='trash')
                <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
                <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
            @endif
            <td>{{$record->employee->name}}</td>
            <td>{{$record->employee->id}}</td>
                <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
                <td>{{$record->amount}}</td>
            <td>{{$record->note}}</td>

            <td>




            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="8" style="text-align:center;">
            There are no records match your inputs.
        </td>
    </tr>
@endif
