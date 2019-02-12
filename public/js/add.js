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
      user_id: $('#product-person').val(),
      _token : $('meta[name="csrf-token"]').attr('content'),

    },
    success: function(result) {
      if (result.errors) {
        jQuery.each(result.errors, function(key, value){
          jQuery('.alert-danger').show();
          jQuery('.alert-danger').append('<p>'+value+'</p>');
        });
      } else{
        $('#add-product').modal('hide');
        var newData = '';
        var total_fee = document.getElementById('total-fee').innerHTML;
        total_fee = total_fee.replace(/,/g , '');
        total_fee = total_fee.replace(/ VND/g , '');
        total_fee = parseInt(total_fee);
        result_fee = parseInt(result.total_fee);
        total_fee += result_fee;
     
        newData += '<tr><td>' + result.id + '</td><td>' + result.name +'</td><td>' + result.type 
          + '</td><td>' + result.quantity + '</td><td>' + result.created_at + 
          '</td><td>'+ result.user_id + '</td><td>' + result.total_fee + '</td></tr>';
        
        newTotalFee = total_fee.toLocaleString(
            undefined, { minimumFractionDigits: 0 });;
        $('.alert').show();
        jQuery('.alert').html("Added successfully!!");
        $('#table').fadeOut();
        $('#table').prepend(newData);
        $('#total-fee').html(newTotalFee);
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
