<table class="table table-striped table-bordered table-hover responsive  gridTable">
    <thead>
    <tr>
        <th class="all">SN</th>
        <th class="all">Blog Category</th>
        <th>Description</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($blog_category)):
        $sn = 1;
        foreach ($blog_category as $row) { ?>
            <tr class="gradeX" id="row_<?php echo $row->BL_CAT_ID; ?>">
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <span><?php echo $sn++; ?></span><span class="hidden"
                                                           id="loader_<?php echo $row->BL_CAT_ID; ?>"></span></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->BL_CATEGORY; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>><?php echo $row->BL_CATEGORY_DESC; ?></td>
                <td <?php echo ($row->ACTIVE_STATUS == 1) ? "" : "class='inactive'"; ?>>
                    <a class="label label-default openModal" id="<?php echo $row->BL_CAT_ID; ?>"
                       title="Update Blog Category Information" data-action="setup/blogCatUpdate" data-type="edit"><i
                            class="fa fa-pencil"></i></a>
                    <a class="label label-danger deleteItem" id="<?php echo $row->BL_CAT_ID; ?>"
                       title="Click For Delete" data-type="delete" data-field="BL_CAT_ID" data-tbl="blog_category"><i
                            class="fa fa-times"></i></a>
                    <a class="itemStatus" id="<?php echo $row->BL_CAT_ID; ?>"
                       data-status="<?php echo $row->ACTIVE_STATUS ?>" data-fieldId="BL_CAT_ID"
                       data-field="ACTIVE_STATUS" data-tbl="blog_category" data-su-url="setup/blogCatById">
                        <?php echo ($row->ACTIVE_STATUS == 1) ? '<span class="label label-success" title="Click For Inactive">Inactive</span>' : '<span class="label label-danger" title="Click For Inactive">Active</span>' ?>
                    </a>
                </td>
            </tr>
        <?php } ?>
    <?php endif; ?>
    </tbody>
    <tfoot>
    <tr>
        <th>SN</th>
        <th>Blog Category</th>
        <th>Description</th>
        <th>Action</th>
    </tr>
    </tfoot>
</table>