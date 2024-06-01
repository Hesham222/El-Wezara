@if(count($records))
    @foreach($records as $record)
        <tr id="tableRecord-{{$record->id}}">
            <td>{{$record->id}}</td>
            @if(request()->query('view')=='trash')
                <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
                <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
            @endif
            <td>{{$record->headDepartment?$record->headDepartment->name:'لا يوجد'}}</td>
            <td>{{$record->getTranslation('name', 'en')}}</td>
            <td>{{$record->getTranslation('name', 'ar')}}</td>
            <td>{{$record->getTranslation('description', 'en')}}</td>
            <td>{{$record->getTranslation('description', 'ar')}}</td>
            <td>@if($record->head_of_department){{$record->head_of_department->name}}@endif</td>
            <td>{{$record->number_of_employees}}</td>
            <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
            <td>
                @if(request()->query('view')=='trash')
                    <a
                        class="btn btn-sm btn-primary"
                        title="Restore"
                        data-toggle="modal"
                        data-target="#confirm-password-modal"
                        onclick="injectModalData('{{$record->id}}', '{{route('organizations.department.restore')}}', 'confirm-password-form', 'POST')"
                    >
                        <i class="fa fa-undo" style="color: #fff"></i>
                    </a>
                    <a
                        class="btn btn-sm btn-danger"
                        title="Destroy"
                        data-toggle="modal"
                        data-target="#confirm-password-modal"
                        onclick="injectModalData('{{$record->id}}', '{{route('organizations.department.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
                    >
                        <i class="fa fa-trash" style="color: #fff"></i>
                    </a>
                @else
                    @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Department-Edit'))

                    <a
                        href="{{route('organizations.department.edit',$record->id)}}"
                        title="Edit"
                        class="btn btn-sm btn-primary">
                        <i class="fa fa-edit" style="color: #fff"></i>
                    </a>
                    @endif
                        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Department-Delete'))

                        <a
                            class="btn btn-sm btn-danger"
                            title="Remove"
                            data-toggle="modal"
                            data-target="#confirm-password-modal"
                            onclick="injectModalData('{{$record->id}}', '{{route('organizations.department.trash')}}', 'confirm-password-form', 'POST')" >
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
            There are no records match your inputs.
        </td>
    </tr>
@endif
