<x-organization::layout>
    <x-slot name="pageTitle">نسب ارباح المدربين | اضف</x-slot name="pageTitle">
    @section('freelance-trainers-active', 'm-menu__item--active m-menu__item--open')
    @section('freelance-trainers-create-active', 'm-menu__item--active')
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
                    نسب ارباح المدربين
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
                            نسب ارباح المدربين
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">
                        <div id="date" style="display: flex;justify-content: flex-end;align-items:flex-end;margin-bottom: 20px">
                            <div class="input-group" style="width: 40%">
                            </div>
                            <div class="input-group" style="width: 40%">
                                <label> التاريخ من </label>
                                <input class="form-control" type="date" name="date_from" id="date_from" value="{{ old('date_from') }}" required>
                            </div>
                            <div class="input-group" style="width: 40%">
                                <label> التاريخ الي </label>
                                <input class="form-control" type="date" name="date_to" id="date_to" value="{{ old('date_to') }}" required>
                            </div>
                        </div>
                        <input hidden value="{{$record_id}}" name="record_id" id="record_id">
                        <div id="appendTable">
                            @include('Organization::freelanceTrainers.components.append_table')
                        </div>

                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- end page content -->
    <x-slot name="scripts">
        <script>
            $('#date').change(function(){
                var record_id = $('#record_id').val();
                var date_to = $('#date_to').val();
                var date_from = $('#date_from').val();
                console.log(record_id)
                console.log(date_to)
                console.log(date_from)
                $.ajax({
                    type:'get',
                    url:'{{route('organizations.freelanceTrainer.append.table')}}',
                    data:{
                        "_token": "{{ csrf_token() }}",
                        record_id:record_id,
                        date_to:date_to,
                        date_from:date_from,
                    },
                    success:function(resp){
                        $("#appendTable").html(resp);

                    },error:function(){
                        alert('Error');
                    }
                });
            });
        </script>
    </x-slot>
</x-organization::layout>
