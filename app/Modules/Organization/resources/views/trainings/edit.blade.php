<x-organization::layout>
    <x-slot name="pageTitle">التدريبات | تعديل</x-slot name="pageTitle">
    @section('trainings-active', 'm-menu__item--active m-menu__item--open')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />
    <x-slot name="style">
        <!-- Some styles -->
        <style>
            .invalid-feedback {
                display: block;
            }
            .prices-wrapper.hide-duration #duration_in_days{
                display: none;
            }

        </style>
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    التدريبات
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
                        <form method="POST" action="{{route('organizations.training.update', $record->id)}}"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                            @csrf
                            @method('put')
                            <div class="m-portlet__body">
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>اسم التدريب :</label>
                                        <input
                                            type="text"
                                            value="{{old('name')?old('name'):$record->name}}"
                                            name="name"
                                            required=""
                                            class="form-control m-input"
                                            placeholder="ادخل اسم التدريب..." />
                                        </td>
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>رياضه النادي:</label>

                                        <select name="club_sport_id" required="" id="club_sport_id"
                                                class="form-control m-input m-input--square selectpicker"
                                        >
                                            @foreach($clubSports as $clubSport)
                                                <option @if(old('club_sport_id')== $clubSport->id || $clubSport->id==$record->club_sport_id) selected @endif
                                                value="{{ $clubSport->id }}">{{ $clubSport->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('club_sport_id')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>

                                    <div id="appendTrainers" class="col-lg-6">
                                        @include('Organization::trainings.components.append_trainers')
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-6">
                                        <label>مساحه الانشطه الارياضيه:</label>
                                        <select name="activity_area_id" id="activity_area_id" required=""
                                                class="form-control m-input m-input--square selectpicker"
                                                id="exampleSelect1">
                                            @foreach($activityAreas as $activityArea)
                                                <option @if(old('activity_area_id')== $activityArea->id || $activityArea->id==$record->activity_area_id) selected @endif
                                                value="{{ $activityArea->id }}">{{ $activityArea->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('activity_area_id')
                                        <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-6">
                                        <label>النوع:</label>
                                        <select  id="audience_type" name="type" required="" class="form-control m-input m-input--square selectpicker" >

                                            <option @if(old('type')== 'مواعيد ثابتة بالجلسات' || $record->type=='مواعيد ثابتة بالجلسات') selected @endif
                                            value="مواعيد ثابتة بالجلسات">مواعيد ثابتة بالجلسات
                                            </option>
                                            <option @if(old('type')== 'بعدد الجلسات' || $record->type=='بعدد الجلسات') selected @endif
                                            value="بعدد الجلسات">بعدد الجلسات
                                            </option>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-group m-form__group row">
                                    <div class="col-lg-12">
                                        <label class="">الجداول:</label><br>
                                        <table  width="100%" class="table table-striped- table-bordered table-hover table-checkable" id="ingredients-table">
                                            <col style="width:30%">
                                            <col style="width:30%">
                                            <col style="width:30%">
                                            <col style="width:10%">
                                            <thead>
                                            <tr>
                                                <th style="font-weight: bold;">اليوم</th>
                                                <th style="font-weight: bold;">وقت البدء</th>
                                                <th style="font-weight: bold;">وقت النهاية</th>
                                                <th style="font-weight: bold;">مسح</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($record->Schedules as $value)
                                                <tr>
                                                    <td>
                                                        <select name="day[]" required="" class="form-control m-input m-input--square" >

                                                            <option @if(old('day')== 'Saturday' || $value->day=='Saturday') selected @endif
                                                            value="Saturday">Saturday
                                                            </option>
                                                            <option @if(old('day')== 'Sunday' || $value->day=='Sunday') selected @endif
                                                            value="Sunday">Sunday
                                                            </option>
                                                            <option @if(old('day')== 'Monday' || $value->day=='Monday') selected @endif
                                                            value="Monday">Monday
                                                            </option>
                                                            <option @if(old('day')== 'Tuesday' || $value->day=='Tuesday') selected @endif
                                                            value="Tuesday">Tuesday
                                                            </option>
                                                            <option @if(old('day')== 'Wednesday' || $value->day=='Wednesday') selected @endif
                                                            value="Wednesday">Wednesday
                                                            </option>
                                                            <option @if(old('day')== 'Thursday' || $value->day=='Thursday') selected @endif
                                                            value="Thursday">Thursday
                                                            </option>
                                                            <option @if(old('day')== 'Friday' || $value->day=='Friday') selected @endif
                                                            value="Friday">Friday
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="time" name="start_time[]" id="start_time[]" value="{{ old('start_time')?old('start_time'):$value->start_time }}" required>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="time" name="end_time[]" id="end_time[]" value="{{ old('end_time')?old('end_time'):$value->end_time }}" required>
                                                    </td>

                                                    <td>
                                                        <a
                                                            title="Remove the row"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="DeleteVendorRowTable(this)">
                                                            <i class="fa fa-times" style="color: #fff"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button type="button" class="btn btn-default " id="new_row"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group m-form__group row">
                                    <div class="col-lg-12 prices-wrapper">
                                        <label class="">التسعير:</label><br>
                                        <table  width="100%" class="table table-striped- table-bordered table-hover table-checkable" id="pricing-table">
                                            <col style="width:30%">
                                            <col style="width:20%">
                                            <col style="width:20%">
                                            <col style="width:20%">
                                            <col style="width:10%">
                                            <thead>
                                            <tr>
                                                <th style="font-weight: bold;">انواع المشتركين</th>
                                                <th style="font-weight: bold;">اسم الاشتراك</th>
                                                <th style="font-weight: bold;">عدد الجلسات</th>
                                                <th style="font-weight: bold;">المدة بالأيام</th>
                                                <th style="font-weight: bold;">السعر</th>
                                                <th style="font-weight: bold;">مسح</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($record->Pricings as $key => $value)
                                                <tr>
                                                    <td>
                                                        <select name="subscriber_type_id[]" id="subscriber_type_id[]" required=""
                                                                class="form-control m-input m-input--square"
                                                                id="exampleSelect1">
                                                            @foreach($subscriberTypes as $subscriberType)
                                                                <option @if(old('subscriber_type_id')== $subscriberType->id || $subscriberType->id==$value->subscriber_type_id) selected @endif
                                                                value="{{ $subscriberType->id }}">{{ $subscriberType->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input
                                                            type="text"
                                                            value="{{old('pricing_name')?old('pricing_name'):$value->pricing_name}}"
                                                            name="pricing_name[]"
                                                            required=""
                                                            class="form-control m-input"
                                                            placeholder="ادخل الاسم..." />                                              </td>
                                                    <td>
                                                        <input type="number" required="" value="{{old('num_of_sessions')?old('num_of_sessions'):$value->num_of_sessions}}" class="form-control m-input" name="num_of_sessions[]" placeholder="ادخل عدد الجلسات...">
                                                    </td>
                                                    @if($record->type =='بعدد الجلسات')
                                                        <td>
                                                            <input id="duration_in_days" style="display: none" type="text" value="{{old('duration_in_days')?old('duration_in_days'):$value->duration_in_days}}"  class="form-control m-input" name="duration_in_days[]" placeholder="ادخل المده بالايام...">
                                                        </td>
                                                    @else
                                                        <td>
                                                            <input id="duration_in_days"  type="number" value="{{old('duration_in_days')?old('duration_in_days'):$value->duration_in_days}}"  class="form-control m-input" name="duration_in_days[]" placeholder="ادخل المده بالايام...">
                                                        </td>
                                                    @endif

                                                    <td>
                                                        <input type="number" value="{{old('price')?old('price'):$value->price}}" step="0.01" name="price[]" required="" class="form-control m-input">
                                                    </td>
                                                    <td>
                                                        <a
                                                            title="Remove the row"
                                                            class="btn btn-sm btn-danger"
                                                            onclick="DeletePricingRowTable(this)">
                                                            <i class="fa fa-times" style="color: #fff"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button type="button" class="btn btn-default " id="new_pricing_row"><i class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.1/moment.min.js" integrity="sha512-Dz4zO7p6MrF+VcOD6PUbA08hK1rv0hDv/wGuxSUjImaUYxRyK2gLC6eQWVqyDN9IM1X/kUA8zkykJS/gEVOd3w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <x-slot name="scripts">
        <script>
            function DeleteVendorRowTable(i)
            {
                if($('#ingredients-table tbody tr').length == 1)
                {
                    toastr.error('You can not delete all the schedules.');
                    return;
                }
                var p=i.parentNode.parentNode;
                p.parentNode.removeChild(p);
            }
            $(document).on('click','#new_row',function(){

                $.ajax({
                    url: "<?php echo e(route('organizations.training.get.schedule.row')); ?>",
                    success: function (data) {
                        $('#ingredients-table > tbody:last-child').append(data['data']['responseHTML']);
                        $(".vendor-id").selectpicker();
                    },

                });
            });

        </script>
        <script>
            function DeletePricingRowTable(i)
            {
                if($('#pricing-table tbody tr').length == 1)
                {
                    toastr.error('You can not delete all the pricings.');
                    return;
                }
                var p=i.parentNode.parentNode;
                p.parentNode.removeChild(p);
            }
            $(document).on('click','#new_pricing_row',function(){


                $.ajax({
                    url: "<?php echo e(route('organizations.training.get.pricing.row')); ?>",
                    success: function (data) {
                        $('#pricing-table > tbody:last-child').append(data['data']['responseHTML']);

                        $(".vendor-id").selectpicker();
                    },

                });
            });

        </script>
        <script>
            $('#club_sport_id').change(function(){
                var club_sport_id = $(this).val();
                var freelance_trainer_id =$(this).data('trainer');
                $.ajax({
                    type:'get',
                    url:"{{route('organizations.training.append.trainers')}}",
                    data:{
                        "_token": "{{ csrf_token() }}",
                        club_sport_id:club_sport_id,
                        freelance_trainer_id:freelance_trainer_id},
                    success:function(resp){
                        $("#appendTrainers").html(resp).hide().fadeIn('slow');
                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>
        <script>
            $("#audience_type").on('change',function (){
                if ( this.value == 'مواعيد ثابتة بالجلسات') {

                    $('#duration_in_days').css("display", "block");
                    $('.prices-wrapper').removeClass("hide-duration");

                }else {
                    $('#duration_in_days').css("display", "none");
                    $('.prices-wrapper').addClass("hide-duration");
                }
            });
        </script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    </x-slot>
</x-organization::layout>

