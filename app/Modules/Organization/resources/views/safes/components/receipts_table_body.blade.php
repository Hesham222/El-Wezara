@if(count($records))
@foreach($records as $record)
@if($record->received == 1)
continue;

@endif
<tr id="tableRecord-{{$record->id}}">

    <td>{{$record->id}}</td>
    <td>{{$record->created_at}}</td>
    <td>{{$record->created_by?\Organization\Models\OrganizationAdmin::where
    ('id',$record->created_by)->first()->name:"لا يوجد"}}</td>
    <td>{{$record->po_sheet->point_of_sale?$record->po_sheet->point_of_sale->name:"لا يوجد"}}</td>
    <td>{{$record->total}}</td>


    <td>
        @if($record->sent_to_the_bank == 0) 
        <a href="{{ route('organizations.safe.supply',$record->id) }}" class="btn btn-primary">  توريد</a>
       
       @else 
       تم التوريد للبنك
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