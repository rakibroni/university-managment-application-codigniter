<div class="wrapper wrapper-content">
 <div class="ibox-content">
        <form id="reportFormSubmit" class="reportFormSubmit" action="<?php echo site_url('admin/usersGrpLevWiseSearch') ?>"> 
            <div class="col-md-6">
                <div class="form-group"> 
                    <select class="form-control required" name="GROUP_ID" id="GROUP_ID" data-tags="true" data-placeholder="Select Group" data-allow-clear="true">
                        <option value="">Select User Group</option>
                         <?php foreach ($user_group as $row) { ?> 
                        <option
                        value="<?php echo $row->USERGRP_ID; ?>"><?php echo $row->USERGRP_NAME; ?></option>
                        <?php } ?>
                    </select> 
                </div>
            </div>           
            <div class="col-md-4">
                <div class="form-group"> 
                    <select class="form-control required" name="LEVEL_ID" id="LEVEL_ID">
                        <option value="">Select User Level</option>
                    </select>
                </div>
            </div> 
            <div class="col-md-2"> 
              <div class="form-group"> 
                 <button type="submit" class="btn btn-primary btn-sm">Show</button>
              </div>
          </div>
      </form>
      <div class="clearfix"></div>
  </div>
    <div class="ibox float-e-margins">
     <div class="reportResult">
        <div class="ibox-title">
            <h5>User List</h5>
            <?php if ($previlages->CREATE == 1) { ?>
            <a title="View user information" class="btn btn-primary btn-xs pull-right" href="<?php echo site_url() ?>/admin/createUser" target=""> Create User</a> 
            <?php } ?>                         
        </div>
        
        <?php if (!empty($user)): ?>
            <div class="ibox-content">
                <form id="frmContent" method="post">
                    <div class="table-responsive contentArea" id="applicantList">
                        <?php if ($previlages->READ == 1) { ?>
                        <table class="table table-striped table-bordered table-hover gridTable">
                            <thead>
                                <tr>
                                    <th>SN</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Basic Info</th>
                                    <th>User Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="searchUser">
                                <?php
                                $sn = 1;
                                foreach ($user as $row):
                                    ?>
                                    <tr class="gradeX" id="row_<?php echo $row->USER_ID; ?>" >
                                        <td>
                                            <span class="hidden" id="loader_<?php echo $row->USER_ID; ?>"></span>
                                            <?php echo $sn++; ?>
                                        </td>
                                        <td> 
                                            <div class="feed-element">
                                                <a class="pull-left" href="#">
                                                    <?php $photo=($row->EMP_IMG !='')? "upload/employee/photo/".$row->EMP_IMG : 'assets/img/default.png' ?>
                                                    <img alt="image" class="img-circle m-t-xs img-responsive" src="<?php echo base_url($photo); ?>">
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <h3><strong><?php echo $row->FULL_ENAME; ?></strong></h3>
                                            <a href="#"></a>                                                     
                                        </td>
                                        <td>
                                            <b> DEPT :<?php echo $row->DEPT_NAME; ?> <br> DESIG : <?php echo $row->DESIGNATION; ?></b>
                                        </td>
                                        <td >
                                            <p><b>User Group:&nbsp;</b> <?php echo $row->USERGRP_NAME; ?></br>
                                                <b>User Level:&nbsp;</b><?php echo $row->UGLEVE_NAME; ?></br>
                                                <b>User Name:&nbsp;</b> <?php echo $row->USERNAME; ?></p>
                                            </td>
                                            <td class="text-center">
                                                <!--                                                <a title="View user information" class="label label-info openModal" data-action="admin/viewUserLevel" data-type="edit"  id="--><?php //echo $row->USER_ID; ?><!--"> <i class="fa fa-eye"></i></a>                                                  -->
                                                <!--                                                <a title="Update User information" class="label label-default openBigModal" data-action="admin/updateUserLevel" data-type="edit"  id="--><?php //echo $row->USER_ID; ?><!--"> <i class="fa fa-pencil"></i></a>                                                  -->
                                                <?php if ($previlages->UPDATE == 1) : ?>
                                                    <a class="label label-default openModal" id="<?php echo $row->USER_ID; ?>"
                                                     title="Update User Information" data-action="admin/updateUserLevel"
                                                     data-type="edit"><i class="fa fa-pencil"></i></a>
                                                 <?php endif; ?>
                                             </td>
                                         </tr>
                                         <?php
                                     endforeach;
                                     ?>
                                 </tbody>
                                 <tfoot>
                                    <tr>
                                        <th>SN</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Basic Info</th>
                                        <th>User Level</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                            <?php
                        } else {
                            echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
                        }
                        ?>
                    </div>
                </form>
            </div>
        <?php else: ?>

            <div class="alert alert-danger"><p class="text-center">No user Found </p> </div>                                
        <?php endif; ?>
    </div>
</div>
</div>

