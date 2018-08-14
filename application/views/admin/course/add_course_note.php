<style type="text/css">
    .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 5px;
    }
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
</style>
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Course Content Upload</h5>
        <div class="ibox-tools">
            <a href="<?php echo base_url(); ?>teacher/courseContent">
                <button class="btn btn-primary btn-xs" type="button"><i class="fa fa-arrow-left"></i> Back</button>
            </a>
        </div>
    </div>
    <form class="form-horizontal" id="" action="<?php echo base_url(); ?>teacher/createCourseContent" method="post"
          enctype="multipart/form-data">
        <div class="ibox-content">
            <span class="frmMsg"></span>
            <div class="form-group">
                <label class="col-lg-3 control-label">Content Type</label>
                <div class="col-lg-2">
                    <select name="CONT_TYPE_ID" class="form-control" required>
                        <option>-Select-</option>
                        <?php foreach ($content_type as $row): ?>
                            <option value="<?php echo $row->CONT_TYPE_ID ?>"><?php echo $row->CONT_TYPE ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Content Title</label>
                <div class="col-lg-5">
                    <input type="text" id="CONTENT_TITLE" name="CONTENT_TITLE" value="" class="form-control" required>
                </div>
            </div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Upload File</label>

                <div class="col-lg-8">
                    <input id="uploadFile" placeholder="Choose File" name="tt" disabled="disabled"/>

                    <div class="fileUpload btn btn-primary btn-xs">
                        <span>Upload</span>
                        <input id="uploadBtn" type="file" name="course_content" class="upload"/>
                    </div>
                </div>
            </div>
            <div class="hr-line-dashed"></div>
            <div class="form-group">
                <label class="col-lg-3 control-label">Active?</label>
                <div class="col-lg-5">
                    <label class="control-label">
                        <?php
                        $data = array(
                            'name' => 'status',
                            'id' => 'status',
                            'class' => 'checkBoxStatus',
                            'value' => 1,
                            'checked' => 'checked'
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

    </form>
</div>
<div class="hr-line-dashed"></div>
</form>
</div>
<script>
    $(document).on('click', '.checkBoxStatus', function () {
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });

    document.getElementById("uploadBtn").onchange = function () {
        document.getElementById("uploadFile").value = this.value;
    };
</script>