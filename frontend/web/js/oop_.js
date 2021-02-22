/*function addRequest(){
    var data = $('#request').yiiGridView('getSelectedRows');
        
    //console.log(yii.getCsrfToken());
    //var ajax = new XMLHttpRequest();
    if(data.length !== 0){
        $.ajax({
            type: "POST",
            url: 'getreqid', // Your controller action
            data: {data: data},
            success: function(data){
                //console.log(data);
                //return data;
                //prompt('Email Address:');
                //window.location.href = data;
            },
            error: function (xhr, ajaxOptions, throwError) {
                alert(xhr);
                alert(throwError);
            }
        });
    } else {
        alert('Select Request/s to Create Order of Payment.');
    }
}

function addrequest()
{
    var data = $('#request').yiiGridView('getSelectedRows');
    
    if(data.length !== 0)
    {
        return true;
    } else {
        alert('Select Request/s to Create Order of Payment.');
        return false;
    }
}

function service()
{
    alert();
}

function balance() {
    var bal = 0;
    $('input[type="number"][name="balance[]"]').each(function () {
       bal = bal + Number($(this).val());    
    });
    var total = Number($('#sum').val()) - bal;
    $('#total').val(total.toFixed(2));
    $('#totalBalance').css("background-color", "red").val(bal.toFixed(2));
}

function fund() {
    alert();
    var select = $('#fund option:selected').val();
    
    if (select == 0) {
        $('imput[type="number"][name="trustfund[]"]').attr({readonly : true, placeholder : 'Amount'}).val('');
    } else if (select == 1) {
        $('imput[type="number"][name="trustfund[]"]').attr('readonly', true).val(0);
    } else {
        $('imput[type="number"][name="trustfund[]"]').removeAttr('readonly').attr('placeholder', 'Amount').val('');
    }
}
function fund(id) {
    var select = $('#fund' + id + ' option:selected').val();
    
    if (select == 0) {
        $('#tf' + id).attr({readonly : true, placeholder : 'Amount'}).val('');
    } else if (select == 1) {
        var gf = Number($('#tf' + id).val()) + Number($('#gf' + id).val());
        $('#tf' + id).attr('readonly', true).val(0);
        $('#gf' + id).val(gf);
    } else {
        $('#tf' + id).removeAttr('readonly').attr('placeholder', 'Amount').val('');
    }
}
*/
/*$(document).ready(function(){
    $('#ts').on('click', function(){
        alert('technical');
        $('li .tac').removeClass('active');
        $('li .ts').attr({class : 'active'});
    });
});*/

$(document).ready(function () {
    //$('a[href="' + this.location.pathname + '"]').parent().addClass('active');
    // Remove active for all items.
    $('.page-sidebar-menu li').removeClass('active');

    // highlight submenu item
    $('li a[href="' + this.location.pathname + '"]').parent().addClass('active');

    // Highlight parent menu item.
    $('ul a[href="' + this.location.pathname + '"]').parents('li').addClass('active');
});

function trustFundAmount(id, total) {
    var tf = $('#tf' + id).val();
    var gf = Number(total) - Number(tf);
    $('#gf' + id).val(gf);
}

function fundCluster(){
    var select = $('#fund option:selected').val();
    if (select == '') {
        $('input[type="number"][name="trustFund[]"]').each(function(){
           $(this).attr({readonly : true, placeholder : 'Amount'}).val('');
        });
    } else {
        var type;
        if (select == 1) {
            $('input[type="number"][name="trustFund[]"]').each(function(){
               $(this).attr({readonly : true}).val('0'); 
            });
            type = 'collection';
        }
        if (select == 2){
            $('input[type="number"][name="trustFund[]"]').each(function(){
               $(this).removeAttr('readonly').attr('placeholder', 'Amount').val('');
            });
            type = 'service';
        }
        //alert(select);
        $.ajax({
             url: 'getincometype',
             type: 'post',
             data: {type: type},
             success: function (data) {
                 console.log(data);
                 if(data['type'] == 'collection'){
                     name = 'collection_name';
                 } else {
                     name = 'service_title';
                 }
                 $('#incomeCode option').each(function(){
                     $(this).remove();
                 });
                 $('#incomeCode').append('<option value="">Select Income Code</option>')
                 $.each(data['data'], function(key, value){
                     console.log(value['id'] + " : " + value[name]);
                     $('#incomeCode').append('<option value="' + value['id'] + '">' + value[name] + '</option>');
                 });
             }
        });
    }    
}

