<x-organization::layout>
 <x-slot name="pageTitle">التذاكر | تعديل</x-slot name="pageTitle">
 @section('tickets-active', 'm-menu__item--active m-menu__item--open')
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
                 التذاكر
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
                  تعديل
                </h3>
              </div>
            </div>
          </div>
          <div class="m-portlet__body">
            <div class="table-responsive">
                <section class="content">
                  <form method="POST" action="{{route('organizations.ticket.update', $record->id)}}"
                        class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                      @csrf
                      @method('put')
                      <div class="m-portlet__body">
                          <div class="form-group m-form__group row">
                              <div class="col-lg-3">
                                  <label>فئة التذكرة الرئيسية:</label>
                                  <select name="category" required="" class="form-control m-input m-input--square" id="category-select">
                                      <option>أختر الفئة الرئيسية</option>
                                      @foreach($categories as $category)
                                          <option @if($record->details->ticket_category_id == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                      @endforeach
                                  </select>
                                  @error('category')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-3">
                                  <label>فئة التذكرة:</label>
                                  <select name="ticketPrice" required="" class="form-control m-input m-input--square" id="subCategory-select">
                                      <option selected value="{{$record->details->id}}">{{ $record->details->subCategory->name }} - {{ $record->details->price }}</option>
                                  </select>
                                  @error('ticketPrice')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                              <div class="col-lg-3">
                                  <label>البوابة:</label>
                                  <select name="gate" required="" class="form-control m-input m-input--square" id="exampleSelect1">
                                      @foreach($gates as $gate)
                                          <option @if($record->gate_id == $gate->id) selected @endif value="{{ $gate->id }}">{{ $gate->name }}</option>
                                      @endforeach
                                  </select>
                                  @error('gate')
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
                                  <div class="col-lg-6">
                                  </div>
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
          $('#category-select').on('change', function() {
              var category_id = this.value;
              $("#subCategory-select").html('');
              $.ajax({
                  url:"{{route('organizations.ticket.prices')}}",
                  type: "POST",
                  data: {
                      category_id: category_id,
                      _token: '{{csrf_token()}}'
                  },
                  dataType : 'json',
                  success: function(result){
                      $('#subCategory-select').html('<option value="">أختر الفئة</option>');
                      $.each(result,function(key,value){
                          $("#subCategory-select").append('<option value="'+value.id+'">'+value.subCategory+'.-.'+value.price+'</option>');
                      });
                  }
              });
          });
      </script>
  </x-slot>
</x-organization::layout>

