<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Registration Period List</h5>

        <div class="ibox-tools">
                <span title="Create Registration Period" class="btn btn-primary btn-xs pull-right openModal"
                      data-action="setup/regPeriodForm"> Add New </span>
        </div>

    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/setup/registration_period/reg_period_list"); ?>
        </div>
    </div>
</div>
