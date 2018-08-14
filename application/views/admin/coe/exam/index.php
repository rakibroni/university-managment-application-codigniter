<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Exam List</h5>
        <?php if ($previlages->CREATE == 1) { ?>
            <div class="ibox-tools">
                            <span title="Create Exam" class="btn btn-primary btn-xs pull-right openBigModal"
                                  data-action="Coe/examForm"> Add New </span>
            </div>
        <?php } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/coe/exam/exam_list"); ?>
        </div>
    </div>
</div>
