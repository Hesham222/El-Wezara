@if(count($records))
    @foreach($records as $record)

        <tr  id="tableRecord-{{$record->id}}">
            <td>{{$record->id}}</td>
            @if(request()->query('view')=='trash')
                <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
                <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
            @endif
            <td>{{$record->ingredient->getTranslation('name', 'ar')}}</td>
            <td>{{$record->ingredient->getTranslation('name', 'en')}}</td>

            <td>{{$record->quantity}}</td>
            <td>{{$record->expiration_date}}</td>
            <td>{{$record->admin->name}}</td>
          
        
            <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
           
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="8" style="text-align:center;">
            There are no records match your inputs.
        </td>
    </tr>
@endif
