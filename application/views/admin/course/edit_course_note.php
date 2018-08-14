<div class="row">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>Course Content Edit</h5>

            <div class="ibox-tools">
                <a href="<?php echo base_url(); ?>admin/courseContent">
                    <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-arrow-left"></i> Back</button>
                </a>
            </div>
        </div>
        <form class="form-horizontal" id="" action="<?php echo base_url(); ?>admin/updateCourseContent" method="post"
              enctype="multipart/form-data">
            <div class="col-md-12">
                <div class="ibox-content">
                    <span class="frmMsg"></span>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Content Type</label>

                        <div class="col-lg-5">
                            <select name="CONT_TYPE_ID" required>
                                <option>-Select-</option>
                                <?php foreach ($content_type as $row): ?>
                                    <option
                                        value="<?php echo $row->CONT_TYPE_ID ?>"<?php echo ($previous_info->CONT_TYPE_ID == $row->CONT_TYPE_ID) ? 'selected' : '' ?>><?php echo $row->CONT_TYPE ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Content Title</label>

                        <div class="col-lg-5">
                            <input type="text" id="CONTENT_TITLE" name="CONTENT_TITLE"
                                   value="<?php echo $previous_info->CONTENT_TITLE ?>" class="form-control" required>
                            <input type="hidden" name="C_CONTENT_ID" value="<?php echo $previous_info->C_CONTENT_ID ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Upload File</label>

                        <div class="col-lg-5">
                            <input type="file" id="" name="course_content" value="">
                            <a href="<?php echo base_url(); ?>upload/course_content/<?php echo $previous_info->CONTENT_URI ?>"
                               target="_blank"><?php echo $previous_info->CONTENT_URI ?></a>
                        </div>
                    </div>
                    <div class="hr-line-dashed"></div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Active?</label>

                        <div class="col-lg-5">
                            <?php $checked = ($previous_info->ACTIVE_STATUS == 1) ? 'checked' : '' ?>
                            <label class="control-label">
                                <?php
                                $data = array(
                                    'name' => 'status',
                                    'id' => 'status',
                                    'class' => 'checkBoxStatus',
                                    'value' => $previous_info->ACTIVE_STATUS,
                                    'checked' => $checked
                                );
                                echo form_checkbox($data);
                                ?>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-offset-3 col-lg-10">
                            <span class="modal_msg pull-left"></span>
                            <input type="submit" class="btn btn-primary btn-sm" value="submit">
                            <input type="reset" class="btn btn-default btn-sm" value="Reset">
                            <span class="loadingImg"></span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="hr-line-dashed"></div>
</form>
</div>
<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });
</script>