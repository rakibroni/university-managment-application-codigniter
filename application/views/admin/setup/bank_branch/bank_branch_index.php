<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Bank Branch List</h5>
        <!--?php if ($previlages->CREATE == 1) { ?-->
        <div class="ibox-tools">
                        <span title="Bank Branch Create" class="btn btn-primary btn-xs pull-right openModal"
                              data-action="setup/bankBranchFormInsert"> Add New </span>
        </div>
        <!--?php } ?-->
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/setup/bank_branch/bank_branch_list"); ?>
        </div>

    </div>
</div>