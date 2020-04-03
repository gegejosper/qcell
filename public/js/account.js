$(document).ready(function() {
    $(document).on('click', '.edit-account', function() {

          $('#edit_id').val($(this).data('id'));
          $('#edit_fname').val($(this).data('fname'));
          $('#edit_lname').val($(this).data('lname'));
          $('#edit_mname').val($(this).data('mname'));
          $('#edit_dob').val($(this).data('dob'));
          $('#edit_address').val($(this).data('address'));
          $('#edit_gender').val($(this).data('gender'));
        
          $('#member_modal').modal('show');
          //console.log($(this).data('name') + $(this).data('points'));
      });
      $(document).on('click', '.delete-modal', function() {
          $('#footer_action_button').text(" Delete");
          $('#footer_action_button').removeClass('glyphicon-check');
          $('#footer_action_button').addClass('glyphicon-trash');
          $('.actionBtn').removeClass('btn-success');
          $('.actionBtn').addClass('btn-danger');
          $('.actionBtn').addClass('delete');
          $('.modal-title').text('Delete');
          $('.did').text($(this).data('id'));
          $('.deleteContent').show();
          $('.form-horizontal').hide();
          $('.dname').html($(this).data('name'));
          $('#myModal').modal('show');
      });
  
      $('.modal-footer').on('click', '.edit', function() {
  
          $.ajax({
              type: 'post',
              url: 'branchs/editbranchs',
              data: {
                  //_token:$(this).data('token'),
                  '_token': $('input[name=_token]').val(),
                  'id': $("#fid").val(),
                  'branch_name': $('#branchedit_name').val()
              },
              success: function(data) {
                  $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.branch_name + "</td><td class='td-actions'><button class='edit-modal btn btn-small btn-success' data-id='" + data.id + "' data-name='" + data.branch_name + "'><i class='fa fa-pencil'> </i> Edit</button><a class='delete-modal btn btn-danger btn-small' data-id='" + data.id + "'><i class='fa fa-times'></i>  Remove</a></td></tr>");
                  console.log("success");
                }
          });
      });
      $("#add").click(function() {
  
          $.ajax({
              type: 'post',
              url: 'branchs/addbranchs',
              data: {
                  '_token': $('input[name=_token]').val(),
                  'branch_name': $('input[name=branch_name]').val()
              },
              success: function(data) {
                  if ((data.errors)){
                    $('.error').removeClass('hidden');
                      $('.error').text(data.errors.name);
                  }
                  else {
                      $('.error').addClass('hidden');
                      $('#table').append("<tr class='item" + data.id + "'><td>" + data.branch_name + "</td><td class='td-actions'><button class='edit-modal btn btn-small btn-success' data-id='" + data.id + "' data-name='" + data.branch_name + " data-cashier='" + data.cashier + "'><i class='fa fa-pencil'> Edit</i></button><a class='delete-modal btn btn-danger btn-small' data-id='" + data.id + "'><i class='fa fa-times'> Remove</i></a></td></tr>");
                  }
              },
  
          });
          $('#name').val('');
      });
      $('.modal-footer').on('click', '.delete', function() {
          $.ajax({
              type: 'post',
              url: 'branchs/deletebranchs',
              data: {
                  '_token': $('input[name=_token]').val(),
                  'id': $('.did').text()
              },
              success: function(data) {
                  $('.item' + $('.did').text()).remove();
              }
          });
      });
  });
  