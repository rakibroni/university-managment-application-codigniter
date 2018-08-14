<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Charge List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
            <div class="ibox-tools">
                            <span title="Charge Create" class="btn btn-primary btn-xs pull-right openModal"
                                  data-action="setup/chargeFormInsert"> Add New </span>
            </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/setup/expense/charge_list"); ?>
        </div>
    </div>
</div>
