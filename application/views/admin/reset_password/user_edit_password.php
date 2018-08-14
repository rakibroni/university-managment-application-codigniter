

<style type="text/css">
  .modal-header h4 {
    color: #681156;
    margin-top: 15px;
    font-size: 25px;
    margin-bottom: 8px;
    border-bottom: 1px solid #ddd !important;
    padding-bottom: 20px !important;
}

.row>div.form-group{
  display: block !important;
}
</style>
 <form class="form-horizontal frmContent" id="Password">
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
<input type="hidden" name="USER_ID" id="USER_ID" value="<?php echo  $user_detail->userId; ?>">
<button class="col-sm-offset-4 btn btn-primary btn-sm  formUpdatePasswordSubmit" type="submit">Submit</button>
<span class="loadingImg"></span>
</div>
</form>
<script type="text/javascript">
    $(document).ready(function () {
  $(document).on("click", ".formUpdatePasswordSubmit", function (event) {
    if (confirm("Are You Sure?")) {
        var USER_ID = $("#USER_ID").val();
        var Password =$(".Currpassword").val();
        //alert(Password);
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
        $.ajax({
            type: "POST",
            url: '<?php echo site_url('portal/update_visitor_profile_password') ?>',
            data: {USER_ID: USER_ID, passwordNew: passwordNew,'<?php echo  $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
            success: function (data) {
              //alert(data);
                $(".frmMsg").html(data);
                event.preventDefault();
               //window.location.reload(true);
            }
        });
    } else {
        return false;
    }
});

$(document).on("blur", ".passwordCheckIndividual", function() {
  var USER_ID = $("#USER_ID").val();
  //alert("USER_ID");
  var password = $(this).val();
  //alert("okay");
  if(password!='')
  {
    var url = '<?php echo site_url('portal/checkUserPassword') ?>';
    $.ajax({

      type: "POST",
      url: url,
      dataType : 'html',
      data: {USER_ID:USER_ID ,password: password,'<?php echo  $this->security->get_csrf_token_name(); ?>':'<?php echo $this->security->get_csrf_hash(); ?>'},
      success: function(data1) {
        //console.log(data1);
        if(data1 == 0){
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

$(function () {
  $(".password_conf").on('blur', function(){
    var passwordNew = $(".passwordIndNew").val();
    var confirmPassword = $(".password_conf").val();
    if (passwordNew != confirmPassword) {
      alert("These passwords miss match.");
      $(".passwordIndNew").val('');
      $(".password_conf").val('');
      return false;
    }
    return true;
  });
});

});

</script>