<script type="text/javascript">
    //email validation
    $(document).on('keyup', '#EMAIL', function () {
        var str = $(this).val();
        var userId = $("#userId").val();
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if (!re.test(str)) {
            $(".email_validation").html('Invalid Email address');
        } else {
            $(".email_validation").html('');
            $.ajax({
                type: 'POST',
                url: '<?php echo site_url('admin/checkEmailAddress'); ?>',
                data: {user_id: userId, Email: str},
                success: function (data) {
                    if(data == "used"){
                        $('.email_validation').html("Already used");                        
                    }
                }
            });
        }
    });
    $(document).on('change', '#USERGRP_IDS', function () {
        var user_group_id = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('admin/userLavelByGrId'); ?>',
            data: {user_group_id: user_group_id},
            success: function (data) {
                $('#USER_GRP_LVL_IDS').html(data);
            }
        });
    });
    $(document).on('keyup', '#BIOMETRIC_ID', function () {
        var bId = $(this).val();
        var userId = $("#userId").val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('admin/checkBiometricId'); ?>',
            data: {user_id: userId, BIOMETRIC_ID: bId},
            success: function (data) {
                if(data == "used"){
                    $('.biometric_validation').html("Already used");   
                }else{
                    $('.biometric_validation').html('');                        
                }
            }
        });
    });
    $(document).on("click", ".userUpdate", function () {
        var bio = $('.biometric_validation').text();
        var email = $('.email_validation').text();
        var isValid = 0;
        $('.required').each(function () {
            $(this).keyup(function () {
                $(this).css("border", "1px solid #ccc");
            });
            if ($(this).val() == "") {
                var label = $(this).parent().siblings("label").text();
                //alert(label + " Is Empty");
                $(this).siblings(".validation").html(label + " is required");
                $(this).css("border", "1px solid red");
                isValid = 1;
                //return false;
            } else {
                $(this).siblings(".validation").html("");
                $(this).css("border", "1px solid #ccc");
            }
            if(bio == "Already used" || email == "Already used"){
                isValid = 1;
                if(bio == "Already used"){
                    alert("Biometric id already used");                        
                }else{
                    alert("Email already used");                        
                }
            }
        });
        if (isValid == 0) {
            if (confirm("Are You Sure?")) {
                var frmContent = $(".frmContent").serialize();
                var action_uri = $(this).attr("data-action");
                var type = $(this).attr("data-type");
                var success_action_uri = $(this).attr("data-su-action");
                var ac_type = $(this).attr("");
                var param = "";
                if (type != "list") {
                    param = $(".rowID").val();
                }
                var sn = $("#loader_" + param).siblings("span").text();
                $.ajax({
                    type: "post",
                    data: frmContent,
                    url: "<?php echo site_url(); ?>/" + action_uri,
                    beforeSend: function () {
                        $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function (data) {
                        $(".loadingImg").html("");
                        $(".frmMsg").html(data);
                        $.ajax({
                            type: "post",
                            data: {param: param},
                            url: "<?php echo site_url(); ?>/" + success_action_uri,
                            beforeSend: function () {
                                if (type != "list") {
                                    $("#loader_" + param).removeClass("hidden").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' style='width:10px;' />").siblings("span").addClass("hidden");
                                }
                            },
                            success: function (data1) {
                                //$(".loadingImg").html("");
                                if (type == "list") {
                                    $(".contentArea").html(data1);
                                    $(".gridTable").dataTable();
                                } else if (type == "msg") {
                                    $('#rinci').html(response).modal();
                                } else {
                                    $("#loader_" + param).addClass("hidden").html("").siblings("span").removeClass("hidden");
                                    $("#row_" + param).html(data1);
                                    $("#loader_" + param).siblings("span").html(sn);
                                }
                            }
                        });
                    }
                });
            } else {
                return false;
            }
        } else {
            return false;
        }
    });
    $(document).ready(function () {
        $(document).on("click", ".formSearch", function () {
            var is_valid = 0;
            $('.required').each(function () {
                $(this).keyup(function () {
                    $(this).css("border", "1px solid #ccc !important");
                });
                if ($(this).val() == "") {
                    var label = $(this).parent().siblings("label").text();
                    //alert(label + " Is Empty");
                    $(this).siblings(".validation").html(label + " is required");
                    $(this).css("border", "1px solid red");
                    is_valid = 1;
                } else {
                    $(this).css("border", "1px solid #ccc");
                }
            });
            if (is_valid == 0) {
                var USERGRP_IDS = $("#USERGRP_IDS").val();
                var USER_LVL = $("#USER_GRP_LVL_IDS").val();
                if ( USERGRP_IDS == '' || USER_LVL == '' ) {
                    if (USERGRP_IDS == '') {
                        alert('User Group Select !!');
                    } else if (USER_LVL == '') {
                        alert('User Level Select !!');
                    }

                } else {
                    var action_url = '<?php echo site_url('admin/searchUser') ?>';
                    $.ajax({
                        type: "POST",
                        url: action_url,
                        data: {
                            USERGRP_IDS: USERGRP_IDS,
                            USER_LVL: USER_LVL
                        },
                        dataType: 'html',
                        beforeSend: function () {
                            $(".loadingImg").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                        },
                        success: function (data) {
                            $(".loadingImg").html("");
                            $('.searchUser').html(data);
                        }
                    });
                }
            }
        });
    });

 $(document).on("change", "#GROUP_ID", function () {
  var groupId=$(this).val();
  //alert(grupId);
  var getUrl = '<?php echo site_url("admin/getUserLevel") ?>'+'/'+groupId;

    $.ajax({
      type: "GET",
      url: getUrl,
      success: function (data) {
        $("select#LEVEL_ID").html(data);
      }
    });
  
});


</script>


