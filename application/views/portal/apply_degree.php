<?php
if (isset($_POST['param'])) {
    $degree_id = $_POST['param'];
}
?>
<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-lg-4 padding_0">
            <div class="ibox float-e-margins">
                <div class="ibox-content mailbox-content">
                    <div class="file-manager">
                        <div class="space-25"></div>
                        <h5>Degree Name</h5>
                        <ul class="folder-list m-b-md padding_0">
                            <?php
                            $degreeList = $this->utilities->findAllByAttribute('degree', array('ACTIVE_STATUS' => 1));
                            foreach ($degreeList as $degreeInfo) {
                                ?>
                                <li><a href="#"><span class="deg_link pointer"
                                                      id="<?php echo $degreeInfo->DEGREE_ID; ?>"><i
                                                class="fa fa-graduation-cap "></i> <?php echo $degreeInfo->DEGREE_NAME; ?></span></a>
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
                               placeholder="Search program">

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
                    $programList = $this->utilities->findAllByAttribute('program', array('DEGREE_ID' => $degree_id));
                    foreach ($programList as $programInfo) {
                        ?>
                        <tr class="read">
                            <td><span class="openModal" title="Course offer of program"
                                      id="<?php echo $programInfo->PROGRAM_ID; ?>" data-action="portal/applyProg"
                                      data-type="edit"><a href="#"><?php echo $programInfo->PROGRAM_NAME; ?></a></span>
                            </td>
                            <td class="text-right"><span class="label label-warning pull-right openModal pointer"
                                                         title="Course offer of program"
                                                         id="<?php echo $programInfo->PROGRAM_ID; ?>"
                                                         data-action="portal/applyProg"
                                                         data-type="edit">Course Offered</span></td>
                        </tr>
                    <?php
                    }
                    ?>
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

        $(document).on("click", ".prog_info", function () {
            var thisValue = $(this);
            var prog_info = thisValue.attr("id");
            alert(prog_info);
        });
    });

</script>
