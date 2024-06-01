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
    <td>{{$record->safe_receipt_id }}</td>
    <td>{{$record->total}}</td>


{{--    <td>--}}
{{--        @if($record->file)--}}
{{--         <a href="{{ route('organizations.safe.bankSupply.download',$record->id) }}" class="btn btn-primary">  تحميل ملف</a>--}}

{{--       @else--}}
{{--      لا يوجد ملف--}}
{{--        @endif--}}
{{--    </td>--}}

</tr>
@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
