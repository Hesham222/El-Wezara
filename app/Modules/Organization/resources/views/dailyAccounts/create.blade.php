<x-organization::layout>
 <x-slot name="pageTitle">سجل قيود اليوم - لم يتم ترحيلها | اضف</x-slot name="pageTitle">
 @section('dailyAccounts-active', 'm-menu__item--active m-menu__item--open')
 @section('dailyAccounts-create-active', 'm-menu__item--active')
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
                سجل قيود اليوم - لم يتم ترحيلها
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
                    سجل قيود اليوم - لم يتم ترحيلها
                </h3>
              </div>
            </div>
          </div>
          <div class="m-portlet__body">
            <div class="table-responsive">
                <section class="content">

                      <table class="table table-condensed">
                          <thead>
                          <tr>
                              <th>التعريف</th>
                              <th>مبلغ مدين</th>
                              <th>مبلغ دائن</th>
                              <th>الحساب المدين</th>
                              <th> الحساب الدائن</th>
                              <th> شرح القيد</th>
                              <th>  ترحيل</th>
                              <th>  المسؤول</th>
                              <th>نشأ في</th>
                          </tr>
                          </thead>
                          <tbody>
                          @if(count($journalEntries))
                              @foreach($journalEntries as $journalEntry)
                          <form method="POST" action="{{route('organizations.dailyAccount.store')}}" enctype="multipart/form-data"
                              class="m-form m-form--fit m-form--label-align-right m-form--group-seperator-dashed">
                          @csrf
                          <tr>
                              <td>
                                  <input
                                      type="text"
                                      value="{{$journalEntry->id?$journalEntry->id:"لا يوجد"}}"
                                      required=""
                                      name="journal_entry_id"
                                      class="form-control m-input"
                                      readonly="readonly"/>
                                  @error('journal_entry_id')
                                  <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror

                              </td>
                              <td>
                                  <ul>
                                      @foreach($journalEntry->Debits as $debit)
                                          <li>{{$debit->amount?$debit->amount:"لا يوجد"}}
                                          </li>
                                      @endforeach
                                          <li>Total >> {{$journalEntry->sum_debits}}</li>

                                  </ul>
                              </td>
                              <td>
                                  <ul>
                                      @foreach($journalEntry->Credits as $credit)
                                          <li>{{$credit->amount?$credit->amount:"لا يوجد"}}</li>
                                      @endforeach
                                          <li>Total >> {{$journalEntry->sum_credits}}</li>

                                  </ul>
                              </td>
                              <td>
                                  <ul>
                                      @foreach($journalEntry->Debits as $debit)
                                          @if(isset($debit->account_id))
                                              <li>{{$debit->Account?$debit->Account->name:"لا يوجد"}}</li>
                                          @else
                                              <li>{{$debit->SubAccount?$debit->SubAccount->name:"لا يوجد"}}</li>

                                          @endif
                                      @endforeach
                                  </ul>
                              </td>
                              <td>
                                  <ul>
                                          @foreach($journalEntry->Credits as $credit)
                                              @if(isset($credit->account_id))
                                                  <li>{{$credit->Account?$credit->Account->name:"لا يوجد"}}</li>
                                              @else
                                                  <li>{{$credit->SubAccount?$credit->SubAccount->name:"لا يوجد"}}</li>

                                              @endif
                                          @endforeach
                                  </ul>
                              </td>
                              <td>
                                  {{$journalEntry->description?$journalEntry->description:"لا يوجد"}}
                              </td>
                              <td>
                                  <button type="submit" name="status" value="1" class="btn btn-primary">ترحيل</button>
                              </td>
                              <td>
                                  {{$journalEntry->createdBy?$journalEntry->createdBy->name:"لا يوجد"}}
                              </td>
                              <td>{{ date('M d, Y', strtotime($journalEntry->created_at)) .'-'.date('h:i a', strtotime($journalEntry->created_at)) }}</td>

                          </tr>
                          </form>
                          @endforeach
                          @else
                              <tr>
                                  <td colspan="8" style="text-align:center;">
                                      لا توجد سجلات تطابق المدخلات الخاصة بك.
                                  </td>
                              </tr>
                          @endif
                          </tbody>
                      </table>
                </section>
            </div>
          </div>
        </div>
      </div>
    <!-- end page content -->
    <x-slot name="scripts">
        <script>
            form.addEventListener('submit', () => {
                if (document.getElementById("yes").checked) {
                    document.getElementById('no').disabled = true;
                }
            })
        </script>
    </x-slot>
</x-organization::layout>
