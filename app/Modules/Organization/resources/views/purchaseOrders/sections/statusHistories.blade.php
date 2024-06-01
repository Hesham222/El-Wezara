<table class="table" id="items-table">
    <thead class="thead-dark">
    <tr>
        <th scope="col">الحالة</th>
        <th scope="col">التاريخ</th>
        <th scope="col">التوقيت</th>
        <th scope="col">الشخص المسئول</th>
    </tr>
    </thead>
    <tbody>
    @foreach($po->StatusHistoies as $status)
        <tr>
            @if($status->status)
                <td scope="row">
                    <span style="font-weight: bold;border: 2px solid #fff;color: {{$status->status->color}}">{{$status->status->name}}</span>
                </td>
            @else
                <td>--</td>
            @endif
            <td>{{ $status->created_at->format('d-M-Y') }}</td>
            <td>{{ date('h:i A', strtotime($status->created_at)) }}</td>
            @if($status->account_admin)
                <td>
                    <span>{{$status->account_admin->name  }}</span>
                </td>
            @else
                <td>--</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
