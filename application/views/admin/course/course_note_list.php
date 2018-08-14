<table class="table table-striped table-bordered table-hover gridTable">
    <thead>
    <tr>
        <th>SN</th>
        <th>Content Title</th>
        <th>Content Type</th>
        <th>File</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php $i = 1;
    foreach ($course_content as $cc): ?>
        <tr>
            <td><?php echo $i++ ?></td>
            <td><?php echo $cc->CONTENT_TITLE ?></td>
            <td><?php echo $cc->CONT_TYPE ?></td>
            <td><a href="<?php echo base_url(); ?>upload/course_content/<?php echo $cc->CONTENT_URI ?>"
                   target="_blank"><?php echo $cc->CONTENT_URI ?></a></td>
            <td><a href="<?php echo base_url(); ?>admin/editCourseContent/<?php echo $cc->C_CONTENT_ID ?>"
                   class="btn btn-xs btn-primary"><i class="fa fa-edit"></i></a></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
    <tfoot>
    <tr>
        <th>SN</th>
        <th>Name</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>