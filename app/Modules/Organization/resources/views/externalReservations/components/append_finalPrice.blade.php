@if(isset($record['total']))
    <div>
        <label>اجمالي السعر </label>
        <input type="number" step="0.01" value="{{$record['total']}}" readonly="readonly" required="" class="form-control m-input" name="total" id="total" placeholder="اجمالي السعر...">
    </div>
@endif
@if(isset($total))
        <label>اجمالي السعر </label>
        <input type="number" step="0.01" value="{{$total}}" readonly="readonly" required="" class="form-control m-input" name="total" id="total" placeholder="اجمالي السعر...">
@endif
