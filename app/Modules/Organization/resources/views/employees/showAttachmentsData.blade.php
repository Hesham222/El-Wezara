<x-organization::layout>
    @if(request()->input('view')=='trash')
        <x-slot name="pageTitle">بيانات الموظف| @lang('Organization::organization.trash')</x-slot name="pageTitle">
        @section('employee-trash-active', 'm-menu__item--active')
    @else
        <x-slot name="pageTitle">بيانات الموظف | @lang('Organization::organization.view')</x-slot name="pageTitle">
        @section('employee-active', 'm-menu__item--active')
    @endif
    @section('employee-active', 'm-menu__item--active m-menu__item--open')
    @include('Organization::_modals.confirm_password')
    <x-slot name="style">
        <!-- Some styles -->

        <style type="text/css">
            .card {
                border-radius: 12px;
                box-shadow: 0 6px 10px -4px rgba(0, 0, 0, .15);
                background-color: #002575;
                color: #fff;
                margin-bottom: 20px;
                position: relative;
                border: 0;
                transition: box-shadow .2s ease, -webkit-transform .3s cubic-bezier(.34, 2, .6, 1);
                transition: transform .3s cubic-bezier(.34, 2, .6, 1), box-shadow .2s ease;
                transition: transform .3s cubic-bezier(.34, 2, .6, 1), box-shadow .2s ease, -webkit-transform .3s cubic-bezier(.34, 2, .6, 1);
            }

            .card {
                display: flex;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-clip: border-box;
            }

            .card-stats .card-body {
                padding: 15px 15px 0;
            }

            .card .card-body {
                padding: 15px 15px 10px;
            }

            .card-stats {
                position: relative;
                top: 0;
                transition: top ease 0.5s;
            }

            .card-stats:hover {
                top: -10px;
            }

            .card-body {
                flex: 1 1 auto;
                padding: 1.25rem;
            }

            .card-stats .card-body .numbers {
                text-align: right;
                font-size: 2em;
            }

            .card .numbers {
                font-size: 2em;
            }

            .card-stats .card-body .numbers .card-category {
                color: #9a9a9a;
                font-size: 16px;
                line-height: 1.4em;
            }

            .card-stats .card-body .numbers p {
                margin-bottom: 0;
            }

            .card-category {
                font-size: 1em;
            }

            .card-category,
            .category {
                text-transform: capitalize;
                font-weight: 400;
                color: #9a9a9a;
                font-size: .7142em;
            }

            .card-stats .card-body .numbers p {
                margin-bottom: 0;
            }

            .card-title {
                margin-bottom: .75rem;
            }
        </style>

    </x-slot>
    <!-- Start page content -->
    <div class="m-subheader ">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">
                    الملفات
                </h3>
            </div>
        </div>
    </div>
    <div class="m-content">
        <div class="m-portlet m-portlet--mobile">
            <div class="m-portlet__head">
                <div class="m-portlet__head-caption">
                    <div class="m-portlet__head-title">

                    </div>
                </div>
                <div class="m-portlet__head-tools">
                    <ul class="m-portlet__nav">
                    <a class="btn btn-primary" href="{{route('organizations.employee.upload.attachment',$emp->id)}}">اضافه ملفات اخرى</a>
                    </ul>
                </div>
            </div>
            <div class="m-portlet__body">
                <section class="content">

                    <table id="example" style="width:100%" class="ui celled table unstackable">

                        <thead>
                        <tr>
                            <th>الرقم التعريفى</th>
                            <th>الملف</th>
                            <th>الاجراءات</th>
                        </tr>
                        </thead>
                        <tbody id="supplier-info">
                        @foreach ($emp->attachments as $attachment)

                            <tr>
                                <td>{{ $attachment->id }}</td>
                                <td><a target="_blank" href="{{route('organizations.employee.download.attachment',$attachment->id)}}">Download</a></td>

                                <td>

                                    <a href="{{route('organizations.employee.delete.attachment',$attachment->id)}}" title="حذف">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>

                    </table>


                </section>
            </div>
        </div>
    </div>
    <!-- End page content -->
    <x-slot name="scripts">
        <script>
            $('#example').DataTable({

            });
        </script>
    </x-slot>
</x-organization::layout>
