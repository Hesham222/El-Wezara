@if(count($records))
    @foreach($records as $record)
        <tr id="tableRecord-{{$record->id}}">
            <td>{{$record->id}}</td>
            @if(request()->query('view')=='trash')
                <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
                <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
            @endif
            <td>{{$record->name}}</td>
            <td>{{$record->company_name}}</td>
            <td>{{$record->tax_card}}</td>
            <td>{{$record->commercial_record}}</td>
            <td>
                <a target="_blank"
                   href="{{asset('storage'.DS().$record->tax_card_attachment)}}"
                   title="الرقم القومي"
                   class="btn btn-sm btn-primary">
                    <i class="fa fa-eye" style="color: #fff"></i>
                    <input type="hidden" name="image" value="{{ $record->tax_card_attachment}}">

                </a>
            </td>
            <td>
                <a target="_blank"
                   href="{{asset('storage'.DS().$record->commercial_record_attachment)}}"
                   title="الرقم القومي"
                   class="btn btn-sm btn-primary">
                    <i class="fa fa-eye" style="color: #fff"></i>
                    <input type="hidden" name="image" value="{{ $record->commercial_record_attachment}}">

                </a>
            </td>

            <td>{{ $record->purchaseOrders->where('status_id',4)->count() }}</td>
            <td>{{ $record->purchaseOrders->where('status_id',2)->count() }}</td>
            <td>{{ $record->purchaseOrders->where('status_id',4)->sum('total') }} L.E</td>
{{--            <td><a href="{{route('organizations.vendor.download.tax_card',$record->id)}}">download</a></td>--}}
{{--            <td><a href="{{route('organizations.vendor.download.commercial_record',$record->id)}}">download</a></td>--}}
            <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
            <td>
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Vendor-View-Details'))

                <a href="{{route('organizations.vendor.show',$record->id)}}"
                   target="_blank"
                   class="btn btn-sm btn-primary"><i class="fa fa-eye"
                                                     title="مشاهده التفاصيل"
                                                     style="color: #fff"></i>
                </a>
                @endif
                    @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Vendor-Add-Ingredients'))

                    <a
                        href="{{route('organizations.vendor.create.ingredient',$record->id)}}"
                        title="اضف مكون وجبات الى مورد"
                        class="btn btn-sm btn-focus">

                        <i class="fa fa-plus" style="color:  #fff"></i>
                    </a>
                    @endif
                    @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Vendor-View-Ingredients'))
                    <a
                        href="{{route('organizations.vendor.show.ingredient',$record->id).'?view=ingredient'}}"
                        title="مكونات الوجبات"
                        class="btn btn-sm btn-focus">

                        <i class="fa fa-eye" style="color:  #fff"></i>
                    </a>
                    @endif

                @if(request()->query('view')=='trash')
                    <a
                        class="btn btn-sm btn-primary"
                        title="Restore"
                        data-toggle="modal"
                        data-target="#confirm-password-modal"
                        onclick="injectModalData('{{$record->id}}', '{{route('organizations.vendor.restore')}}', 'confirm-password-form', 'POST')"
                    >
                        <i class="fa fa-undo" style="color: #fff"></i>
                    </a>
                    <a
                        class="btn btn-sm btn-danger"
                        title="Destroy"
                        data-toggle="modal"
                        data-target="#confirm-password-modal"
                        onclick="injectModalData('{{$record->id}}', '{{route('organizations.vendor.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
                    >
                        <i class="fa fa-trash" style="color: #fff"></i>
                    </a>
                @else
                        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Vendor-Edit'))

                        <a
                        href="{{route('organizations.vendor.edit',$record->id)}}"
                        title="Edit"
                        class="btn btn-sm btn-primary">
                        <i class="fa fa-edit" style="color: #fff"></i>
                    </a>
                        @endif
                            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Vendor-Delete'))

                        <a
                            class="btn btn-sm btn-danger"
                            title="Remove"
                            data-toggle="modal"
                            data-target="#confirm-password-modal"
                            onclick="injectModalData('{{$record->id}}', '{{route('organizations.vendor.trash')}}', 'confirm-password-form', 'POST')" >
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
