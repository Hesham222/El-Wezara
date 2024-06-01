@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
    <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>
        <ul>
            @foreach($record->JournalEntry->Debits as $debit)
                <li>{{$debit->amount?$debit->amount:"لا يوجد"}}
                </li>
            @endforeach
                <li>Total >> {{$record->JournalEntry->sum_debits}}</li>

        </ul>
    </td>
    <td>
        <ul>
            @foreach($record->JournalEntry->Credits as $credit)
                <li>{{$credit->amount?$credit->amount:"لا يوجد"}}</li>
            @endforeach
                <li>Total >> {{$record->JournalEntry->sum_credits}}</li>

        </ul>
    </td>
    <td>
        <ul>
            @foreach($record->JournalEntry->Debits as $debit)
                @if(isset($debit->account_id))
                    <li>{{$debit->Account?$debit->Account->name:"لا يوجد"}}</li>
                @else
                    <li>{{$debit->SubAccount?$debit->SubAccount->name:"لا يوجد"}}</li>

                @endif
            @endforeach
        </ul>
    </td>
    <td>
        <ul>
            @foreach($record->JournalEntry->Credits as $credit)
                @if(isset($credit->account_id))
                    <li>{{$credit->Account?$credit->Account->name:"لا يوجد"}}</li>
                @else
                    <li>{{$credit->SubAccount?$credit->SubAccount->name:"لا يوجد"}}</li>

                @endif
            @endforeach
        </ul>
    </td>
    <td>{{$record->JournalEntry?$record->JournalEntry->description:"لا يوجد"}}</td>
    <td>
        {{$record->JournalEntry->createdBy?$record->JournalEntry->createdBy->name:"لا يوجد"}}
    </td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
</tr>
@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
