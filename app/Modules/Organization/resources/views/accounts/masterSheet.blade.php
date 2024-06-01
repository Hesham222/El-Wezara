<x-organization::layout>
    <x-slot name="pageTitle">دفتر الأستاذ | عرض</x-slot name="pageTitle">
    @section('accounts-view-active', 'm-menu__item--active')
    @section('accounts-active', 'm-menu__item--active m-menu__item--open')
    <x-slot name="style">
        <!-- Some styles -->
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    الحسابات
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
                    <section class="content table-responsive">
                        <h5>{{ $account->name }} - {{ $account->account_number }}</h5>
                        <div class="row">
                            <div class="col-md-6">
                                <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                                    <thead>
                                        <tr>
                                            <th style="font-weight: bold">مدين</th>
                                        </tr>
                                    </thead>
                                    <thead>
                                    <tr>
                                        <th>التاريخ</th>
                                        <th>شرح القيد</th>
                                        <th>المبلغ المدين</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($account->Debits->sortByDesc('id') as $debit)
                                        <tr>
                                            <td>{{ date('d M Y', strtotime($debit->created_at)) }}</td>
                                            <td>{{ $debit->JournalEntry->description }}</td>
                                            <td>{{ $debit->amount }}</td>
                                        </tr>
                                    @endforeach
                                    @if(count($result) > 0 && $result[0] == "Debit")
                                        <tr>
                                            <td></td>
                                            <td>رصيد</td>
                                            <td>{{ $result[1]}}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>الاجمالي</td>
                                            <td>{{ ($account->Debits) ? $account->Debits->sum('amount') + $result[1] : ""}}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td></td>
                                            <td>الاجمالي</td>
                                            <td>{{ ($account->Debits) ? $account->Debits->sum('amount') : ""}}</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                    <tbody id="data-table-body"></tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                                    <thead>
                                    <tr>
                                        <th style="font-weight: bold">دائن</th>
                                    </tr>
                                    </thead>
                                    <thead>
                                    <tr>
                                        <th>التاريخ</th>
                                        <th>شرح القيد</th>
                                        <th>المبلغ الدائن</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($account->Credits->sortByDesc('id') as $credit)
                                        <tr>
                                            <td>{{ date('d M Y', strtotime($credit->created_at)) }}</td>
                                            <td>{{ $credit->JournalEntry->description }}</td>
                                            <td>{{ $credit->amount }}</td>
                                        </tr>
                                    @endforeach
                                    @if(count($result) > 0 && $result[0] == "Credit")
                                        <tr>
                                            <td></td>
                                            <td>رصيد</td>
                                            <td>{{ $result[1]}}</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>الاجمالي</td>
                                            <td>{{ ($account->Credits) ? $account->Credits->sum('amount') + $result[1] : ""}}</td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td></td>
                                            <td>الاجمالي</td>
                                            <td>{{ ($account->Credits) ? $account->Credits->sum('amount') : ""}}</td>
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

