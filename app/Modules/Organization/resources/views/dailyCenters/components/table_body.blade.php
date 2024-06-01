<thead>
<tr>
    <th style="width: 15%">رقم القيد</th>
    @if(request()->query('view')=='trash')
        <th>مسح بواسطه</th>
        <th>مسح في</th>
    @endif
    <th style="width: 15%"> شرح القيد</th>
    <th style="width: 15%">  القيد</th>
    <th style="width: 15%">  المبلغ</th>

{{--    @foreach($records as $record)--}}
{{--        @foreach($record->JournalEntry->Debits as $debit)--}}
{{--            @if(isset($debit->account_id))--}}
{{--                <th style="width: 15%">{{$debit->Account?$debit->Account->name:"لا يوجد"}}</th>--}}
{{--            @else--}}
{{--                <th style="width: 15%">{{$debit->SubAccount?$debit->SubAccount->name:"لا يوجد"}}</th>--}}

{{--            @endif--}}
{{--        @endforeach--}}
{{--        @foreach($record->JournalEntry->Credits as $credit)--}}
{{--            @if(($credit->Account->name))--}}
{{--                @continue($credit->Account->name)--}}
{{--                @endif--}}
{{--            @if(isset($credit->account_id))--}}
{{--                <th style="width: 15%">{{$credit->Account?$credit->Account->name:"لا يوجد"}}</th>--}}
{{--            @else--}}
{{--                <th style="width: 15%">{{$credit->SubAccount?$credit->SubAccount->name:"لا يوجد"}}</th>--}}

{{--            @endif--}}
{{--        @endforeach--}}
{{--    @endforeach--}}
</tr>
</thead>
@if(count($records))

@foreach($records as $record)
    <tr>
        <td></td>
        <td></td>

        <td>
            <ul>
                <li>حساب مدين </li>
                <br>
                <li> حساب دائن</li>
            </ul>
        </td>
        <td>
            <ul>
                <li> مدين </li>
                <br>
                <li> دائن</li>
            </ul>
        </td>
                @foreach($record->JournalEntry->Debits as $debit)
                    <td>
                        <ul>

                    @if(isset($debit->account_id))
                                <li> مدين </li>
                                <br>
                                <li> دائن</li>
                    @else
                                <li> مدين </li>
                                <br>
                                <li> دائن</li>
                    @endif
                        </ul>
                    </td>
                @endforeach
        @foreach($record->JournalEntry->Credits as $credit)
                @if(($credit->Account->name))
                    @continue($credit->Account->name)
            @else
                <td>
                    <ul>
                        @if(isset($credit->account_id))
                            <li> مدين </li>
                            <br>
                            <li> دائن</li>
                        @else
                            <li> مدين </li>
                            <br>
                            <li> دائن</li>
                        @endif
                    </ul>
                </td>
                @endif
                @if(isset($credit->account_id))
                    <th hidden style="width: 15%">{{$credit->Account?$credit->Account->name:"لا يوجد"}}</th>
                @else
                    <th hidden style="width: 15%">{{$credit->SubAccount?$credit->SubAccount->name:"لا يوجد"}}</th>

                @endif

        @endforeach

    </tr>
    <tr>
        <td>{{$record->id?$record->id:"لايوجد"}}</td>
        <td>{{$record->JournalEntry->description?$record->JournalEntry->description:"لايوجد"}}</td>
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
        <td>
            <ul>
                @foreach($record->JournalEntry->Debits as $debit)
                    <li>{{$debit->amount?$debit->amount:"لا يوجد"}}
                    </li>
                @endforeach
            </ul>
            <ul>
                @foreach($record->JournalEntry->Credits as $credit)
                    <li>{{$credit->amount?$credit->amount:"لا يوجد"}}</li>
                @endforeach
            </ul>
        </td>

                @foreach($record->JournalEntry->Debits as $debit)
            <td>
                <ul>
                    @if(isset($debit->account_id))

                            <li style="width: 15%">{{$debit->amount?$debit->amount:"لا يوجد"}}</li>
                    @else

                            <li style="width: 15%">{{$debit->amount?$debit->amount:"لا يوجد"}}</li>

                    @endif
                </ul>
            </td>
        @endforeach
        @foreach($record->JournalEntry->Credits as $credit)
            <td>
                <ul>
                    @if(isset($credit->account_id))

                        <li style="width: 15%">{{$credit->amount?$credit->amount:"لا يوجد"}}</li>
                    @else

                        <li style="width: 15%">{{$credit->amount?$credit->amount:"لا يوجد"}}</li>

                    @endif
                </ul>
            </td>
        @endforeach

    </tr>


@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
