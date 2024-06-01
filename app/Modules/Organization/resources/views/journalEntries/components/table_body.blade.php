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
            @foreach($record->Debits as $debit)
                <li>{{$debit->amount?$debit->amount:"لا يوجد"}}
                </li>
            @endforeach
                <li>Total >> {{$record->sum_debits}}</li>
        </ul>

    </td>
    <td>
        <ul>
            @foreach($record->Credits as $credit)
                <li>{{$credit->amount?$credit->amount:"لا يوجد"}}</li>
            @endforeach
                <li>Total >> {{$record->sum_credits}}</li>

        </ul>

    </td>
    <td>
        <ul>
            @foreach($record->Debits as $debit)
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
            @foreach($record->Credits as $credit)
                @if(isset($credit->account_id))
                    <li>{{$credit->Account?$credit->Account->name:"لا يوجد"}}</li>
                @else
                    <li>{{$credit->SubAccount?$credit->SubAccount->name:"لا يوجد"}}</li>

                @endif
            @endforeach
        </ul>
    </td>
    <td>{{$record->description?$record->description:"لا يوجد"}}</td>

    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
    @if(request()->query('view')=='trash')
        <a
        class="btn btn-sm btn-primary"
        title="استرجاع"
        data-toggle="modal"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('organizations.journalEntry.restore')}}', 'confirm-password-form', 'POST')"
        >
        <i class="fa fa-undo" style="color: #fff"></i>
        </a>
        <a
            class="btn btn-sm btn-danger"
            title="حذف نهائي"
            data-toggle="modal"
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('organizations.journalEntry.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
        >
            <i class="fa fa-trash" style="color: #fff"></i>
        </a>
    @else
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialJournalEntry-Edit'))

            <a
            href="{{route('organizations.journalEntry.edit',$record->id)}}"
            title="تعديل"
            class="btn btn-sm btn-primary">
            <i class="fa fa-edit" style="color: #fff"></i>
        </a>
            @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'FinancialJournalEntry-Delete'))

                <a
        class="btn btn-sm btn-danger"
        title="حذف"
        data-toggle="modal"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('organizations.journalEntry.trash')}}', 'confirm-password-form', 'POST')" >
        <i class="fa fa-trash" style="color: #fff"></i>
        </a>
                @endif
    @endif
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
