@if(count($records))

@foreach($records as $record)

     <tr id="tableRecord-{{$record->id}}">
         <td>{{$record->Training->ClubSport?$record->Training->ClubSport->id:"لا يوجد"}}</td>
         <td>{{$record->Training->ClubSport?$record->Training->ClubSport->name:"لا يوجد"}}</td>
         <td>{{$record->Training->Subscriptions?$record->Training->Subscriptions->sum('price'):"لا يوجد"}}</td>

         <td>
            <a
                href="{{route('organizations.revenueSport.show',$record->Training->ClubSport->id)}}"
                title="Revenue Details"
                style="margin:5px"
                class="btn btn-sm btn-primary">
                <i class="fa fa-money-check" style="color: #fff"></i>
            </a>
        </td>
         <td>
             <a
                 href="{{route('organizations.revenueSport.clubSport',$record->Training->ClubSport->id)}}"
                 title="Training Details"
                 style="margin:5px"
                 class="btn btn-sm btn-primary">

                 <i class="fa fa-eye" style="color: #fff"></i>
             </a>
         </td>
         <td>
             <a
                 href="{{route('organizations.revenueSport.training',$record->Training->id)}}"
                 title="Subscription Details"
                 style="margin:5px"
                 class="btn btn-sm btn-primary">
                 <i class="fa fa-eye" style="color: #fff"></i>
             </a>
         </td>
     </tr>

@endforeach
@else
<tr>
    <td colspan="8" style="text-align:center;">
        لا توجد سجلات تطابق المدخلات الخاصة بك.
    </td>
</tr>
@endif
