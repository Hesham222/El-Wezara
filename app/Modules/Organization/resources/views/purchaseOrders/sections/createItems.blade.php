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
<table class="table table-bordered" id="items-table">
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

    @if(isset($ingredient) && isset($qnt))
        <tr>

            <td scope="row">
                <input type="hidden" value="{{$ingredient->id}}" name="items[]">
                <input type="text" value="{{$ingredient->name}}" raedonly class="form-control">
            </td>
            <td>
                <input  type="number"  name="selling_price[]" class="prices form-control" value="@if($ingredient->price){{$ingredient->price}}@else{{round(0)}}@endif">
            </td>
            <td>
                <input  type="number" class="stock form-control" value="{{$ingredient->stock}}" readonly>
            </td>
            <td>
                <input  type="number"  name="order_qty[]" onchange='changeOrderdQty(this)' class="orderQty form-control" min="1"  value="{{$qnt}}">
            </td>
            <td>
                <input  type="number"  name="cost[]" onchange='changeCost(this)' class="cost form-control" min="1"  value="@if($ingredient->final_cost){{round($ingredient->final_cost, 2)}}@else{{round($ingredient->cost, 2)}}@endif">
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


        @endif

    @if(isset($order) && isset($type))
        @if($type == 'point')
        @foreach($order->PointOrderIngredients as $item)
        <tr>

            <td scope="row">
                <input type="hidden" value="{{$item->ingredient->id}}" name="items[]">
                <input type="text" value="{{$item->ingredient->name}}" raedonly class="form-control">
            </td>
            <td>
                <input  type="number" step="0" name="selling_price[]" class="prices form-control" value="@if($item->ingredient->price){{$item->ingredient->price}}@else{{round(0)}}@endif">
            </td>
            <td>
                <input  type="number" class="stock form-control" value="{{$item->ingredient->stock}}" readonly>
            </td>
            <td>
                <input  type="number" step="0" name="order_qty[]" onchange='changeOrderdQty(this)' class="orderQty form-control" min="1"  value="{{$item->quantity }}">
            </td>
            <td>
                <input  type="number" step="0" name="cost[]" onchange='changeCost(this)' class="cost form-control" min="1"  value="@if($item->ingredient->final_cost){{round($item->ingredient->final_cost, 2)}}@else{{round($item->ingredient->cost, 2)}}@endif">
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
        @endforeach

        @elseif($type == 'hotel')

            @foreach($order->hotelOrderIngredients as $item)
                <tr>

                    <td scope="row">
                        <input type="hidden" value="{{$item->ingredient->id}}" name="items[]">
                        <input type="text" value="{{$item->ingredient->name}}" raedonly class="form-control">
                    </td>
                    <td>
                        <input  type="number" step="0" name="selling_price[]" class="prices form-control" value="@if($item->ingredient->price){{$item->ingredient->price}}@else{{round(0)}}@endif">
                    </td>
                    <td>
                        <input  type="number" class="stock form-control" value="{{$item->ingredient->stock}}" readonly>
                    </td>
                    <td>
                        <input  type="number" step="0" name="order_qty[]" onchange='changeOrderdQty(this)' class="orderQty form-control" min="1"  value="{{$item->quantity }}">
                    </td>
                    <td>
                        <input  type="number" step="0" name="cost[]" onchange='changeCost(this)' class="cost form-control" min="1"  value="@if($item->ingredient->final_cost){{round($item->ingredient->final_cost, 2)}}@else{{round($item->ingredient->cost, 2)}}@endif">
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
            @endforeach
        @elseif($type == 'laundry')

            @foreach($order->inventoryOrderIngredients as $item)
                <tr>

                    <td scope="row">
                        <input type="hidden" value="{{$item->ingredient->id}}" name="items[]">
                        <input type="text" value="{{$item->ingredient->name}}" raedonly class="form-control">
                    </td>
                    <td>
                        <input  type="number" step="0" name="selling_price[]" class="prices form-control" value="@if($item->ingredient->price){{$item->ingredient->price}}@else{{round(0)}}@endif">
                    </td>
                    <td>
                        <input  type="number" class="stock form-control" value="{{$item->ingredient->stock}}" readonly>
                    </td>
                    <td>
                        <input  type="number" step="0" name="order_qty[]" onchange='changeOrderdQty(this)' class="orderQty form-control" min="1"  value="{{$item->quantity }}">
                    </td>
                    <td>
                        <input  type="number" step="0" name="cost[]" onchange='changeCost(this)' class="cost form-control" min="1"  value="@if($item->ingredient->final_cost){{round($item->ingredient->final_cost, 2)}}@else{{round($item->ingredient->cost, 2)}}@endif">
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
            @endforeach

        @elseif($type == 'prepration')

            @foreach($order->AreaOrderIngredients as $item)
                <tr>

                    <td scope="row">
                        <input type="hidden" value="{{$item->ingredient->id}}" name="items[]">
                        <input type="text" value="{{$item->ingredient->name}}" raedonly class="form-control">
                    </td>
                    <td>
                        <input  type="number" step="0" name="selling_price[]" class="prices form-control" value="@if($item->ingredient->price){{$item->ingredient->price}}@else{{round(0)}}@endif">
                    </td>
                    <td>
                        <input  type="number" class="stock form-control" value="{{$item->ingredient->stock}}" readonly>
                    </td>
                    <td>
                        <input  type="number" step="0" name="order_qty[]" onchange='changeOrderdQty(this)' class="orderQty form-control" min="1"  value="{{ $item->quantity}}">
                    </td>
                    <td>
                        <input  type="number" step="0" name="cost[]" onchange='changeCost(this)' class="cost form-control" min="1"  value="@if($item->ingredient->final_cost){{round($item->ingredient->final_cost, 2)}}@else{{round($item->ingredient->cost, 2)}}@endif">
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
            @endforeach

            @endif
        @endif
    </tbody>
</table>
