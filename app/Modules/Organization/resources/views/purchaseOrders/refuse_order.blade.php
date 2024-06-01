<x-organization::layout>
    <x-slot name="pageTitle">  رفض اذن الصرف</x-slot name="pageTitle">
    @section('inventory-active', 'm-menu__item--active m-menu__item--open')
    <x-slot name="style">
        <!-- Some styles -->

        <style type="text/css">
            .swal2-confirm {
                background: #3085d6 !important;
                border: #3085d6 !important;
            }

            .swal2-cancel {
                background: #f12143 !important;
                color: #fff !important;
            }
        </style>
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">

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

            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">

                        <form method="POST" action="{{route('organizations.po.store.refuse.order')}}" enctype="multipart/form-data"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      <input type="hidden" name="order_id" value="{{  $order->id }}" />
                      <input type="hidden" name="type" value="{{  $type }}" />
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-6">
                                  <label> سبب الرفض :</label>
                                  <textarea
                                    name="reason"
                                    required=""
                                    class="form-control m-input"
                                     ></textarea>
                                  @error('reason')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                             
                          </div>
                       
                          <div class="form-group m-form__group row">
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
        <script type="text/javascript">
            $(document).ready(function () {
                //call datatabel

                $('#POs-table').dataTable({
                    "order": [[ 0, "desc" ]]
                });
                $('#POs-table').on('click', 'tbody tr', function(e) {
                    window.location=$(this).data('route')
                })

            });


        </script>

    </x-slot>
</x-organization::layout>
