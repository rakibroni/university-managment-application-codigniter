<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Requisition List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
            <div class="ibox-tools">
                            <span title="Create Requisition" class="btn btn-primary btn-xs pull-right openBigModal"
                                  data-action="inventory/requisitionFormInsert"> Add New </span>
            </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("inventory/requisition/requisition_list"); ?>
        </div>

    </div>
</div>
