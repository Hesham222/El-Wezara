@if(count($records))

@foreach($records as $record)

     <tr id="tableRecord-{{$record->id}}">
         <td>{{$record->Training->FreelanceTrainer?$record->Training->FreelanceTrainer->id:"لا يوجد"}}</td>
         <td>{{$record->Training->FreelanceTrainer?$record->Training->FreelanceTrainer->name:"لا يوجد"}}</td>
{{--         <td>{{$record->Training->FreelanceTrainer?$record->Training->FreelanceTrainer->phone:"لا يوجد"}}</td>--}}
        <td>
            <a
                href="{{route('organizations.trainerAttend.showCount',$record->Training->FreelanceTrainer->id)}}"
                title="عدد التدريبات"
                style="margin:5px"
                class="btn btn-sm btn-primary">
                <i class="fa fa-calculator" style="color: #fff"></i>
            </a>
        </td>
         <td>
             <a
                 href="{{route('organizations.trainerAttend.show',$record->Training->FreelanceTrainer->id)}}"
                 title="Trainings Details"
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
