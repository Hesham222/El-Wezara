
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<style>
    table, th, td {
        border: 1px solid;
    }

    div {
        width: 70px;
        height: 300px;
        border: 1px solid #c3c3c3;
        display: flex;
        flex-wrap: wrap;
        align-content: center;
    }

</style>
<body>
<div>
<table>
    <tr>
        <th>English Name</th>
        <th>Arabic Name</th>
        <th>English Description</th>
        <th>Arabic Description</th>
        <th>Unit Of Measurement</th>
        <th>Quantity</th>
        <th>Calories</th>
        <th>Cost</th>
        <th>Tags</th>
        <th>Created at</th>
    </tr>
  @foreach($ingredients as $record)
    <tr>

        <td>{{$record->getTranslation('name', 'en')}}</td>
        <td>{{$record->getTranslation('name', 'ar')}}</td>
        <td>{{$record->getTranslation('description', 'en')}}</td>
        <td>{{$record->getTranslation('description', 'ar')}}</td>
        <td>{{$record->unit_of_measurement->name}}</td>
        <td>{{$record->quantity}}</td>
        <td>{{$record->calories}}</td>
        <td>{{$record->cost}}</td>
        <td>@if(count($record->getTags()) > 0){{json_encode($record->getTags())}}@else -- @endif</td>
        <td>{{ date('M d, Y', strtotime($record->created_at)) .'-'.date('h:i a', strtotime($record->created_at)) }}</td>
    </tr>
    @endforeach
</table>
</div>
</body>
</html>
