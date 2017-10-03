<!DOCTYPE html>
<html>
<head>
    <meta content="text/html; charset=utf-8">
    <link rel="stylesheet" href="<?php echo CSSLIB.'/articole_dual_div.css'; ?>" >
    <link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Mono|Roboto+Condensed" rel="stylesheet">
</head>

<body>
    <?php include TEMPL . "/tpl_header_home_link.php"; ?>
    <?php include TEMPL . "/tpl_header_main_nav.php"; ?>
    <div class = "column-container">
        <div class="col cuprins">
            <?php echo $articoleCardRows ?>
        </div>
        <div class="col main-img-container">
            <?php include TEMPL . "/tpl_page_viewer.php"; ?>
        </div>
    </div>
</body>
</html>