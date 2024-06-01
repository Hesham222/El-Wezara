<table class="table" id="items-table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">عنصر</th>
        <th scope="col">سعر البيع (EGY)</th>
        <th scope="col">في المخزن</th>
        <th scope="col">الكمية المطلوبة	</th>
        <th scope="col">الكمية المستلمة</th>
        <th scope="col">الحالة</th>
        <th scope="col">التكلفة	</th>
        <th scope="col">التكلفة النهائية	</th>
        <th scope="col"> اخر سعر شراء	</th>
        <th scope="col">المجموع</th>
        <th scope="col">المجموع الفرعي	</th>
        <th scope="col"> تاريخ انتهاء الصلاحية	</th>
    </tr>
    </thead>
    <tbody>
    @foreach($po->items as $itm)
        <tr>
            <td scope="row">
                <input type="hidden" name="items[]" value="{{$itm->id}}">
                <span>{{$itm->item?$itm->item->name:'-'}}</span>
            </td>
            <td>
                <input  type="number"  name="selling_price[]" class="prices form-control" value="{{$itm->selling_price}}">
            </td>
            <td>
                <span class="stock">{{$itm->item?$itm->item->stock:'0'}}</span>
            </td>
            <td>
                <input  type="number" readonly="" class="form-control orderQty" value="{{$itm->ordered_quantity}}">
            <!-- <span>{{$itm->ordered_quantity}}</span> -->
            </td>
            <td>
                <input  type="number"  name="received_qty[]" onchange='changeRecivedQty(this)' class="receivedQty form-control" min="0" max="" value="{{$itm->received_quantity?$itm->received_quantity:$itm->ordered_quantity}}">
            </td>
            <td>
                <input class="status_input" type="text"  readonly="" name="item_statues[]" value="{{$itm->status?$itm->status:'مكتملة'}}" style="border: 0">
            </td>
            <td>
                <input  type="number"  name="cost[]" onchange='changeCost(this)' class="cost form-control" min="0"  value="{{$itm->cost}}">
            </td>
            <td>
                <input  type="number" name="item_final_cost[]"  readonly value="{{$itm->final_cost}}" class="form-control final-cost">
            </td>

            <td>
                <input  type="number" name="item_last_final_cost[]"  readonly value="{{$itm->item->last_selling_price}}" class="form-control">
            </td>

            <td>
                <input  type="number" name="item_total[]"  readonly value="{{$itm->total}}" class="form-control total">
            </td>
            <td>
                <input type="number" name="item_subtotal[]"  readonly value="{{$itm->subtotal}}" class="form-control subtotal">
            </td>
            <td>
                <input type="date" name="itemDate[]"    class="form-control date">
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
