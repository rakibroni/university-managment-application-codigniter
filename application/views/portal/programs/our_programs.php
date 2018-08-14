<div class="col-md-12">
    <div class="widget-main">
        <div class="widget-inner shortcode-typo">
            <div class="row">
                <div class="col-md-12">
                    <h4>Our Programs</h4>
                    <div class="tab-content" id="my-tab-content">
                        <div id="section-1" class="tab-pane fade in active">
                            <div class="row">
                            	<table class="table table-bordered">
								    <thead>
								      	<tr>
								        	<th rowspan="2">S.L</th>
								        	<th rowspan="2">Faculty</th>
								        	<th rowspan="2">Department</th>
								        	<th colspan="5" class="text-center">Program</th>
								      	</tr>
								      	<tr>							        	
								        	<td>Name</td>
								        	<td>Credit</td>
								        	<td>Duration</td>
								        	<td>Semesters</td>
								        	<td>Fees</td>
								      	</tr>
								    </tdead>
								    <tbody>
	                            	<?php 
	                            		$i = 1;
	                            		$faculty = $this->db->query("SELECT FACULTY_ID, FACULTY_NAME FROM faculty 
																	WHERE ACTIVE_STATUS = 1 AND ADMINISTRATION = 0
																	ORDER BY FACULTY_NAME")->result();
	                            		foreach ($faculty as $f_row) {
	                            			echo "<tr>";	     
	                            			$pro_count = $this->db->query("SELECT count(PROGRAM_ID)p_count FROM program WHERE FACULTY_ID = $f_row->FACULTY_ID")->row();
	                            			echo "<td rowspan=".$pro_count->p_count.">".$i++."</td>";
		                            		echo "<td rowspan=".$pro_count->p_count."><b>".$f_row->FACULTY_NAME."</b></td>";
	                            			$dept_C = $this->db->query("SELECT DEPT_ID, DEPT_NAME
																		FROM department
																		WHERE FACULTY_ID = $f_row->FACULTY_ID")->result();
	                            			foreach ($dept_C as $d_row) {
	                            				$dept_count = $this->db->query("SELECT count(PROGRAM_ID)d_count FROM program WHERE DEPT_ID = $d_row->DEPT_ID")->row();
	                            				$prog_C = $this->db->query("SELECT PROGRAM_ID, PROGRAM_NAME, TOTAL_SEMISTER, DURATION
																			FROM program
																			WHERE DEPT_ID = $d_row->DEPT_ID")->result();
	                            				echo "<td rowspan=".$dept_count->d_count.">".$d_row->DEPT_NAME."</td>";
		                            			foreach ($prog_C as $p_row) {	                            				
		                            				
	                            					$totalS = $this->db->query("SELECT SUM(ac.CREDIT)t_credit FROM aca_semester_course sc INNER JOIN aca_course ac on ac.COURSE_ID = sc.COURSE_ID WHERE sc.PROGRAM_ID = $p_row->PROGRAM_ID")->row();
	                            					$totalFee = $this->db->query("SELECT SUM(AMOUNT)Total_Fee FROM ac_academic_charge_rate WHERE PROGRAM_ID = $p_row->PROGRAM_ID")->row();
		                            				echo "<td>".$p_row->PROGRAM_NAME."</td>";
		                            				echo "<td>".$totalS->t_credit."</td>";
		                            				echo "<td>".$p_row->DURATION."</td>";
		                            				echo "<td>".$p_row->TOTAL_SEMISTER."</td>";
		                            				if($totalFee->Total_Fee){
		                            					echo "<td>".$totalFee->Total_Fee."/-</td>";		                            					
		                            				}else{
		                            					echo "<td></td>";		                            					
		                            				}
		                            				echo "</tr>";
											      
		                            			}
		                            			
	                            			}	
	                            			
	                            		}
	                            	?>
	                            	</tbody>
								</table>                                
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>

        </div>
        <!-- /.widget-inner -->
    </div>
    <!-- /.widget-main -->

</div>