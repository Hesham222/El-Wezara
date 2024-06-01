@if(count($records))
@foreach($records as $record)
<tr id="tableRecord-{{$record->id}}">
    <td>{{$record->id}}</td>
    @if(request()->query('view')=='trash')
    <td>{{$record->deletedBy ? $record->deletedBy->name : "NONE"}}</td>
    <td>{{ date('M d, Y', strtotime($record->deleted_at)) .'-'.date('h:i a', strtotime($record->deleted_at)) }}</td>
    @endif
    <td>{{$record->hotel->name}}</td>
    <td class="status-{{$record->id}}">{{$record->status}}</td>
    <td>@if($record->status == 'rejected'){{ $record->rejection_reason }} @else -- @endif</td>
    <td>{{$record->createdBy?$record->createdBy->name:"لا يوجد"}}</td>
    <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    <td id="actions">
    @if(request()->query('view')=='trash')
        <a
        class="btn btn-sm btn-primary"
        title="استرجاع"
        data-toggle="modal"
        data-target="#confirm-password-modal"
        onclick="injectModalData('{{$record->id}}', '{{route('organizations.hotelOrder.restore')}}', 'confirm-password-form', 'POST')"
        >
        <i class="fa fa-undo" style="color: #fff"></i>
        </a>
        <a
            class="btn btn-sm btn-danger"
            title="حذف نهائي"
            data-toggle="modal"
            data-target="#confirm-password-modal"
            onclick="injectModalData('{{$record->id}}', '{{route('organizations.hotelOrder.destroy', $record->id)}}', 'confirm-password-form', 'DELETE')"
        >
            <i class="fa fa-trash" style="color: #fff"></i>
        </a>
    @else
            @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelOrder-Receive-Order'))

            @if ($record->status == "approved")

                <a style="color: white" class="btn btn-sm btn-primary changeStatus removeStatus-{{$record->id}}"
                   data-id ="{{$record->id}}"
                   title="استلام الطلب"
                >
                    استلام الطلب                </a>
            @endif
            @endif
                @if(checkOrganizationAdminPermission(auth('organization_admin')->user()->role->permissions->pluck('permission_id')->toArray(),'HotelOrder-Cancel-Order'))

                    @if ($record->status == "pending" || $record->status == "approved")

                    <a class="btn btn-sm btn-warning cancelOrder removeCancel-{{$record->id}}"
                       data-id ="{{$record->id}}"
                       title="الغاء الطلب"
                    >
                        الغاء الطلب
                    </a>
                @endif
                @endif



            {{--        <a--}}
{{--            href="{{route('organizations.laundryOrder.edit',$record->id)}}"--}}
{{--            title="تعديل"--}}
{{--            class="btn btn-sm btn-primary">--}}
{{--            <i class="fa fa-edit" style="color: #fff"></i>--}}
{{--        </a>--}}
{{--        <a--}}
{{--        class="btn btn-sm btn-danger"--}}
{{--        title="حذف"--}}
{{--        data-toggle="modal"--}}
{{--        data-target="#confirm-password-modal"--}}
{{--        onclick="injectModalData('{{$record->id}}', '{{route('organizations.laundryOrder.trash')}}', 'confirm-password-form', 'POST')" >--}}
{{--        <i class="fa fa-trash" style="color: #fff"></i>--}}
{{--        </a>--}}
    @endif
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

<script>
    $('.changeStatus').on('click',function (){
        var order_id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: '{{route('organizations.hotelOrder.change.order.status')}}',
            data: {id:order_id},
            success: function(data){
                console.log(data)
                if(data['data'] === $('#status').html()){
                    console.log('not changed')
                }
                else{
                    $('.status-'+order_id+'').html(data['data'])
                    $('.removeStatus-'+order_id+'').remove()

                }
            }
        });
    })
</script>

<script>
    $('.cancelOrder').on('click',function (){
        var order_id = $(this).data('id');
        $.ajax({
            type: "GET",
            url: '{{route('organizations.hotelOrder.cancel.order')}}',
            data: {id:order_id},
            success: function(data){
                $('.status-'+order_id+'').html(data['data'])
                $('.removeCancel-'+order_id+'').remove()
                $('.removeStatus-'+order_id+'').remove()
            }
        });
    })
</script>


