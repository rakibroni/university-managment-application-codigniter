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
<div class="ibox-title">
    <h4>Create Blog <a class="btn btn-primary btn-xs pull-right" href="<?php
        echo base_url(); ?>teacher/blogList"> Back </a></h4>
</div>
<form class="form-horizontal" action="<?php
echo base_url(); ?>teacher/createBlog" method="post" enctype="multipart/form-data">
    <div class="ibox-content">
        <span class="frmMsg"></span>
 
        <div class="form-group">
            <label class="col-lg-2 control-label">Blog Title</label>

            <div class="col-lg-8">
                <input type="text" id="POST_TITLE" name="POST_TITLE" class="form-control required" value=""
                       placeholder="Blog Title">
            </div>
        </div>
 
        <div class="form-group">
            <label class="col-lg-2 control-label">Banner</label>

            <div class="col-lg-8">
                <input id="uploadFile" placeholder="Choose File" name="tt" disabled="disabled"/>

                <div class="fileUpload btn btn-primary btn-xs">
                    <span>Upload</span>
                    <input id="uploadBtn" type="file" name="POST_BANNER" class="upload"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">Description</label>

            <div class="col-lg-8">
                <textarea rows="10" name="POST_CONTENT" class="form-control redactor"></textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">Blog Tag</label>

            <div class="col-lg-4">
                <input type="text" placeholder="Ex: C, C++, JAVA" class="form-control" name="POST_TAGS">
            </div>
        </div>
        <div class="form-group">
            <label class="col-lg-2 control-label">Is Active?</label>

            <div class="col-lg-8">

                <label class="control-label">
                    <?php
                    $data = array('name' => 'ACTIVE_STATUS', 'id' => 'status', 'class' => 'checkBoxStatus', 'value' => 1, 'checked' => 'checked');
                    echo form_checkbox($data);
                    ?>
                </label>
            </div>
        </div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-8">
                <input type="submit" class="btn btn-primary btn-sm formSubmit" data-action="setup/createBlogCat"
                       data-su-action="setup/blogCatList" data-type="list" value="submit">
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</form>

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
        var status = ($(this).is(':checked') ) ? 1 : 0;
        $("#status").val(status);
    });

    document.getElementById("uploadBtn").onchange = function () {
        document.getElementById("uploadFile").value = this.value;
    };
</script>