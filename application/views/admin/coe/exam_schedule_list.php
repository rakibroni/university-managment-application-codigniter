<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>View All Exam Schedule</h5>
        <div class="ibox-tools">
            <a title="Create Exam" class="btn btn-primary btn-xs pull-right"
               href="examSchedule"> Add New </a>
        </div>
    </div>
    <div class="ibox-content">
        <div class="table-responsive ">
            <table class="table table-striped table-bordered table-hover gridTable ">
                <thead>
                <tr>
                    <th>Exam Name</th>
                    <th>Start Date</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Room</th>
                    <th>Roll</th>
                    <th>Program</th>
                    <th>Course</th>
                    <th>Session</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($exam_schedule_list as $row): ?>
                    <tr class="gradeX" id="row_<?php echo $row->EX_SC_ID; ?>">
                        <td><?php echo $row->EX_TITLE ?></td>
                        <td><?php echo $row->START_DT ?></td>
                        <td><?php echo $row->START_TIME ?></td>
                        <td><?php echo $row->END_TIME ?></td>
                        <td><?php echo $row->BR_NAME ?>[<?php echo $row->BR_CODE ?>]</td>
                        <td><?php echo $row->ROLL_NO_FROM ?> - <?php echo $row->ROLL_NO_TO ?></td>

                        <td><?php echo $row->PROGRAM_NAME ?></td>
                        <td><?php echo $row->COURSE_TITLE ?>[<?php echo $row->COURSE_CODE ?>]</td>
                        <td><?php echo $row->SESSION_NAME?></td>
                        <td>
                            <a class="label label-danger deleteItem" id="<?php echo $row->EX_SC_ID; ?>"
                               title="Click For Delete" data-type="delete" data-field="EX_SC_ID"
                               data-tbl="exam_schedule"><i
                                    class="fa fa-times"></i>
                            </a>&nbsp;
                            <a class="label label-default"   title="Update Exam"
                               href="examScheduleEdit/<?php echo $row->EX_SC_ID; ?>" data-type="edit"><i class="fa fa-pencil"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
