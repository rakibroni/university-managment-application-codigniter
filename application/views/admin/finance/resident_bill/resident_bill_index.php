
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Resident Bill</h5>
        <?php if ($previlages->CREATE == 1) { ?>
        <div class="ibox-tools">            
            <span title="Resident Bill Create" class="btn btn-primary btn-xs pull-right openModal" data-action="Finance/residentBillInsert">Add New </span>
        </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div id="printArea" class="table-responsive contentArea">
            <?php $this->load->view("admin/finance/resident_bill/resident_bill_list");  ?>
        </div>
    </div>
</div>
