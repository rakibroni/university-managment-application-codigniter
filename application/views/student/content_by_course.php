<?php
if (!empty($content_by_course)) {
    foreach ($content_by_course as $row):
        ?>
        <div class="file-box">
            <div class="file">
                <a href="<?php echo base_url()?>upload/course_content/<?php echo $row->CONTENT_URI?>" target="_blank">
                    <span class="corner"></span>

                    <div class="icon">
                        <i class="<?php $file_parts = pathinfo($row->CONTENT_URI);
                        if ($file_parts["extension"] == "pdf") {
                            echo "fa fa-file-pdf-o";
                        } else if ($file_parts["extension"] == "doc") {
                            echo 'fa fa-file-word-o';
                        } else if ($file_parts["extension"] == "xlsx") {
                            echo 'fa fa-file-excel-o';
                        } else {
                            echo "fa fa-file";
                        }?>"></i>
                    </div>
                    <div class="file-name">
                        <?php echo $row->CONTENT_TITLE ?>
                        <br>
                        <small>Added:  <?php echo date('d-M-Y', strtotime($row->CREATE_DATE)) ?></small>
                        <i class="fa fa-download pull-right"></i>
                    </div>
                </a>

            </div>

        </div>

    <?php
    endforeach;
} else {
    echo "No content available";
}
?>
<div class="clearfix"></div>
<script>
    $(document).ready(function () {
        $('.file-box').each(function () {
            animationHover(this, 'pulse');
        });
    });
</script>