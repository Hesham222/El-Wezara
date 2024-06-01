<x-organization::layout>
 <x-slot name="pageTitle">طلبات الفنادق | اضف</x-slot name="pageTitle">
 @section('hotelOrders-active', 'm-menu__item--active m-menu__item--open')
 @section('hotelOrders-create-active', 'm-menu__item--active')
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
                طلبات الفنادق
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
                  اضف
                </h3>
              </div>
            </div>
          </div>
          <div class="m-portlet__body">
            <div class="table-responsive">
                <section class="content">
                  <form method="POST" action="{{route('organizations.hotelOrder.store')}}" enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <select name="hotel" id="hotel" required=""
                                          class="form-control m-input m-input--square" id="exampleSelect1">
                                      <option value="" disabled selected>Please select a Hotel</option>
                                      @foreach($hotels as $hotel)
                                          <option @if(old('hotel')== $hotel->id) selected @endif
                                          value="{{ $hotel->id }}">{{ $hotel->name }}
                                          </option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="col-lg-6"></div>
                          </div>
                          @include('Organization::hotelOrders.components.ingredient.table')
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
        {{--ingredient Script--}}
        <script>
            function DeleteServiceRowTable(i)
            {
                var p=i.parentNode.parentNode;
                p.parentNode.removeChild(p);

            }

            $(document).on('click','#new_service_row',function(){
                $.ajax({
                    url: "{{route('organizations.hotelOrder.get.service.row')}}",
                    success: function (data) {
                        $('#ingredients-table  tbody:last-child').append(data['data']['responseHTML']);
                        $(".vendor-id").selectpicker();
                    },

                });
            });

        </script>
    </x-slot>
</x-organization::layout>
