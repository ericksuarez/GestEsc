<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php foreach ($css_files as $file): ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
        <?php endforeach; ?>
        <?php foreach ($js_files as $file): ?>
            <script src="<?php echo $file; ?>"></script>
        <?php endforeach; ?>
        <style type='text/css'>
            body
            {
                font-family: Arial;
                font-size: 14px;
            }
            a {
                color: blue;
                text-decoration: none;
                font-size: 14px;
            }
            a:hover
            {
                text-decoration: underline;
            }
        </style>
    </head>
    <body>
<!--        <div id="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-12">
                        <div class="media">
                            <div class="media-body message">
                                <div class="panel panel-default">-->
                                    <?php echo $output; ?>
<!--                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
    </body>
</html>
