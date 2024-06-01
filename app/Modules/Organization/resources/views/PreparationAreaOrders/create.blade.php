<x-organization::layout>
 <x-slot name="pageTitle">طلبات منطقه التحضير  | اضف</x-slot name="pageTitle">
 @section('preparationAreaOrders-active', 'm-menu__item--active m-menu__item--open')
 @section('preparationAreaOrders-create-active', 'm-menu__item--active')
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
                طلبات منطقه التحضير
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
                  <form method="POST" action="{{route('organizations.preparationAreaOrder.store')}}" enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <select name="area" id="area" required=""
                                          class="form-control m-input m-input--square" id="exampleSelect1">
                                      <option value="" disabled selected>اختر منطقة تحضير</option>
                                      @foreach($areas as $area)
                                          <option @if(old('area')== $area->id) selected @endif
                                          value="{{ $area->id }}">{{ $area->name }}
                                          </option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="col-lg-6"></div>
                          </div>
                          @include('Organization::PreparationAreaOrders.components.ingredient.table')
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
                if($('#ingredients-table tbody tr').length == 1)
                {
                    toastr.error('You can not delete all the Items.');
                    return;
                }
                var p=i.parentNode.parentNode;
                p.parentNode.removeChild(p);

            }

            $(document).on('click','#new_service_row',function(){
                $.ajax({
                    url: "{{route('organizations.preparationAreaOrder.get.service.row')}}",
                    success: function (data) {
                        $('#ingredients-table  tbody:last-child').append(data['data']['responseHTML']);
                        $(".vendor-id").selectpicker();
                    },

                });
            });

        </script>
    </x-slot>
</x-organization::layout>
