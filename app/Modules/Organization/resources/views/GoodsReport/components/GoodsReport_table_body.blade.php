@if(count($records))
@foreach($records as $record)
    @if(count($record->ingredients) > 0)
        <h2>{{$record->name}}</h2>
        @foreach($record->ingredients as $ingredient)
            <tr id="tableRecord-{{$ingredient->id}}">
                <td>{{$ingredient->id}}</td>
                <td>{{$ingredient->name?$ingredient->name:"لا يوجد"}}</td>
                <td>{{$ingredient->re_order_quantity?$ingredient->re_order_quantity:"لا يوجد"}}</td>
                <td>{{$ingredient->final_cost?$ingredient->final_cost:"لا يوجد"}}</td>
                <td>{{$ingredient->final_cost * $ingredient->re_order_quantity}}</td>

                <td>{{date('d M Y', strtotime($ingredient->created_at)) ." - ". date('h:i a', strtotime($ingredient->created_at))}}</td>
            </tr>
        @endforeach
    @endif
@endforeach
@foreach($records as $record)
    @if(count($record->ingredients) <= 0)
        <h2>{{$record->name}}</h2>
        <tr>
           <td>{{"لا يوجد مكونات وجبات"}}</td>
        </tr>
    @endif
@endforeach

@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
