@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
    <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td><a title="show details" href="{{route('organizations.item.showDetail',$record->id)}}" >{{$record->getTranslation('name', 'ar')}}</a></td>

    <td><a title="show details" href="{{route('organizations.item.showDetail',$record->id)}}">{{$record->getTranslation('name', 'en')}}</a></td>
    <td>{{$record->getTranslation('description', 'en')}}</td>
    <td>{{$record->getTranslation('description', 'ar')}}</td>
    <td>{{$record->type}}</td>
    <td>
        @if($record->image)
        <div>

            <img style="
                                         width: 100px;
                                         padding: 10px;" src="{{ asset('storage/'.$record->image) }}" id="img_url">

        </div>
        @else
        ---
        @endif
    </td>
    <td>{{$record->cost}}</td>
    <td>{{$record->price}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td>
    @if(request()->query('view')=='trash')
        <a
        class="btn btn-sm btn-primary"
        title="Restore"
        data-toggle="modal"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('organizations.item.restore')}}', 'confirm-password-form', 'POST')"
        >
        <i class="fa fa-undo" style="color: #fff"></i>
        </a>
        <a
            class="btn btn-sm btn-danger"
            title="Destroy"
            data-toggle="modal"
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('organizations.item.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
        >
            <i class="fa fa-trash" style="color: #fff"></i>
        </a>
    @else
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Item-Edit'))

            <a
            href="{{route('organizations.item.edit',$record->id)}}"
            title="Edit"
            class="btn btn-sm btn-primary">
            <i class="fa fa-edit" style="color: #fff"></i>
        </a>
            @endif

        @if($record->type == 'Variant')
                    @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Item-Add-Variant'))

                    <a
                    href="{{route('organizations.item.add.variant',$record->id)}}"
                    title="Add Variant"
                    class="btn btn-sm btn-primary">
                    <i class="fa fa-plus-circle" style="color: #fff"></i>
                </a>
                    @endif
                        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Item-Show-Variant'))

                <a
                    href="{{route('organizations.item.all.variant',$record->id)}}"
                    title="Show Variants"
                    class="btn btn-sm btn-primary">
                    <i class="fa fa-list" style="color: #fff"></i>
                </a>
                        @endif
            @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Item-Delete'))

                <a
                class="btn btn-sm btn-danger"
                title="Remove"
                data-toggle="modal"
                data-target="#confirm-password-modal"
                onclick="injectModalData('{{$record->id}}', '{{route('organizations.item.trash')}}', 'confirm-password-form', 'POST')" >
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
