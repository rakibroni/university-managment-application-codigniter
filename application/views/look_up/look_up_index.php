<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5> Group settings</h5>
        <?php if ($previlages->CREATE == 1) { ?>
        <div class="ibox-tools">
            <span title="Create Group" class="btn btn-primary btn-xs pull-right openLookUpModal"
            data-action="lookUp/lookupGroupForm">Add Group</span>
        </div>
        <?php } ?>
    </div>
    <?php if ($previlages->READ == 1) { ?>
    <div class="ibox-content">

        <div class="col-md-3"></div>
        <div class="col-md-6"><?php foreach ($group as $gr) { ?>
            <div class="panel panel-default" style="margin-bottom: 5px !important;">
                <div class="panel-heading" role="tab" id="headingOne" style="padding:2px 10px 7px 10px !important;">
                    <h4 class="panel-title">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                        href="#<?php echo $gr->GRP_ID ?>" aria-expanded="false" aria-controls="collapseOne">
                        <i class="fa fa-angle-right"></i> <?php echo $gr->GRP_NAME ?>
                    </a>
                    <?php
                    if ($previlages->DELETE == 1) {
                        ?>
                        <a class="pull-right label label-danger deletelookup"
                        item_id="<?php echo $gr->GRP_ID; ?>" title="Click For Delete" data-type="delete"
                        data-field="GRP_ID" data-tbl="m00_lkpgrp"><i class="fa fa-times"></i></a>
                        <?php } ?>
                    </h4>
                </div>
                <div id="<?php echo $gr->GRP_ID ?>" class="panel-collapse collapse" role="tabpanel"
                 aria-labelledby="headingOne">
                 <div class="panel-body ">
                  <?php
                  if ($previlages->CREATE == 1) {
                    ?>
                    <a data-action="lookUp/lookupDataFormInsert/<?php echo $gr->GRP_ID; ?>"
                       class="btn btn-primary btn-xs pull-right openLookUpModal" title="Add Data">Add
                   new</a>
                   <?php } ?>
                   <table class="table table-bordered contentArea">
                    <thead>
                        <tr>
                            <th style="width: 5%;color: green">SN</th>
                            <th style="color: green">Name</th>
                            <th style="color: green">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $this->db->query("select * from m00_lkpdata where GRP_ID = $gr->GRP_ID")->result();
                        $sr = 0;
                        foreach ($result as $rr) {
                            $sr = $sr + 1;
                            ?>
                            <tr class="gradeX" id="row_<?php echo $rr->LKP_ID; ?>">
                                <td <?php echo ($rr->ACT_FG == 1) ? "" : "class='inactive'"; ?>>
                                    <span><?php echo $sr; ?></span><span class="hidden"
                                    id="loader_<?php echo $rr->LKP_ID; ?>"></span>
                                </td>
                                <td <?php echo ($rr->ACT_FG == 1) ? "" : "class='inactive'"; ?>><?php echo $rr->LKP_NAME ?></td>
                                <td <?php echo ($rr->ACT_FG == 1) ? "" : "class='inactive'"; ?>>
                                    <?php if ($previlages->STATUS == 1) { ?>
                                    <span style="cursor:pointer" id="status<?php echo $rr->LKP_ID ?>"
                                      class="status" look_up_id="<?php echo $rr->LKP_ID ?>"
                                      data-status="<?php echo $rr->ACT_FG ?>"
                                      data-su-url="lookUp/lookUpById">
                                      <?php echo ($rr->ACT_FG == 1) ? '<span id="toggol_' . $rr->LKP_ID . '" class="label label-success" title="Click For Inactive" >Inactive</span>' : '<span id="toggol_' . $rr->LKP_ID . '" class="label label-danger" title="Click For Active" >Active</span>'; ?>
                                  </span>
                                  <?php
                              } 
                              if ($previlages->UPDATE == 1) {
                                ?>
                                <a class="label label-default openLookUpModal" title="Edit Group Data"
                                data-action="LookUp/lookupDataFormUpdate/<?php echo $rr->GRP_ID; ?>/<?php echo $rr->LKP_ID; ?>"
                                data-type="edit"><i class="fa fa-pencil"></i></a>
                                <?php
                            }
                            if ($previlages->DELETE == 1) {
                             ?>
                             <a class="label label-danger deletelookup"
                             item_id="<?php echo $rr->LKP_ID; ?>" title="Click For Delete"
                             data-type="delete" data-field="LKP_ID" data-tbl="m00_lkpdata"><i
                             class="fa fa-times"></i></a>
                             <?php } ?>
                         </td>
                     </tr>
                     <?php } ?>
                 </tbody>
             </table>
         </div>
     </div>
 </div>
 <?php } ?></div>
 <div class="col-md-3">



 </div>
 <div class="clearfix"></div>
</div>
<?php
} else {
    echo "<div class='alert alert-danger'>You Don't Have Permission To View This Page</div>";
}
?>
</div>


