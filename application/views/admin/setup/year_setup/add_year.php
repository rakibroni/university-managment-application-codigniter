<link href="<?php echo base_url(); ?>assets/css/plugins/datapicker/datepicker3.css" rel="stylesheet">
<style>
    .datepicker.dropdown-menu {
        z-index: 9999 !important;
    }
</style>
<form class="form-horizontal frmContent" id="year" method="post">
    <div class="block-flat">
        <?php
        if ($ac_type == 2) {
            //var_dump($yearSetup); exit;
            ?>
            <input type="hidden" name="yearSetupId" class="rowID" value="<?php echo $yearSetup->YEAR_ID; ?>"/>
            <?php
        }
        ?>
        <span class="frmMsg"></span>

        <div>

        </div>
        <div class="form-group"><label class="col-lg-3 control-label">Title <span class="text-danger">*</span></label>

            <div class="col-lg-6">
                <input type="text" id="eventName" name="yearTile"
                value="<?php echo ($ac_type == 2) ? $yearSetup->YEAR_TITLE : '' ?>"
                class="form-control required" placeholder="Enter Title">
                <span class="validation"></span>
                <span class="help-block m-b-none ">e.g.  2016.</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">Start Date <span
            class="text-danger">*</span></label>

            <div class="col-lg-3">
                <div id="data_1">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                        <input type="text" name="startDate" class="form-control required"
                        value="<?php echo ($ac_type == 2) ? date('d/m/Y', strtotime($yearSetup->START_DT)) : '' ?>">
                    </div>
                </div>
                <span class="help-block m-b-none ">e.g.  2/10/2015</span>
            </div>
        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group"><label class="col-lg-3 control-label">End Date <span
            class="text-danger">*</span></label>

            <div class="col-lg-3">
                <div id="data_1">
                    <div class="input-group date">
                        <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text"
                        name="endDate"
                        class="form-control required"
                        value="<?php echo ($ac_type == 2) ? date('d/m/Y', strtotime($yearSetup->END_DT)) : '' ?>"
                        required>
                    </div>
                </div>
                <span class="help-block m-b-none ">e.g.  05/10/2015</span>
            </div>

        </div>
        <div class="hr-line-dashed"></div>
        <div class="form-group">
            <label class="col-lg-3 control-label"><span>Description</span></label>

            <div class="col-lg-8">
                <textarea class="redactor"
                name="content"><?php echo ($ac_type == 2) ? $yearSetup->YEAR_DESC : ''; ?></textarea>
                <span class="validation"></span>
                <span class="help-block m-b-none">e.g. year setup description text here.</span>
            </div>
        </div>

    </div>
    <div class="hr-line-dashed"></div>
    <div class="form-group">
        <div class="col-lg-offset-2 col-lg-10">
            <!--<span class="modal_msg pull-left"></span>-->
            <?php if ($ac_type == 2) { ?>
            <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/updateYearSetup"
            data-su-action="setup/yearSetupById" value="Update">
            <?php } else { ?>
            <input type="button" class="btn btn-primary btn-sm formSubmit" data-action="setup/createYearSetup"
            data-su-action="setup/yearSetupList" data-type="list" value="Submit">
            <?php
        }
        ?>
        <input type="reset" class="btn btn-default btn-sm" value="Reset">
        <span class="loadingImg"></span>
    </div>
</div>
</form>
</div>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/redactor/redactor.css"/>
<script src="<?php echo base_url(); ?>assets/redactor/redactor.min.js"></script>

<!-- Data picker -->
<script src="<?php echo base_url(); ?>assets/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<script type="text/javascript">
    $(document).ready(
        function () {
            $('.redactor').redactor();
        }
        );
    </script>
    <script>
        $(document).on('click', '.checkBoxStatus', function () {
            var status = ($(this).is(':checked')) ? 1 : 0;
            $("#status").val(status);


            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('#data_1 .input-group.date').datepicker({
                todayBtn: "linked",
                keyboardNavigation: false,
                forceParse: false,
                calendarWeeks: true,
                autoclose: true
            });
        });
    </script>