function balance(i) {
    if(Number($('#amount' + i).val()) < Number($('#tp' + i).val())){
        alert('The amount you enter is either > or = the amount of the request');
        $('#tp' + i).val('');
    } else {
        var totalBal = 0;
        var bal = 0;
        $('input[type="number"][name="toPay[]"]').each(function (e) {
            
            var amount = Number($('#amount' + e).val());
            var topay = Number($('#tp' + e).val());
            bal = amount - topay;
            totalBal = totalBal + bal;
            $('#bal' + e).val(bal);
        });
    
        var total = Number($('#sum').val()) - totalBal;
        $('#total').val(total.toFixed(2));
        $('#totalBalance').css("background-color", "red").val(totalBal.toFixed(2));
    }
    
    
    
}

function addPaymentDetails(mode){
    "use strict";
    var name, row = 0;
    var rowCount = $('tbody[id="payment_details"] tr.'+mode).length;
    alert(rowCount);
    /*if(mode == 'check'){
        if(rowCount == 0){
            $('#cash').after('<tr class="'+mode+'">'
                +'<th>sample</th>'
                +'<td>sample</td>'
                +'<td>sample</td>'
                +'<td>sample</td>'
                +'<td>'
                    +'<img src="/opms/images/remove.png" onclick="remove();" style="width:25px; height:25px; cursor: pointer;" alt="Remove" />'
                +'</td>'
             +'</tr>');
        }
    }*/
    
    if(rowCount == 0){
        row = rowCount + 1;
        if(mode == 'check'){
             name = 'Check';
        } else {
            name = 'LDDAP-ADA';
        }
        $('#cash').after('<tr class="'+mode+'" id="'+mode+row+'">'
            +'<th>'+name+' Amount</th>'
            +'<td>'
                +'<div class="form-group">'
                    +'<input class="form-control" type="number" name="" id="" onchange="" placeholder="'+name+row+' Amount" />'
                +'</div>'
            +'</td>'
            +'<td>'
                +'<div class="form-group">'
                    +'<input class="form-control" type="number" name="" id="" onchange="" placeholder="'+name+row+' Amount" />'
                +'</div>'
            +'</td>'
            +'<td>'
                +'<div class="form-group">'
                    +'<input class="form-control" type="number" name="" id="" onchange="" placeholder="'+name+row+' Amount" />'
                +'</div>'
            +'</td>'
            +'<td>'
                +'<img src="/opms/images/remove.png" onclick="remove();" style="width:25px; height:25px; cursor: pointer;" alt="Remove" />'
            +'</td>'
         +'</tr>');
    } else {
        row = rowCount + 1;
        $('#'+mode+rowCount).after('<tr class="'+mode+'" id="'+mode+row+'">'
            +'<th>'+name+' Amount</th>'
            +'<td>'
                +'<div class="form-group">'
                    +'<input class="form-control" type="number" name="" id="" onchange="" placeholder="'+name+row+' Amount" />'
                +'</div>'
            +'</td>'
            +'<td>'
                +'<div class="form-group">'
                    +'<input class="form-control" type="number" name="" id="" onchange="" placeholder="'+name+row+' Amount" />'
                +'</div>'
            +'</td>'
            +'<td>'
                +'<div class="form-group">'
                    +'<input class="form-control" type="number" name="" id="" onchange="" placeholder="'+name+row+' Amount" />'
                +'</div>'
            +'</td>'
            +'<td>'
                +'<img src="/opms/images/remove.png" onclick="remove();" style="width:25px; height:25px; cursor: pointer;" alt="Remove" />'
            +'</td>'
         +'</tr>');
    }
    
    /*<img src="../../../pictures/add.png" class="rmv" alt="Add" title="Add" style="width:25px; height:25px; cursor: pointer;" onclick="assayTheoAdd(`ssrtc`);" >
    <img src="../../../pictures/cancel.png" class="rmv" alt="Remove" title="Remove" style="width:25px; height:25px; cursor: pointer;" onclick="assayTheoRemove(`ssrtc`);" >*/
    
    

    /*$(tRowId).after('<tr class="' + id + '_body" id="' + id + '_tr' + stdIdNo + '">'
       + '<th colspan="2" >'
          + '<table width="100%" style="font-size:12px; font-weight:normal; border-collapse: separate; border-spacing:0px 2px;">'
             + '<tbody>'
                  + '<tr>'
                     + '<th>Vol of Aliquot (' + stdIdNo + ')</th>'
                      + '<th>'
                           + '<input type="number" class="form-control input-sm" style="text-align:center;" id="' + id + '_isvoa' + stdIdNo + '" name="' + id + '_isvoa[]" placeholder="100" step="any" onchange="criSolution(`' + id + '`,' + stdIdNo + ');" >'
                      + '</th>'
                  + '</tr>'
                  + '<tr>'
                     + '<th>Dilution, mL (' + stdIdNo + ')</th>'
                      + '<th>'
                           + '<input type="number" class="form-control input-sm" style="text-align:center;" id="' + id + '_isdil' + stdIdNo + '" name="' + id + '_isdil[]" placeholder="100" step="any" onchange="criSolution(`' + id + '`,' + stdIdNo + ');" >'
                      + '</th>'
                  + '</tr>'
             + '</tbody>'
          + '</table>'
        + '</th>'
   + '</tr>');*/
}

