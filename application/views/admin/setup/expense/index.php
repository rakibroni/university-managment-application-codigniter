
    <form method="post">
        <div class="">
            <div class=" ">
                <div class="ibox-content">
                    <div class="row">
                        <?php $this->load->view("common/faculty_dept_program"); ?>
                    </div>
                    <div class="row"></br>
                        <div class="form-group ">
                            <div class="col-md-5">
                                <span class="modal_msg pull-left"></span>
                                <input type="button" id="searchExpense" class="btn btn-primary btn-sm text-left"
                                       value="Search">
                                <input type="reset" class="btn btn-default btn-sm" value="Reset">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>



            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Particulars Charge List</h5>
                <?php if ($previlages->CREATE == 1) { ?>
                    <div class="ibox-tools">

                        <span title="Create Expense" class="btn btn-primary btn-xs pull-right openModal"
                              data-action="setup/expenseFormInsert"> Add New </span>
                    </div>
                <?php } ?>
                </div>
                <div class="ibox-content" id="particular_list">
                    <div class="table-responsive contentArea">
                        <?php $this->load->view("admin/setup/expense/expense_list"); ?>
                    </div>
                </div>
                <div class="ibox-content" id="particularList">
                    <div class="table-responsive contentArea">
                        <div class="ibox-content" id="particularCharge">
                            <span class="contentArea"></span>
                        </div>
                    </div>
                </div>

            </div>


<script type="text/javascript">
    $(document).on("click", "#searchExpense", function () {
        var faculty, department, program;
        faculty = $("#FACULTY_ID").val();
        department = $("#DEPT_ID").val();
        program = $("#PROGRAM_ID").val();
        if (faculty == '' || department == '' || program == '') {
            if(faculty == ''){
                alert('Faculty select!!');
            }else if(department == ''){
                alert('Department select!!');
            }else if(program == ''){
                alert('Program select!!');
            }
        } else {
            $("#particular_list").hide();
            $("#particularList").show();
            var url = '<?php echo site_url('setup/ajax_get_particular_charge_rate') ?>';
            $.ajax({
                type: "POST",
                url: url,
                data: {faculty: faculty, department: department, program: program},
                dataType: 'html',
                success: function (data) {
                    $('#particularCharge').html(data);
                }
            });
        }
    });
</script>


