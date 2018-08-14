<?php
if (isset($_POST['param'])) {
    $DEPT_id = $_POST['param'];
}
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-4 padding_0">
            <div class="ibox float-e-margins">
                <div class="ibox-content mailbox-content">
                    <div class="file-manager">
                        <div class="space-25"></div>
                        <h5>Program Name</h5>
                        <ul class="folder-list m-b-md padding_0">
                            <?php
                            $program = $this->utilities->findAllByAttribute('program', array('DEPT_ID' => $DEPT_id));

                            foreach ($program as $programInfo) {
                                ?>
                                <li><a href="#"><span class="deg_link pointer"
                                                      id="<?php echo $programInfo->PROGRAM_ID; ?>"><i
                                                class="fa fa-forward"></i> <?php echo $programInfo->PROGRAM_NAME; ?></span></a>
                                </li>
                            <?php
                            }
                            ?>
                        </ul>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 animated fadeInRight">
            <div class="mail-box-header">

                <form method="get" action="" class="pull-right mail-search">
                    <div class="input-group">
                        <input type="text" class="form-control input-sm prog_value" name="search"
                               placeholder="Search for course offer">

                        <div class="input-group-btn">
                            <button type="submit" class="btn btn-sm btn-success">
                                Search
                            </button>
                        </div>
                    </div>
                </form>
                <h2>
                    &nbsp;
                </h2>

            </div>
            <div class="mail-box">
                <table class="table table-hover table-mail">
                    <tbody class="common_program">
                    <?php
                    //$couOffList = $this->utilities->findAllByAttribute('course_offer', array('PROGRAM_ID' => $program_id));
                    //var_dump($couOffList);
                    /*
                      foreach ($couOffList as $couOffInfo) {
                      ?>
                      <tr class="read">
                      <td class="prog_info" id="<?php echo $couOffInfo->OFFERED_COURSE_ID; ?>"><span class="openModal" title="Course Offer of Program" id="<?php echo $couOffInfo->OFFERED_COURSE_ID; ?>" data-action="portal/applyProg" data-type="edit"><a href="#"><?php echo $couOffInfo->OFFERED_COURSE_ID; ?></a></span></td>
                      <td class="text-right"><span class="label label-warning pull-right openModal" title="Course Offer of Program" id="<?php echo $couOffInfo->OFFERED_COURSE_ID; ?>" data-action="portal/applyProg" data-type="edit">Details</span></td>
                      </tr>
                      <?php
                      }
                     *
                     */
                    ?>
                    <tr class="read">
                        <td class="prog_info">
                            <a href="admissionForm"><?php echo 'B.sc Computer Science'//echo $couOffInfo->OFFERED_COURSE_ID; ?></a>
                        </td>
                        <td class="text-right"><a href="admissionForm">Apply Now</a></td>
                    </tr>
                    </tbody>
                    <tbody class="search_prog">

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        $(".prog_value").keyup(function () {
            var find_prog = $('.prog_value').val();

            if (find_prog.length > 2) {

                $('.common_program').hide();
                $('.search_prog').show();
                $.ajax({
                    type: "POST",
                    url: "searchProg",
                    data: 'find_prog=' + find_prog,
                    success: function (result) {
                        $(".search_prog").html(result);
                    }
                });
            } else {
                $('.common_program').show();
                $('.search_prog').hide();
            }
        });
        $(document).on("click", ".deg_link", function () {
            var thisValue = $(this);
            var find_deg_program = thisValue.attr("id");
            $.ajax({
                type: "POST",
                url: "searchProg",
                data: "find_deg_program=" + find_deg_program,
                success: function (result) {
                    $(".common_program").html(result);
                }
            });
        });
        /*
         $(document).on("click", ".prog_info", function () {
         var thisValue = $(this);
         var prog_info = thisValue.attr("id");
         });
         */
    });

</script>
