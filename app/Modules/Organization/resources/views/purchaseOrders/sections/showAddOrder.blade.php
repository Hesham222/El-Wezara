<table class="table" id="items-table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">الرقم التعريفي</th>
        <th scope="col">مصدر امر الاضافة</th>
        <th scope="col">وقت اصدار الامر 	</th>
    </tr>
    </thead>
    <tbody>
        @if($po->add_order)
            <tr>
                <td scope="row">
                    <span>{{$po->add_order->id}}</span>
                </td>
                <td>
                    <span>{{$po->add_order->admin->name}}</span>
                </td>
               
                <td>
                    <span>{{$po->add_order->created_at}}</span>
                </td>
           
            </tr>
 
        
    @else
    <tr><td colspan="6" style="text-align: center;">لا يوجد امر اضافة</td></tr>
    @endif
    </tbody>
</table>
