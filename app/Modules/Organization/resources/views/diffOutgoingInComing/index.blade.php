<x-organization::layout>
    <x-slot name="pageTitle">الصافى بين المنصرف والمرتجع للمخازن   | عرض</x-slot name="pageTitle">
    @section('dailyCenters-active', 'm-menu__item--active')
    <x-slot name="style">
        <!-- Some styles -->
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    الصافى بين المنصرف والمرتجع للمخازن                </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            {{request()->input('view')=='trash' ? 'سله المهملات' :  'عرض'}}
                        </h3>
                    </div>
                </div>
            </div>



          

            <div class="m-portlet__body">
                <div class="table-responsive">
                    <form  method="GET"  action="{{route('organizations.diffOutgoingInComing.index')}}" >
                        <input type="hidden" name="view" value="{{ request()->input('view',0)}}">
                        <div style="display: flex;justify-content: flex-end;align-items:flex-end;margin-bottom: 20px">
                            <div class="input-group" style="width: 50%">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">من</span>
                                    <input type="date" name="start_date" id="startDateCol" class="form-control">
                                </div>
                                @if($errors->has('start_date'))
                                    <span class="invalid-feedback" style="display:block;" role="alert">
                            <strong>{{ $errors->first('start_date') }}</strong>
                          </span>
                                @endif
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="">الى</span>
                                    <input type="date" name="end_date" id="endDateCol" class="form-control">
                                </div>
                                @if($errors->has('end_date'))
                                    <span class="invalid-feedback" style="display:block;" role="alert">
                            <strong>{{ $errors->first('end_date') }}</strong>
                          </span>
                                @endif
                            </div>
                           
                                <div class="input-group-append">
                                    <button
                                      
                                        class="btn btn-primary"
                            
                                        title="بحث"
                                        type="submit"
                                    >
                                        <i class="fa fa-search"></i>
                                    </button>
                                 
                                </div>

                                <div class="input-group-append">
                                    {{-- <a
                                      
                                        class="btn btn-primary"
                            
                                        title="تحميل"
                                       href="{{ route('organizations.diffOutgoingInComing.export') }}"
                                    >
                                        <i class="fa fa-file"></i>
                                    </a> --}}
                                 
                                </div>
                            </div>
                        </div>
                    </form>
                    <section class="content table-responsive">
                   
                        <h2>المنصرف</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                                    <thead>
                                 
                                    <tr>
                                        <th>التعريف</th>
                                        <th>المكون</th>
                                        <th>الكمية</th>
                                        <th>الثمن</th>
                                        <th>الاجمالى</th>
                                       
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($reseved_holet_orders as $reseved_holet_order)

                                            @foreach ($reseved_holet_order->hotelOrderIngredients as $hotelOrderIngredient)
                                                
                                           
                                        <tr>
                                            <td>{{ $hotelOrderIngredient->Ingredient->id }}</td>
                                            <td>{{ $hotelOrderIngredient->Ingredient->name }}</td>
                                            <td>{{ $hotelOrderIngredient->quantity }} / {{ $hotelOrderIngredient->Ingredient->unit_of_measurement->name }}</td>
                                            <td>{{ $hotelOrderIngredient->Ingredient->final_cost }}</td>
                                            <td>{{ $hotelOrderIngredient->quantity * $hotelOrderIngredient->Ingredient->final_cost }}</td>
                                         
                                        </tr>
                                        @endforeach

                                        @endforeach








                                        @foreach($reseved_inventory_orders as $reseved_inventory_order)

                                        @foreach ($reseved_inventory_order->inventoryOrderIngredients as $inventoryOrderIngredient)
                                            
                                       
                                    <tr>
                                        <td>{{ $inventoryOrderIngredient->Ingredient->id }}</td>
                                        <td>{{ $inventoryOrderIngredient->Ingredient->name }}</td>
                                        <td>{{ $inventoryOrderIngredient->quantity }} / {{ $inventoryOrderIngredient->Ingredient->unit_of_measurement->name }}</td>
                                        <td>{{ $inventoryOrderIngredient->Ingredient->final_cost }}</td>
                                        <td>{{ $inventoryOrderIngredient->quantity * $inventoryOrderIngredient->Ingredient->final_cost }}</td>
                                     
                                    </tr>
                                    @endforeach

                                    @endforeach







                                    
                                    @foreach($reseved_pos_orders as $reseved_pos_order)

                                    @foreach ($reseved_pos_order->PointOrderIngredients as $PointOrderIngredient)
                                        
                                   
                                <tr>
                                    <td>{{ $PointOrderIngredient->Ingredient->id }}</td>
                                    <td>{{ $PointOrderIngredient->Ingredient->name }}</td>
                                    <td>{{ $PointOrderIngredient->quantity }} / {{ $PointOrderIngredient->Ingredient->unit_of_measurement->name }}</td>
                                    <td>{{ $PointOrderIngredient->Ingredient->final_cost }}</td>
                                    <td>{{ $PointOrderIngredient->quantity * $PointOrderIngredient->Ingredient->final_cost }}</td>
                                 
                                </tr>
                                @endforeach

                                @endforeach






                                @foreach($reseved_prep_orders as $reseved_prep_order)

                                @foreach ($reseved_prep_order->AreaOrderIngredients as $AreaOrderIngredient)
                                    
                               
                            <tr>
                                <td>{{ $AreaOrderIngredient->Ingredient->id }}</td>
                                <td>{{ $AreaOrderIngredient->Ingredient->name }}</td>
                                <td>{{ $AreaOrderIngredient->quantity }} / {{ $AreaOrderIngredient->Ingredient->unit_of_measurement->name }}</td>
                                <td>{{ $AreaOrderIngredient->Ingredient->final_cost }}</td>
                                <td>{{ $AreaOrderIngredient->quantity * $AreaOrderIngredient->Ingredient->final_cost }}</td>
                             
                            </tr>
                            @endforeach

                            @endforeach




                                    </tbody>
                                    <tbody id="data-table-body"></tbody>
                                </table>
                            </div>
                        </div>




