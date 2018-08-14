<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Exam Schedule</h5>
        <div class="ibox-tools">
            <div class="col-md-2 pull-right">
            <select class="form-control">
                <option value="">-Select Session-</option>
                <option value="">Fall 14-15</option>
                <option value="">Spring 14-15</option>
            </select>
            </div>
        </div>
    </div>
    <div class="ibox-content">
        <div class="table-responsive ">
            <table class="table table-striped table-bordered ">
                <thead>
                <tr>
                    <th>Course</th>


                    <th>Date</th>
                    <th>Time</th>

                    <th>Room</th>

                    <th>Exam Name</th>



                </tr>
                </thead>
                <tbody>
                <?php foreach ($exam_schedule_list as $row): ?>
                    <tr class="gradeX" id="row_<?php echo $row->EX_SC_ID; ?>">
                        <td><?php echo $row->COURSE_TITLE ?>[<?php echo $row->COURSE_CODE ?>]</td>

                        <td><?php echo date('d-M-Y',strtotime($row->START_DT)) ?></td>
                        <td><?php echo $row->START_TIME.' - '.$row->END_TIME ?></td>
                        <td><?php echo $row->BR_NAME ?>[<?php echo $row->BR_CODE ?>]</td>

                        <td><?php echo $row->EX_TITLE ?></td>



                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
