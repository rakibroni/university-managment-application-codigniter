<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Exam Type</h5>
        <?php  if ($previlages->CREATE == 1) { ?>
        <div class="ibox-tools">
                            <span title="Exam Type Setup" class="btn btn-primary btn-xs pull-right openModal"
                                  data-action="exam/examTypeFormInsert"> Add New </span>
        </div>
        <?php  } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/setup/exam/examType/examType_list"); ?>
        </div>

    </div>
</div>
