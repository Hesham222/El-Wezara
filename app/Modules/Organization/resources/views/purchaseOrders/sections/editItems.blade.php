<div class="col-lg-6">
    <div class="input-group-prepend">
        <input type="text" placeholder="search items(write item id or name)..." id="itemSearchKey" name="getItem" class="form-control" >
        <button
            id="getItemButton"
            class="btn btn-primary"
            type="button"
            title="search data"
        >
            <i class="fa fa-search"></i>
        </button>
    </div>
    <div class="input-group-prepend" id="item-list-holder">

    </div>
</div>
<br>
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
        <th scope="col">أجراءات</th>
    </tr>
    </thead>
    <tbody>
    @foreach($po->items as $itm)
        <tr>
            <td scope="row">
                <input type="hidden" value="{{$itm->item ? $itm->item->id : 0}}" name="items[]">
                <input type="text" value="{{$itm->item ? $itm->item->name : 'deleted'}}" raedonly class="form-control">
            </td>
            <td>
                <input  type="number"  name="selling_price[]" class="prices form-control" value="{{$itm->selling_price}}">
            </td>
            <td>
                <span class="stock">{{$itm->item?$itm->item->stock:'0'}}</span>
            </td>
            <td>
                <input  type="number"  name="order_qty[]" onchange='changeOrderdQty(this)' class="orderQty form-control" min="1" max="" value="{{$itm->ordered_quantity}}">
            </td>
            <td>
                <input  type="number"  name="cost[]" onchange='changeCost(this)' class="cost form-control" min="1"  value="{{$itm->cost}}">
            </td>
            <td>
                <input  type="number" name="item_final_cost[]"  readonly value="{{$itm->final_cost}}" class="form-control final-cost">
            </td>
            <td>
                <input  type="number" name="item_total[]"  readonly value="{{$itm->total}}" class="form-control total">
            </td>
            <td>
                <input  type="number" name="item_subtotal[]"  readonly value="{{$itm->subtotal}}" class="form-control subtotal">
            </td>
            <td>
                <a title='delete item' class='btn btn-sm btn-danger' onclick='DeleteRowTable(this)'><i class='fa fa-times' style='color: #fff'></i></a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
