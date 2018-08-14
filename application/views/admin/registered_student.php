<div class="row">
    <div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-title">
                <h5>Student List</h5>

                <div class="ibox-tools">
                    <a href="<?php echo base_url(); ?>admin/addRegStu">
                        <button class="btn btn-primary btn-sm" type="button"><i class="fa fa-plus"></i> Add New</button>
                    </a>
                </div>
            </div>
            <div class="ibox-content">
                <table class="table table-responsive">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Program</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Rakib Mostofa</td>
                        <td>01722085398</td>
                        <td>B.sc in CSE</td>
                        <td></td>
                    </tr>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
<div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                        class="sr-only">Close</span></button>
                <h4 class="modal-title"></h4>
                <small class="font-bold"></small>
            </div>
            <div class="modal-body">

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).on("click", ".userModal", function () {
        $("#myModal5").modal();
        var param_value = "";
        var action_type = $(this).attr("data-type");
        var action_uri = $(this).attr("data-action");
        var title = $(this).attr("title");
        if (action_type == "edit") {
            param_value = $(this).attr("id");
        }
        $.ajax({
            type: "post",
            url: "<?php echo site_url(); ?>/" + action_uri,
            data: {param: param_value},
            beforeSend: function () {
                $(".modal-title").html(title);
                $(".modal-body").html("<img src='<?php echo base_url(); ?>assets/img/loader.gif' />");
            },
            success: function (data) {
                $(".modal-body").html(data);
            }
        });
    });
</script>