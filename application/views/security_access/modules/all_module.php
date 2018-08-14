
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Module List</h5>

                <div class="ibox-tools">
                    <span class="btn btn-primary btn-xs pull-right  " data-toggle="modal" href="#modalDefault">Create
                        New </span>

                </div>

            </div>

            <div class="ibox-content">
                <div class="table-responsive contentArea">
                    <div class="row">

                    </div>
                    <br>

                    <?php
                    if (!empty($all_modules)) {
                        ?>
                        <table class="table table-striped table-bordered table-hover gridTable">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Module Name</th>
                                <th>Module Icon</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $i = 1;
                            foreach ($all_modules as $all_mod) {
                                ?>
                                <tr id="mod_row_<?php echo $all_mod->MODULE_ID; ?>">
                                    <td><?php echo $all_mod->SL_NO; ?></td>
                                    <td><?php echo $all_mod->MODULE_NAME; ?></td>
                                    <td><span class="<?php echo $all_mod->MODULE_ICON ?>"> </span> <?php echo $all_mod->MODULE_ICON; ?> </td>
                                    <td class="center"><?php echo ($all_mod->ACTIVE_STATUS == 1) ? '<span class="btn btn-success btn-xs">Active</span>' : '<span class="btn btn-danger btn-xs">Inactive</span>'; ?></td>

                                    <td>
                                        <span class="btn btn-warning btn-xs openModal"
                                              data-action="securityAccess/module_data_edit_model/<?php echo $all_mod->MODULE_ID; ?>"
                                              mod_id="<?php echo $all_mod->MODULE_ID; ?>" title="Update Module"><i
                                                class="fa fa-edit"></i></span>
                                        <span class="btn btn-danger btn-xs modDltBtn"
                                              mod_id="<?php echo $all_mod->MODULE_ID; ?>" title="Delete"><i
                                                class="fa fa-trash-o"></i></span>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                    <?php
                    } else {
                        echo "<p class='text-danh text-danger'><br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;No Data Found</p>";
                    }
                    ?>
                </div>
            </div>

        </div>

<div class="modal fade" id="modalDefault" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span
                        aria-hidden="true">×</span></button>
                <h4 id="gridModalLabel" class="modal-title">Create Module</h4>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label class="col-sm-3 control-label" for="txtModuleName">Module Name</label>

                    <div class="col-sm-8">
                        <div class="fg-line">
                            <input type="text" name="txtModuleName" class="form-control" id="txtModuleName" value=""
                                   placeholder="Enter Module Name" />
                        </div>
                    </div>
                    <br clear="all" />
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="txtModuleNameBn">Module Name Bangla</label>

                    <div class="col-sm-8">
                        <div class="fg-line">
                            <input type="text" name="txtModuleNameBn" id="txtModuleNameBn" class="form-control" value=""
                                   placeholder="Enter Module Bangla Name" />
                        </div>
                    </div>
                    <br clear="all" />
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="SL_NO">Serial No</label>

                    <div class="col-sm-8">
                        <div class="fg-line">
                            <input type="text" name="SL_NO" id="SL_NO" class="form-control" value=""
                                   placeholder="Enter Module Serial" />
                        </div>
                    </div>
                    <br clear="all" />
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="SL_NO">Module Icon</label>

                    <div class="col-sm-8">
                        <div class="fg-line">
                            <input type="text" name="MODULE_ICON" id="MODULE_ICON" class="form-control" value=""
                                   placeholder="Enter Module Icon" />
                        </div>
                    </div>
                    <br clear="all" />
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label" for="txtModLink">Action </label>

                    <div class="col-sm-8">
                        <div class="fg-line">
                            <?php
                            $chkStatus = array(
                                'name' => 'ACTIVE_STATUS',
                                'id' => 'ACTIVE_STATUS',
                                'value' => '1',
                                'style' => 'margin-right:5px'
                            );
                            echo form_checkbox($chkStatus);
                            ?>
                        </div>
                    </div>
                    <br clear="all" />
                </div>

            </div>
            <div class="modal-footer">
                <span class="modal_msg pull-left" style="color: green"></span>
                <button type="button" class="btn btn-primary" id="createModule">Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url(); ?>assets/security_access/bootgrid/jquery.bootgrid.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#data-table-basic").bootgrid({
            css: {
                icon: 'md icon',
                iconColumns: 'md-view-module',
                iconDown: 'md-expand-more',
                iconRefresh: 'md-refresh',
                iconUp: 'md-expand-less'
            }
        });
        $(document).on("click", "#createModule", function () {
            var mod_name = $("#txtModuleName").val();
            var mod_name_bn = $("#txtModuleNameBn").val();
            var sl_no = $("#SL_NO").val();
            var status = $("#ACTIVE_STATUS").prop('checked');

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('securityAccess/createModule'); ?>",
                data: {mod_name: mod_name, mod_name_bn: mod_name_bn, sl_no: sl_no, status: status},
                success: function (result) {
                    $(".modal_msg").html(result);
                    window.location.reload(true);
                }
            });
        });
        $(document).on("click", ".statusType", function () {
            var status = $(this).attr('status');
            var linkId = $(this).attr('data-linkId');
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/setup/changeModuleStatus'); ?>",
                data: {linkid: linkId, status: status},
                success: function (result) {
                    window.location.reload(true);
                }
            });
        });


        $(".modDltBtn").click(function () {
            if (confirm("Are you want to delete?")) {
                var mod_id = $(this).attr('mod_id');
                $.ajax({
                    url: '<?php echo site_url('securityAccess/delete_module_from_db'); ?>',
                    type: 'POST',
                    data: {mod_id: mod_id},
                    success: function (data) {
                        if (data == 1) {
                            alert('Module deleted Successfully');
                            $('#mod_row_' + mod_id).remove();
                        }
                    }
                });
            } else {
                return false;
            }
        });
    });
</script>