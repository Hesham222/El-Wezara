@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    <td>{{$record->createdBy?$record->createdBy->name:"لا يوجد"}}</td>
    <td>{{$record->laundry?$record->laundry->name:"لا يوجد"}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
        <a
            href="{{route('organizations.LaundryStocking.detail',$record->id)}}"
            title="مشاهده تفاصيل الجرد"
            target="_blank"
            class="btn btn-sm btn-primary">
            <i class="fa fa-eye" style="color: #fff"></i>
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
