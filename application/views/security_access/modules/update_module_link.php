<style>
    .error {
        border-color: #EBCCD1;
        color: #B94A48;
    }
</style>
<div class="row">
    <?php echo form_open("securityAccess/update_module_link/" . $link_id); ?>
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
        <label class="col-sm-3 control-label" for="id">Modules</label>

        <div class="col-sm-6">
            <?php
            $modules = $this->security_model->get_all_modules();
            $options = array('' => 'Select Module');
            foreach ($modules as $module) {
                $options["$module->MODULE_ID"] = $module->MODULE_NAME;
            }

            echo form_dropdown('txtmoduleId', $options, $link_details->MODULE_ID, 'id="id" class="form-control"');
            ?>
        </div>
        <br clear="all"/>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="txtLinkName">Link Name</label>

        <div class="col-sm-8">
            <div class="fg-line">
                <input type="text" name="txtLinkName" class="form-control" id="txtLinkName"
                       value="<?php echo $link_details->LINK_NAME; ?>" placeholder="Enter Link Name"/>
            </div>
        </div>
        <br clear="all"/>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="txtModLink">URL</label>

        <div class="col-sm-8">
            <div class="fg-line">
                <input type="text" name="txtModLink" id="txtModLink" class="form-control"
                       value="<?php echo $link_details->URL_URI; ?>" placeholder="Enter Module Link"/>
            </div>
        </div>
        <br clear="all"/>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="txtModLink">Action Pages</label>

        <div class="col-sm-8">
            <div class="fg-line">
                <?php
                $page_acc = explode(',', $link_details->ATI_MLINK_PAGES);


                $chkCreate = array(
                    'name' => 'chkpages[]',
                    'id' => 'chkInsert',
                    'value' => 'I',
                    'style' => 'margin-right:5px',
                    'checked' => (in_array('I', $page_acc)) ? 'checked' : ''
                );
                echo form_checkbox($chkCreate) . "Create &nbsp;&nbsp;&nbsp;";
                $chkView = array(
                    'name' => 'chkpages[]',
                    'id' => 'chkView',
                    'value' => 'V',
                    'style' => 'margin-right:5px',
                    'checked' => (in_array('V', $page_acc)) ? 'checked' : ''
                );
                echo form_checkbox($chkView) . "View &nbsp;&nbsp;&nbsp;";
                $chkUpdate = array(
                    'name' => 'chkpages[]',
                    'id' => 'chkUpdate',
                    'value' => 'U',
                    'style' => 'margin-right:5px',
                    'checked' => (in_array('U', $page_acc)) ? 'checked' : ''
                );
                echo form_checkbox($chkUpdate) . "Update &nbsp;&nbsp;&nbsp;";
                $chkDelete = array(
                    'name' => 'chkpages[]',
                    'id' => 'chkDelete',
                    'value' => 'D',
                    'style' => 'margin-right:5px',
                    'checked' => (in_array('D', $page_acc)) ? 'checked' : ''
                );
                echo form_checkbox($chkDelete) . "Delete &nbsp;&nbsp;&nbsp;";
                $chkStatus = array(
                    'name' => 'chkpages[]',
                    'id' => 'chkStatus',
                    'value' => 'S',
                    'style' => 'margin-right:5px',
                    'checked' => (in_array('S', $page_acc)) ? 'checked' : ''
                );
                echo form_checkbox($chkStatus) . "Status";
                ?>
            </div>
        </div>
        <br clear="all"/>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="SL_NO">Serial No</label>

        <div class="col-sm-2">
            <div class="fg-line">
                <input type="text" name="SL_NO" id="SL_NO" class="form-control"
                       value="<?php echo $link_details->SL_NO; ?>" placeholder="Enter Module Link Serial"/>
            </div>
        </div>
        <br clear="all"/>
    </div>
    <div class="form-group">
        <label class="col-sm-3 control-label" for="txtModLink">Active</label>

        <div class="col-sm-8">
            <div class="fg-line">
                <?php
                $acStatus = array(
                    'name' => 'ACTIVE_STATUS',
                    'id' => 'ACTIVE_STATUS',
                    'value' => '1',
                    'style' => 'margin-right:5px',
                    'checked' => ($link_details->ACTIVE_STATUS == 1) ? 'checked' : ''
                );
                echo form_checkbox($acStatus);
                ?>
            </div>
        </div>
        <br clear="all"/>
    </div>
    <button class="col-sm-offset-3 btn btn-primary btn-sm " type="submit">Submit</button>
    <?php echo form_close(); ?>
</div>