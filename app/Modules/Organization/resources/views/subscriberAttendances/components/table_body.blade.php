@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
    <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>{{$record->Subscriber?$record->Subscriber->name:"لا يوجد"}}</td>
    <td>{{$record->phone?$record->phone:"لا يوجد"}}</td>
    <td>{{$record->Training->ClubSport?$record->Training->ClubSport->name:"لا يوجد"}}</td>
    <td>{{$record->Training?$record->Training->name:"لا يوجد"}}</td>
    <td>{{$record->Training->FreelanceTrainer?$record->Training->FreelanceTrainer->name:"لا يوجد"}}</td>
    <td>{{$record->train_time?$record->train_time:"لا يوجد"}}</td>
    <td>{{$record->getAttendance()?$record->getAttendance():"لا يوجد"}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
{{--    <td>--}}
{{--    @if(request()->query('view')=='trash')--}}
{{--        <a--}}
{{--        class="btn btn-sm btn-primary"--}}
{{--        title="استرجاع"--}}
{{--        data-toggle="modal"--}}
{{--        data-target="#confirm-password-modal"--}}
{{--        onclick="injectModalData('{{$record->id}}', '{{route('organizations.trainerAttendance.restore')}}', 'confirm-password-form', 'POST')"--}}
{{--        >--}}
{{--        <i class="fa fa-undo" style="color: #fff"></i>--}}
{{--        </a>--}}
{{--        <a--}}
{{--            class="btn btn-sm btn-danger"--}}
{{--            title="حذف نهائي"--}}
{{--            data-toggle="modal"--}}
{{--            data-target="#confirm-password-modal"--}}
{{--            onclick="injectModalData('{{$record->id}}', '{{route('organizations.trainerAttendance.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"--}}
{{--        >--}}
{{--            <i class="fa fa-trash" style="color: #fff"></i>--}}
{{--        </a>--}}
{{--    @else--}}
{{--        <a--}}
{{--            href="{{route('organizations.trainerAttendance.edit',$record->id)}}"--}}
{{--            title="تعديل"--}}
{{--            class="btn btn-sm btn-primary">--}}
{{--            <i class="fa fa-edit" style="color: #fff"></i>--}}
{{--        </a>--}}
{{--        <a--}}
{{--        class="btn btn-sm btn-danger"--}}
{{--        title="حذف"--}}
{{--        data-toggle="modal"--}}
{{--        data-target="#confirm-password-modal"--}}
{{--        onclick="injectModalData('{{$record->id}}', '{{route('organizations.trainerAttendance.trash')}}', 'confirm-password-form', 'POST')" >--}}
{{--        <i class="fa fa-trash" style="color: #fff"></i>--}}
{{--        </a>--}}
{{--    @endif--}}
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
