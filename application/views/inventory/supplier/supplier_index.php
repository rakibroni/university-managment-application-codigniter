<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Supplier List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
            <div class="ibox-tools">
                            <span title="Create Supplier" class="btn btn-primary btn-xs pull-right openModal"
                                  data-action="inventory/supplierFormInsert"> Add New </span>
            </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("inventory/supplier/supplier_list"); ?>
        </div>

    </div>
</div>
