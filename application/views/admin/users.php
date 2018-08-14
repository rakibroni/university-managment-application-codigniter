<style>
    .tabs-container .panel-body {
        border: 1px solid #1AB394;
    }
</style>
<div class="">
    <div class="col-lg-3">
        <div class="tabs-container">
            <ul class="nav nav-tabs">
                <li class="active"><a href="tabs.html#tab-1" data-toggle="tab"> Search</a></li>
                <li class=""><a href="tabs.html#tab-2" data-toggle="tab">Advanced Search</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab-1">
                    <div class="panel-body">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content mailbox-content">
                                <form id="filterUser">
                                    <div class="file-manager">
                                        <h5>Group <span style="color: red">*</span></h5>
                                        <?php echo form_dropdown('cmbGroup', $groups, '', 'id="cmbGroup" class="form-control required"'); ?>
                                        <h5>Level <span style="color: red">*</span></h5>
                                        <select class="form-control m-b required" id="userLevel" name="userLevel">
                                            <option value="">Select Level</option>
                                        </select>
                                        <h5>Department</h5>
                                        <?php echo form_dropdown('cmbDepartment', $departments, '', 'id="cmbDepartment" class="form-control"'); ?>
                                        <h5>Designation</h5>
                                        <select class="form-control m-b" id="userDesignation" name="userDesignation">
                                            <option value="">Select Designation</option>
                                        </select>
                                        <h5>Gender</h5>
                                        <select class="form-control m-b" id="userGender" name="userGender">
                                            <option value="">Select Gender</option>
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select>
                                        <span type="submit" id="submitfilter"
                                              class="btn btn-primary btn-sm">Search</span>

                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="tab-2">
                    <div class="panel-body">
                        <div class="ibox float-e-margins">
                            <div class="ibox-content mailbox-content">
                                <form id="advFilterUser">
                                    <div class="file-manager">
                                        <h5>Field Name <span style="color: red">*</span></h5>
                                        <select name="fildName" id="fildName" class="form-control m-b requireds">
                                            <option value="">Select Field</option>
                                            <?php
                                            foreach ($fields as $field) {
                                                echo '<option value="' . $field->name . '" id="' . $field->type . '">' . $field->name . '</option>';
                                            }
                                            ?>
                                        </select>
                                        <h5>Operators <span style="color: red">*</span></h5>
                                        <select name="operator" id="operator" class="form-control m-b requireds">
                                            <option value="">Select Operator</option>
                                            <option class="varchar hidden" value="=">Equal to</option>
                                            <option class="int hidden" value="=">Equal to</option>
                                            <option class="int hidden" value="!=">Not equal to</option>
                                            <option class="int hidden" value=">">Greater than</option>
                                            <option class="int hidden" value=">=">Greater than or equal to</option>
                                            <option class="int hidden" value="<">Less than</option>
                                            <option class="int hidden" value="<=">Less than or equal to</option>
                                            <option class="varchar hidden" value="LIKE" type="1">Begins with</option>
                                            <option class="varchar hidden" value="LIKE" type="2">Contains</option>
                                        </select>
                                        <input type="hidden" id="operatorType" name="operatorType" value=""/>
                                        <h5 class="tag-title">Keyword<span style="color: red">*</span></h5>
                                        <input type="text" name="textKeyword" id="textKeyword"
                                               class="form-control requireds" placeholder="Enter Search Text Here"/>

                                        <div class="hr-line-dashed"></div>
                                        <span type="submit" id="submitAdvFilter"
                                              class="btn btn-primary btn-sm">Search</span>

                                        <div class="clearfix"></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9">
        <div class="ibox float-e-margins" style="margin-bottom: 3px;">
            <div style="overflow: auto;">
                <h3>User list
                    <a href="<?php echo base_url('admin/addUser'); ?>" class="pull-right">
                        <button type="button" class="btn btn-primary btn-xs"><i class="fa fa-plus"></i> Add New</button>
                    </a>
                </h3>
            </div>
        </div>
        <div class="loader" id="searchCon">
            <div class="middle-box text-center animated fadeInRightBig">
                <h3 class="font-bold">This is page content</h3>

                <div class="error-desc">
                    All <span style="color: red"><strong>*</strong></span> field are required.<br>
                    Select All field for more filtering.
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title"></h4>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).on("click", ".userModal", function () {
        $("#myModal5").modal();
        var param_value = "";
        var action_type = $(this).attr("data-type");
        var action_uri = $(this).attr("data-action");
        var title = $(this).attr("title");
        if (action_type == "edit") {
            param_value = $(this).attr("id");
        }
        $.ajax({
            type: "post",
            url: "<?php echo site_url(); ?>/" + action_uri, data: {param: param_value},
            beforeSend: function () {
                $(".modal-title").html(title);
                $(".modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $(".modal-body").html(data);
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('change', '#cmbGroup', function () {
            var groupId = $(this).val();
            var url = '<?php echo site_url('admin/get_userLevelByGroup') ?>';
            $.ajax({
                type: "POST",
                url: url,
                data: {groupId: groupId},
                dataType: 'html',
                success: function (data) {
                    $('#userLevel').html(data);
                }
            });
        });
        $(document).on('change', '#cmbDepartment', function () {
            var dept_id = $(this).val();
            var url = '<?php echo site_url('admin/get_designationByDept') ?>';
            $.ajax({
                type: "POST",
                url: url,
                data: {dept_id: dept_id},
                dataType: 'html',
                success: function (data) {
                    $('#userDesignation').html(data);
                }
            });
        });
        $(document).on("click", "#submitfilter", function () {
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
                var filterUser = $("#filterUser").serialize();
                $.ajax({
                    type: "POST",
                    url: '<?php echo site_url('admin/searchUserList') ?>',
                    data: filterUser,
                    beforeSend: function () {
                        $(".loader").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function (data) {
                        $(".loader").html("");
                        $('#searchCon').html(data);
                    }
                });
            }
        });
// Advanced Search
        $(document).on('change', '#fildName', function () {
            var fildId = $(this).find('option:selected').attr('id');
            if (fildId == 'varchar') {
                $(".varchar").removeClass('hidden');
                $(".int").addClass('hidden');
            } else {
                $(".int").removeClass('hidden');
                $(".varchar").addClass('hidden');
            }
        });
        $(document).on('change', '#operator', function () {
            var operatorType = $(this).find('option:selected').attr('type');
            $('#operatorType').val(operatorType);
        });
        $(document).on("click", "#submitAdvFilter", function () {
            var isValids = 0;
            $('.requireds').each(function () {
                $(this).keyup(function () {
                    $(this).css("border", "1px solid #ccc");
                });
                if ($(this).val() == "") {
                    var label = $(this).parent().siblings("label").text();
                    $(this).siblings(".validation").html(label + " is requireds");
                    $(this).css("border", "1px solid red");
                    isValids = 1;
                } else {
                    $(this).siblings(".validation").html("");
                    $(this).css("border", "1px solid #ccc");
                }
            });
            if (isValids == 0) {
                var advFilterUser = $("#advFilterUser").serialize();
                $.ajax({
                    type: "POST",
                    url: '<?php echo site_url('admin/advSearchUserList') ?>',
                    data: advFilterUser,
                    beforeSend: function () {
                        $(".loader").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
                    },
                    success: function (data) {
                        $(".loader").html("");
                        $('#searchCon').html(data);
                    }
                });
            }
        });
    });
</script>