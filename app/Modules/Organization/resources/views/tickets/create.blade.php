<x-organization::layout>
    <x-slot name="pageTitle">التذاكر | اضف</x-slot name="pageTitle">
    @section('tickets-active', 'm-menu__item--active m-menu__item--open')
    @section('tickets-create-active', 'm-menu__item--active')
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
                            اضف
                        </h3>
                    </div>
                </div>
            </div>
            <div class="m-portlet__body">
                <div class="table-responsive">
                    <section class="content">
                        @if(is_null($startShift))
                            <form method="POST" action="{{route('organizations.ticket.start-shift')}}"
                                  class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                                @csrf
                                <h3>{{ $gate->name }}</h3>
                                <input type="hidden" name="gate" value="{{ $gate->id }}">
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group row">
                                        <div class="col-lg-3">
                                            <label>رصيد الخزنة:</label>
                                            <input
                                                type="text"
                                                value="{{old('startBalance')}}"
                                                name="startBalance"
                                                required=""
                                                class="form-control m-input"
                                                placeholder="رصيد الخزنة..." />
                                            @error('startBalance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                        <div class="col-lg-3">
                                            <button type="submit" class="btn btn-primary">بداية الشيفت</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @else
                            @if($startShift != "gate")
                                <form method="POST" action="{{route('organizations.ticket.end-shift')}}" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                                    @csrf
                                    <input type="hidden" name="shift" value="{{ $startShift->id }}">
                                    <div class="m-portlet__body">
                                        <div class="form-group m-form__group row">
                                            <div class="col-lg-3">
                                                <label>رصيد الخزنة:</label>
                                                <input
                                                    type="text"
                                                    value="{{old('endBalance')}}"
                                                    name="endBalance"
                                                    required=""
                                                    class="form-control m-input"
                                                    placeholder="رصيد الخزنة..." />
                                                @error('endBalance')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                            <div class="col-lg-3">
                                                <button type="submit" class="btn btn-primary">انهاء الشيفت</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            @endif
                            <form method="POST" action="{{route('organizations.ticket.store')}}"
                                  id="ticketForm"
                                  class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                                @csrf
                                <div class="m-portlet__body">
                                    <div class="form-group m-form__group row">
                                        {{--<div class="col-lg-3">
                                            <label>فئة التذكرة الرئيسية:</label>
                                            <select name="category" required="" class="form-control m-input m-input--square" id="category-select">
                                                <option selected>أختر الفئة الرئيسية</option>
                                                @foreach($categories as $category)
                                                    <option @if(old('category') == $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
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

                                            </select>
                                            @error('ticketPrice')
                                            <span class="invalid-feedback" role="alert">
                                              <strong>{{ $message }}</strong>
                                          </span>
                                            @enderror
                                        </div>--}}
                                        <div class="col-lg-6">
                                            <label>البوابة:</label>
                                            @if(isset($gates))
                                                <select name="gate" required="" class="form-control m-input m-input--square" id="exampleSelect1">
                                                    @foreach($gates as $gate)
                                                        <option @if(old('gate') == $gate->id) selected @endif value="{{ $gate->id }}">{{ $gate->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('gate')
                                                <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                                @enderror
                                            @else
                                                <h3>{{ $gate->name }}</h3>
                                                <input type="hidden" name="gate" value="{{ $gate->id }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-form__group row">
                                        @foreach($ticketPrices as $ticketPrice)
                                            <div class="col-lg-4">
                                                <button type="submit" name="ticketPrice" onclick="confirmAction()" class="btn btn-primary btn-lg" value="{{$ticketPrice->id}}">{{$ticketPrice->category->name}} {{$ticketPrice->subCategory->name}} - {{$ticketPrice->price}}</button>
                                                @error('ticketPrice')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        @endforeach
                                        @foreach($reservationTickets as $reservationTicket)
                                            <div class="col-lg-4">
                                                <button type="submit" name="reservation" onclick="confirmAction()" class="btn btn-primary btn-lg" value="{{$reservationTicket->id}}">{{$reservationTicket->customer->name}} - ({{ $reservationTicket->remaining_tickets }}تذكرة )</button>
                                                @error('reservation')
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <input type="hidden" name="owner" value="{{ auth('organization_admin')->user()->id }}">
                                {{--<div class="m-portlet__foot m-portlet__no-border m-portlet__foot--fit">
                                    <div class="m-form__actions m-form__actions--solid">
                                        <div class="row">
                                            <div class="col-lg-6"></div>
                                            <div class="col-lg-6 m--align-right">
                                                <button type="submit" class="btn btn-primary" value="ddddd">حفظ</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>--}}
                            </form>
                        @endif
                    </section>
                </div>
            </div>
        </div>
    </div>
    <input name="ticket_id" id="ticket_id" type="hidden" value="{{ request()->query('ticket_id',0) }}" />

    <!-- end page content -->
    <x-slot name="scripts">
        <script>


            function confirmAction() {

                // confirm("هل انت متأكد من طبع التذكرة");
                if (confirm("هل انت متأكد من طبع التذكرة")){
                    console.log('fffff');
                    var ticket =  $("#ticket_id").val();
                    if(ticket != 0){
                        var url = '{{ route("organizations.ticket.print_ticket", ":id") }}';
                        url = url.replace(':id', ticket);
                        // alert(url);
                        //  window.open(url, "_blank");

                        window.location.replace(url);

                    }
                }else
                {
                    console.log('dddddd');
                    $("#ticketForm").submit(function(e){
                        e.preventDefault();
                    });

                }
            }



        </script>
    </x-slot>
</x-organization::layout>
