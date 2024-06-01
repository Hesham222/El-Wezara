<x-organization::layout>
    <x-slot name="pageTitle">قوائم الدخل | عرض</x-slot name="pageTitle">
    @section('incomeStatement-active', 'm-menu__item--active m-menu__item--open')
    <x-slot name="style">
        <!-- Some styles -->
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    قوائم الدخل
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
                        <h5>قوائم الدخل</h5>
                        <div class="row">
                            <div class="col-md-12">
                                <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                                    <thead>
                                    <tr>
                                        <th style="font-weight: bold" colspan="2">الحسابات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><b>Revenues إيرادات التشغيل</b></td>
                                    </tr>
                                    @php
                                    $totalIncomeDebits = 0;
                                    $totalExpenseDebits = 0;
                                    @endphp
                                        @foreach($incomeAccounts as $incomeAccount)
                                            <tr>
                                                @if(count($incomeAccount->SubAccounts) > 0)
                                                    <td>
                                                        <b>{{ $incomeAccount->name }}</b>
                                                        <br>
                                                    @foreach($incomeAccount->SubAccounts as $sub)
                                                            => {{ $sub->name }}<br>
                                                    @endforeach
                                                        اجمالي الإيرادات
                                                    </td>
                                                    <td>
                                                        <br>
                                                        @foreach($incomeAccount->SubAccounts as $sub)
                                                            @php $totalIncomeDebits = $totalIncomeDebits + $sub->Debits->sum('amount') @endphp
                                                            {{ $sub->Debits->sum('amount') }}<br>
                                                        @endforeach
                                                        {{ $incomeAccount->debitSubAmount }}
                                                    </td>
                                                @else
                                                    <td>
                                                        <b>{{ $incomeAccount->name }}</b>
                                                    </td>
                                                    <td>
                                                        @php $totalIncomeDebits = $totalIncomeDebits + $incomeAccount->Debits->sum('amount') @endphp
                                                        {{ $incomeAccount->Debits->sum('amount') }}<br>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    <tr>
                                        <td><b>Expenses تكاليف النشاط</b></td>
                                    </tr>
                                        @foreach($expenseAccounts as $expenseAccount)
                                            <tr>
                                                @if(count($expenseAccount->SubAccounts) > 0)
                                                    <td>
                                                        <b>{{ $expenseAccount->name }}</b>
                                                        <br>
                                                        @foreach($expenseAccount->SubAccounts as $sub)
                                                            => {{ $sub->name }}<br>
                                                        @endforeach
                                                        اجمالي الإيرادات
                                                    </td>
                                                    <td>
                                                        <br>
                                                        @foreach($expenseAccount->SubAccounts as $sub)
                                                            @php $totalExpenseDebits = $totalExpenseDebits + $sub->Debits->sum('amount') @endphp
                                                            {{ $sub->Debits->sum('amount') }}<br>
                                                        @endforeach
                                                        {{ $expenseAccount->debitSubAmount }}
                                                    </td>
                                                @else
                                                    <td>
                                                        <b>{{ $expenseAccount->name }}</b>
                                                    </td>
                                                    <td>
                                                        @php $totalExpenseDebits = $totalExpenseDebits + $expenseAccount->Debits->sum('amount') @endphp
                                                        {{ $expenseAccount->Debits->sum('amount') }}<br>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    <tr>
                                        <td><b>الفائض العام</b></td>
                                        <td>{{ $totalIncomeDebits - $totalExpenseDebits }}</td>
                                    </tr>
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

