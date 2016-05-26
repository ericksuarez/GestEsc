<?php
/*
 * Para las fucniones de CRUD para cad tipo de usurio.
 */
$uri = $this->uri->segment(1, 0);
?>
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading"><?php echo $tags["titulo"] ?></div>
    <div class="panel-body">

        <table id="example" class="table table-bordered table-condensed" width="100%">
            <thead>
                <tr>
                    <?php foreach ($tags["field"] as $key => $value) { ?>
                        <th><?php echo $value ?></th>
                    <?php } ?>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($lista as $key => $value) {
                    $cnt = 0;
                    ?>
                    <tr>
                                <?php foreach ($lista[$key] as $index => $val) { ?>
                            <th class="text-center capitalize"><b><?php echo $val ?></b></th>
                    <?php } ?>
                    </tr>
                    <?php } ?>
            </tbody>
        </table>
    </div>
</div>

