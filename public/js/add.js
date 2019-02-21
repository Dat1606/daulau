$(document).ready(function() {
  $('#ajaxSubmit').click(function(e) {
    e.preventDefault();
  $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: "/group_consumptions",
    type: 'post',
    data: {
      group_id: $('#group-id').val(),
      name: $('#product-name').val(),
      quantity: $('#product-quantity').val(),
      total_fee: $('#product-fee').val(),
      type: $('#product-type').val(),
      user_id: $('#user_id').val(),
      creator_id: $('#creator_id').val(),
      _token : $('meta[name="csrf-token"]').attr('content'),
    },
    success: function(result) {
      if (result.errors) {
        jQuery.each(result.errors, function(key, value){
          jQuery('.alert-danger').show();
          jQuery('.alert-danger').append('<p>'+value+'</p>');
        });
      } else{
        var type = {
          1: 'Food',
          2: 'General Product',
          3: 'Water Bill',
          4: 'Electricity Bill',
          5: 'Hire Fee',
          6: 'Others',
        }
        var total_fee = document.getElementById('total-fee').innerHTML;
        total_fee = total_fee.replace(/,/g , '');
        total_fee = total_fee.replace(/ VND/g , '');
        total_fee = parseInt(total_fee);
        result_fee = parseInt(result.groupConsumption.total_fee);
        total_fee += result_fee;
        newTotalFee = total_fee +' VND'
        $('#total-fee').html(newTotalFee);
        $('#add-product').modal('hide');
        var newData = $('#group-consumption-template').html();
        newData = newData.replace(/%%group_consumption_id%%/g , result.groupConsumption.id);
        newData = newData.replace('%%group_consumption_name%%', result.groupConsumption.name.substring(0,12));
        newData = newData.replace('%%group_consumption_type%%', type[result.groupConsumption.type]);
        newData = newData.replace('%%group_consumption_quantity%%', result.groupConsumption.quantity);
        newData = newData.replace('%%group_consumption_created_at%%', result.groupConsumption.created_at);
        newData = newData.replace('%%user_id%%', result.buyerName);
        newData = newData.replace('%%creator_id%%', result.creatorName);
        newData = newData.replace('%%group_consumption_total_fee%%', result.groupConsumption.total_fee);
        $('#table').prepend(newData);
        $('.alert').show();
        jQuery('.alert').html("Added successfully!!");
        $('#table').fadeOut();
        $('#table').fadeIn();
    }}
  });
  });
});


$(document).ready(function() {
  $('#group-btn').click(function(e) {
    e.preventDefault();
  $.ajax({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: "/groups",
    type: 'post',
    data: {
        room_id: $('#user-room-id').val(),
        name: $('#group-name').val(),
        _token : $('meta[name="csrf-token"]').attr('content'),
    },
    success: function(result) {
      console.log(result);
      if (result.errors) {
        jQuery.each(result.errors, function(key, value){
          jQuery('.alert-danger').show();
          jQuery('.alert-danger').append('<p>'+value+'</p>');
        });
      } else{
          window.location.reload();
      }
    }
  });
  });
});
