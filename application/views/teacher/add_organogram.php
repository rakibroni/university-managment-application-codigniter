<div class="row">
    <form enctype="multipart/form-data" method="post" action="<?php echo base_url() ?>admin/saveOrganogum"
          class="form-horizontal">
        <div class="col-md-6">
            <div class="ibox-title">
                <h5>Create Organogam </h5>

                <div class="ibox-tools">
                </div>
            </div>
            <div class="ibox-content">
                <div class="form-group">
                    <label class="col-lg-3 control-label">Name</label>

                    <div class="col-lg-4">
                        <input type="text" value="" name="NAME" class="form-control  " id="dp1449738369065">

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-lg-3 control-label">Title</label>

                    <div class="col-lg-4">
                        <input type="text" value="" name="TITLE" class="form-control  " id="dp1449738369065">

                    </div>
                </div>

                <div class="form-group">
                    <label class="col-lg-3 control-label">Parent ID</label>

                    <div class="col-lg-4">
                        <select class="form-control" id="DAY_NAME" name="PARENT_ID">
                            <option value="">-Select-</option>
                            <?php if (!empty($parent)) foreach ($parent as $row) { ?>
                                <option value="<?php echo $row->ID ?>"><?php echo $row->TITLE ?></option>
                            <?php } ?>

                        </select>
                    </div>
                </div>


                <div class="form-group">
                    <div class="col-lg-offset-3 col-lg-10">
                        <span class="modal_msg pull-left"></span>
                        <input type="submit" value="submit" class="btn btn-primary btn-sm">
                        <input type="reset" value="Reset" class="btn btn-default btn-sm">
                        <span class="loadingImg"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">

        </div>
    </form>
</div>