/*function customerSession(id)
{
    var s =  sessionStorage.setItem("cust_id", id);
    alert(sessionStorage.getItem("cust_id"));
    return s;
}*/

function addPar()
{
    "use strict";
    var name, row = 0;
    var rowCount = $('tbody[id="particulars"] tr').length;
    
    //alert(rowCount);
    
    /*$('#par' + (rowCount-1)).after('<tr id="par' + rowCount + '">'
        +'<th>'
            +'<label style="color: #3c8dbc;">' + (rowCount+1) + '</label>'
        +'</th>'
        +'<td>'
            + '<input type="text" id="code' + rowCount + '" class="form-control" name="Particulars[code][]" maxlength="50">'
        +'</td>'
        +'<td>'
            + '<textarea id="description' + rowCount + '" class="form-control" name="Particulars[description][]" maxlength="1000" rows="1" aria-invalid="true"></textarea>'
        +'</td>'
        +'<td>'
            + '<input type="number" id="amount' + rowCount + '" class="form-control" name="Particulars[amount][]" onchange="totalAmount();" >'
        +'</td>'
        +'<td>'
            +'<img src="/opms/images/remove.png" id="rmv0" onclick="remove();" style="width:25px; height:25px; cursor: pointer;" alt="Remove" />'
        +'</td>'
     +'</tr>');*/
    $('#par' + (rowCount-1)).after('<tr id="par' + rowCount + '">'
        +'<th>'
            +'<label style="color: #3c8dbc;">' + (rowCount+1) + '</label>'
        +'</th>'
        +'<td>'
            + '<label style="color: #3c8dbc;">Code</label>'
            + '<input type="text" id="code' + rowCount + '" class="form-control" name="code[]" maxlength="50" aria-required="true" aria-invalid="true" required="">'
        +'</td>'
        +'<td>'
            + '<label style="color: #3c8dbc;">Description</label>'
            + '<textarea id="description' + rowCount + '" class="form-control" name="description[]" maxlength="500" rows="1" aria-required="true" required=""></textarea>'
        +'</td>'
        +'<td>'
            + '<label style="color: #3c8dbc;">Amount</label>'
            + '<input type="number" id="amount' + rowCount + '" class="form-control" name="amount[]" onchange="totalAmount();" aria-required="true" required="">'
        +'</td>'
        +'<td>'
            +'<img src="/opms/images/remove.png" id="rmv0" onclick="remove();" style="width:25px; height:25px; cursor: pointer;" alt="Remove" />'
        +'</td>'
     +'</tr>');
}

function totalAmount()
{
    var total = 0;
    //alert('yes');
    $('input[type="number"][name="amount[]"]').each(function () {
    //$('input[type="number"][name="Particulars[amount][]"]').each(function () {
    //$('input[type="number"][name="Particulars[amount]"]').each(function () {
        total = total + Number($(this).val());
    });
    $('#request-total_amount').val(total.toFixed(2));
}
