<div class="block-flat">
    <form class="form-horizontal frmContent" id="degree" method="post">
        <span class="frmMsg"></span>

        <div class="form-group">
            <label class="col-lg-3 control-label">Program</label>

            <div class="col-lg-9">
                <select name="program_id" id="" class="form-control">
                    <option value="">select</option>
                    <?php foreach ($program as $row) { ?>
                        <option value="<?php echo $row->PROGRAM_ID ?>"><?php echo $row->PROGRAM_NAME ?></option>
                    <?php } ?>
                </select>
                <span class="help-block m-b-none">Example:- Select B.A (Hons.) in Islamic Studies.</span>
            </div>
        </div>
        <div class="form-group"><label class="col-lg-3 control-label">Program Part Name</label>

            <div class="col-lg-9">
                <input type="text" id="programPartName" name="programPartName" class="form-control"
                       placeholder="Program Part Name">
                <span class="help-block m-b-none">Example:- CORE text here.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Active?</label>

            <div class="col-lg-9">
                <input type="checkbox" id="status" name="status"/>
                <span class="help-block m-b-none">Example click checkbox .</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-9">
                <span class="modal_msg pull-left"></span>
                <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createProgramPart"
                       data-su-action="setup/getProgramPart" value="submit">
                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                <span class="loadingImg"></span>
            </div>
        </div>
    </form>
</div>