<table class="table table-condensed">
    <thead>
    <tr>
        <th> التعريف</th>
        <th>اسم المدرب</th>
        <th>اسم التدريب</th>
        <th> عدد جلسات الحضور</th>
        <th>اسم الاشتراك</th>
        <th>مجموع الربح</th>
    </tr>
    </thead>
    <tbody>
    @if(isset($records))
        @foreach($records as $key => $record)
            @if($key == 0)
                @continue($record)
            @else
                <tr>
                    <td>{{$record->Training->FreelanceTrainer->id}}</td>
                    <td>{{$record->Training->FreelanceTrainer->name}}</td>
                    <td>{{$record->Training->name}}</td>
                    <td>{{$record->TrainerAttendances()->count()}}</td>
                    <td>
                        <ul>
                            @foreach($record->Training->Pricings as $pricing)
                                <li>{{$pricing->pricing_name}}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <ul>
                            @foreach($record->PricingProfit() as $total_of_profit)
                                <li>{{round($total_of_profit)}}</li>
                            @endforeach
                        </ul>
                    </td>



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
    </tbody>
</table>
