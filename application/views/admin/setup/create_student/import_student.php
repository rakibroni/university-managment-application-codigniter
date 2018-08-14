
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Student login Information</h5>
                </div>
                <div class="ibox-content">
                    <form class="form-horizontal" method="post" action="<?php echo base_url(); ?>eregistration/saveCsv"
                          enctype="multipart/form-data">

                        <div class="form-group">
                            <label class="col-lg-3 control-label">Upload Student file.<span style="color: red"> *</span></label>

                            <div class="col-lg-3">
                                <input type="file" id="" name="userfile" value="" class="form-control" required>
                                <span id="duplicate" style="color: red;"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-lg-3 control-label"></label>
                            <input type="reset" value="Reset" class="btn btn-sm btn-default">
                            <input type="submit" value="Submit" class="btn btn-sm badge-primary">
                        </div>
                    </form>

                </div>
            </div>
