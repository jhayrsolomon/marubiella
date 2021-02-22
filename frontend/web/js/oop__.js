$(document).ready(function () {
    //$('a[href="' + this.location.pathname + '"]').parent().addClass('active');
    // Remove active for all items.
    $('.page-sidebar-menu li').removeClass('active');

    // highlight submenu item
    $('li a[href="' + this.location.pathname + '"]').parent().addClass('active');

    // Highlight parent menu item.
    $('ul a[href="' + this.location.pathname + '"]').parents('li').addClass('active');
});

function checkOop() {
    var submit = true;
    var fund = $('#fund').val();
    var incomeCode = $('#incomeCode').val();
    var toPay = $('input[type="number"][name="toPay[]"]');
    var trustFund = $('input[type="number"][name="trustFund[]"]');
    
    if (fund.length != 0 && incomeCode.length != 0) {
        if (fund == 2) {
            toPay.each(function (i) {
                if(!isNaN($(this).val()) && !isNaN($('#tf' + i).val()) && Number($(this).val()) != 0 && Number($('#tf' + i).val()) != 0) {
                    submit = true;
                } else {
                    submit = false;
                    alert('Please Fill in the Required Field/s.');
                }
            });
        } else {
            toPay.each(function () {
                if(!isNaN($(this).val()) && Number($(this).val()) != 0) {
                    submit = true;
                } else {
                    submit = false;
                    alert('Please Fill in the Required Field/s.');
                }
            });
        }
    } else {
        submit = false;
        alert('Please Fill in the Required Fields.');
    }
    
    return submit;
}

function validateDate() {
    var request = $('#request-request_date').val();
    var due = $('#request-due_date').val();
    if(request>=due){
        alert('Due Date must ahead from Request Date.');
        $('#request-due_date').val('');
    }
}

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
                 var name;
                 if(data['type'] == 'collection'){
                     name = 'collection_name';
                 } else {
                     name = 'service_title';
                 }
                 $('#incomeCode option').each(function(){
                     $(this).remove();
                 });
                 $('#incomeCode').append('<option value="">Select Income Code</option>');
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

