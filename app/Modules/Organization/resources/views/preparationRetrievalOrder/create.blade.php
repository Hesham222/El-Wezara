<x-organization::layout>
    <x-slot name="pageTitle">مناطق التحضير | ارجاع</x-slot name="pageTitle">
    @section('preparationAreas-active', 'm-menu__item--active m-menu__item--open')

    <x-slot name="style">
        <!-- Some styles -->
        <style>
            .invalid-feedback {
                display: block;
            }
        </style>
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    مناطق التحضير
                </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div style="display: none;" class="m-alert m-alert--icon m-alert--air m-alert--square alert alert-dismissible m--margin-bottom-30" role="alert">
            <div class="m-alert__icon">
                <i class="flaticon-exclamation m--font-brand">
                </i>
            </div>
        </div>
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">
                        <h3 class="m-portlet__head-text">
                            طلب ارجاع
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">
                        <form method="POST" action="{{route('organizations.preparationArea.store.retrieval.order')}}" enctype="multipart/form-data"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            @csrf
                            <div class="m-portlet__body">

                                <input type="hidden" name="area_id" value="{{$area->id}}" />

                                @foreach($area->PreparationAreaInventories as $PreparationAreaInventory)
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-4">
                                            <label>{{$PreparationAreaInventory->ingredient->name}} :</label>
                                            <input
                                                type="hidden"
                                                value="{{$PreparationAreaInventory->ingredient_id}}"
                                                name="ingredients[]"
                                                required=""
                                                class="form-control m-input"
                                            />
                                            @error('ingredients')
                                            <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                            @enderror
                                        </div>

                                        <div class="col-lg-4">
                                            <label>الكمية ف المخزن   :</label>
                                            <input
                                                type="number"
                                                value="{{$PreparationAreaInventory->quantity}}"
                                                name="quantity_before[]"
                                                required=""
                                                readonly
                                                class="form-control m-input"
                                            />
                                            @error('quantity_before')
                                            <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                            @enderror
                                        </div>


                                        <div class="col-lg-4">
                                            <label>الكمية المراد ارجاعها  :</label>
                                            <input
                                                type="number"
                                                value="0"
                                                min="0"
                                                name="quantity_after[]"
                                                required=""
                                                class="form-control m-input"
                                            />
                                            @error('quantity_after')
                                            <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                            @enderror
                                        </div>


                                    </div>

                                @endforeach

                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label> نوع طلب الارجاع</label>
                                        <select name="type" required="" class="form-control m-input m-input--square" id="type" >

                                                <option
                                                value="general">الى المخزن الرئيسى
                                                </option>

                                            <option
                                            value="internal">الى منطقة تحضير اخرى
                                            </option>

                                        </select>
                                        @error('type')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6" id="areas" style="display: none">
                                        <label>مناطق التحضير الاخرى</label>
                                        <select name="area"  class="form-control m-input m-input--square" id="exampleSelect1" >
                                            @foreach($allAreas as $allArea)
                                                <option @if(old('area')== $allArea->id) selected @endif
                                                value="{{ $allArea->id }}">{{ $allArea->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('area')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                <div class="m-form__actions m-form__actions--solid">
                                    <div class="row">
                                        <div class="col-lg-6"></div>
                                        <div class="col-lg-6 m--align-right">
                                            <button type="submit" class="btn btn-primary">حفظ</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- end page content -->
    <x-slot name="scripts">
<script>

    $("#type").on('change',function (){

        if ($(this).val() == "internal"){
            $("#areas").show();

        }else {
            $("#areas").hide();
        }

    });
</script>
    </x-slot>
</x-organization::layout>
