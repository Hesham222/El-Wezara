<x-organization::layout>
     
    <x-slot name="pageTitle">   مرتجع من المخازن الفرعيه للمخزن الرئيسي    | عرض</x-slot name="pageTitle">
    @section('dailyCenters-active', 'm-menu__item--active')
    <x-slot name="style">
        <!-- Some styles -->
    </x-slot>
   
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    مرتجع من المخازن الفرعيه للمخزن الرئيس                </h3>
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
                    <form  method="GET"  action="{{route('organizations.allOutgoing.index')}}" >
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


                                {{-- <div class="input-group" style="width: 50%">
                                    <input type="text" name="value" id="searchField" class="form-control" aria-label="Text input with dropdown button">
                                    <div class="input-group-append">
                                        <select
                                            name="column"
                                            id="searchColumn"
                                            class="form-control"
                                            data-live-search="true"
                                            title="Please select a lunch ...">
                                            <option value="_id">ID</option>
                                            <option value="name">@lang('Organization::organization.name')</option>
                                            <option value="employeeVacationType">@lang('Organization::organization.employeeVacationType')</option>
                                        
                                        </select>
                                    </div>
                            </div> --}}
                           
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
                <h2>مخازن الفنادق </h2>
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

<hr>





<h2>مخازن المغاسل</h2>
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
<hr>






            <h2>مخازن نقاط البيع</h2>
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

<hr>



<h2>مخازن مناطق التحضير</h2>

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
        اجمالى التقرير : {{ $total }}
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