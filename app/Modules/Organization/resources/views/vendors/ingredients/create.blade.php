<x-organization::layout>
    <x-slot name="pageTitle">أضف مكونات وجبات</x-slot name="pageTitle">
    @section('vendor-active', 'm-menu__item--active m-menu__item--open')
    @section('vendor-create-active', 'm-menu__item--active')
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
                    أضف مكون وجبات الي المورد  - {{$record->name }}
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
                            @lang('Organization::organization.create')
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">
                        <form method="POST" action="{{route('organizations.vendor.store.ingredient')}}"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" enctype="multipart/form-data">
                            @csrf
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <input hidden name="vendor_id" value="{{$record->id}}">
                                    <div class="col-lg-6">
                                        <label>مكونات الوجبات:</label>
                                        <select name="ingredient_id" required=""
                                                class="form-control m-input m-input--square"
                                                id="ingredient_id">
                                            <option value="">--اختر مكون وجبات--</option>
                                            @foreach($ingredients as $ingredient)
                                                <option @if(old('ingredient_id')== $ingredient->id) selected @endif
                                                value="{{ $ingredient->id }}">{{ $ingredient->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('ingredient_id')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label> السعر:</label>
                                        <input
                                            type="number"
                                            step="0.01"
                                            value="{{old('price')}}"
                                            name="price"
                                            required=""
                                            class="form-control m-input"
                                            placeholder="السعر..." />
                                        @error('price')
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
                                            <button type="submit" class="btn btn-primary">@lang('Organization::organization.save')</button>
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
        <!-- Some JS -->
        <script>

        </script>
    </x-slot>

</x-organization::layout>
