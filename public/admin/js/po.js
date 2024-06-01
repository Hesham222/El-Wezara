// $(document).bind("contextmenu",function(e) {
//     e.preventDefault();
// });
//this is a general function that used in multiple places, calculate po subtotal, total, item cost, final cost...
function calculateItemFinalCostTotal(){
    var shipCost  = $("#shippingCost").val();
    var vat       = $("input[name='vat']").val();
    var disc      = $("input[name='shippingDisc']").val();
    var POsubtotal  = 0;
    var POtotal  = 0;
    var POtotalWithVat  = 0;
    if (isNaN(shipCost)) {
        shipCost=parseFloat(0);
    }
    if (isNaN(vat)) {
        vat=parseFloat(0);
    }
    if (isNaN(disc)) {
        disc=parseFloat(0);
    }
    var OrderedQtys   = 0;
    $('#items-table > tbody  > tr').each(function(index, tr) {
        OrderedQtys += parseFloat($(this).find("td:eq(3) .orderQty").val());
    });
    if (isNaN(OrderedQtys) || OrderedQtys==0) {
        OrderedQtys=parseFloat(1);
    }
    $("#items-table tbody tr, #helper-table tr").each(function(){
        var orderQty = parseFloat($(this).find("td:eq(3) .orderQty").val());
        var cost     = parseFloat($(this).find("td:eq(4) .cost").val());
        //calculate final cost
        var finalCost = parseFloat(cost+(shipCost/OrderedQtys));
        $(this).find("td:eq(5) .final-cost").val(finalCost.toFixed(2));
        //calculate subtotal
        var subtotal = parseFloat(cost*orderQty);
        $(this).find("td:eq(7) .subtotal").val(subtotal.toFixed(2));
        //calculate total
        var total  = parseFloat(finalCost*orderQty);
        $(this).find("td:eq(6) .total").val(total.toFixed(2));
    });
    $('#items-table > tbody  > tr').each(function(index, tr) {
        POsubtotal += parseFloat($(this).find("td:eq(7) .subtotal").val());
    });
    if (isNaN(POsubtotal)) {
        POsubtotal=0;
    }
    $("#po-subtotal").val(POsubtotal.toFixed(2));
    //calculate toal after discount
    POtotalAfterDisc = POsubtotal-(POsubtotal*(disc/100));
    $("#po-total-disc").val(POtotalAfterDisc.toFixed(2));
    //calculate toal after shipping
    var totalAfterShipping = parseFloat(parseFloat(POtotalAfterDisc)+parseFloat(shipCost));
    $('#POtotalAfterShipping').val(totalAfterShipping.toFixed(2));
    //calculate toal after vat
    POtotalWithVat  = totalAfterShipping/100*vat+(totalAfterShipping);
    $("#po-total").val(POtotalWithVat.toFixed(2));
}
function DeleteRowTable(i) {
    var p = i.parentNode.parentNode;
    p.parentNode.removeChild(p);
    calculateItemFinalCostTotal();
}
//when change Ordered Quantity value, change final cost and toatal  in items table
function changeOrderdQty(that){
    calculateItemFinalCostTotal();
}

//when change cost value, change final cost and toatal  in items table
function changeCost(that){
    calculateItemFinalCostTotal();
}

$(document).ready(function() {
    //make  drop down list has select two
    $('.select2').select2({
        allowClear: true
    });
    //when user click on order button change status from open to ordered
    $('.order-po').click(function(){
        $('#status-value').val('2');
    });
    $('.receivedToInventory').click(function(){
        $('#received-to-inventory').val('1');
    });
    //when add new item, add new row to item table
    $('#add-new-item').click(function(){
        if ($("#items-table tr").length>$(this).data('count-items')) {
            toastr.error("You can't add more rows, you have only "+$(this).data('count-items')+" items !");
            return;
        }
        var item_row = $('#helper-table tr:nth-child(1)').html();
        $("#items-table tbody").append("<tr>"+item_row+"</tr>");
    });
    //when change shipping cost value, change final cost and toatal  in items table
    $("#shippingCost").on("change paste keyup", function() {
        calculateItemFinalCostTotal();
    });
    //when change po discount value, change po subtotal and total
    $("#shippingDisc").on("change paste keyup", function() {
        calculateItemFinalCostTotal();
    });
    //when change po vat value, change po subtotal and total
    $("#vat").on("change paste keyup", function() {
        calculateItemFinalCostTotal();
    });
    //when select item
    $(document).on('change', '.items-list', function(e) {
        var item = this.value;
        var route = $(this).data("route");
        var token = $('meta[name="csrf-token"]').attr('content');
        var row          =  $(this).parents("tr");
        $.ajax({
            url: route,
            method: 'GET',
            data: {
                _token: token,
                item: item
            },
            dataType: 'JSON',

            success: function(data) {
                //seleing price
                row.find("td:eq(1) .prices").css("display", "block")
                row.find("td:eq(1) .prices").val(data['selling_price']);
                //stock
                row.find("td:eq(2) .stock").css("display", "block")
                row.find("td:eq(2) .stock").text(data['quantity']);
                //order quantity
                row.find("td:eq(3) .orderQty").css("display", "block")
                //cost
                row.find("td:eq(4) .cost").css("display", "block")
                row.find("td:eq(4) .cost").val(data['cost']);
                //subtotal
                row.find("td:eq(7) .subtotal").css("display", "block")
                //final cost
                row.find("td:eq(5) .final-cost").css("display", "block")
                //total
                row.find("td:eq(6) .total").css("display", "block")
                calculateItemFinalCostTotal();
                if (data['empty'] == 'empty') {
                    row.find("td:eq(1) .prices").css("display", "none");
                    row.find("td:eq(2) .stock").css("display", "none");
                    row.find("td:eq(3) .orderQty").css("display", "none");
                    row.find("td:eq(4) .cost").css("display", "none");
                    row.find("td:eq(5) .final-cost").css("display", "none");
                    row.find("td:eq(6) .total").css("display", "none");
                    row.find("td:eq(7) .subtotal").css("display", "none");
                }
                if (data['hiddenItem']) {
                    row.find("td:eq(1) .prices").css("display", "none");
                    row.find("td:eq(2) .stock").css("display", "none");
                    row.find("td:eq(3) .orderQty").css("display", "none");
                    row.find("td:eq(4) .cost").css("display", "none");
                    row.find("td:eq(5) .final-cost").css("display", "none");
                    row.find("td:eq(6) .total").css("display", "none");
                    row.find("td:eq(7) .subtotal").css("display", "none");
                    toastr.error(data['hiddenItem']);
                }
            },
            error: function(data) {
                toastr.error('error occered.Please try again.')
            }
        });
    });

});


