<style type="text/css">
    .ibox-content {    
        padding: 5px 20px 23px !important;
    }
    .courseView ol {
        margin-left: -25px !important;
    }
</style>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="table-responsive">
        <div class="row">
            <h4><b><span style="color: green"><?php echo $session_name->SESSION_NAME; ?>  Offered Course List</span></b>
                <span><a href="<?php  echo base_url(); ?>common/coursecurriculum/<?php echo $session.'/'.$program.'/'.$offerType; ?>" target="_blank" class="btn btn-danger btn-xs pull-right "><i class="fa fa-file-pdf-o"></i> Print</a></span>
            </h4>

        </div>        
        <div class="row">
            <?php  foreach ($semester as $row): ?>
                <div class="col-lg-12">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5><?php echo $row->SEMESTER_NAME; ?></h5>
                        </div>
                        <div class="ibox-content courseView" id="course_<?php echo  $row->SL_NO; ?>">
                            <ol class="sortable">
                                <?php 
                                $courseOffer = $this->db->query("SELECT a.SEM_COURSE_ID,
                                                                           a.FACULTY_ID,
                                                                           a.DEPT_ID,
                                                                           a.PROGRAM_ID,
                                                                           a.COURSE_ID,
                                                                           a.OFFERED_COURSE_ID,
                                                                           c.COURSE_CODE,
                                                                           c.COURSE_TITLE
                                                                           FROM aca_semester_course a
                                                                           LEFT JOIN aca_course_offer b
                                                                           ON a.OFFERED_COURSE_ID = b.OFFERED_COURSE_ID
                                                                           LEFT JOIN aca_course c ON b.COURSE_ID = c.COURSE_ID
                                                                           WHERE     a.PROGRAM_ID =$program
                                                                           AND b.OFFER_TYPE = '$offerType'
                                                                           AND a.SESSION_ID = '$session'
                                                                           AND a.SEMESTER_ID = $row->SL_NO")->result();
                                if(!empty($courseOffer)):   
                                    foreach ($courseOffer as $rows) {
                                        ?>                               
                                        <li><a id="courseItem_<?php echo $rows->SEM_COURSE_ID; ?>" data-action="course/courseDetails" course="<?php echo $rows->COURSE_ID; ?>" class="openCourseDetailsModal" title="Course Details"><?php echo $rows->COURSE_CODE."&nbsp;: ".$rows->COURSE_TITLE."</a>"; ?><span>&nbsp;&nbsp;&nbsp;&nbsp;<a class="semOfferedDeleteItem text-danger" id="<?php echo $rows->SEM_COURSE_ID; ?>" title="Click For Delete"  data-type="delete" data-field="SEM_COURSE_ID" data-tbl="aca_semester_course" data-semester="<?php echo $row->SEMESTER_ID; ?>" data-program="<?php echo $program; ?>" offerType="<?php echo $offerType; ?>"><i class="fa fa-times"></i></a></span></li>
                                        <?php
                                    }
                                    endif;
                                    ?>
                                </ol>
                                <a title="Semester Course Offered" class="label label-primary label-sm pull-left openOfferCourseModal" data-action="course/offeredCourse" data-semester="<?php echo $row->SL_NO; ?>" data-program="<?php echo $program; ?>" offerType="<?php echo $offerType; ?>" session="<?php echo $session; ?>">+ Add Course </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>            
        </div>

    </div>
    <script type="text/javascript">
        $(".gridTable").dataTable();
        $("#checkAll").click(function () {
            $(".check").prop('checked', $(this).prop('checked'));
        }); 
        $(function() {
            $( ".sortable" ).sortable();
            $( ".sortable" ).disableSelection();
        });
    </script>