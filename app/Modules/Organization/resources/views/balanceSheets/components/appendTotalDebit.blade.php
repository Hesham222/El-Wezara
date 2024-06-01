@if(isset($debit_amounts))
    <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
        <thead>
        <tr>
            <th style="font-weight: bold">المجاميع - مدين</th>
        </tr>
        </thead>

        <thead>
        </thead>
        <tbody>
        @if(isset($accounts))
            @foreach($accounts as $account)
                    <tr>
                        @if(count($account->Debits) > 0)

                                <td>
                                    {{($account->Debits) ?$account->Debits->sum('amount') : ""}}
                                </td>
                        @else
                            @continue($account)
                        @endif
                    </tr>
            @endforeach
        @endif
        @if(isset($sub_accounts))
            @foreach($sub_accounts as $sub_account)
                <tr>
                    @if(count($sub_account->Debits) > 0)

                            <td>
                                {{($sub_account->Debits) ?$sub_account->Debits->sum('amount') : ""}}
                            </td>
                    @else
                        @continue($sub_account)
                    @endif
                </tr>
            @endforeach

        @endif

        </tbody>
        <tbody id="data-table-body2"></tbody>
    </table>


@endif
