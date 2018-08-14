<link href="<?php echo base_url(); ?>assets/css/plugins/blueimp/css/blueimp-gallery.min.css" rel="stylesheet">
<style type="text/css">
    .text {
        font-size: 12px;
        line-height: 17px;
        font-family: arial;
    }

    .text.short {
        height: 20px;
        overflow: hidden;
    }

    .text.full {

    }

    .read-more {
        cursor: pointer;
        color: Black;

    }

</style>
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url() ?>assets/css/plugins/dataTables/jquery.dataTables.css">
<link rel="stylesheet" type="text/css"
      href="<?php echo base_url() ?>assets/css/plugins/dataTables/dataTables.responsive.css">


<script type="text/javascript" language="javascript">
    $(document).ready(function () {
        var dataTable = $('#employee-grid').DataTable({
            "responsive": true,   // enable responsive
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: "<?php echo base_url()?>teacher/ajaxDatatableBlogList", // json datasource
                type: "post",  // method  , by default get
                error: function () {  // error handling
                    $(".employee-grid-error").html("");
                    $("#employee-grid").append('<tbody class="employee-grid-error"><tr><th colspan="3">No data found in the server</th></tr></tbody>');
                    $("#employee-grid_processing").css("display", "none");

                }
            }
        });
    });
</script>

<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Blog Post Permission</h5>

        <div class="ibox-tools"></div>
    </div>
    <div class="ibox-content">

        <p>Select all &nbsp;<input type="checkbox" id="select-all"> <span style="color:red;margin-left:20px">Before submit please checked those blog post you want to update.</span>
        </p>

        <form id="post_blog" method="post" action="<?php echo base_url(); ?>teacher/blogPostApprove">

            <input type="submit" class="btn btn-primary pull-right" value="Update">
            <table id="employee-grid" class="table table-striped table-bordered" cellpadding="0" cellspacing="0"
                   border="0" class="display" width="100%">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>                   
                    <th>Banner</th>
                    <th>Content</th>
                    <th>Remark</th>
                    <th>Publish Date</th>
                    <th>Action</th>
                </tr>
                </thead>
            </table>

        </form>
        <div class="clearfix"></div>
    </div>
</div>
<div id="blueimp-gallery" class="blueimp-gallery">
    <div class="slides"></div>
    <h3 class="title"></h3>
    <a class="prev">‹</a>
    <a class="next">›</a>
    <a class="close">×</a>
    <a class="play-pause"></a>
    <ol class="indicator"></ol>
</div>
<script src="<?php echo base_url(); ?>assets/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {

        $(document).on("click", ".read-more", function () {

            //e.preventDefault();

            var $elem = $(this).parent().find(".text");
            if ($elem.hasClass("short")) {
                $(this).text("Click to collapse");
                $elem.removeClass("short").addClass("full");
            }
            else {
                $(this).text("Read More");
                $elem.removeClass("full").addClass("short");
            }
        });
        // Listen for click on toggle checkbox
        $('#select-all').click(function (event) {
            if (this.checked) {
                // Iterate each checkbox
                $(':checkbox').each(function () {
                    this.checked = true;
                });
            } else {
                $(':checkbox').each(function () {
                    this.checked = false;
                });
            }
        });
        $(document).on('submit', '#post_blog', function () {

            if (!$('#post_blog input[type="checkbox"]').is(':checked')) {
                alert("Please cheked the box which you want to update at least one.");
                return false;
            } else {
                if (confirm("Are you sure?")) {
                    return true;
                } else {
                    return false;
                }

            }


        });
    });


</script>