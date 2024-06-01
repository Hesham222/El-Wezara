@if($errors->any())
    @foreach($errors->all() as $error)
        <script> toastr.error("{{$error}}");</script>
    @endforeach
@endif
<script>

    $(".vendor-id").selectpicker();

    function DeleteVendorRowTable(i)
    {
        if($('#ingredients-table tbody tr').length == 1)
        {
            toastr.error('You can not delete all the Ingredients.');
            return;
        }
        var p=i.parentNode.parentNode;
            p.parentNode.removeChild(p);

        var val1=[];
        $('select[name="ingredients[]"] option:selected').each(function() {
            val1.push($(this).val());
        });

        var val2 = [];
        $('input[name="quantities[]"]').each(function() {
            val2.push($(this).val());
        });

        var _token = $("#token").val();
        $.ajax({
            url: "{{route('organizations.item.get.ingredients.tags')}}",
            method: "post",
            data: {
                val1:val1,val2:val2,_token:_token},
            success: function (data) {
                $('#cost').val(data['cost']);

                setTimeout(get_calcus, 500)
            },

        });
    }


    $(document).on('click','#new_row',function(){
        var item_id;
        item_id =   $('input[name="item_id"]').val();


        $.ajax({
            url: "{{route('organizations.item.get.ingredients.row')}}",
            data: {
                item_id:item_id},
            success: function (data) {
                $('#ingredients-table > tbody:last-child').append(data['data']['responseHTML']);
                $(".vendor-id").selectpicker();
                var typeVal = $("#type").val();
                if (typeVal == 'Variant'){
                    $(".show-variant").css('display','block');
                }else{
                    $(".show-variant").css('display','none');
                }

                setTimeout(get_calcus, 500)
            },

        });
    });


    $("#item-form").on('change','.ingredient',function(){


        var intVal = $(this).val();


     var check =    jQuery(this).closest('tr').find('[type=checkbox]');

     console.log(intVal.toString());
     console.log('kjnjkn');


     var lastType = jQuery(this).closest('tr').find('[type=hidden]');


     var commingType = $(this).children(":selected").data('type');

     if (commingType === 'item'){

         lastType.val(2);
         check.val(intVal.toString()+',Item');
     }else if(commingType === 'item_variant'){
         lastType.val(3);
         check.val(intVal.toString()+',Item Variant');
        }
     else{
         lastType.val(1);
         check.val(intVal.toString()+',Ingredient');
     }

        var val1=[];
        $('select[name="ingredients[]"] option:selected').each(function() {
            val1.push($(this).val());
        });
        var val2 = [];
        $('input[name="quantities[]"]').each(function() {
            val2.push($(this).val());
        });

        var val3 = [];
        $('input[name="comType[]"]').each(function() {
            val3.push($(this).val());
        });

        var _token = $("#token").val();
        $.ajax({
            url: "{{route('organizations.item.get.ingredients.tags')}}",
            method: "post",
            data: {
                val1:val1,val2:val2,val3:val3,_token:_token},
            success: function (data) {
                $('#cost').val(data['cost']);
                // $(".vendor-id").selectpicker();
                setTimeout(get_calcus, 500)
            },

        });
    });






    $("#item-form").on('change','.quant',function(){

        var intVal = $(this).val();


      //   var check =    jQuery(this).closest('tr').find('[type=checkbox]');
      //
      //   console.log(intVal.toString());
      //   console.log('kjnjkn');
      // //  check.val(intVal.toString());

        var val1=[];
        $('select[name="ingredients[]"] option:selected').each(function() {
            val1.push($(this).val());
        });
        var val2 = [];
        $('input[name="quantities[]"]').each(function() {
            val2.push($(this).val());
        });
        var val3 = [];
        $('input[name="comType[]"]').each(function() {
            val3.push($(this).val());
        });
        var _token = $("#token").val();
        $.ajax({
            url: "{{route('organizations.item.get.ingredients.tags')}}",
            method: "post",
            data: {
                val1:val1,val2:val2,val3:val3,_token:_token},
            success: function (data) {
                $('#cost').val(data['cost']);
                // $(".vendor-id").selectpicker();
                setTimeout(get_calcus, 500)
            },

        });
    });




    $("#item-form").on('change','#type',function(){

        var intVal = $(this).val();

        if (intVal == 'Variant'){
            $(".show-variant").css('display','block');
        }else {
            $(".show-variant").css('display','none');
        }


    });

    function get_price()
    {
        var price_option = $("#price_options").val();

        if (price_option == 20){
            $(".show_final_price_calcued").show();
            $(".show_final_price").hide();

            var final_price = $(".final_cost").val() * (1 + (20/100)) ;
            $(".final_price_calcued").val(final_price);
        }else if(price_option == 30){
            $(".show_final_price_calcued").show();
            $(".show_final_price").hide();

            var final_price = $(".final_cost").val() * (1 + (30/100)) ;
            $(".final_price_calcued").val(final_price);
        }else {
            $(".show_final_price_calcued").hide();
            $(".show_final_price").show();
        }

    }

    function get_calcus()
    {

        var _token = $("#token").val();
        $.ajax({
            url: "{{route('organizations.item.get.calcus')}}",
            method: "post",
            data: {
                cost:$("#cost").val(),_token:_token},
            success: function (data) {
                $(".auxiliary_materials").val(data.auxiliary_materials);

                $(".mortal").val(data.mortal);
                $(".variable_ratio").val(data.variable_ratio);
                $(".final_cost").val(data.final_cost);
                get_price();
            },

        });


    }

    // $('.quant').on('keydown', function() {
    //
    //     get_calcus();
    // });
    // $(".quant").keyup( function() {
    //
    // });

    // $(".ingredient").change( function() {
    //     get_calcus();
    // });

</script>
