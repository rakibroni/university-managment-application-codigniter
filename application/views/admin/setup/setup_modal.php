<div class="block-flat">
    <div class="header">
        <h3>Add Group </h3>
    </div>
    <div class="content">
        <div class="msg">
            <?php
            if (validation_errors() != false) {
                echo "<div class='alert alert-danger'>";
                echo validation_errors();
                echo "</div>";
            }
            ?>
        </div>
        <?php echo form_open('', array('class' => 'form-horizontal')); ?>
        <div class="form-group">
            <label class="col-sm-3 control-label">Group Name</label>

            <div class="col-sm-5">
                <?php echo form_input('GRP_NAME', '', 'class ="form-control" id = "country"'); ?>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-10">
                <button type="submit" class="btn btn-primary">Save</button>
                <button type="reset" class="btn btn-default">Reset</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {

    });
</script>