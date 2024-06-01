<x-organization::layout>
    <x-slot name="pageTitle">قائمة المركز المالي | عرض</x-slot name="pageTitle">
    @section('financialStatement-active', 'm-menu__item--active m-menu__item--open')
    <x-slot name="style">
        <!-- Some styles -->
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    قائمة المركز المالي
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
                        <h5>قائمة المركز المالي</h5>
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
                                        <td><b>=> Assets</b></td>
                                    </tr>
                                    @php
                                    $totalAssetDebits = 0;
                                    $totalLiabilityDebits = 0;
                                    $totalOwnerShipDebits = 0;
                                    @endphp
                                        @foreach($assetAccounts as $assetAccount)
                                            <tr>
                                                @if(count($assetAccount->SubAccounts) > 0)
                                                    <td>
                                                        <b>{{ $assetAccount->name }}</b>
                                                        <br>
                                                    @foreach($assetAccount->SubAccounts as $sub)
                                                            => {{ $sub->name }}<br>
                                                    @endforeach
                                                        اجمالي الإيرادات
                                                    </td>
                                                    <td>
                                                        <br>
                                                        @foreach($assetAccount->SubAccounts as $sub)
                                                            @php $totalAssetDebits = $totalAssetDebits + $sub->Debits->sum('amount') @endphp
                                                            {{ $sub->Debits->sum('amount') }}<br>
                                                        @endforeach
                                                        {{ $assetAccount->debitSubAmount }}
                                                    </td>
                                                @else
                                                    <td>
                                                        <b>{{ $assetAccount->name }}</b>
                                                    </td>
                                                    <td>
                                                        @php $totalAssetDebits = $totalAssetDebits + $assetAccount->Debits->sum('amount') @endphp
                                                        {{ $assetAccount->Debits->sum('amount') }}<br>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    <tr>
                                        <td>Total Assets:</td>
                                        <td>{{ $totalAssetDebits }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>=> Liabilities</b></td>
                                    </tr>
                                        @foreach($liabilityAccounts as $liabilityAccount)
                                            <tr>
                                                @if(count($liabilityAccount->SubAccounts) > 0)
                                                    <td>
                                                        <b>{{ $liabilityAccount->name }}</b>
                                                        <br>
                                                        @foreach($liabilityAccount->SubAccounts as $sub)
                                                            => {{ $sub->name }}<br>
                                                        @endforeach
                                                        اجمالي الإيرادات
                                                    </td>
                                                    <td>
                                                        <br>
                                                        @foreach($liabilityAccount->SubAccounts as $sub)
                                                            @php $totalLiabilityDebits = $totalLiabilityDebits + $sub->Debits->sum('amount') @endphp
                                                            {{ $sub->Debits->sum('amount') }}<br>
                                                        @endforeach
                                                        {{ $liabilityAccount->debitSubAmount }}
                                                    </td>
                                                @else
                                                    <td>
                                                        <b>{{ $liabilityAccount->name }}</b>
                                                    </td>
                                                    <td>
                                                        @php $totalLiabilityDebits = $totalLiabilityDebits + $liabilityAccount->Debits->sum('amount') @endphp
                                                        {{ $liabilityAccount->Debits->sum('amount') }}<br>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    <tr>
                                        <td>Total Liabilities:</td>
                                        <td>{{ $totalLiabilityDebits }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>=> Equity Rights</b></td>
                                    </tr>
                                    @foreach($ownerShipAccounts as $ownerShipAccount)
                                        <tr>
                                            @if(count($ownerShipAccount->SubAccounts) > 0)
                                                <td>
                                                    <b>{{ $ownerShipAccount->name }}</b>
                                                    <br>
                                                    @foreach($ownerShipAccount->SubAccounts as $sub)
                                                        => {{ $sub->name }}<br>
                                                    @endforeach
                                                    اجمالي الإيرادات
                                                </td>
                                                <td>
                                                    <br>
                                                    @foreach($ownerShipAccount->SubAccounts as $sub)
                                                        @php $totalOwnerShipDebits = $totalOwnerShipDebits + $sub->Debits->sum('amount') @endphp
                                                        {{ $sub->Debits->sum('amount') }}<br>
                                                    @endforeach
                                                    {{ $ownerShipAccount->debitSubAmount }}
                                                </td>
                                            @else
                                                <td>
                                                    <b>{{ $ownerShipAccount->name }}</b>
                                                </td>
                                                <td>
                                                    @php $totalOwnerShipDebits = $totalOwnerShipDebits + $ownerShipAccount->Debits->sum('amount') @endphp
                                                    {{ $ownerShipAccount->Debits->sum('amount') }}<br>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td>Total Equity Rights:</td>
                                        <td>{{ $totalOwnerShipDebits }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Total Liabilities and Equities </b></td>
                                        <td>{{ $totalLiabilityDebits + $totalOwnerShipDebits}}</td>
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

