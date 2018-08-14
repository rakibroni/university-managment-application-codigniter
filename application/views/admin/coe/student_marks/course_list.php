<?php if ($courseList): ?>
    <div class="hr-line-dashed"></div>
    <table class="table table-bordered ">
        <thead>
        <tr>
            <th><input type="checkbox" id="checkAll"></th>
            <th>Course Title</th>
            <th>Marks</th>
        </tr>
        </thead>
        <tbody>
        <?php $sn = 1; ?>
        <?php foreach ($courseList as $row) { ?>
            <tr>
                <td><input type="checkbox" class="check" id="course_id" name="courseId[]"
                           value="<?php echo $row->COURSE_ID; ?>"></td>
                <td><?php echo "<b>" . $row->COURSE_CODE . "</b> " . $row->COURSE_TITLE; ?></td>
                <td>
                    <input type="number" name="marks<?php echo $row->COURSE_ID; ?>"
                           data-duration="marks_<?php echo $row->COURSE_ID; ?>"
                           id="marks_<?php echo $row->COURSE_ID; ?>" style="width:60px ;">
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
<?php else: ?>
    <p class="text-danger">No Course List Found !!</p>
<?php endif; ?>
<script type="text/javascript">
    $("#checkAll").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });
</script>