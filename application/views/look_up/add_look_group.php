<div class="block-flat">
    <form class="form-horizontal lookUpFrmContent" id="groups" method="post">
        <span class="frmMsg"></span>
        <br>

        <div class="form-group">
            <label class="col-sm-3 control-label">Group Name <span style="color: red">*</span></label>

            <div class="col-sm-5">
                <?php echo form_input('GRP_NAME', '', 'class ="form-control required" id = "country"'); ?>
                <span class="validation"></span>
                <span class="help-block m-b-none">Example:- Group name here.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-lg-offset-3 col-lg-10">
                <span class="modal_msg pull-left"></span>
                <input type="button" class="btn btn-primary btn-sm lookUpFormSubmit" data-action="lookUp/addLookupGroup"
                       data-su-action="#" value="submit">
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span>
            </div>
        </div>
    </form>
</div>