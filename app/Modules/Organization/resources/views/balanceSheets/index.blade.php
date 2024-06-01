<x-organization::layout>
    <x-slot name="pageTitle">ميزان المراجعة | عرض</x-slot name="pageTitle">
    @section('balanceSheets-active', 'm-menu__item--active m-menu__item--open')
    <x-slot name="style">
        <!-- Some styles -->
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    ميزان المراجعة
                </h3>
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

                <div>


                    <form  method="GET"  action="{{route('organizations.balanceSheet.index')}}" >
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
                            </div>
                           
                                <div class="input-group-append">
                                    <button
                                      
                                        class="btn btn-primary"
                            
                                        title="بحث"
                                        type="submit"
                                    >
                                        <i class="fa fa-search"></i>
                                    </button>
                                 
                                </div>
                            </div>
                        </div>
                    </form>

                </div>


                <div class="table-responsive">
                    <section class="content table-responsive">
                        <h5>ميزان المراجعة</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                                    <thead>
                                    <tr>
                                        <th style="font-weight: bold">الحسابات</th>
                                        <th style="font-weight: bold" colspan="2">المجاميع</th>
                                        <th style="font-weight: bold" colspan="2">الأرصدة</th>
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th>مدين</th>
                                        <th>دائن</th>
                                        <th>مدين</th>
                                        <th>دائن</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($accounts as $account)
                                            <tr>
                                                <td>{{ $account->name }}</td>
                                                <td>{{ $account->Debits->whereBetween('created_at',[\Carbon\Carbon::parse($start_date), \Carbon\Carbon::parse($end_date)])->sum('amount') }}</td>
                                                <td>{{ $account->Credits->whereBetween('created_at',[\Carbon\Carbon::parse($start_date), \Carbon\Carbon::parse($end_date)])->sum('amount') }}</td>
                                                @if($account->Debits->whereBetween('created_at',[\Carbon\Carbon::parse($start_date), \Carbon\Carbon::parse($end_date)])->sum('amount') > $account->Credits->whereBetween('created_at',[\Carbon\Carbon::parse($start_date), \Carbon\Carbon::parse($end_date)])->sum('amount'))
                                                    <td></td>
                                                    <td>{{ $account->Debits->whereBetween('created_at',[\Carbon\Carbon::parse($start_date), \Carbon\Carbon::parse($end_date)])->sum('amount') - $account->Credits->whereBetween('created_at',[\Carbon\Carbon::parse($start_date), \Carbon\Carbon::parse($end_date)])->sum('amount')}}</td>
                                                @elseif($account->Credits->whereBetween('created_at',[\Carbon\Carbon::parse($start_date), \Carbon\Carbon::parse($end_date)])->sum('amount') > $account->Debits->whereBetween('created_at',[\Carbon\Carbon::parse($start_date), \Carbon\Carbon::parse($end_date)])->sum('amount'))
                                                    <td>{{ $account->Credits->whereBetween('created_at',[\Carbon\Carbon::parse($start_date), \Carbon\Carbon::parse($end_date)])->sum('amount') - $account->Debits->whereBetween('created_at',[\Carbon\Carbon::parse($start_date), \Carbon\Carbon::parse($end_date)])->sum('amount')}}</td>
                                                    <td></td>
                                                @else
                                                    <td>0</td>
                                                    <td>0</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tbody id="data-table-body"></tbody>
                                </table>
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