<hr>



<h2>المرتجع</h2>
<div class="row">
    <div class="col-md-12">
        <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
            <thead>
         
            <tr>
                <th>التعريف</th>
                <th>المكون</th>
                <th>الكمية</th>
                <th>الثمن</th>
                <th>الاجمالى</th>
               
            </tr>
            </thead>
            <tbody>
                @foreach($canceled_holet_orders as $canceled_holet_order)

                    @foreach ($canceled_holet_order->hotelOrderIngredients as $hotelOrderIngredient)
                        
                   
                <tr>
                    <td>{{ $hotelOrderIngredient->Ingredient->id }}</td>
                    <td>{{ $hotelOrderIngredient->Ingredient->name }}</td>
                    <td>{{ $hotelOrderIngredient->quantity }} / {{ $hotelOrderIngredient->Ingredient->unit_of_measurement->name }}</td>
                    <td>{{ $hotelOrderIngredient->Ingredient->final_cost }}</td>
                    <td>{{ $hotelOrderIngredient->quantity * $hotelOrderIngredient->Ingredient->final_cost }}</td>
                 
                </tr>
                @endforeach

                @endforeach








                @foreach($canceled_inventory_orders as $canceled_inventory_order)

                @foreach ($canceled_inventory_order->inventoryOrderIngredients as $inventoryOrderIngredient)
                    
               
            <tr>
                <td>{{ $inventoryOrderIngredient->Ingredient->id }}</td>
                <td>{{ $inventoryOrderIngredient->Ingredient->name }}</td>
                <td>{{ $inventoryOrderIngredient->quantity }} / {{ $inventoryOrderIngredient->Ingredient->unit_of_measurement->name }}</td>
                <td>{{ $inventoryOrderIngredient->Ingredient->final_cost }}</td>
                <td>{{ $inventoryOrderIngredient->quantity * $inventoryOrderIngredient->Ingredient->final_cost }}</td>
             
            </tr>
            @endforeach

            @endforeach







            
            @foreach($canceled_pos_orders as $canceled_pos_order)

            @foreach ($canceled_pos_order->PointOrderIngredients as $PointOrderIngredient)
                
           
        <tr>
            <td>{{ $PointOrderIngredient->Ingredient->id }}</td>
            <td>{{ $PointOrderIngredient->Ingredient->name }}</td>
            <td>{{ $PointOrderIngredient->quantity }} / {{ $PointOrderIngredient->Ingredient->unit_of_measurement->name }}</td>
            <td>{{ $PointOrderIngredient->Ingredient->final_cost }}</td>
            <td>{{ $PointOrderIngredient->quantity * $PointOrderIngredient->Ingredient->final_cost }}</td>
         
        </tr>
        @endforeach

        @endforeach






        @foreach($canceled_prep_orders as $canceled_prep_order)

        @foreach ($canceled_prep_order->AreaOrderIngredients as $AreaOrderIngredient)
            
       
    <tr>
        <td>{{ $AreaOrderIngredient->Ingredient->id }}</td>
        <td>{{ $AreaOrderIngredient->Ingredient->name }}</td>
        <td>{{ $AreaOrderIngredient->quantity }} / {{ $AreaOrderIngredient->Ingredient->unit_of_measurement->name }}</td>
        <td>{{ $AreaOrderIngredient->Ingredient->final_cost }}</td>
        <td>{{ $AreaOrderIngredient->quantity * $AreaOrderIngredient->Ingredient->final_cost }}</td>
     
    </tr>
    @endforeach

    @endforeach




            </tbody>
            <tbody id="data-table-body"></tbody>
        </table>
    </div>
</div>




                    </section>
                </div>
            </div>
        </div>
    </div>
    <x-slot name="scripts">
    </x-slot>
</x-organization::layout>