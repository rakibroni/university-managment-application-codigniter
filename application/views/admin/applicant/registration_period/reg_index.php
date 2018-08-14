<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>All Admission Registration Period</h5>
        <?php if ($previlages->CREATE == 1) { ?>
            <div class="ibox-tools">
                            <span title="Create registration period"
                                  class="btn btn-primary btn-xs pull-right openBigModal"
                                  data-action="setup/applicantRegPeriodForm"> Add New </span>
            </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/applicant/registration_period/reg_period_list"); ?>
        </div>
    </div>
</div>
         