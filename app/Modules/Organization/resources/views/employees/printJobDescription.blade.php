

<html>
<head>
    <meta charset="UTF-8" />

    <style>
        table{
            border: 0.5px solid black;
        }
        * {
            -webkit-print-color-adjust: exact !important;   /* Chrome, Safari, Edge */
            color-adjust: exact !important;                 /*Firefox*/
        }
    </style>
</head>
<body>



<div class="profile--container">
    <!-- start Orders details -->

    <div class="pdf-content-wrapper" style="font-family: URWDIN, sans-serif">
        <div id='DivIdToPrint' style="direction: rtl" class="canvas_div_pdf" style="font-family: URWDIN, sans-serif">
            <page size="A4" style="font-family: URWDIN, sans-serif">
                            <br>
                            <br>
                            <table class="order-table">
                                <tr>
                                    <th style="background-color : #D9E2F3; text-align: right;">الرقم التعريفي</th>
                                    <th style="background-color : #D9E2F3; text-align: right;">اسم الموظف</th>
                                    <th style="background-color : #D9E2F3; text-align: right;"> اسم الوظيفة </th>
                                    <th style="background-color : #D9E2F3; text-align: right;"> وصف الوظيفة </th>

                                </tr>


                                    <tr>

                                                <td>{{$emp->id}}</td>
                                        <td>{{$emp->name}}</td>
                                        <td>{{$emp->employee_job->name}}</td>
                                        <td>{!! $emp->employee_job->description !!}</td>
                                    </tr>

                            </table>
            </page>
        </div>
    </div>
</div>


<script>

    window.print();

</script>
</body>
</html>