<div class="modal fade lookUpModal" role="dialog" aria-labelledby="gridSystemModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content animated pulse">
            <div class="modal-header" style="background-color: #BEDCF0;">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                    aria-hidden="true">&times;</span></button>
                    <h4 class="lookUpModalTitle" style="font-size: 20px;text-align: center; "></h4>
                    <small class="font-bold"></small>
                </div>
                <div class="lookUpModalBody">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).on("click", ".openLookUpModal", function () {
                $(".lookUpModal").modal();
                var param_value = "";
                var action_type = $(this).attr("data-type");
                var action_uri = $(this).attr("data-action");
                var title = $(this).attr("title");
                if (action_type == "edit") {
                    param_value = $(this).attr("id");
                }
                if (action_type == "delete") {
                    param_value = $(this).attr("id");
                }
                $.ajax({
                    type: "post",
                    url: "<?php echo site_url(); ?>/" + action_uri,
                    data: {param: param_value},
                    beforeSend: function () {
                        $(".lookUpModalTitle").html(title);
                        $(".lookUpModalBody").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function (data) {
                        $(".lookUpModalBody").html(data);
                    }
                });
            });
            $(document).on("click", ".lookUpFormSubmit", function () {
                var isValid = 0;
                $('.required').each(function () {
                    $(this).keyup(function () {
                        $(this).css("border", "1px solid #ccc");
                    });
                    if ($(this).val() == "") {
                        var label = $(this).parent().siblings("label").text();
                        $(this).siblings(".validation").html(label + " is required");
                        $(this).css("border", "1px solid red");
                        isValid = 1;
                    } else {
                        $(this).siblings(".validation").html("");
                        $(this).css("border", "1px solid #ccc");
                    }
                });
                if (isValid == 0) {
                    if (confirm("Are You Sure?")) {
                        var lookUpFrmContent = $(".lookUpFrmContent").serialize();
                        var action_uri = $(this).attr("data-action");

                        var type = $(this).attr("data-type");
                        var success_action_uri = $(this).attr("data-su-action");
                        var ac_type = $(this).attr("");
                        var param = "";
                        if (type != "list" || type == "lookup") {
                            param = $(".rowID").val();
                        }
                        var sn = $("#loader_" + param).siblings("span").text();
                        $.ajax({
                            type: "post",
                            data: lookUpFrmContent,
                            url: "<?php echo site_url();?>/" + action_uri,
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
                                    //$(".gridTable").dataTable();
                                    if (type != "list" || type == "lookup") {
                                        $("#loader_" + param).removeClass("hidden").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' style='width:10px;' />").siblings("span").addClass("hidden");
                                    }
                                },
                                success: function (data1) {
                                    //$(".loadingImg").html("");
                                    if (type == "list" || type == "lookup") {
                                        $(".contentArea").html(data1);
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
            $(document).on('click', '.status', function () {
                if (confirm("Are You Sure?")) {
                    var look_up_id = $(this).attr("look_up_id");
                    var status = $(this).attr("data-status");
                    var data_su_url = $(this).attr("data-su-url");
                    var success_url = "<?php echo site_url() ?>/" + data_su_url;
                    var sn = $("#loader_" + look_up_id).siblings("span").text();
                    $.ajax({
                        type: 'POST',
                        url: '<?php echo site_url('lookUp/edit_look_up_status') ?>/',
                        data: {look_up_id: look_up_id, status: status},
                        beforeSend: function () {
                            $("#loader_" + look_up_id).html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                        },
                        success: function (data) {
                            if (data == "Y") {
                                $.ajax({
                                    type: 'POST',
                                    url: success_url,
                                    data: {param: look_up_id},
                                    beforeSend: function () {
                                        $("#loader_" + look_up_id).removeClass("hidden").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' style='width:10px;' />").siblings("span").addClass("hidden");
                                    },
                                    success: function (data1) {
                                        $("#loader_" + look_up_id).addClass("hidden").html("").siblings("span").removeClass("hidden");
                                        $("#row_" + look_up_id).html(data1);
                                        $("#loader_" + look_up_id).siblings("span").html(sn);
                                    }
                                });
                            } else {
                                return false;
                            }
                        }
                    });
                } else {
                    return false;
                }
            });

            $(document).on("click", ".deletelookup", function () {
                if (confirm("Are You Sure?")) {
                    var item_id = $(this).attr("item_id");
                    var data_field = $(this).attr("data-field");
                    var data_tbl = $(this).attr("data-tbl");
                    $.ajax({
                        type: "post",
                        url: "<?php echo site_url('lookUp/deletelookUp'); ?>/",
                        data: {item_id: item_id, data_field: data_field, data_tbl: data_tbl},
                        beforeSend: function () {
                            $("#loader_" + item_id).html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                        },
                        success: function (data) {
                            if (data == "Y") {
                                $("#row_" + item_id).remove();
                            } else {
                                alert("Row Delete Field");
                            }
                        }
                    });
                } else {
                    return false;
                }
            });
        });
    </script>