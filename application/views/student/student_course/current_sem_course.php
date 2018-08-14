
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Current Semester Course</h5>
    </div>
    <div class="ibox-content">
        <div class="table-responsive ">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>SN</th>
                    <th>Course Title</th>
                    <th>Code</th>
                </tr>
                </thead>
                <tbody>
                   <?php if(!empty($courses))$sl=1; foreach($courses as $row): ?>
                        <tr class="gradeX" id="row_">

                            <td><?php echo $sl++ ?> </td>
                            <td><?php echo $row->COURSE_TITLE ?> </td>
                            <td><?php echo $row->COURSE_CODE ?> </td>


                        </tr>
                <?php endforeach; ?>

                </tbody>
                <tfoot>
                <tr>
                    <th>SN</th>
                    <th>Course Title</th>
                    <th>Code</th>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
