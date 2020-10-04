 $(document).ready(function(){  
  load_data();
  function load_data(){
    $.ajax({
      url:"fetch.php",
      method:"POST",
      success:function(data)
      {
        $('#user_data').html(data);
      }
    });
  }
  $('#buttonOkTop').click(function(){
    if (!$('.controls [type=checkbox]').is(':checked')){
      alert ("Виберіть юзера");
    }else{
      if($('#selectT option:selected').text() == '1. Please select'){
       alert ("Виберіть варіант");
      }
      /*
        Makes choose user active
      */
      if($('#selectT option:selected').text() == '2. Set active'){
        var id='', isChecked='';
          $('.controls input:checkbox:checked').each(function(){
            id += $(this).attr('id')+',';
            isChecked += $(this).attr('checked');
              
          });
           $.ajax({
            url:"action.php",
            method:"POST",
            data:{
              action: 'setAct',
                    id: id, 
                    isChecked: isChecked 
                    },
            success:function(data)
            {
              alert("Selected users are active");
              load_data();
            }
          }); 
      }
      /*
        Makes choose user not active
      */
      if($('#selectT option:selected').text() == '3. Set not active'){
        var id='', isChecked='';
          $('.controls input:checkbox:checked').each(function(){
            id += $(this).attr('id')+',';
            isChecked += $(this).attr('checked');
          });
           $.ajax({
            url:"action.php",
            method:"POST",
            data:{
              action: 'setNoAct',
              id: id, 
              isChecked: isChecked 
            },
            success:function(data)
            {
              alert("Selected users are no active");
              load_data();
            }
          }); 
      } 
      /*
        Makes choose user not active
      */
      if ($('#selectT option:selected').text() == '4. Delete'){
        var id='', isChecked='';
          $('.controls input:checkbox:checked').each(function(){
            id += $(this).attr('id')+',';
            isChecked += $(this).attr('checked');
              
          });
           $.ajax({
            url:"action.php",
            method:"POST",
            data:{
              action: 'del',
                    id: id, 
                    isChecked: isChecked 
                    },
            success:function(data)
            {
              alert("Selected users are deleted");
              load_data();
            }
        }); 
      }
    }
  });
  $('#buttonOkBotom').click(function(){
    if (!$('.controls [type=checkbox]').is(':checked')){
      alert ("Виберіть юзера");
    }else{
      if($('#selectB option:selected').text() == '1. Please select'){
       alert ("Виберіть варіант");
      }
      /*
        Makes choose user active
      */
      if($('#selectB option:selected').text() == '2. Set active'){
        var id='', isChecked='';
          $('.controls input:checkbox:checked').each(function(){
            id += $(this).attr('id')+',';
            isChecked += $(this).attr('checked');
              
          });
           $.ajax({
            url:"action.php",
            method:"POST",
            data:{
              action: 'setAct',
                    id: id, 
                    isChecked: isChecked 
                    },
            success:function(data)
            {
              load_data();
              alert("Selected users are active");
            }
          }); 
      }
      /*
        Makes choose user not active
      */
      if($('#selectB option:selected').text() == '3. Set not active'){
        var id='', isChecked='';
          $('.controls input:checkbox:checked').each(function(){
            id += $(this).attr('id')+',';
            isChecked += $(this).attr('checked');
          });
           $.ajax({
            url:"action.php",
            method:"POST",
            data:{
              action: 'setNoAct',
              id: id, 
              isChecked: isChecked 
            },
            success:function(data)
            {
              load_data();
              alert("Selected users are no active");
            }
          }); 
      } 
      /*
        Makes choose user not active
      */
      if ($('#selectB option:selected').text() == '4. Delete'){
        var id='', isChecked='';
          $('.controls input:checkbox:checked').each(function(){
            id += $(this).attr('id')+',';
            isChecked += $(this).attr('checked');
              
          });
           $.ajax({
            url:"action.php",
            method:"POST",
            data:{
              action: 'del',
                    id: id, 
                    isChecked: isChecked 
                    },
            success:function(data)
            {
              load_data();
              alert("Selected users are deleted");
            }
        }); 
      }
    }
  });
  $('#user_form').on('submit', function(event){
    event.preventDefault();
    var error_first_name = '';
    var error_last_name = '';
    if($('#first_name').val() == '')
    {
      error_first_name = 'First Name is required';
      $('#error_first_name').text(error_first_name);
      $('#first_name').css('border-color', '#cc0000');
    }
    else
    {
      error_first_name = '';
      $('#error_first_name').text(error_first_name);
      $('#first_name').css('border-color', '');
    }
    if($('#last_name').val() == '')
    {
      error_last_name = 'Last Name is required';
      $('#error_last_name').text(error_last_name);
      $('#last_name').css('border-color', '#cc0000');
    }
    else
    {
      error_last_name = '';
      $('#error_last_name').text(error_last_name);
      $('#last_name').css('border-color', '');
    }
    
    if(error_first_name != '' || error_last_name != '')
    {
      return false;
    }
    else
    {
      $('#form_action').attr('disabled', 'disabled');
      var form_data = $(this).serialize();
      $.ajax({
        url:"action.php",
        method:"POST",
        data:form_data,
        success:function(data)
        {
          alert(data);
          $("#user_dialog").modal("hide");
          load_data();

        }
      });
    }
  });
  $('.add').click(function(){
    $('#staticBackdropLabel').text('Add Data');
    $('#action').val('insert');
    $('#myButton').text('Insert');
    $('#user_form')[0].reset();
  });
  $(document).on('click', '.delete', function(){
    var id = $(this).attr("id");
    $('#myModal').data('id', id).modal('show');
    $('.del_ok').attr("id",id);
    // $('#delete_confirmation').data('id', id).dialog('open');
  });
  $('.del_ok').click(function(){
    var id =$(this).attr("id");
 $.ajax({
            url:"action.php",
            method:"POST",
            data:{
              action: 'delete',
                    id: id
                    },
            success:function(data)
            {
              load_data();
              alert("Date deleted");
            }
          }); 
  });

});