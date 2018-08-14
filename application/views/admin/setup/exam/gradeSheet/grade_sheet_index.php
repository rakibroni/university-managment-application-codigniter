<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Exam Grade Sheet</h5>
        <?php  if ($previlages->CREATE == 1) { ?>
        <div class="ibox-tools">
                            <span title="Exam Grade Sheet" class="btn btn-primary btn-xs pull-right openModal"
                                  data-action="exam/gradeSheetFormInsert"> Add New </span>
        </div>
        <?php  } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/setup/exam/gradeSheet/grade_sheet_list"); ?>
        </div>

    </div>
</div>