function addPar()
{
    "use strict";
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
            //+ '<label style="color: #3c8dbc;">Sample Code</label>'
            + '<input type="text" id="code' + rowCount + '" class="form-control" name="code[]" maxlength="50" aria-required="true" aria-invalid="true" placeholder="Sample Code" required>'
        +'</td>'
        +'<td>'
            //+ '<label style="color: #3c8dbc;">Description</label>'
            + '<textarea id="description' + rowCount + '" class="form-control" name="description[]" maxlength="500" rows="1" aria-required="true" required></textarea>'
        +'</td>'
        +'<td>'
            //+ '<label style="color: #3c8dbc;">Amount</label>'
            + '<input type="number" id="amount' + rowCount + '" class="form-control" name="amount[]" onchange="totalAmount();" aria-required="true" placeholder="0.00" required>'
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

function orCategory()
{
    var select = $('#or_category option:selected').val();
    //alert(select);
    
    if (select == '') {
        $('input[type="text"][name="or_number"]').val('00000');
    } else {
        //$('input[type="text"][name="or_number"]').val(select);
        $.ajax({
             url: 'getornumber',
             type: 'post',
             data: {id : select},
             success: function (data) {
                 console.log(data);
                 if(data['next'] <= data['end']){
                     $('input[type="text"][name="or_number"]').val(data['next']);
                 } else {
                     alert('Please create/activate valid OR Series. ');
                     ('input[type="text"][name="or_number"]').val('00000');
                 }
             },
            error: function(xhr, status, error){
                alert('No OR Series for this category.');
                alert('Please create/activate valid OR Series for this Category.');
                $('input[type="text"][name="or_number"]').val('00000');
            },
        });
    }
}

function modeOfPayment(id, gf, tf)
{
    var checkbox = $('input[type="checkbox"][id="' + id + '"]:checked');
    console.log(checkbox.val());
    console.log(id);
    if(checkbox.val()){
        if(checkbox.val() == 2){
            $('#checkDetails').removeAttr('hidden');
            $('input[type="text"][name="check_type[]"]').removeAttr('readonly').attr('required', true);
            $('input[type="text"][name="check_bank_name[]"]').removeAttr('readonly').attr('required', true);
            $('input[type="text"][name="check_bank_branch[]"]').removeAttr('readonly').attr('required', true);
            $('input[type="text"][name="check_number[]"]').removeAttr('readonly').attr('required', true);
            $('input[type="date"][name="check_date[]"]').removeAttr('readonly').attr('required', true);
            $('input[type="number"][name="check_amount[]"]').removeAttr('readonly').attr('required', true);
        }
        if(checkbox.val() == 4){
            $('#lddapDetails').removeAttr('hidden');
            $('input[type="text"][name="lddap_name[]"]').removeAttr('readonly').attr('required', true);
            $('input[type="text"][name="lddap_bank_branch[]"]').removeAttr('readonly').attr('required', true);
            $('input[type="text"][name="lddap_number[]"]').removeAttr('readonly').attr('required', true);
            $('input[type="date"][name="lddap_date[]"]').removeAttr('readonly').attr('required', true);
            $('input[type="number"][name="lddap_amount[]"]').removeAttr('readonly').attr('required', true);
        }
        $('.'+id).removeAttr('readonly').attr('required', true);
        
    } else {
        if(id == "check"){
            $('#checkDetails').attr('hidden', true);
            $('input[type="text"][name="check_type[]"]').removeAttr('required').attr('readonly', true);
            $('input[type="text"][name="check_bank_name[]"]').removeAttr('required').attr('readonly', true);
            $('input[type="text"][name="check_bank_branch[]"]').removeAttr('required').attr('readonly', true);
            $('input[type="text"][name="check_number[]"]').removeAttr('required').attr('readonly', true);
            $('input[type="date"][name="check_date[]"]').removeAttr('required').attr('readonly', true);
            $('input[type="number"][name="check_amount[]"]').removeAttr('required').attr('readonly', true);
        }
        if(id == "lddap"){
            $('#lddapDetails').attr('hidden', true);
            $('input[type="text"][name="lddap_name[]"]').removeAttr('required').attr('readonly', true);
            $('input[type="text"][name="lddap_bank_branch[]"]').removeAttr('required').attr('readonly', true);
            $('input[type="text"][name="lddap_number[]"]').removeAttr('required').attr('readonly', true);
            $('input[type="date"][name="lddap_date[]"]').removeAttr('required').attr('readonly', true);
            $('input[type="number"][name="lddap_amount[]"]').removeAttr('required').attr('readonly', true);
        }
        $('.'+id).removeAttr('required').attr('readonly', true);
    }
}

function checkType()
{
    $.ajax({
        url: 'getchecktype',
        type: 'post',
        data: {},
        success: function (data) {
            console.log(data);
            var rowCount = $('tbody[id="checkTable"] tr').length;
            //console.log(rowCount);
            //$('#check_type' + (rowCount-1)).append('<option value="">Select Check Type</option>');
            $.each(data, function(key, value){
                console.log(value.check_code);
                $('#check_type' + (rowCount-1)).append('<option value="' + value.id + '">' + value.check_code + '</option>');
            });
        },
        error: function(xhr, status, error){
        },
    });
}

function addCheckDetails(){
    "use strict";
    var rowCount = $('tbody[id="checkTable"] tr').length;
    
    $('#checkDetails' + (rowCount-1)).after('<tr id="checkDetails' + rowCount + '">'
        +'<td>' + (rowCount+1) + '</td>'
        +'<td>'
            /*+'<div class="form-group">'
                +'<input class="form-control" type="text" name="check_type[]" id="check_type' + rowCount + '" placeholder="Check Type" required />'
            +'</div>'*/
            +'<div class="form-group col-lg-12">'
                +'<select class="form-control" name="check_type[]" id="check_type' + rowCount + '" >'
                    +'<option value="">Select Check Type</option>'
                +'</select>'
            +'</div>'
        +'</td>'
        +'<td>'
            +'<div class="form-group">'
                +'<input class="form-control" type="text" name="check_bank_name[]" id="check_bank_name' + rowCount + '" placeholder="Bank Name" required />'
            +'</div>'
        +'</td>'
        +'<td>'
            +'<div class="form-group">'
                +'<input class="form-control" type="text" name="check_bank_branch[]" id="check_bank_branch' + rowCount + '" placeholder="Bank Branch Name" required />'
            +'</div>'
        +'</td>'
        +'<td>'
            +'<div class="form-group">'
                +'<input class="form-control" type="text" name="check_number[]" id="check_number' + rowCount + '" placeholder="Check Number" required />'
            +'</div>'
        +'</td>'
        +'<td>'
            +'<div class="form-group">'
                +'<input class="form-control" type="date" name="check_date[]" id="check_date' + rowCount + '" required />'
            +'</div>'
        +'</td>'
        +'<td>'
            +'<div class="form-group">'
                +'<input class="form-control" type="number" name="check_amount[]" id="check_amount' + rowCount + '" placeholder="0.00" required />'
            +'</div>'
        +'</td>'
    +'</tr>');
    
    checkType();
}
function addLddapDetails(){
    "use strict";
    var rowCount = $('tbody[id="lddapTable"] tr').length;
    
    $('#lddapDetails' + (rowCount-1)).after('<tr id="lddapDetails' + rowCount + '">'
        +'<td>' + (rowCount+1) + '</td>'
        +'<td>'
            +'<div class="form-group">'
                +'<input class="form-control" type="text" name="lddap_name[]" id="lddap_name' + rowCount + '" placeholder="LDDAP Name" required />'
            +'</div>'
        +'</td>'
        +'<td>'
            +'<div class="form-group">'
                +'<input class="form-control" type="text" name="lddap_bank_branch[]" id="lddap_bank_branch' + rowCount + '" placeholder="Bank Branch Name" required />'
            +'</div>'
        +'</td>'
        +'<td>'
            +'<div class="form-group">'
                +'<input class="form-control" type="text" name="lddap_number[]" id="lddap_number' + rowCount + '" placeholder="Check Number" required />'
            +'</div>'
        +'</td>'
        +'<td>'
            +'<div class="form-group">'
                +'<input class="form-control" type="date" name="lddap_date[]" id="lddap_date' + rowCount + '" placeholder="Date" required />'
            +'</div>'
        +'</td>'
        +'<td>'
            +'<div class="form-group">'
                +'<input class="form-control" type="number" name="lddap_amount[]" id="lddap_amount' + rowCount + '" placeholder="0.00" required />'
            +'</div>'
        +'</td>'
    +'</tr>');
}

function validateOfficialReceipt()
{
    "use strict";
    
    var mode = $('input[type="checkbox"][name="mode_of_payment[]"]:checked').length;
    var orNum = $('#or_number').val();
    var payor = $('#payor_name').val();
    var amountToPay = Number($('#amount_to_pay').val());
    var totalAmount = Number($('#total_amount').val());
    
    alert(mode);
    
    if(mode != 0 && orNum != '0000000000' && payor != '' && amountToPay === totalAmount){
        alert(mode);
        return true;
    } else {
        alert('Please fill in required fields and select mode/s of payment.');
        alert('Please total amount paid is equal to total amount to pay.');
        
        return false;
    }
}

function amountOfPayment(id)
{
    var gen = Number($('#general' + id).val());
    var trust = Number($('#trust' + id).val());
    var sub = gen+trust;
    var tgf = 0;
    var ttf = 0;
    var total = 0;
    $('#total' + id).val(sub.toFixed(2));
    for(x=1; x <= 4; x++){
        
        ttf += Number($('#trust' + x).val());
        tgf += Number($('#general' + x).val());
        total += Number($('#total' + x).val());
        console.log(total);
    }
    $('#total_gf_amount').val(tgf.toFixed(2));
    $('#total_tf_amount').val(ttf.toFixed(2));
    $('#total_amount').val(total.toFixed(2));
}


