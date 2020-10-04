<!DOCTYPE html>
<html lang="en">
<head>
  <title>PHP Ajax Crud using JQuery UI Dialog Box</title>  

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
  <div class="container">
        <br>
        <h3 align="center">PHP Ajax Crud using JQuery UI Dialog</h3><br />
        <br>
        <div>
          <select id="selectT">
            <option value="select">1. Please select</option>
            <option value="set_act">2. Set active</option>
            <option value="set_noact">3. Set not active</option> 
            <option value="del">4. Delete</option> 
          </select>
          <button id="buttonOkTop">ok</button>
          <button type="button" name="add" class="add" data-toggle="modal" data-target="#user_dialog">
          add
          </button>
        </div>
        <br>
        <div class="table-responsive" id="user_data">
          
        </div>
        <div>
          <select id="selectB">
            <option value="select">1. Please select</option>
            <option value="set_act">2. Set active</option>
            <option value="set_noact">3. Set not active</option> 
            <option value="del">4. Delete</option> 
          </select>
          <button id="buttonOkBotom">ok</button>
          <button type="button" name="add" class="add" data-toggle="modal" data-target="#user_dialog">
          add
          </button>
        </div>
      
     
      
      <div id="action_alert" title="Action">
        
      </div>
      
       <div class="modal" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          <p>Are you sure you want to Delete this data?</p>
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
          <button type="button" id="" class="btn btn-primary del_ok" data-dismiss="modal">Ok</button>
        </div>
        
      </div>
    </div>
  </div>
   
    <!-- 
      ***
      The Modal 
      ***
    -->
    <div class="modal fade" id="user_dialog" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" id="user_form">
        <div class="modal-body">
          <div class="form-group">
            <label>Enter First Name</label>
            <input type="text" name="first_name" id="first_name" class="form-control" />
            <span id="error_first_name" class="text-danger"></span>
          </div>
          <div class="form-group">
            <label>Enter Last Name</label>
            <input type="text" name="last_name" id="last_name" class="form-control" />
            <span id="error_last_name" class="text-danger"></span>
          </div>
          <div class="form-group">
            <label>Status</label>
            <br>
            <label class="switch">
              <input type="checkbox" checked name="status" id="status">
              <span class="slider round"></span>
            </label>
          </div>
          <div class="form-group">
            <label>Role</label><br>
            <select id="select_Adm" name="role">
              <option value="admin">Admin</option>
              <option value="user">User</option>
            </select>
          </div>
          <hr>
          <div class="form-group">
            <input type="hidden" name="action" id="action" value="insert" />
            <input type="hidden" name="hidden_id" id="hidden_id" />
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="myButton" class="btn btn-primary">Save changes</button>
        </div>
        </form>
      </div>
    </div>
  </div>
  
</div>

</body>
<script src="jquery.js"></script>
<script >
  $(document).ready(function(){
    $(document).on('click', '.edit', function(){
      var id = $(this).attr('id');
      var action = 'fetch_single';
      $.ajax({
        url:"action.php",
        method:"POST",
        data:{id:id, action:action},  
        success:function(response)
        {
          var data = $.parseJSON(response);
          $('#first_name').val(data.first_name);
          $('#last_name').val(data.last_name);
          if (data.status == 1) 
            $('#status').prop('checked',true);
          else
            $('#status').prop('checked',false);
          if (data.role == 1) 
            $('#select_Adm ').val('admin');
          else
            $('#select_Adm ').val('user');
          $('#staticBackdropLabel').text('Edit Data');
          $('#action').val('update');
          $('#hidden_id').val(id);
          $('#myButton').text('Update');
          $('#user_dialog').modal("show");
        }
      });
    });
  });
</script>
</html>
