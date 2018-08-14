
<h3><span style="color: red;">Course Assign already existed </span>|| Course Assign List 
    <a data-placement="top"
    data-toggle="tooltip"
    data-action="course/courseOfferAdd"
    offerType="<?php echo $offer_type; ?>"
    faculty="<?php// echo $faculty; ?>"
    dept="<?php //echo $department; ?>"
    program="<?php echo $program; ?>"
    data-title="Create course assign"
    class="btn btn-primary btn-sm pull-right openOfferModal">
    Add New </a>
</h3>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="courseList"></div>
    <div class="table-responsive">
        <?php if(empty($offered_courses)){echo "<p>No course found</p>";}else{ ?>
        <table id="course_offer_table" class="table table-striped table-bordered table-hover gridTable ">
            <thead>
                <tr>
                    <th>sn</th>
                    <th>Code</th>                         
                    <th>Title</th>                         
                    <th>Category</th>
                    <th>Credit</th>
                    <th> Duration</th>
                    <th>Min Credit Limit</th>                        
                    <th>Prerequisit</th>                        
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $sl=1; foreach($offered_courses as $row){ ?>
                <tr id="row_<?php echo  $row->OFFERED_COURSE_ID  ?>">
                    <td><?php echo $sl++ ?></td>
                    <td><?php echo $row->COURSE_CODE ?></td>                    
                    <td><?php echo $row->COURSE_TITLE ?></td>                    
                    <td><?php echo $row->CAT_NAME ?></td>
                    <td><?php echo $row->CREDIT ?></td>
                    <td><?php echo $row->DURATION ?></td>
                    <td><?php echo $row->DURATION ?></td>
                    <td >
                        <?php
                        $pre_course=$this->course_model->getCourseWisePrerequisitionCourse($program,$row->COURSE_ID,$offer_type);                     
                        if(!empty($pre_course)):
                            foreach ($pre_course as $pre_crs_row) {
                                echo $pre_crs_row->COURSE_CODE.' , ';
                            }
                            endif;
                            ?>                         
                        </td>
                        <td class="text-center"> 
                            <a class="label label-danger deleteCourseOffered"
                            id="<?php echo $row->OFFERED_COURSE_ID; ?>" data-type="delete"
                            data-field="OFFERED_COURSE_ID" data-tbl="aca_course_offer"><i
                            class="fa fa-times"></i></a>

                            <a  class="label label-warning openPreModal"  title="Add Prerequisite Course" course_id="<?php echo $row->COURSE_ID ?>" program="<?php echo $program; ?>" offer_type="<?php echo $offer_type; ?>" data-action="course/coursePrerequisite" data-type="edit"><i class="fa fa-plus"></i>&nbsp;
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php } ?>
            </div>
        </div>

        <script type="text/javascript">

            $(document).ready(function () {
                $(".gridTable").dataTable();
            });

            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
