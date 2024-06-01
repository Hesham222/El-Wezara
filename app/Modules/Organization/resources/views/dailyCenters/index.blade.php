<x-organization::layout>
    <x-slot name="pageTitle">اليومية المركزية | عرض</x-slot name="pageTitle">
    @section('dailyCenters-active', 'm-menu__item--active m-menu__item--open')
    <x-slot name="style">
        <!-- Some styles -->
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    اليومية المركزية
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
                <div class="table-responsive">
                    <form  method="GET"  action="{{route('organizations.dailyCenter.index')}}" >
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
                    <section class="content table-responsive">
                        <h5>اليومية المركزية</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                                    <thead>
                                    <tr>
                                        <th style="font-weight: bold">رقم القيد</th>
                                        <th style="font-weight: bold">الشرح</th>
                                        <th style="font-weight: bold" colspan="2">القيد</th>
                                        <th style="font-weight: bold" colspan="2">المبلغ</th>
                                        @foreach($accounts as $account)
                                            <th style="font-weight: bold" colspan="2">{{ $account->name }}</th>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        <th></th>
                                        <th></th>
                                        <th>مدين</th>
                                        <th>دائن</th>
                                        <th>مدين</th>
                                        <th>دائن</th>
                                        @for($i = 1; $i <= count($accounts); $i++)
                                            <th>مدين</th>
                                            <th>دائن</th>
                                        @endfor
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($dailyAccounts as $daily)
                                        <tr>
                                            <td>{{ $daily->id }}</td>
                                            <td>{{ $daily->JournalEntry->description }}</td>
                                            <td>
                                                @foreach($daily->JournalEntry->Debits as $debits)
                                                    {{ ($debits->Account) ? $debits->Account->name : $debits->SubAccount->Account->name }}<br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($daily->JournalEntry->Credits as $credits)
                                                    {{ ($credits->Account) ? $credits->Account->name : $credits->SubAccount->Account->name }}<br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($daily->JournalEntry->Debits as $debits)
                                                    {{ $debits->amount }}<br>
                                                @endforeach
                                            </td>
                                            <td>
                                                @foreach($daily->JournalEntry->Credits as $credits)
                                                    {{ $credits->amount }}<br>
                                                @endforeach
                                            </td>
                                            @foreach($accounts as $account)
                                                @if(count($account->SubAccounts) > 0 )
                                                    @php
                                                        $totalDebit = 0;
                                                        $totalCredit = 0;
                                                        foreach ($account->SubAccounts as $sub)
                                                        {
                                                            $totalDebit = $totalDebit + $sub->Debits->where('journal_entry_id',$daily->JournalEntry->id)->whereBetween('created_at',[\Carbon\Carbon::parse($start_date), \Carbon\Carbon::parse($end_date)])->sum('amount');
                                                            $totalCredit = $totalCredit + $sub->Credits->where('journal_entry_id',$daily->JournalEntry->id)->whereBetween('created_at',[\Carbon\Carbon::parse($start_date), \Carbon\Carbon::parse($end_date)])->sum('amount');
                                                        }
                                                    @endphp
                                                    <td>{{ $totalDebit }}</td>
                                                    <td>{{ $totalCredit }}</td>
                                                @else
                                                    <td>{{ $account->Debits->where('journal_entry_id',$daily->JournalEntry->id)->whereBetween('created_at',[\Carbon\Carbon::parse($start_date), \Carbon\Carbon::parse($end_date)])->sum('amount') }}</td>
                                                    <td>{{ $account->Credits->where('journal_entry_id',$daily->JournalEntry->id)->whereBetween('created_at',[\Carbon\Carbon::parse($start_date), \Carbon\Carbon::parse($end_date)])->sum('amount') }}</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    @if(count($dailyAccounts) > 0)
                                        <tr>
                                            <td>Totals</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            @foreach($accounts as $account)
                                                @if(count($account->SubAccounts) > 0 )
                                                    @php
                                                    $totalDebit = 0;
                                                    $totalCredit = 0;
                                                    foreach ($account->SubAccounts as $sub)
                                                    {
                                                        $totalDebit = $totalDebit + $sub->Debits->whereBetween('created_at',[\Carbon\Carbon::parse($start_date), \Carbon\Carbon::parse($end_date)])->sum('amount');
                                                        $totalCredit = $totalCredit + $sub->Credits->whereBetween('created_at',[\Carbon\Carbon::parse($start_date), \Carbon\Carbon::parse($end_date)])->sum('amount');
                                                    }
                                                    @endphp
                                                    <td>{{ $totalDebit }}</td>
                                                    <td>{{ $totalCredit }}</td>
                                                @else
                                                    <td>{{ $account->Debits->whereBetween('created_at',[\Carbon\Carbon::parse($start_date), \Carbon\Carbon::parse($end_date)])->sum('amount') }}</td>
                                                    <td>{{ $account->Credits->whereBetween('created_at',[\Carbon\Carbon::parse($start_date), \Carbon\Carbon::parse($end_date)])->sum('amount') }}</td>
                                                @endif
                                            @endforeach
                                        </tr>
                                    @endif
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

