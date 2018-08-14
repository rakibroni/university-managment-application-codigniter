<div class="panel panel-primary">             
    <div id="" class="panel-collapse collapse in" aria-expanded="true">
        <div class="panel-body">
        <h4>Courses Already Assign </h4>
            <table class="table table-bordered">
            <?php if(!empty($teacher_course_map)){ ?>
                <tbody>
                <tr  class="info">
                        <th>#</th>
                        <th>Course Code</th>
                        <th>Title</th>
                        <th class="text-center">Credit</th>                   
                        <th class="text-center">Action</th>                   
                    </tr>
                    <?php  $total_credit=0; $sl=1; foreach($teacher_course_map as $row): ?> 
                    <tr id="row_<?php   echo $row->TE_COURSE_MAP_ID ?>">
                        <td><?php echo $sl++; ?></td>
                        <td><?php echo $row->COURSE_CODE ?></td>
                        <td><?php echo $row->COURSE_TITLE ?></td>
                        <td class="text-center"><?php $total_credit += $row->CREDIT; echo $row->CREDIT ?></td>
                        <td class="text-center">
                            <a class="label label-danger deleteItem" id="<?php   echo $row->TE_COURSE_MAP_ID ?>" title="Click For Delete" data-type="delete" data-field="TE_COURSE_MAP_ID" data-tbl="teacher_course_map"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td colspan="3"><b class="pull-right">Total Credit:</b> </td>
                    <td  class="text-center"><?php echo $total_credit; ?></td>
                    <td  class="text-center"> </td>
                </tr>

            </tbody>
            <?php }else{ echo "No record found";} ?>
        </table>                             
    </div>
</div>
</div>