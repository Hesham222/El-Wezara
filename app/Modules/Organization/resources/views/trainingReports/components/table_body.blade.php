@if(count($records))

@foreach($records as $record)

     <tr id="tableRecord-{{$record->id}}">
         <td>{{$record->Training->name?$record->Training->name:"لا يوجد"}}</td>
         <td>{{$record->Training->FreelanceTrainer?$record->Training->FreelanceTrainer->name:"لا يوجد"}}</td>
         <td>{{$record->day?$record->day:"لا يوجد"}}</td>
         <td>{{$record->start_time?$record->start_time:"لا يوجد"}}</td>
         <td>{{$record->end_time?$record->end_time:"لا يوجد"}}</td>
        <td>
            <a
                href="{{route('organizations.trainingReport.show',$record->Training->id)}}"
                title="اظهر المشتركين"
                style="margin:5px"
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
