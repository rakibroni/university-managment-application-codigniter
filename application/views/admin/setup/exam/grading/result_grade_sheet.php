<style type="text/css">

    table#interpretation_tbl { 
        background-color: #f1f1c1;
    } 
    
</style>
<div class="row">
 <div class="col-md-12"><button id="print_grade_sheet_btn" class="btn btn-xs btn-danger pull-right"><i class="fa fa-print"></i>Print</button></div>  
</div>
<div id="printablediv">

    <table class="table">
        <tr>
            <td>
                <table class="table table-bordered">
                    <tr>
                        <td class="text-center" colspan="4"><img width="60" src="<?php echo base_url(); ?>/assets/img/logo/kyau_web.png"></td>
                    </tr>
                    <tr>
                        <td class="text-center" colspan="4" style="padding: 2px !important"><h4><b>KHWAJA YUNUS ALI UNIVERSITY<br>Grade Sheet</b></h4>  </td>
                    </tr>
                    <tr>
                        <th>Department:</th>
                        <td><?php echo $ins_dept->DEPT_ABBR ?></td>
                        <th>Batch No:</th>
                        <td><?php echo $aca_batch->BATCH_TITLE ?></td>
                    </tr>
                    <tr>
                        <th>Program:</th>
                        <td><?php echo $ins_program->PROGRAM_SHORT_NAME ?></td>
                        <th>Examination:</th>
                        <td><?php echo $session->SESSION_NAME ?></td>
                    </tr>
                    <tr>
                        <th>Course Code:</th>
                        <td><?php echo $aca_course->COURSE_CODE ?></td>
                        <th>Credit:</th>
                        <td><?php echo $aca_course->CREDIT ?></td>
                    </tr>
                    <tr>
                        <th>Course Title:</th>
                        <td><?php echo $aca_course->COURSE_TITLE ?></td>
                        <th>Section:</th>
                        <td><?php echo $aca_section->NAME ?></td>
                    </tr>  
                    <tr>
                        <th>Course Teacher:</th>
                        <td><?php echo $employe->FULL_ENAME ?></td>
                        <th>Date of Submission:</th>
                        <td></td>
                    </tr>
                </table>
            </td>
            <td>
                <table id="interpretation_tbl" class="table-bordered">
                    <tr>
                        <th colspan="3" class="text-center">INTERPRETATION OF GRADE</th>
                    </tr>
                    <tr>
                        <th class="text-center">Range of Marks</th>
                        <th class="text-center">Grade Points</th>
                        <th class="text-center">Letter Grade</th>
                    </tr>
                    <?php if(!empty($exam_grade)): foreach($exam_grade as $roweg): ?>
                        <tr>
                            <td class="text-center" colspan="<?php if($roweg->GR_LETTER =='I' || $roweg->GR_LETTER =='W'){echo "2";} ?> ">
                                <?php
                                if($roweg->GR_LETTER =='I'){
                                    echo "Incomplete";
                                }elseif($roweg->GR_LETTER =='W'){
                                    echo "Withdrawal";
                                }else{
                                    echo $roweg->GR_MARKS_FROM.'% - '.$roweg->GR_MARKS_TO.'%';
                                } 

                                ?>

                            </td>
                            <?php if($roweg->GR_LETTER =='I' || $roweg->GR_LETTER =='W'){ ?> 

                            <?php }else{ ?>
                            <td class="text-center"><?php echo $roweg->GRADE_POINT; ?></td>
                            <?php } ?>
                            <td class="text-center"><?php echo $roweg->GR_LETTER; ?></td>
                        </tr>
                    <?php endforeach; endif; ?>
                </table>
            </td>
        </tr>
    </table>  
    <table class="table table-bordered">
        <tr>
            <th class="text-center">Sl. No.</th>
            <th>Registration No. (ID)</th>
            <th>Name of the student</th>
            <?php
            $mark_type_id=array();
            if(!empty($exam_grade_sheet)){
                foreach($exam_grade_sheet as $row){
                    $mark_type_id []=$row->EXAM_MARKS_TYPE_ID;
                    ?>
                    <th><?php echo $row->MARKS_TITLE.' ('.$row->MARKS_PER.')'; ?></th>
                    <?php }} ?>

                    <th>Total Marks(100)</th>
                    <th>Grade point(GP)</th>
                    <th>Letter Grade(LG)</th>
                    <th>Remarks</th>
                </tr>
                <?php
                if(!empty($course_student)){ $sl=1; foreach($course_student as $row){
                    ?>
                    <tr>
                        <td class="text-center"><?php echo $sl++; ?></td>
                        <td><?php echo $row->REGISTRATION_NO; ?></td>
                        <td><?php echo $row->FULL_NAME_EN; ?></td>


                        <?php $remarks=''; $total_marks=0; foreach ($mark_type_id as $key => $value) {?>
                        <td class="text-center">
                           <?php
                           $student_mark=$this->exam_model->getCourseMarkByStudent($row->PROGRAM_ID,$row->BATCH_ID,$row->SECTION_ID,$row->SESSION_ID,$row->COURSE_ID,$row->STUDENT_ID,$value);


                           if(!empty($student_mark)):
                            $marks_with_grace =$student_mark->MARKS + $student_mark->GRACE_MARKS_PER;
                            $total_marks +=$marks_with_grace;
                        echo $marks_with_grace;
                        $remarks .=$student_mark->REMARKS.' ';
                        endif; 
                        ?></td>   
                    </td>

                    <?php } ?>

                    <td class="text-center"><?php echo  $total_marks; ?></td>
                    <td class="text-center"><?php $grade_point=$this->exam_model->gradePointLetter($total_marks);  if(!empty($grade_point )){echo $grade_point->GRADE_POINT;} ?></td>
                    <td class="text-center"><?php $grade_letter=$this->exam_model->gradePointLetter($total_marks); if(!empty($grade_letter)){echo $grade_letter->GR_LETTER;} ?></td>
                    <td><?php echo $remarks; ?></td>

                </tr>

                <?php }} ?>
            </table>
            <?php //print_r($mark_type_id); ?>


            <br><br>


            <table class="table ">
                <tr>
                    <td>..................................................<br>Signature of Course Teacher<br>Date:........................................</td>
                    <td>..................................................<br>Signature of Scrutinizer<br>Date:........................................</td>
                    <td>..................................................<br>Signature of Head With Seal<br>Date:........................................</td>
                </tr>

            </table> 

        </div>
        <script type="text/javascript">
            $(document).ready(function(){


                $( "#print_grade_sheet_btn" ).click(function() {
                  $('#printablediv').printThis({
                    pageTitle: " ",
                    loadCSS: "",
                    header: "<h1>Grade Sheet</h1>"
                });
              });

            });
        </script>

    </div>
