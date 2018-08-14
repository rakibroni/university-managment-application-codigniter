<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Email Template List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
            <div class="ibox-tools">
                            <span title="Email Template Create" class="btn btn-primary btn-xs pull-right openModal"
                                  data-action="setup/emailTemFormInsert"> Add New </span>
            </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/setup/email_template/email_template_list"); ?>
        </div>

    </div>
</div>
