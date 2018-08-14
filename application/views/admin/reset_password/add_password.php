       <form class="form-horizontal" id="" method="post">
    <div class="block-flat">
        <span class="frmMsg"></span>
    <div class="row">
        <div class="form-group">
            <label class="col-sm-4 control-label" for="password">Current Password</label>
            <div class="col-sm-7">
                <div class="fg-line">
                    <input type="password" name="" class="form-control passwordCheckIndividual Currpassword" id="password"
                    value="" placeholder="Current Password"/>
                    <div id="checkIndPassword"></div>
                </div>
            </div>
            <br clear="all"/>
        </div>
    <div class="form-group">
        <label class="col-sm-4 control-label" for="SL_NO">New Password</label>
        <div class="col-sm-7">
            <div class="fg-line">
                <input type="password" name="passwordNew" id="passwordNew" class="form-control passwordIndNew"
                placeholder="New Password"/>
            </div>
        </div>
        <br clear="all"/>
    </div>
    <div class="form-group">
        <label class="col-sm-4 control-label" for="SL_NO">Confirm Password</label>
        <div class="col-sm-7">
            <div class="fg-line">
                <input type="password" name="passwordconf" id="passwordconf" class="form-control password_conf"
                placeholder="Confirm Password"/>
            </div>
        </div>
        <br clear="all"/>
    </div>
    <?php  $session_info = $this->session->userdata('logged_in');
     $userId=$session_info["USER_ID"]
    ?>
    <button class="col-sm-offset-4 btn btn-primary btn-sm  formUpdatePasswordSubmit" type="submit">Submit</button>
    <span class="loadingImg"></span>
    </div>
    </div>
    </form>

    <script type="text/javascript">
        $(document).ready(function () {
      $(document).on("click", ".formUpdatePasswordSubmit", function (e) {
         e.preventDefault();
        if (confirm("Are You Sure?")) {
            var Password =$(".Currpassword").val();        //alert(Password);
            var passwordNew = $("#passwordNew").val();
             var passwordconf = $("#passwordconf").val();
              if (Password === '' || passwordNew === '' || passwordconf === '') {
                alert('Password field is empty?');
                 return false;
                }
               if($("#passwordNew").val().length < 6){
                 alert('You have to enter at least 6 digit!');
                 $("#passwordNew").val('');
                 return false;
                }
             
            var action_uri = '<?php echo site_url('/admin/updateVisitorProfilePassword'); ?>';
            
             
             $.ajax({
                    type: "post",
                    url: action_uri,
                    data: {passwordNew: passwordNew},                     
                    success: function (data) {
                        $(".frmMsg").html(data);
                        
                    }
                });
        } else {
            return false;
        }
    });

    $(document).on("blur", ".passwordCheckIndividual", function() {
      //var USER_ID = $("#USER_ID").val();
     // alert(USER_ID);
      var password = $(this).val();
      //alert("okay");
      if(password!='')
      {
        var url = '<?php echo site_url('admin/checkUserPassword') ?>';
        $.ajax({

          type: "POST",
          url: url,
          dataType : 'html',
          data: {password: password},
          success: function(data1) {
            console.log(data1);
            if(data1 == "false"){
             // alert(data1);
              $(".passwordCheckIndividual").val('');
              $('#checkIndPassword').html("<span class='emailExist' style='color:red'>Your Current password could not match</span>");
            }else{
              $('#checkIndPassword').html('');
            }

          }
        });
      }
      else
      {
        $("span.emailExist").remove();
      }

    });
    });


      

    </script>
