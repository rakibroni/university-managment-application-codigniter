<div class="block-flat">

    <form class="form-horizontal" id="degree" method="post">
        <div class="form-group">
            <label class="col-sm-3 control-label">Degree</label>

            <div class="col-sm-6">
                <select name="faculty_id" id="" class="form-control">
                    <option value="">select</option>
                    <?php foreach ($degree as $row) { ?>
                        <option value="<?php echo $row->DEGREE_ID ?>"><?php echo $row->DEGREE_NAME ?></option>
                    <?php } ?>
                </select>
            </div>

        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Department</label>

            <div class="col-sm-6">
                <select name="faculty_id" id="" class="form-control">
                    <option value="">select</option>
                    <?php foreach ($department as $row) { ?>
                        <option value="<?php echo $row->DEPT_ID ?>"><?php echo $row->DEPT_NAME ?></option>
                    <?php } ?>
                </select>
            </div>

        </div>
        <!--        <form class="form-horizontal" role="form">-->
        <div class="form-group">
            <label class="col-sm-3 control-label">Program Name</label>

            <div class="col-sm-6">
                <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Name', 'id' => 'Name', 'name' => 'department_full_name', 'value' => set_value('department_full_name'))); ?>
            </div>

        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Semester Per Year</label>

            <div class="col-sm-6">
                <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Name', 'id' => 'Name', 'name' => 'department_short_name', 'value' => set_value('department_short_name'))); ?>
            </div>

        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">Total Semester</label>

            <div class="col-sm-6">
                <?php echo form_input(array('class' => 'form-control', 'placeholder' => 'Name', 'id' => 'Name', 'name' => 'department_short_name', 'value' => set_value('department_short_name'))); ?>
            </div>

        </div>

        <div class="form-group">
            <label class="col-sm-3 control-label">Is Active ?</label>

            <div class="col-sm-6">
                <label class="control-label"> <?php echo form_checkbox('status', '', TRUE); ?> </label>
            </div>
        </div>


        <div class="form-group">
            <div class="col-lg-offset-2 col-lg-10">
                <span class="modal_msg pull-left"></span>
                <input type="submit" id="createModule" class="btn btn-primary" value="submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
        </div>
    </form>
</div>