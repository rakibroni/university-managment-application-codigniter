<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Distributed Course Content </h5>

    </div>
    <div class="ibox-content">
        <div class="table-responsive contentArea">
            <form id="frmCourseOffer">
                <table class="table table-striped table-bordered table-hover gridTable">
                    <thead>
                    <tr>
                        <th>SN</th>
                        <th>Content Title</th>
                        <th>Content</th>
                        <th>Program</th>
                        <th>Batch</th>
                        <th>Session</th>
                        <th>Semester</th>
                        <th>Course Code</th>
                        <th>Course Title</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $i = 1;
                    foreach ($dis_content as $row):
                        ?>
                        <tr id="row_id_<?php echo $row->CONTENT_DIST_ID ?>">
                            <td><?php echo $i++ ?></td>
                            <td><?php echo $row->CONTENT_TITLE ?></td>
                            <td><a href="<?php echo base_url(); ?>upload/course_content/<?php echo $row->CONTENT_URI ?>"
                                   target="_blank"><?php echo $row->CONTENT_URI ?></a></td>
                            <td><?php echo $row->PROGRAM_NAME ?></td>
                            <td><?php echo $row->BATCH_TITLE ?></td>
                            <td><?php echo $row->SESSION_NAME ?></td>
                            <td><?php echo $row->LKP_NAME ?></td>
                            <td><?php echo $row->COURSE_CODE ?></td>
                            <td><?php echo $row->COURSE_TITLE ?></td>
                            <td>

                                <a attribute_id="<?php echo $row->CONTENT_DIST_ID ?>" attribute="CONTENT_DIST_ID"
                                   table_name="aca_crs_content_distribution" class="label label-danger delete_row_data"><i
                                        class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    <?php
                    endforeach;
                    ?>
                    </tbody>

                </table>
            </form>
        </div>
    </div>
</div>
<script>
    $(document).on('click', '.delete_row_data', function () {
        if (confirm("Are you sure?")) {
            var attribute_id = $(this).attr('attribute_id'),
                attribute = $(this).attr('attribute'),
                table_name = $(this).attr('table_name');

            $.ajax({
                type: 'POST',
                url: '<?php echo base_url(); ?>common/delRowData',
                data: {
                    attribute_id: attribute_id,
                    attribute: attribute,
                    table_name: table_name
                },
                success: function (data) {
                    if (data == 'Y') {
                        $('#row_id_' + attribute_id).remove();

                    }
                }
            });
        }
        return false;
    });
</script>