@if(count($records))
    @foreach($records as $record)
        <tr id="tableRecord-{{$record->id}}">
            <td>{{$record->id}}</td>
            @if(request()->query('view')=='trash')
                <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
                <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
            @endif
            <td>{{$record->Ingredient?$record->Ingredient->name:"لا يوجد"}}</td>
            <td>{{$record->Vendor?$record->Vendor->name:"لا يوجد"}}</td>
            <td>{{$record->price?$record->price:"لا يوجد"}}</td>

            <td>
                <a
                    href="{{route('organizations.vendor.edit.ingredient',$record->id)}}"
                    title="تعديل"
                    class="btn btn-sm btn-primary">
                    <i class="fa fa-edit" style="color: #fff"></i>
                </a>
                <a
                    class="btn btn-sm btn-danger"
                    title="مسح "
                    data-toggle="modal"
                    data-target="#confirm-password-modal"
                    onclick="injectModalData('{{$record->id}}', '{{route('organizations.vendor.destroy.ingredient', $record->id)}}', 'confirm-password-form', 'DELETE')"
                >
                    <i class="fa fa-trash" style="color: #fff"></i>
                </a>
            </td>


{{--                <a--}}
{{--                    class="btn btn-sm btn-danger"--}}
{{--                    title="Destroy Section"--}}
{{--                    data-toggle="modal"--}}
{{--                    data-target="#confirm-password-modal"--}}
{{--                    onclick="injectModalData('{{$ingredient->id}}', '{{route('admins.photo.destroy.section', $ingredient->id)}}', 'confirm-password-form', 'DELETE')"--}}
{{--                >--}}
{{--                    <i class="fa fa-trash" style="color: #fff"></i>--}}
{{--                </a>--}}
{{--            </td>--}}
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="8" style="text-align:center;">
            There are no records match your inputs.
        </td>
    </tr>
@endif
