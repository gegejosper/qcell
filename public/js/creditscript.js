$(document).ready(function() {

    $(document).on('click', '.paymentmodal', function() {
          
          $('#fid').val($(this).data('id'));
          $('#bill_id').val($(this).data('billid'));
          $('#account_id').val($(this).data('acountid'));
          $('#credit_id').val($(this).data('creditid'));
          $('#amount_to_pay').val($(this).data('amountopay'));
          $('#balance').val($(this).data('balance'));
          $('#modalpayment').modal('show');
      });

    $('.modal-footer').on('click', '.processpayment', function() {
  
        $.ajax({
            type: 'post',
            url: '/admin/bill/pay',
            data: {
                //_token:$(this).data('token'),
                '_token': $('input[name=_token]').val(),
                'bill_id': $("#bill_id").val(),
                'credit_id': $("#credit_id").val(),
                'account_id': $("#account_id").val(),
                'amount': $('#amount').val(),
                'balance': $('#balance').val()
            },
            success: function(data) {
              alert('Payment Success');
              location.reload();
             
              }
        });
    });

});
  