<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Exam Grade Policy List</h5>
        <?php  if ($previlages->CREATE == 1) { ?>
        <div class="ibox-tools">
                            <span title="Exam Grade Policy Create" class="btn btn-primary btn-xs pull-right openModal"
                                  data-action="exam/policyFormInsert"> Add New </span>
        </div>
        <?php  } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/setup/exam/policy/policy_list"); ?>
        </div>

    </div>
</div>
