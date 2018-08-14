<?php if (!empty($semCourse)): ?>
    <div class="flexys">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th><input type="checkbox" id="checkAllC" class="checkS clickcheck" name="selectAll"></th>
                <th>Title</th>
                <th>Code</th>
                <th>Credit</th>
            </tr>
            </thead>
            <tbody>

            <?php $sn = 1; ?>
            <?php foreach ($semCourse as $row) { ?>
                <tr>
                    <td><input type="checkbox" value="<?php echo $row->SEM_COURSE_ID ?>"
                               class="checkbox-primary checkS clickcheck" id="chkCourses" name="chkCourses[]"/></td>
                    <td><?php echo $row->COURSE_TITLE; ?></td>
                    <td><?php echo $row->COURSE_CODE; ?></td>
                    <td><?php echo $row->CREDIT; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php else: ?>
    <div class='text-danger'>Course not assign.</div>
<?php endif; ?>
<style>
    .flexys {
        display: block;
        width: 137%;
        border: 1px solid #eee;
        max-height: 200px;
        overflow: auto;
    }

    .toggle-div {
        display: none;
        padding: 10px;
        border-radius: 10px;
    }

    .toggle-div-course {
        display: none;
        background-color: #FCF8E3;
        padding: 10px;
        border-radius: 10px;
        width: 400px;
    }

    .toggle-div1 {
        padding: 10px;
        border-radius: 10px;
    }
</style>
<script>
    $("#checkAllC").click(function () {
        $(".checkS").prop('checked', $(this).prop('checked'));
    });
</script>