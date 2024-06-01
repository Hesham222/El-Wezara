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
            toastr.error('لا يمكن عمل اوردر على الاقل من مكون واحد');
            return;
        }
        var p=i.parentNode.parentNode;
            p.parentNode.removeChild(p);

        var val1=[];
        $('select[name="ingredients[]"] option:selected').each(function() {
            val1.push($(this).val());
        });

        $('select[name="ing[]"] option:selected').each(function() {
            val1.push($(this).val());
        });

        var val2 = [];
        $('input[name="quantities[]"]').each(function() {
            val2.push($(this).val());
        });

        $('input[name="qo[]"]').each(function() {
            val2.push($(this).val());
        });

        var val3 = [];
        $('input[name="comType[]"]').each(function() {
            val3.push($(this).val());
        });

        $('input[name="comTyp[]"]').each(function() {
            val3.push($(this).val());
        });

        var _token = $("#token").val();
        $.ajax({
            url: "{{route('organizations.pointOfSale.get.ingredients.tags')}}",
            method: "post",
            data: {
                val1:val1,val2:val2,val3:val3,_token:_token},
            success: function (data) {
                $('#final_price').val(data['cost']);

               // setTimeout(get_calcus, 500)
            },

        });
    }


    $(document).on('click','#new_row',function(){
        var item_id;
        item_id =   $('input[name="item_id"]').val();
        $.ajax({
            url: "{{route('organizations.pointOfSale.get.ingredients.row')}}",
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

               // setTimeout(get_calcus, 500)
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

        $('select[name="ing[]"] option:selected').each(function() {
            val1.push($(this).val());
        });

        $('input[name="qo[]"]').each(function() {
            val2.push($(this).val());
        });


        $('input[name="comTyp[]"]').each(function() {
            val3.push($(this).val());
        });


        var _token = $("#token").val();
        $.ajax({
            url: "{{route('organizations.pointOfSale.get.ingredients.tags')}}",
            method: "post",
            data: {
                val1:val1,val2:val2,val3:val3,_token:_token},
            success: function (data) {
                $('#final_price').val(data['cost']);
                // $(".vendor-id").selectpicker();
              //  setTimeout(get_calcus, 500)
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


        $('select[name="ing[]"] option:selected').each(function() {
            val1.push($(this).val());
        });

        $('input[name="qo[]"]').each(function() {
            val2.push($(this).val());
        });


        $('input[name="comTyp[]"]').each(function() {
            val3.push($(this).val());
        });

        var _token = $("#token").val();
        $.ajax({
            url: "{{route('organizations.pointOfSale.get.ingredients.tags')}}",
            method: "post",
            data: {
                val1:val1,val2:val2,val3:val3,_token:_token},
            success: function (data) {
                $('#final_price').val(data['cost']);
                // $(".vendor-id").selectpicker();
              //  setTimeout(get_calcus, 500)
            },

        });
    });








</script>
