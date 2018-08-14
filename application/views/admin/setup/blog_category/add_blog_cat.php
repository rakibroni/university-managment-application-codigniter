<form class="form-horizontal frmContent" id="blog_cat" method="post">
    <div class="ibox-content">
        <span class="frmMsg"></span>
        <?php
        if ($ac_type == 2) {
            ?>
            <input type="hidden" class="rowID" name="BL_CAT_ID" value="<?php
            echo $blog_category->BL_CAT_ID
            ?>"/>
        <?php
        }
        ?>
        <div class="form-group">
            <label class="col-lg-4 control-label">Blog Category Name</label>

            <div class="col-lg-8">
                <input type="text" id="BL_CATEGORY" name="BL_CATEGORY" class="form-control required" value="
            <?php
                echo ($ac_type == 2) ? $blog_category->BL_CATEGORY : ''
                ?>" placeholder="Blog Category Name">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-4 control-label">Description</label>

            <div class="col-lg-8">
                <input type="text" id="BL_CATEGORY_DESC" name="BL_CATEGORY_DESC" class="form-control" value="<?php
                echo ($ac_type == 2) ? $blog_category->BL_CATEGORY_DESC : '' ?>"
                       placeholder="Blog Category Description">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-4 control-label">Is Active ?</label>

            <div class="col-lg-8">
                <?php
                $ACTIVE_STATUS = ($ac_type == 2) ? $blog_category->ACTIVE_STATUS : '';
                $checked = ($ac_type == 2) ? (($blog_category->ACTIVE_STATUS == '1') ? TRUE : FALSE) : '';
                ?>
                <label class="control-label">
                    <?php
                    $data = array('name' => 'ACTIVE_STATUS', 'id' => 'status', 'class' => 'checkBoxStatus', 'value' => 1, 'checked' => $checked);
                    echo form_checkbox($data);
                    ?>
                </label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-4 col-lg-8">
                <?php
                if ($ac_type == 2) { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateBlogCat"
                           data-su-action="setup/blogCatById" value="Update">
                <?php
                } else { ?>
                    <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createBlogCat"
                           data-su-action="setup/blogCatList" data-type="list" value="submit">
                <?php
                }
                ?>
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</form>
<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
    // user lavel value on change user group
    $(document).on('change', '#USERGRP_ID', function () {
        var user_group_id = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php
echo site_url('admin/userLavelByGrId'); ?>',
            data: {user_group_id: user_group_id},
            success: function (data) {
                $('#USER_GRP_LVL_ID').html(data);
            }
        });
    });
</script>