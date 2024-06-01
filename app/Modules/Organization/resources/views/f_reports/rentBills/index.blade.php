<x-organization::layout>
    <x-slot name="pageTitle">مدفوعات الايجار | عرض</x-slot name="pageTitle">
    @section('bills-active', 'm-menu__item--active m-menu__item--open')
    @section('rentBills-report-active', 'm-menu__item--active')
    <x-slot name="style">
        <!-- Some styles -->
    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    مدفوعات الايجار
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
                            عرض
                        </h3>
                    </div>
                </div>

            </div>
            <div class="m-portlet__body">
                <section class="content">
                    @include('Organization::f_reports.rentBills.filterForm')
                    <div class="table-responsive">
                        <section class="content table-responsive">
                            <table id="data-table" class="table table-striped- table-bordered table-hover table-checkable" >
                                <thead>
                                <tr>
                                    <th>التعريف</th>
                                    <th>تاريخ الاستحقاق</th>
                                    <th>المبلغ</th>
                                    <th>الحالة</th>
                                    <th>نوع الدفع</th>
                                    <th>تاريخ الدفع</th>
                                    <th> اسم المستاجر</th>
                                    <th> اسم مساحة الاستجار</th>
                                    <th>عمل قيض محاسبى </th>
                                    <th> قبول الفاتورة</th>
                                </tr>
                                </thead>
                                <tbody id="spinner">
                                <tr>
                                    <td style="height: 100px;text-align: center;line-height: 100px;" colspan="8">
                                        <i class="fa fa-spinner fa-spin text-primary" style="font-size: 30px" aria-hidden="true"></i>
                                    </td>
                                </tr>
                                </tbody>
                                <tbody id="data-table-body"></tbody>
                            </table>
                            <div id="paginationLinksContainer" style="display: flex;justify-content: center;align-items: center;margin-top: 10px"></div>
                        </section>
                    </div>
                </section>

                <form method="get" action="{{route('organizations.journalEntry.invoices')}}" class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed" id="invoiceForm">
                                @csrf
<input type="hidden" name="invoicesIds[]" id="invoicesIds">
 <div class="col-lg-6">

      
<input type="hidden" name="invoiceType" value="RentContractPayment">
                                  <label>اختر نوع القيض المحاسبى:</label>
                                  <select name="type" required="" class="form-control m-input m-input--square" id="exampleSelect1">
                            
                                          <option  value="creditor">creditor</option>
                                       <option  value="debtor">debtor</option>

                                  </select>
                                  @error('type')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                                 <button type="submit" class="btn btn-primary submit">الذهاب الى القيد المحاسبى</button>
                              
                                    </form>
            </div>
        </div>
    </div>
    <!-- End page content -->
    <x-slot name="scripts">
        <script>
            $(function () {
                render("{!! route('organizations.report.rentBills.data',['view' => request()->input('view',0)]) !!}");
                /**
                 * When Click on the pagination buttons, calling this script.
                 *
                 * */
                $('#paginationLinksContainer').on('click', 'a.page-link', function (event) {
                    event.stopPropagation();
                    render($(this).attr('href'));
                    return false;
                });
                /**
                 * When Click on the search button, calling this script.
                 *
                 * */
                $('#searchButton').on('click', function (event) {
                    event.stopPropagation();
                    render("{!! route('organizations.report.rentBills.data',['view' => request()->input('view',0)]) !!}&column=" + $('#searchColumn').val() + '&value=' + $('#searchField').val()+ '&start_date=' + $('#startDateCol').val()+ '&end_date=' + $('#endDateCol').val());
                });
            });



$('.submit').click(function(event) {
    event.preventDefault();
                // Get data as array, ['Jon', 'Mike']
               var invoices = []
$("input[name='invoices[]']:checked").each(function ()
{
    invoices.push(parseInt($(this).val()));

    $("input[name='invoicesIds[]']").push(parseInt($(this).val()));
});
$("#invoicesIds").val(invoices);

$("#invoiceForm").submit();

console.log(invoices);





            });
            
        </script>
    </x-slot>
</x-organization::layout>
