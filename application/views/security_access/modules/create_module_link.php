
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h4>Create Module Link</h4>
            </div>
            <div class="ibox-content">
                <br>

                <div class="row">
                    <?php echo form_open(); ?>
                    <div class="msg">
                        <?php
                        if (validation_errors() != false) {
                            ?>
                            <div class="alert alert-danger">
                                <button data-dismiss="alert" class="close" type="button">×</button>
                                <?php echo validation_errors(); ?>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="id">Modules</label>

                        <div class="col-sm-3">
                            <?php
                            $modules = $this->security_model->get_all_modules();
                            $options = array('' => 'Select Module');
                            foreach ($modules as $module) {
                                $options["$module->MODULE_ID"] = $module->MODULE_NAME;
                            }
                            $mId = set_value('txtmoduleId');
                            echo form_dropdown('txtmoduleId', $options, $mId, 'id="id" class="form-control"');
                            ?>
                        </div>
                        <br clear="all"/>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="txtLinkName">Link Name</label>

                        <div class="col-sm-3">
                            <div class="fg-line">
                                <input type="text" name="txtLinkName" class="form-control" id="txtLinkName"
                                       value="<?php echo set_value('txtLinkName'); ?>" placeholder="Enter Link Name"/>
                            </div>
                        </div>
                        <br clear="all"/>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="txtModLink">URL</label>

                        <div class="col-sm-3">
                            <div class="fg-line">
                                <input type="text" name="txtModLink" id="txtModLink" class="form-control"
                                       value="<?php echo set_value('txtModLink'); ?>" placeholder="Enter Module Link"/>
                            </div>
                        </div>
                        <br clear="all"/>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="txtModLink">Action Pages</label>

                        <div class="col-sm-8">
                            <div class="fg-line">
                                <?php
                                $chkCreate = array(
                                    'name' => 'chkpages[]',
                                    'id' => 'chkInsert',
                                    'value' => 'I',
                                    'style' => 'margin-right:5px',
                                );
                                echo form_checkbox($chkCreate) . "Create &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;";
                                $chkView = array(
                                    'name' => 'chkpages[]',
                                    'id' => 'chkView',
                                    'value' => 'V',
                                    'style' => 'margin-right:5px',
                                );
                                echo form_checkbox($chkView) . "View &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;";
                                $chkUpdate = array(
                                    'name' => 'chkpages[]',
                                    'id' => 'chkUpdate',
                                    'value' => 'U',
                                    'style' => 'margin-right:5px',
                                );
                                echo form_checkbox($chkUpdate) . "Update &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;";
                                $chkDelete = array(
                                    'name' => 'chkpages[]',
                                    'id' => 'chkDelete',
                                    'value' => 'D',
                                    'style' => 'margin-right:5px',
                                );
                                echo form_checkbox($chkDelete) . "Delete &nbsp;&nbsp; &nbsp;&nbsp;&nbsp;";
                                $chkStatus = array(
                                    'name' => 'chkpages[]',
                                    'id' => 'chkStatus',
                                    'value' => 'S',
                                    'style' => 'margin-right:5px',
                                );
                                echo form_checkbox($chkStatus) . "Status";
                                ?>
                            </div>
                        </div>
                        <br clear="all"/>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="SL_NO">Serial No</label>

                        <div class="col-sm-2">
                            <div class="fg-line">
                                <input type="text" name="SL_NO" id="SL_NO" class="form-control"
                                       placeholder="Enter Module Link Serial"/>
                            </div>
                        </div>
                        <br clear="all"/>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label" for="txtModLink">Active</label>

                        <div class="col-sm-8">
                            <div class="fg-line">
                                <?php
                                $acStatus = array(
                                    'name' => 'ACTIVE_STATUS',
                                    'id' => 'ACTIVE_STATUS',
                                    'value' => '1',
                                    'style' => 'margin-right:5px'
                                );
                                echo form_checkbox($acStatus);
                                ?>
                            </div>
                        </div>
                        <br clear="all"/>
                    </div>
                    <button class="col-sm-offset-2 btn btn-primary btn-sm " type="submit">Submit</button>
                    <?php echo form_close(); ?>
                </div>

            </div>
        </div>


        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h4>All Module Links</h4>
            </div>
            <div class="ibox-content">
                <div class="table-responsive contentArea">
                    <table class="table table-striped table-bordered table-hover gridTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Module Name</th>
                            <th>Link Name</th>
                            <th>Link URL</th>
                            <th>Serial No</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1;
                        foreach ($all_modules as $row) { ?>
                            <tr id="link_row_<?php echo $row->LINK_ID; ?>">
                                <td><?php echo $i++;
                                    $row->SL_NO; ?></td>
                                <td><?php echo $row->MODULE_NAME; ?></td>
                                <td><?php echo $row->LINK_NAME; ?></td>
                                <td><?php echo $row->URL_URI; ?></td>
                                <td><?php echo $row->SL_NO; ?></td>
                                <td class="center"><?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="btn btn-success btn-xs">Active</span>' : '<span class="btn btn-danger btn-xs">Inactive</span>'; ?></td>
                                <td>
                                    <span class="btn btn-warning btn-xs openModal "
                                          data-action="securityAccess/link_data_edit_model/<?php echo $row->LINK_ID; ?>"
                                          link_id="<?php echo $row->LINK_ID; ?>" title="Update Module Link"><i
                                            class="fa fa-edit"></i></span>
                                    <span class="btn btn-danger btn-xs linkDltBtn"
                                          link_id="<?php echo $row->LINK_ID; ?>" title="Delete"><i
                                            class="fa fa-trash-o"></i></span>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


<script type="text/javascript">
    $(document).ready(function () {

        $(".linkDltBtn").click(function () {
            if (confirm("Are you want to delete?")) {
                var link_id = $(this).attr('link_id');
                $.ajax({
                    url: '<?php echo site_url('securityAccess/delete_row_from_db'); ?>',
                    type: 'POST',
                    data: {link_id: link_id},
                    success: function (data) {
                        if (data == 1) {
                            alert('Link deleted Successfully');
                            $('#link_row_' + link_id).remove();
                        }
                    }
                });
            } else {
                return false;
            }
        });
    });
</script>