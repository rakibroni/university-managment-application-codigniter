<div class="block-flat">
    <form class="form-horizontal frmContent" id="degree" method="post">
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="txtLibAuthId" value="<?php echo $lib_author->AUTHOR_ID ?>"/>
            <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div class="form-group"><label class="col-lg-3 control-label">Author Name<span
            class="text-danger">*</span></label>

            <div class="col-lg-8">
                <input type="text" id="libAuthName" name="libAuthName"
                value="<?php echo ($ac_type == 2) ? $lib_author->AUTHOR_NAME : '' ?>" class="form-control required"
                placeholder="Enter Library Author Name">
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Author Country<span
            class="text-danger">*</span></label>

            <div class="col-lg-8">
                <input type="text" id="libAuthCountry" name="libAuthCountry"
                value="<?php echo ($ac_type == 2) ? $lib_author->AUTHOR_COUNTRY : '' ?>" class="form-control required"
                placeholder="Enter Library Author Country Name">
                <span class="validation"></span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Remarks</label>

            <div class="col-lg-8">
              <textarea class="col-md-12"
              name="remarks"><?php echo ($ac_type == 2) ? $lib_author->REMARKS : ''; ?></textarea>
              <span class="validation"></span>
          </div>
      </div>
        <div class="hr-line-dashed"></div>
      <div class="form-group"><label class="col-lg-3 control-label">Active?</label>

        <div class="col-lg-8">
            <?php
            $ACTIVE_STATUS = ($ac_type == 2) ? $lib_author->ACTIVE_STATUS : '';
            $checked = ($ac_type == 2) ? (($lib_author->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
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
            <span class="help-block m-b-none">Example click checkbox .</span>
        </div>
    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-lg-offset-3 col-lg-10">
            <span class="modal_msg pull-left"></span>
            <?php if ($ac_type == 2) { ?>
            <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateLibAuthor"
            data-su-action="setup/libAuthorById" value="Update">
            <?php } else { ?>
            <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createlibAuthor"
            data-su-action="setup/libAuthorList" data-type="list" value="submit">
            <?php
        }
        ?>
        <input type="reset" class="btn btn-default btn-sm" value="Reset">
        <span class="loadingImg"></span>
    </div>
</div>
</form>
</div>
<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
</script>