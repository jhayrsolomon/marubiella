$(document).ready(function(){
    $('#employeeaddress-municipality_id').on('change', function(){
        var municipality_id = $('#employeeaddress-municipality_id').val();
        //alert(municipality_id);
        $.ajax({
            url: 'loadbarangay',
            type: 'post',
            data: {municipality_id: municipality_id},
            success: function (data) {
                //console.log(data);
                $('#employeeaddress-barangay_id option').each(function(){
                    $(this).remove();
                });
                $('#employeeaddress-barangay_id').append('<option value="">Select Barangay</option>');
                $.each(data, function(key, value){
                    //console.log(value['id'] + " : " + value['brgyDesc']);
                    $('#employeeaddress-barangay_id').append('<option value="' + value['id'] + '">' + value['brgyDesc'] + '</option>');
                });
            }
        });
    });
    
    $('#employeeaddress-province_id').on('change', function(){
        var province_id = $('#employeeaddress-province_id').val();
        var region_id = $('#employeeaddress-region_id').val();
        //alert(province_id);
        $.ajax({
            url: 'loadmunicipality',
            type: 'post',
            data: {province_id: province_id},
            success: function (data) {
                //console.log(data);
                $('#employeeaddress-municipality_id option').each(function(){
                    $(this).remove();
                });
                $('#employeeaddress-municipality_id').append('<option value="">Select Municipality</option>');
                $.each(data, function(key, value){
                    //console.log(value['municipality_id'] + " : " + value['description']);
                    $('#employeeaddress-municipality_id').append('<option value="' + value['id'] + '">' + value['citymunDesc'] + '</option>');
                });
            }
        });
    });
    
    $('#employeeaddress-region_id').on('change', function(){
        var region_id = $('#employeeaddress-region_id').val();
        //alert(region_id);
        $.ajax({
             url: 'loadprovince',
             type: 'post',
             data: {region_id: region_id},
             success: function (data) {
                 //console.log(data);
                 $('#employeeaddress-province_id option').each(function(){
                     $(this).remove();
                 });
                 $('#employeeaddress-province_id').append('<option value="">Select Province</option>');
                 $.each(data, function(key, value){
                     //console.log(value['province_id'] + " : " + value['description']);
                     $('#employeeaddress-province_id').append('<option value="' + value['id'] + '">' + value['provDesc'] + '</option>');
                 });
             }

        });
    });
});

$(document).ready(function(){
    $('#customer-municipality_id').on('change', function(){
        var municipality_id = $('#customer-municipality_id').val();
        //alert(municipality_id);
        $.ajax({
            url: 'loadbarangay',
            type: 'post',
            data: {municipality_id: municipality_id},
            success: function (data) {
                //console.log(data);
                $('#customer-barangay_id option').each(function(){
                    $(this).remove();
                });
                $('#customer-barangay_id').append('<option value="">Select Barangay</option>');
                $.each(data, function(key, value){
                    //console.log(value['id'] + " : " + value['brgyDesc']);
                    $('#customer-barangay_id').append('<option value="' + value['id'] + '">' + value['brgyDesc'] + '</option>');
                });
            }
        });
    });
    
    $('#customer-province_id').on('change', function(){
        var province_id = $('#customer-province_id').val();
        //alert(province_id);
        $.ajax({
            url: 'loadmunicipality',
            type: 'post',
            data: {province_id: province_id},
            success: function (data) {
                //console.log(data);
                $('#customer-municipality_id option').each(function(){
                    $(this).remove();
                });
                $('#customer-municipality_id').append('<option value="">Select Municipality</option>');
                $.each(data, function(key, value){
                    //console.log(value['municipality_id'] + " : " + value['description']);
                    $('#customer-municipality_id').append('<option value="' + value['id'] + '">' + value['citymunDesc'] + '</option>');
                });
            }
        });
    });
    
    $('#customer-region_id').on('change', function(){
        var region_id = $('#customer-region_id').val();
        //alert(region_id);
        $.ajax({
             url: 'loadprovince',
             type: 'post',
             data: {region_id: region_id},
             success: function (data) {
                 console.log(data);
                 $('#customer-province_id option').each(function(){
                     $(this).remove();
                 });
                 $('#customer-province_id').append('<option value="">Select Province</option>');
                 $.each(data, function(key, value){
                     //console.log(value['province_id'] + " : " + value['description']);
                     $('#customer-province_id').append('<option value="' + value['id'] + '">' + value['provDesc'] + '</option>');
                 });
             }

        });
    });
});

