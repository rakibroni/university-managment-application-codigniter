<form class="form-horizontal" action="<?php echo base_url(); ?>notice/saveAcaNotice" method="post"
      enctype="multipart/form-data">
    <div class="ibox-title">
        <h5>Create Notice</h5>

        <div class="ibox-tools">
            <a href="<?php echo base_url() ?>notice/academicNotice">
                <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-arrow-left"></i> Back</button>
            </a>
        </div>
    </div>
    <div class="ibox-content">
        <div class="form-group">
            <label class="col-md-4 control-label">Notice For</label>

            <div class="col-md-4">
                <select name="USER_TYPE" class="user_type form-control">
                    <option value="">-Select-</option>
                    <?php foreach ($user_type as $row): ?>
                        <option value="<?php echo $row->USER_TYPE_ID ?>"><?php echo $row->USER_TYPE_NAME ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="user_group" style="display: none">
            <div class="form-group">
                <label class="col-md-4 control-label">User Group</label>

                <div class="col-md-3">
                    <select class="form-control" name="USERGRP_ID" id="USERGRP_ID">
                        <option value="">-Select-</option>
                        <?php foreach ($user_group as $row) { ?>
                            <option value="<?php echo $row->USERGRP_ID ?>"><?php echo $row->USERGRP_NAME ?></option>
                        <?php } ?>
                    </select>
                    <span class="red"><?php echo form_error('FACULTY'); ?></span>
                </div>

            </div>
            <div class="form-group">
                <label class="col-md-4 control-label">User Level</label>

                <div class="col-md-3">
                    <select class="form-control" name="USER_GRP_LVL_ID" id="USER_GRP_LVL_ID">
                        <option value="">-Select-</option>
                    </select>
                    <span class="red"><?php echo form_error('FACULTY'); ?></span>
                </div>
            </div>
        </div>

            <span class="university_faculty" style="display: none">
                <?php $this->load->view('common/faculty_dept_program'); ?>

            </span>

        <div class="form-group">
            <label class="col-md-4 control-label">Notice Title</label>

            <div class="col-lg-8">
                <input type="text" id="NOTICE_TITLE" name="NOTICE_TITLE" class="form-control required" value=""
                       placeholder="Notice Title">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Description</label>

            <div class="col-lg-8">
                <textarea name="NOTICE_DESCRIPTION" class="form-control"> </textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Upload File</label>

            <div class="col-lg-3">
                <input type="file" name="N_ATTACHMENT">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">From Date</label>

            <div class="col-md-2">
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value=""
                                                                                                class="form-control datepicker"
                                                                                                name="START_DATE">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">To Date</label>

            <div class="col-md-2">
                <div class="input-group date">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" value=""
                                                                                                class="form-control datepicker"
                                                                                                name="END_DATE">
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Is Global ?</label>

            <div class="col-lg-8">

                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'IS_GLOBAL',
                        'id' => 'status',
                        'class' => 'checkBoxStatus',
                        'value' => 0,
                        'checked' =>''
                    );
                    echo form_checkbox($data);
                    ?>
                </label>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-4 control-label">Is Important ?</label>

            <div class="col-lg-8">

                <label class="control-label">
                    <?php
                    $data = array(
                        'name' => 'IS_IMPORTANT',
                        'id' => 'IS_IMPORTANT',
                        'class' => 'checkBoxStatus',
                        'value' => 0,
                        'checked' => ''
                    );
                    echo form_checkbox($data);
                    ?>
                </label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-4 col-lg-10">
                <input type="submit" class="btn btn-primary btn-sm " value="submit">
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
        $(this).val(status);
    });


    // user lavel value on change user group
    $(document).on('change', '#USERGRP_ID', function () {
        var user_group_id = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo site_url('admin/userLavelByGrId'); ?>',
            data: {user_group_id: user_group_id},
            success: function (data) {
                $('#USER_GRP_LVL_ID').html(data);
            }
        });

    });
    $(document).on('change','.user_type',function(){
        var user_type=$(this).val();
        if(user_type !=''){
                if(user_type == '300'){
                    $('.university_faculty').show();
                    $('.user_group').hide();
                }else if(user_type == '290'){
                    $('.user_group').show();
                    $('.university_faculty').show();
                }else if(user_type == '291' || '292'){
                    $('.user_group').show();
                    $('.university_faculty').hide();
                }else{
                    $('.user_group').hide();
                    $('.university_faculty').hide();
                }
        }else{
            $('.user_group').hide();
            $('.university_faculty').hide();
        }
            });
</script>