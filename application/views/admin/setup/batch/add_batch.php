<style>
    .select2-container {
        z-index: 999999;
    }

    .pop-width {
        width: 25% !important;
    }
</style>
<div class="block-flat">
    <form class="form-horizontal frmContent" id="Batch" method="post">
        <?php
        if ($ac_type == "edit") {
            ?>
            <input type="hidden" class="rowID" name="txtbatchId" value="<?php echo $previous_info->BATCH_ID ?>"/>
        <?php
        }
        ?>


        <div class="form-group">
            <label class="col-md-4 control-label">Batch Title<span class="text-danger">*</span></label>

            <div class="col-md-8">
                <input type="text" id="batchName" name="batchName" class="form-control required"
                       value="<?php echo ($ac_type == 'edit') ? $previous_info->BATCH_TITLE : ''; ?>"
                       placeholder="Batch Name">
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Batch 1.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-md-4 control-label"><span>Description</span></label>

            <div class="col-md-8">
                <textarea class="redactor"
                          name="description"><?php echo ($ac_type == 'edit') ? $previous_info->BATCH_DESC : ''; ?></textarea>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Batch 1 description.</span>
            </div>
        </div>
 
        
        <div class="form-group"><label class="col-md-4 control-label">Active?</label>

            <div class="col-md-8">
                <?php
                $ACTIVE_STATUS = ($ac_type == "edit") ? $previous_info->ACTIVE_STATUS : '';
                $checked = ($ac_type == "edit") ? (($previous_info->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
                ?>
                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'status',
                        'id' => 'status',
                        'class' => 'checkBoxStatus',
                        'value' => $ACTIVE_STATUS,
                        'checked' => $checked,
                    );
                    echo form_checkbox($data);
                    ?>
                </label>
                <span class="help-block m-b-none">click on checkbox for active status.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-lg-offset-4 col-lg-10">
                <?php if ($ac_type == "edit") { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateBatch"
                           data-su-action="setup/batchById" value="Update">
                <?php } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createBatch"
                           data-su-action="setup/batchList" data-type="list" value="Submit">
                <?php
                }
                ?>
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span>
            </div>
        </div>

    </form>
</div>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/redactor/redactor.css"/>
<script src="<?php echo base_url(); ?>assets/redactor/redactor.min.js"></script>

<script type="text/javascript">
    $(document).ready(
        function () {
            $('.redactor').redactor();
        }
    );
</script>
<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked')) ? 1 : 0;
        $("#status").val(status);


    });
    $(".select2DropdownMulti").select2({
             tags: true
        });
</script>