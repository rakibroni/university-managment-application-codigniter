<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Grade Policy List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
            <div class="ibox-tools">
                            <span title="Create Grade Policy" class="btn btn-primary btn-xs pull-right openModal"
                                  data-action="Coe/gradePolicyForm"> Add New </span>
            </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/coe/grade_policy/grade_policy_list"); ?>
        </div>
    </div>
</div>
