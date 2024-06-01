@if(count($records))
    @foreach($records as $record)

        <tr @if($record->re_order_quantity >= $record->stock) style="color: red;" @endif id="tableRecord-{{$record->id}}">
            <td>{{$record->id}}</td>
            @if(request()->query('view')=='trash')
                <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
                <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
            @endif
            <td>{{$record->getTranslation('name', 'ar')}}</td>
            <td>{{$record->getTranslation('name', 'en')}}</td>

            <td>{{$record->getTranslation('description', 'en')}}</td>
            <td>{{$record->getTranslation('description', 'ar')}}</td>
           <td>{{$record->re_order_quantity}}</td>
            <td>{{$record->stock}}</td>
            <td>
                @if($record->ingredient_quantities)

                    @foreach($record->ingredient_quantities as $ingredient_quantity)
                        qty : {{$ingredient_quantity->quantity}} , exp date : {{$ingredient_quantity->expiration_date}}
                        <br>
                    @endforeach

                @else
                --
                @endif

            </td>
            <td>{{$record->quantity}}</td>
            <td>@if($record->unit_of_measurement){{$record->unit_of_measurement->name}}@else -- @endif</td>
            <td>@if($record->category){{$record->category->name}}@else -- @endif</td>
            <td>{{$record->cost}}</td>
            <td>{{$record->final_cost}}</td>
            <td>{{$record->price}}</td>
            <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
            <td>
                @if(request()->query('view')=='trash')
                    <a
                        class="btn btn-sm btn-primary"
                        title="Restore"
                        data-toggle="modal"
                        data-target="#confirm-password-modal"
                        onclick="injectModalData('{{$record->id}}', '{{route('organizations.ingredient.restore')}}', 'confirm-password-form', 'POST')"
                    >
                        <i class="fa fa-undo" style="color: #fff"></i>
                    </a>

                    <a
                        class="btn btn-sm btn-danger"
                        title="Destroy"
                        data-toggle="modal"
                        data-target="#confirm-password-modal"
                        onclick="injectModalData('{{$record->id}}', '{{route('organizations.ingredient.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
                    >
                        <i class="fa fa-trash" style="color: #fff"></i>
                    </a>
                @else

                    @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Ingredient-View-ExecutionOrder'))

                <a
                href="{{route('organizations.ingredient.execution',$record->id)}}"
                title="  مشاهده الكميات الواجب اعدامها"
                class="btn btn-sm btn-warning" target="_blank">

                  مشاهده الكميات الواجب اعدامها
            </a>
                    @endif
                        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Ingredient-Add-ManufacturingProducts'))

                        <a
                        href="{{route('organizations.ingredient.manufactured',$record->id)}}"
                        title="اضافة منتجات تصنيع"
                        class="btn btn-sm btn-primary" target="_blank">

                        اضافة منتجات تصنيع
                    </a>
                        @endif
                        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Ingredient-View-Stocking'))

                            <a class="btn btn-sm btn-primary"
                               href="{{route('organizations.InventoryStocking.index',$record->id)}}"
                               data-id ="{{$record->id}}"
                               title="الجرد">
                                الجرد
                            </a>
                        @endif
                        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Ingredient-Edit'))

                        <a
                        href="{{route('organizations.ingredient.edit',$record->id)}}"
                        title="Edit"
                        class="btn btn-sm btn-primary">
                        <i class="fa fa-edit" style="color: #fff"></i>
                    </a>
                        @endif




                        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Ingredient-Edit'))

                        <a
                        href="{{route('organizations.ingredient.card',$record->id)}}"
                        title="card"
                        class="btn btn-sm btn-primary">
                        <i class="fa fa-file" style="color: #fff"></i>
                    </a>
                        @endif


                        @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'Ingredient-Delete'))

                        <a
                        class="btn btn-sm btn-danger"
                        title="Remove"
                        data-toggle="modal"
                        data-target="#confirm-password-modal"
                        onclick="injectModalData('{{$record->id}}', '{{route('organizations.ingredient.trash')}}', 'confirm-password-form', 'POST')" >
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
