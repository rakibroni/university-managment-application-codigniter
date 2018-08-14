<script language="JavaScript">
    $(function () {
        $(window).on('beforeunload', function () {
            preventDefault();
            alert("");
            return false;
        });
    });
</script>