function time(stat){
    var timedate;
    var td = new Date();
    timedate = td.getHours()+':'+td.getMinutes()+':'+td.getSeconds();
    console.log('Time '+ stat +': '+ timedate);
    $.ajax({
        url: '/marubiella/sales/dashboard/addtimerecord',
        type: 'post',
        data: {stat: stat, timedate: timedate},
        success: function (data) {
            alert(data);
            setInterval(location.reload(), '5000');
            //console.log(data);
        }
    });
}

function getDetails(id){
    //$('#salesonline-product_id'+id).on('change', function(){
        var prod_id = $('#product_id'+id).val();
        $.ajax({
             url: 'getproductdetails',
             type: 'post',
             data: {prod_id: prod_id},
             success: function (data) {
                 console.log(data);
                 var amount = Number(data['amount'])*1;
                 $('#quantity'+id).val(1);
                 $('#collectible_amount'+id).val(amount.toFixed(2));
                 var col_amount = $('input[name="collectible_amount[]"]').map(function(){return $(this).val();}).get();
                 var total = 0;
                 console.log(col_amount);
                 $.each(col_amount, function(key, value){
                    total += Number(value);
                 });
                 $('#salesonline-total_amount').val(total);
             }
        });
    //});
}

function getQuantity(id){
    //$('#salesonline-quantity'+id).on('change', function(){
        var prod_id = $('#product_id'+id).val();
        $.ajax({
             url: 'getproductdetails',
             type: 'post',
             data: {prod_id: prod_id},
             success: function (data) {
                 //console.log(data);
                 var quantity = Number($('#quantity'+id).val());
                 var amount = data['amount']*quantity;
                 $('#collectible_amount'+id).val(amount.toFixed(2));
                 var col_amount = $('input[name="collectible_amount[]"]').map(function(){return $(this).val();}).get();
                 var total = 0;
                 console.log(col_amount);
                 $.each(col_amount, function(key, value){
                     total += Number(value);
                 });
                 $('#salesonline-total_amount').val(total.toFixed(2));
             }
        });
    //});
}
function addRowProduct(){
    var rowCount = $('#productRow tr').length;
    //console.log(rowCount);
    $.ajax({
         url: 'getproductsall',
         //type: 'post',
         //data: {prod_id: prod_id},
         success: function (data) {
             console.log(data);
             var row = '<tr>'
                +'<th class="text-center">'+(rowCount+1)+'</th>'
                +'<td>'
                    +'<div class="form-group field-product_id'+rowCount+' required has-error">'
                        +'<label class="control-label" for="product_id'+rowCount+'"></label>'
                        +'<select id="product_id'+rowCount+'" class="form-control form-control-sm" name="product_id[]" aria-required="true" aria-invalid="true" onchange="getDetails('+rowCount+');">'
                            +'<option value="">Select Product</option>';
                            $.each(data, function(key, value){
                                 row += '<option value="'+value['id']+'">'+value['product_name']+'</option>';
                             });
                        row +='</select>'
                        +'<div class="help-block">Product ID cannot be blank.</div>'
                    +'</div>'                            
                +'</td>'
                +'<td>'
                    +'<div class="form-group field-quantity'+rowCount+' required">'
                        +'<label class="control-label" for="quantity'+rowCount+'"></label>'
                        +'<input type="number" id="quantity'+rowCount+'" class="form-control form-control-sm" name="quantity[]" placeholder="Quantity" aria-required="true" onchange="getQuantity('+rowCount+');">'
                        +'<div class="help-block"></div>'
                    +'</div>'                            
                +'</td>'
                +'<td>'
                    +'<div class="form-group field-collectible_amount'+rowCount+' required">'
                        +'<label class="control-label" for="collectible_amount'+rowCount+'"></label>'
                        +'<input type="number" id="collectible_amount'+rowCount+'" class="form-control form-control-sm" name="collectible_amount[]" readonly="" placeholder="0.00" aria-required="true">'
                        +'<div class="help-block"></div>'
                    +'</div>'                            
                +'</td>'
                +'<td></td>'
            +'</tr>';
            $('#productRow').append(row);
         }
    });
}