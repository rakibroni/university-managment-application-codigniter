<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Leave requests from Employee</h5>
        <?php // if ($previlages->CREATE == 1) { ?>
<!--        <div class="ibox-tools">-->
<!--                            <span title="Exam Grade Setup" class="btn btn-primary btn-xs pull-right openModal"-->
<!--                                  data-action="exam/gradeFormInsert"> Add New </span>-->
<!--        </div>-->
        <?php // } ?>
    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <?php $this->load->view("admin/leave_request/leave_request_list"); ?>
        </div>

    </div>
</div>
