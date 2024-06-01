$(document).bind("contextmenu",function(e) {
    e.preventDefault();
});
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
    var RecivedQtys   = 0;
    $('#items-table > tbody  > tr').each(function(index, tr) {
        RecivedQtys += parseFloat($(this).find("td:eq(4) .receivedQty").val());
    });
    if (isNaN(RecivedQtys) || RecivedQtys==0) {
        RecivedQtys=parseFloat(1);
    }
    $("#items-table tbody tr").each(function(){
        var receivedQty = parseFloat($(this).find("td:eq(4) .receivedQty").val());
        if (isNaN(receivedQty)) {
            receivedQty=parseFloat(0);
        }
        var cost     = parseFloat($(this).find("td:eq(6) .cost").val());
        if (isNaN(cost)) {
            cost=parseFloat(0);
        }
        //calculate final cost
        var finalCost = parseFloat(cost+(shipCost/RecivedQtys));
        if (isNaN(finalCost)) {
            finalCost=parseFloat(0);
        }
        $(this).find("td:eq(7) .final-cost").val(finalCost.toFixed(2));
        //calculate total
        var total  = parseFloat(finalCost*receivedQty);
        $(this).find("td:eq(8) .total").val(total.toFixed(2));
        //calculate subtotal
        var subtotal = parseFloat(cost*receivedQty);
        $(this).find("td:eq(9) .subtotal").val(subtotal.toFixed(2));
    });
    $('#items-table > tbody  > tr').each(function(index, tr) {
        POsubtotal += parseFloat($(this).find("td:eq(9) .subtotal").val());
    });
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
//when change cost value, change final cost and toatal  in items table
function changeCost(that){
    calculateItemFinalCostTotal();
}
//when chenge recived qty, change status
function changeRecivedQty(that){
    calculateItemFinalCostTotal();
    row        = $(that).parents("tr");
    orderQty   = parseFloat(row.find("td:eq(3) .orderQty").val());
    recivedQty = parseFloat(that.value);
    if (recivedQty==orderQty){
        row.find("td:eq(5) .status_input").val("Completed");
    }
    else if(recivedQty < orderQty){
        row.find("td:eq(5) .status_input").val("Partially  Received");
    }
    else if(recivedQty > orderQty){
        row.find("td:eq(5) .status_input").val("Extra Received");
    }
    if(recivedQty == 0){
        row.find("td:eq(5) .status_input").val("Not received");
    }
}
$(document).ready(function() {
    //make  drop down list has select two
    $('.select2').select2({
        allowClear: true
    });
    $('.receivedToInventory').click(function(){
        $('#received-to-inventory').val('1');
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

    //when click on recive all btn, recive all qties
    $('.receive-all-orders').click(function(){
        $('#items-table > tbody  > tr').each(function(index, tr) {
            var OrderedQty = $(this).find("td:eq(3) .orderQty").val();
            $(this).find("td:eq(4) .receivedQty").val(OrderedQty);
            $(this).find("td:eq(5) .status_input").empty();
            $(this).find("td:eq(5) .status_input").val("Completed");
        });
        calculateItemFinalCostTotal();
    });
});


