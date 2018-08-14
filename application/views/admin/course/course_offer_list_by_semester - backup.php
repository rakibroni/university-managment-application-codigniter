<div class="wrapper wrapper-content animated fadeInRight">
    <div class="table-responsive">
        <?php //echo "<pre>"; print_r($courses); exit()?>
        <?php if (!empty($courses)): ?>
            <table class="table table-striped table-bordered table-hover gridTable" >
                <thead>
                    <tr>
                        <th>SN</th>
                        <th><input type="checkbox" id="checkAll"></th>
                        <?php if ($flag == 1) { ?><th>Sequence</th> <?php } ?>
                        <th>Title</th>
                        <th></th>
                        <th>Category</th>
                        <th>Credit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $sn = 1; ?>
                    <?php foreach ($courses as $row) { ?>
                        <tr  class="gradeX"  id="row_<?php echo $row->COURSE_ID; ?>">
                            <td><span><?php echo $sn++; ?></span><span class="hidden" id="loader_<?php echo $row->COURSE_ID; ?>"></span></td>
                            <td><input type="checkbox" class="check" id="course_id" name="course_id[]" value="<?php echo $row->COURSE_ID; ?>" <?php echo ($row->IN_SEMESTER == 1) ? 'checked' : ''; ?>></td>
                            <?php if ($flag == 1) { ?><td><input type="text" style="width: 30px;" data-seq="seq_<?php echo $row->COURSE_ID; ?>"  id="course_id_<?php echo $row->COURSE_ID; ?>" class="form-control sequence" name="sequence<?php echo $row->COURSE_ID; ?>" value="<?php echo $row->SEQUENCE; ?>"></td><?php } ?>
                            <td><a data-action="course/courseDetails" course="<?php echo $row->COURSE_ID; ?>" class="openCourseDetailsModal" title="Course Details"><?php echo "<b>".$row->COURSE_CODE."</b>&nbsp;: ".$row->COURSE_TITLE."<br>"; ?></a></td>
                            <td><span><i class="fa fa-square" style="color: <?php echo $row->CAT_COLOR; ?>"></i></span></td>
                            <td><?php echo $row->CAT_NAME; ?></td>
                            <td><?php echo $row->CREDIT; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <th>SN</th>
                        <th></th>
                        <?php if ($flag == 1) { ?><th>Sequence</th> <?php } ?>
                        <th>Title</th>
                        <th></th>
                        <th>Category</th>
                        <th>Credit</th>
                    </tr>
                </tfoot>
            </table>
            <div class="row">
                <ul class="small-list" style="list-style:none;">
                    <?php foreach ($courseCat as $color): ?>

                            <i class="fa fa-square" style="color: <?php echo $color->CAT_COLOR; ?>"></i><span class="m-l-xs">&nbsp;&nbsp;<strong><?php echo $color->CAT_NAME; ?></strong></span>&nbsp;&nbsp;

                    <?php endforeach; ?>
                </ul>
            </div>
            <?php
        else :
            if ($flag == 1):
                echo "<div class='alert alert-danger'> Can't create Course Offer </div>";
            else:
                echo "<div class='alert alert-danger'> No Course Found </div>";
            endif;
        endif;
        ?>
    </div>

</div>
<script type="text/javascript">
    $(".gridTable").dataTable();
    $("#checkAll").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });

</script>