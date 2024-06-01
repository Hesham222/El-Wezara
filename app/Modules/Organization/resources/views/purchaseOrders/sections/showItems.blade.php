<table class="table" id="items-table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">عنصر</th>
        <th scope="col">سعر البيع (EGY)</th>
        <th scope="col">في المخزن</th>
        <th scope="col">الكمية المطلوبة	</th>
        <th scope="col">التكلفة	</th>
        <th scope="col">التكلفة النهائية	</th>
        <th scope="col">المجموع</th>
        <th scope="col">المجموع الفرعي	</th>
        @if($po->status_id==4 or $po->status_id==3)
            <th scope="col">الكمية المستلمة</th>
            <th scope="col">الحالة</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @if($po->items->count())
        @foreach($po->items as $itm)
            <tr>
                <td scope="row">
                    <span>{{$itm->item?$itm->item->name:'-'}}</span>
                </td>
                <td>
                    <span>{{$itm->selling_price}}</span>
                </td>
                <td>
                    <span class="stock">{{$itm->item?$itm->item->stock:'0'}}</span>
                </td>
                <td>
                    <span>{{$itm->ordered_quantity}}</span>
                </td>
                <td>
                    {{$itm->cost}}
                </td>
                <td>
                    <span  class="final-cost">{{$itm->final_cost}}</span>
                </td>
                <td>
                    <span  class="total">{{$itm->total}}</span>
                </td>
                <td>
                    <span  class="subtotal">{{$itm->subtotal}}</span>
                </td>
                @if($po->status_id==4 or $po->status_id==3)
                    <td>
                        <span  class="final-cost">{{$itm->received_quantity?$itm->received_quantity:0}}</span>
                    </td>
                    <td>
                        <span  class="total">{{$itm->status?$itm->status:'Not Recived'}}</span>
                    </td>
                @endif
            </tr>
        @endforeach
    @else
        <tr><td colspan="6" style="text-align: center;">لا يوجد اوامر شراء</td></tr>
    @endif
    </tbody>
</table>
