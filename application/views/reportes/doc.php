
        <div id="exportar">
            <?php echo $print; ?>
        </div>
        
        <?php if($export > 0){?>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="<?php echo base_url() ?>recursos/export/dist/jquery.table2excel.js"></script>
        <script>
            $(document).ready(function () {
                $('#example').removeAttr("class");
                $('#example').removeAttr("width");
                $('#example >tbody >tr >th').removeAttr("class");
                $('#example').removeAttr("id");
                window.open('data:application/vnd.ms-excel,' + $('#exportar').html());
                window.close();
//                window.history.back();
            });
        </script>
        <?php }?>

