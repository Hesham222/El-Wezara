<tr>
    <td scope="row">
        <input type="hidden" value="{{$item->id}}" name="items[]">
        <input type="text" value="{{$item->name}}" raedonly class="form-control">
    </td>
    <td>
        <input  type="number" step="0" name="selling_price[]" class="prices form-control" value="@if($item->price){{$item->price}}@else{{round(0)}}@endif">
    </td>
    <td>
        <input  type="number" class="stock form-control" value="{{$item->stock}}" readonly>
    </td>
    <td>
        <input  type="number" step="0" name="order_qty[]" onchange='changeOrderdQty(this)' class="orderQty form-control" min="1"  value="">
    </td>
    <td>
        <input  type="number" step="0" name="cost[]" onchange='changeCost(this)' class="cost form-control" min="1"  value="@if($item->final_cost){{round($item->final_cost, 2)}}@else{{round($item->cost, 2)}}@endif">
    </td>
    <td>
        <input  type="number" name="item_final_cost[]"  readonly value="0" class="form-control final-cost">
    </td>
    <td>
        <input  type="number" name="item_total[]"  readonly value="0" class="form-control total">
    </td>
    <td>
        <input  type="number" name="item_subtotal[]"  readonly value="0" class="form-control subtotal">
    </td>
    <td>
        <a title='delete item' class='btn btn-sm btn-danger' onclick='DeleteRowTable(this)'><i class='fa fa-times' style='color: #fff'></i></a>
    </td>

</tr>
