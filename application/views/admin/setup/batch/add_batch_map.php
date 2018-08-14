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
            <label class="col-md-2 control-label">Batch <span class="text-danger">*</span></label> 
            <div class="col-lg-10">

                <?php if ($ac_type == "edit"): // if the form action is EDIT ?>
                   <select class="select2Dropdown form-control required" name="PROGRAM_ID" id="PROGRAM_ID"
                   data-tags="true" data-placeholder="Select Batch" data-allow-clear="true">

                   <option value="">Select Program</option>
                   <?php foreach ($program as $row): ?>
                    <option
                    value="<?php echo $row->PROGRAM_ID; ?>" <?php echo ($previous_info->PROGRAM_ID == $row->PROGRAM_ID) ? 'selected' : ''; ?>><?php echo $row->PROGRAM_NAME ; ?></option>

                <?php endforeach; ?>

            </select>

        <?php else: // if the form action is VIEW ?>

            <select class="select2Dropdown form-control required" name="BATCH_ID" id="BATCH_ID"
            data-tags="true" data-placeholder="Select Batch" data-allow-clear="true">
            <option value="">Select Program</option>
            <?php foreach ($batch as $row): ?>
                <option
                value="<?php echo $row->BATCH_ID; ?>"><?php echo $row->BATCH_TITLE ; ?></option>
            <?php endforeach; ?>
        </select>
    <?php endif; ?>
    <span class="validation"></span>
    
</div>

</div>      
<div class="form-group">
    <label class="col-md-2 control-label">Program <span class="text-danger">*</span></label> 
    <div class="col-lg-10">

        <?php if ($ac_type == "edit"): // if the form action is EDIT ?>
           <select class="select2DropdownMulti form-control required" name="PROGRAM_ID" id="PROGRAM_ID"
           data-tags="true" data-placeholder="Select Program" data-allow-clear="true">

           <option value="">Select Program</option>
           <?php foreach ($program as $row): ?>
            <option
            value="<?php echo $row->PROGRAM_ID; ?>" <?php echo ($previous_info->PROGRAM_ID == $row->PROGRAM_ID) ? 'selected' : ''; ?>><?php echo $row->PROGRAM_NAME ; ?></option>

        <?php endforeach; ?>

    </select>

<?php else: // if the form action is VIEW ?>

    <select class="select2DropdownMulti form-control required" name="PROGRAM_ID[]" id="PROGRAM_ID"
    data-tags="true" data-placeholder="Select Program" multiple="multiple">
    <option value="">Select Program</option>
    <?php foreach ($program as $row): ?>
        <option
        value="<?php echo $row->PROGRAM_ID; ?>"><?php echo $row->PROGRAM_NAME ; ?></option>
    <?php endforeach; ?>
</select>
<?php endif; ?>
<span class="validation"></span>

</div>

</div> 
<div class="form-group">
    <label class="col-md-2 control-label">Sessoin <span class="text-danger">*</span></label> 
    <div class="col-lg-10">

        <?php if ($ac_type == "edit"): // if the form action is EDIT ?>
           <select class="select2Dropdown form-control required" name="PROGRAM_ID" id="PROGRAM_ID"
           data-tags="true" data-placeholder="Select Session" data-allow-clear="true">

           <option value="">Select Sessoin</option>
           <?php foreach ($session as $row): ?>
            <option
            value="<?php echo $row->YSESSION_ID; ?>" <?php echo ($previous_info->PROGRAM_ID == $row->PROGRAM_ID) ? 'selected' : ''; ?>><?php echo $row->PROGRAM_NAME ; ?></option>

        <?php endforeach; ?>

    </select>

<?php else: // if the form action is VIEW ?>

    <select class="select2Dropdown form-control required" name="SESSION_ID" id="SESSION_ID"
    data-tags="true" data-placeholder="Select Session" data-allow-clear="true">
    <option value="">Select Sessoin</option>
    <?php foreach ($session as $row): ?>
        <option
        value="<?php echo $row->YSESSION_ID; ?>"><?php echo $row->SESSION_NAME ; ?></option>
    <?php endforeach; ?>
</select>
<?php endif; ?>
<span class="validation"></span>    
</div>
</div>
<div class="form-group"><label class="col-md-2 control-label">Active?</label>
    <div class="col-md-10">
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
        <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateBatchMap"
        data-su-action="setup/batchMapById" value="Update">
        <?php } else { ?>
        <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createBatchMap"
        data-su-action="setup/batchMapList" data-type="list" value="Submit">
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