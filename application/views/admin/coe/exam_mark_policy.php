<style>
    #multi-select {
        overflow: auto;
        border: 1px solid #ccc;
    }

    #multi-select h1 {
        margin: 0;
        font-size: 11px;
        border-right: 1px solid #ccc;
        background: -moz-linear-gradient(center top, #F7F7F7 0%, #E6E6E6 100%) repeat scroll 0 0 rgba(0, 0, 0, 0);
        padding: 5px;
    }

    #selectable .ui-selecting {
        background: #FECA40;
    }

    #selectable .ui-selected {
        background: #F39814;
        color: white;
    }

    #selectable, #selectable-target {
        list-style-type: none;
        margin: 0;
        padding: 0;
        height: 300px;
        overflow: auto;
        background: #fff;
        border-right: 1px solid #ccc;
    }

    #selectable li, #selectable-target li {
        padding: 0.4em;
        font-size: 11px;
        border-bottom: 1px solid #e3e3e3;
    }

    .ui-widget-content {
        box-shadow: none;
    }

    #selectable .ui-selected, #selectable .ui-selecting, #selectable-target .ui-selected, #selectable-target .ui-selecting {
        background: #5899C4;
        color: #fff;
    }

    #selectable-target {
        border-radius: 3px;
        height: 300px;
        border-left: 1px solid #ccc;
        border-right: 0;
    }

    #multi-select-btn {
        margin-top: 70px;
    }

    #multi-select-btn .iconb {
        font-size: 14px;
        width: 30px;
        margin-bottom: 5px;
    }
    .select2-container{width:100% !important;}
</style>
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>View All Exam Schedule</h5>
        <div class="ibox-tools">
            <a class="btn btn-primary btn-sm addModule" data-toggle="modal" href="#modal_window"
               data-hid="<?php //echo $careProvider->ORG_ID; ?>">Add New</a>
        </div>
    </div>
    <div class="ibox-content">
        <div class="table-responsive ">
            <table class="table table-striped table-bordered table-hover gridTable ">
                <thead>
                <tr>

                    <th>Marks Type</th>
                    <th>Percentage</th>
                    <th>Program</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($exam_marks_policy as $row): ?>

                    <tr class="gradeX" id="row_<?php //echo $row->EX_SC_ID; ?>">

                        <td><?php echo $row->LKP_NAME ?></td>
                        <td><?php echo $row->MARK_PERCENT ?></td>
                        <td><?php echo $row->PROGRAM_NAME ?></td>
                        <td>
                            <a class="btn btn-primary btn-sm editModule" data-id="<?php echo $row->M_POLICY_ID ?>" data-toggle="modal" href="#modal_window"class="label label-default"><i class="fa fa-pencil"></i>
                            </a>
                        </td>

                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

<div id="modal_window" class="modal fade" role="dialog" aria-labelledby="">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
        <div class="modal-header"><h3>Distribute Marks</h3> </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>
    $(document).on("click", ".editModule", function () {

        var id = $(this).attr('data-id');

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('coe/editMarkPolicy'); ?>",
            data: {id: id},
            beforeSend: function () {
            },
            success: function (data) {
                $("#modal_window .modal-body").html(data);
                $("#selectable").selectable({
                    stop: function (event, ui) {
                        var result = $("#multi-select-add-single-ids").empty();
                        $(".ui-selected", this).each(function () {
                            result.append("<input type='hidden' name='add_selected_single_id[]' value='" + $(this).attr("id") + "' />");
                            result.append("<input type='hidden' name='add_selected_single_name[]' value='" + $(this).attr("title") + "' />");

                        });
                    }
                });
                $(".select2Dropdown").select2({
                    theme: "classic"
                });
            }
        });
    });

</script>